<?php


namespace Mlp\Cli\Console\Command;

use Mlp\Cli\Helper\CategoriesConstants as Cat;
use Mlp\Cli\Helper\SqlHelper as SqlHelper;
use Braintree\Exception;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Filesystem\DirectoryList;
use Mlp\Cli\Helper\Manufacturer as Manufacturer;
use Mlp\Cli\Helper\splitFile;
use Mlp\Cli\Helper\imagesHelper;
use Mlp\Cli\Helper\LoadCsv;
use Mlp\Cli\Helper\Category;
use Mlp\Cli\Model\ProdutoInterno;
use SqlHelper as GlobalSqlHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;





class Sorefoz extends Command
{

    /**
     * Filter Prodcuts
     */
    const UPDATE_CATEGORIES = 'updata-categories';
    const UPDATE_STOCKS = 'update-stocks';
    const ADD_IMAGES = 'add-images';

    private $directory;

    
    private $productRepository;
    private $state;
    private $produtoInterno;
    private $loadCsv;
    private $imagesHelper;
    private $sorefozCategories;
    private $sqlHelper;
    private $categoryHelper;

    public function __construct(
                                
                                DirectoryList $directory,
                                \Mlp\Cli\Helper\SqlHelper $sqlHelper,
                                \Magento\Framework\App\State $state,
                                \Mlp\Cli\Model\ProdutoInterno $produtoInterno,
                                \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface,
                                LoadCsv $loadCsv,
                                imagesHelper $imagesHelper,
                                \Mlp\Cli\Helper\Sorefoz\SorefozCategories $sorefozCategories,
                                \Mlp\Cli\Helper\Category $categoryHelper)
    {

        $this -> directory = $directory;
        $this->sqlHelper = $sqlHelper;
        $this -> productRepository = $productRepositoryInterface;
        $this -> state = $state;
        $this -> produtoInterno = $produtoInterno;
        $this->loadCsv = $loadCsv;
        $this->imagesHelper = $imagesHelper;
        $this->sorefozCategories = $sorefozCategories;
        $this->categoryHelper = $categoryHelper;

        parent ::__construct();
    }

    protected function configure()
    {
        $this -> setName('Mlp:Sorefoz')
            -> setDescription('Manage Sorefoz Products')
            -> setDefinition([
                new InputOption(
                    self::UPDATE_CATEGORIES,
                    '-c',
                    InputOption::VALUE_NONE,
                    'Add new Products'
                ),
                new InputOption(
                    self::UPDATE_STOCKS,
                    '-u',
                    InputOption::VALUE_NONE,
                    'Update Sorefoz Products'
                ),
                new InputOption(
                    self::ADD_IMAGES,
                    '-i',
                    InputOption::VALUE_NONE,
                    'Add images to products'
                )
            ])->addArgument('categories', InputArgument::OPTIONAL, 'Categories?');
        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this -> state -> setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);
        $categories = $input->getArgument('categories');
        $addProducts = $input -> getOption(self::UPDATE_CATEGORIES);
        if ($addProducts) {
            $this->updateProductCategories($categories);
        }
        $updateStocks = $input -> getOption(self::UPDATE_STOCKS);
        if ($updateStocks) {
            $this -> updateSorefozProducts();
        }
        $addImages = $input->getOption(self::ADD_IMAGES);
        if($addImages) {
            $this->addImages($categories);
        }
        else {
            throw new \InvalidArgumentException('Option  is missing.');
        }
    }


    protected function updateProductCategories(){
        //Se precisarmos de alterar as categorias basta mudar o fichero sorefozCategories.php e executar este comando
        $writer = new \Zend\Log\Writer\Stream($this -> directory -> getRoot() . '/var/log/Sorefoz.log');
        $logger = new \Zend\Log\Logger();
        $logger -> addWriter($writer);
        print_r("Updating Sorefoz Categories" . "\n");
        $this->getCsvFromFTP($logger);
        $row = 0;
        foreach ($this -> loadCsv -> loadCsv('/Sorefoz/tot_jlcb_utf.csv', ";") as $data) {
            $sku = trim($data[18]);
            $name = trim($data[1]);
            print_r($row++." - ".$sku." - \n");
            //É para entrar??
            if ($this->notValidProduct($data)){
                print_r("not valid\n");
                continue;
            } 
            if (in_array(strlen($sku),[11,12,13])) {
                try {
                    [$gama,$familia,$subFamilia] =  $this->sorefozCategories
                        ->getCategories(trim($data[5]),trim($data[7]),trim($data[9]),
                                        $logger,$sku,$name);        
                    
                    $product = $this->productRepository->get($sku, true, null, true);
                    $this->produtoInterno->setCategories($product, $logger, $gama,$familia,$subFamilia);
                }catch (NoSuchEntityException $e){
                    print_r("Produto ainda não existe\n");
                }catch (Exception $e) {
                    print_r("ERRO: ".$e->getMessage()."\n");
                    $logger->info(Cat::ERROR_GET_CATEGORIAS.$this->produtoInterno->sku);
                }
                
            }
        }
    }

    
    protected function updateSorefozProducts()
    {
        $writer = new \Zend\Log\Writer\Stream($this -> directory -> getRoot() . '/var/log/Sorefoz.log');
        $logger = new \Zend\Log\Logger();
        $logger -> addWriter($writer);
        print_r("Updating Sorefoz products" . "\n");
        //$this->getCsvFromFTP($logger);
        $row = 0;

        $statusAttributeId = $this->sqlHelper->sqlGetAttributeId('status');
        $priceAttributeId = $this->sqlHelper->sqlGetAttributeId('price');

        foreach ($this -> loadCsv -> loadCsv('/Sorefoz/tot_jlcb_utf.csv', ";") as $data) {
            $sku = trim($data[18]);
            print_r($row++." - ".$sku." - ");
            //É para entrar??
            if ($this->notValidProduct($data)){
                print_r("not valid\n");
                continue;
            } 
            //Update status sql
            if (in_array(strlen($sku),[11,12,13])) {
                if ($this->sqlHelper->sqlUpdateStatus($sku,$statusAttributeId[0]["attribute_id"])){
                    //update price anda stock
                    $price = $this->produtoInterno->getPrice((int)str_replace(".", "", $data[12]),
                                                        $logger,$sku);
                    if ($price == 0){
                        print_r(" price 0\n");
                        $logger->info(Cat::ERROR_PRICE_ZERO.$sku);
                        continue;
                    }
                    $this->sqlHelper->sqlUpdatePrice($sku,$priceAttributeId[0]["attribute_id"],$price);
                    $this->produtoInterno->sku = $sku;
                    $this->produtoInterno->stock = $this->getStock($data[29]);    
                    $this->produtoInterno->setStock($logger,"sorefoz");
                    print_r("updated - stock\n");
                }else {
                    //Add Product
                    print_r("Not found - Add Product - ");
                    if (!$this->setSorefozData($data,$logger)){
                        print_r("\n");
                        continue;
                    }
                    $this->produtoInterno -> add_product($logger, $this->produtoInterno->sku);
                    print_r("\n");
                }
            } else {
                print_r("Sku invalido\n");
                $logger->info(Cat::ERROR_WRONG_SKU.$sku." : name: ".$data[1]);
            }
        }
    }

    private function getStock($stock) {
        if (preg_match("/sim/i",$stock) == 1){
            return 3;
        }else {
            return 0;
        }
    }

    


    public function setSorefozData($data,$logger) {
        //Tirar os espaços em branco
        $functionTim = function ($el){
            return trim($el);
        };
        $data = array_map($functionTim,$data);

        $this->produtoInterno->sku = $data[18];
        $this->produtoInterno->name = $data[1];
        
        $stock = $this->getStock($data[29]);
        
        $this->produtoInterno->status = Status::STATUS_ENABLED;
        $this->produtoInterno->stock = $stock;
        $this->produtoInterno->price = ceil((float)trim($data[12]));
        $this->produtoInterno->setStock($logger,"sorefoz");
       
        if($this->produtoInterno->price == 0){
            //Se o preço for 0 desativar produto e ver o que se passa
            $logger->info(Cat::ERROR_PRICE_ZERO.$this->produtoInterno->sku);
            $this->produtoInterno->status = 2;
        }

        try {
            [$gama,$familia,$subFamilia] =  $this->sorefozCategories
                ->getCategories(trim($data[5]),trim($data[7]),trim($data[9]),
                                $logger,$this->produtoInterno->sku,$this->produtoInterno->name);        
        }catch (Exception $e) {
            $logger->info(Cat::ERROR_GET_CATEGORIAS.$this->produtoInterno->sku);
            return 0;
        }
        
        
        $this->produtoInterno->gama = $gama;
        $this->produtoInterno->familia = $familia;
        $this->produtoInterno->subFamilia = $subFamilia;
        $this->produtoInterno->description = $data[25];
        $this->produtoInterno->meta_description = $data[24];
        $this->produtoInterno->manufacturer = Manufacturer::getSorefozManufacturer($data[3]);
        $this->produtoInterno->length = (int)$data[20];
        $this->produtoInterno->width = (int)$data[21];
        $this->produtoInterno->height = (int)$data[22];
        $this->produtoInterno->weight = (int)$data[19];
        $this->produtoInterno->price = $this->produtoInterno->getPrice((int)str_replace(".", "", $data[12]),
                                        $logger,$this->produtoInterno->sku);
        $this->produtoInterno->image = $data[24];
        $this->produtoInterno->classeEnergetica = $data[27];
        $this->produtoInterno->imageEnergetica = $data[28];
        $this->produtoInterno->stock = $stock;
        return 1;
        
    }

    
    private function addImages($categoriesFilter) 
    {
        $writer = new \Zend\Log\Writer\Stream($this->directory->getRoot().'/var/log/Sorefoz.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $row = 0;
        foreach ($this->loadCsv->loadCsv('/Sorefoz/tot_jlcb_utf.csv',";") as $data) {
            $row++;
            print_r($row." - ");
            $this->setSorefozData($data,$logger);
            if (!in_array(strlen($this->produtoInterno->sku),[11,12,13])) {
                print_r("invalid sku - \n");
                continue;
            }
            try {
                print_r($this->produtoInterno->sku);
                $product = $this -> productRepository -> get($this->produtoInterno->sku, true, null, true);
                //Ver se o produto tem imagem senão tiver adicionar.
                $this->produtoInterno->updateProductImages($product, $logger, $this->produtoInterno->sku, 
                    $this->produtoInterno->image, $this->produtoInterno->imageEnergetica);
                $this->productRepository->save($product);
                if($this->produtoInterno->classeEnergetica){
                    $this->produtoInterno->setClasseEnergetica($product);
                }
                print_r("\n");
            } catch (\Exception $exception) {
                print_r($exception->getMessage().PHP_EOL);
            }
        }
    }

    private function getCsvFromFTP($logger) {
        $file = 'tot_jlcb.csv';
        $local_file = $this->directory->getRoot()."/app/code/Mlp/Cli/Csv/Sorefoz/".$file;
        // set up basic connection
        $conn_id = ftp_connect('www.sorefoz.pt');

        // login with username and password
        if (ftp_login($conn_id, 'loj0078', 'nyvt64#')){
            ftp_pasv($conn_id, true);
            if (ftp_get($conn_id, $local_file, $file)) {
                print_r( "Successfully written to $local_file\n");
            } else {
                print_r("ftp_get problem\n");
            }
        } else {
            print_r("ftp_login Connection problem\n");
        }

        // try to download $server_file and save to $local_file
        

        // close the connection
        ftp_close($conn_id);

        $local_utf_file = $this->directory->getRoot()."/app/code/Mlp/Cli/Csv/Sorefoz/tot_jlcb_utf.csv";
        
        //Convet to csv to UTF-8
        $in = fopen($local_file, "r");
        $out = fopen($local_utf_file, "w+");

        $start = microtime(true);

        while(($line = fgets($in)) !== false) {
            $converted = iconv("ISO-8859-1","UTF-8",$line);
            fwrite($out, $converted);
        }

        $elapsed = microtime(true) - $start;
        print_r("Iconv took $elapsed seconds\n");
    }

    private function notValidProduct($data) {
        switch(trim($data[5])){
            case 'ACESSÓRIOS E BATERIAS':
                return true;
            case 'GRANDES DOMÉSTICOS':
                if (strcmp(trim($data[7]),"ACESSORIOS ENCASTRE")==0){
                    return true;
                }
            case 'IMAGEM E SOM':
                switch (trim($data[7])) {
                    case 'DVD /BLURAY /TDT':
                        return true;
                    case 'CÂMARAS':
                        return true;
                    case 'TELEVISÃO':
                        switch (trim($data[9])){
                            case 'TV LCD 32"':
                            case 'TV 4x3 DE 29" STEREO':
                            case 'TV 16x9 DE 32"':
                            case 'TV LCD 37"':
                            case 'TV LCD 32"':
                                return true;
                            default:
                                return false;
                        }
                    default:
                        return false;
                }
            case 'ENCASTRE':
                switch ($data[7]) {
                    case 'OUTROS EQUIPAMENTOS ENC':
                        return true;
                    default:
                        return false;
                }  
            default:
                return false;
        }
    }
}

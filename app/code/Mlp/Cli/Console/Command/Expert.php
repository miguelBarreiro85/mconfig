<?php


namespace Mlp\Cli\Console\Command;

use Magento\Catalog\Model\Product\Attribute\Source\Status;
use \Mlp\Cli\Helper\Category as CategoryManager;
use \Mlp\Cli\Helper\Expert\ExpertCategories;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Filesystem\DirectoryList;
use Symfony\Component\Console\Command\Command;
use Mlp\Cli\Helper\imagesHelper as ImagesHelper;
use Symfony\Component\Console\Input\InputOption;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Mlp\Cli\Helper\CategoriesConstants as Cat;
use Mlp\Cli\Helper\Manufacturer as Manufacturer;
use Mlp\Cli\Helper\SqlHelper as SqlHelper;
class Expert extends Command
{

    /**
     * Filter Prodcuts
     */
    const UPDATE_PRODUCTS = 'update-products';
    const ADD_IMAGES = 'add-images';
    const UPDATE_CATEGORIES = 'update-categories';
    

    private $directory;
    
    private $productRepository;
    private $state;
    private $produtoInterno;
    private $loadCsv;
    private $imagesHelper;
    private $sqlHelper;

    public function __construct(DirectoryList $directory,
                                \Mlp\Cli\Helper\SqlHelper $sqlHelper,
                                \Magento\Framework\App\State $state,
                                \Mlp\Cli\Model\ProdutoInterno $productoInterno,
                                \Mlp\Cli\Helper\LoadCsv $loadCsv,
                                \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
                                \Mlp\Cli\Helper\imagesHelper $imagesHelper){

        $this->directory = $directory;
        $this->sqlHelper = $sqlHelper;
        $this->state = $state;
        $this->produtoInterno = $productoInterno;
        $this->loadCsv = $loadCsv;
        $this->productRepository = $productRepository;
        $this->imagesHelper = $imagesHelper;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('Mlp:Expert')
            ->setDescription('Manage Expert csv')
            ->setDefinition([
              
                new InputOption(
                    self::UPDATE_PRODUCTS,
                    '-u',
                    InputOption::VALUE_NONE,
                    'Update Products'
                ),
                new InputOption(
                    self::ADD_IMAGES,
                    '-i',
                    InputOption::VALUE_NONE,
                    'Add Images'
                ),
                new InputOption(
                    self::UPDATE_CATEGORIES,
                    '-c',
                    InputOption::VALUE_NONE,
                    'Update Categories'
                )
            ])->addArgument('categories', InputArgument::OPTIONAL, 'Categories?');
        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $writer = new \Zend\Log\Writer\Stream($this->directory->getRoot().'/var/log/Expert.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);

        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);
        $categories = $input->getArgument('categories');   
        $updateProducts = $input->getOption(self::UPDATE_PRODUCTS);
        if ($updateProducts){
            $this->updateProducts($logger,$categories);
        }
        $addImages = $input->getOption(self::ADD_IMAGES);
        if ($addImages) {
            $this->addImages($logger);
        }
        $updateCategories = $input->getOption(self::UPDATE_CATEGORIES);
        if ($updateCategories) {
            $this->updateProductCategories($logger);
        }
        else {
            throw new \InvalidArgumentException('Option is missing.');
        }
    }


    protected function updateProductCategories($logger){
        //Se precisarmos de alterar as categorias basta mudar o fichero expertCategories.php e executar este comando
        $writer = new \Zend\Log\Writer\Stream($this -> directory -> getRoot() . '/var/log/Sorefoz.log');
        $logger = new \Zend\Log\Logger();
        $logger -> addWriter($writer);
        print_r("Updating Expert Categories" . "\n");
        //$this->getCsvFromFTP($logger);
        $row = 0;
        foreach ($this -> loadCsv -> loadCsv('/Expert/Expert.csv', ";") as $data) {
            $sku = trim($data[1]);
            $name = trim($data[5]);
            print_r($row++." - ".$sku." - \n");
            //É para entrar??
            if ($this->notValidProduct($data[2])){
                print_r("not valid\n");
                continue;
            } 
            if (in_array(strlen($sku),[11,12,13])) {
                try {
                    [$gama,$familia,$subFamilia] =  ExpertCategories::setExpertCategories(trim($data[2]),$logger,$sku,$data[15], trim($data[5]));        
                    $product = $this->productRepository->get($sku, true, null, true);
                    $this->produtoInterno->setCategories($product, $logger, $gama,$familia,$subFamilia);
                }catch (\Exception $e) {
                    print_r("ERRO: ".$e->getMessage()."\n");
                    $logger->info(Cat::ERROR_UPDATE_CATEGORIES.$this->produtoInterno->sku);
                }
                
            }
        }
    }
    protected function updateProducts($logger, $categoriesFilter = null){
        print_r("Getting Csv\n");
        //$this->downloadCsv($logger);
        print_r("Updating Expert products" . "\n");
        $row = 0;
        $statusAttributeId = $this->sqlHelper->sqlGetAttributeId('status');
        $priceAttributeId = $this->sqlHelper->sqlGetAttributeId('price');

        foreach ($this -> loadCsv -> loadCsv('/Expert/Expert.csv', ";") as $data) {
            //Update status sql
            $sku = trim($data[1]);
            print_r($row++." - ".$sku." - ");
            if (in_array(strlen($sku),[11,12,13])){
                if ($this->sqlHelper->sqlUpdateStatus($sku,$statusAttributeId[0]["attribute_id"])){
                    //update price anda stock
                    $price = $this->produtoInterno->getPrice((int)trim($data[7]),$logger,$sku);
                    if ($price == 0){
                        print_r(" price 0\n");
                        $logger->info(Cat::ERROR_PRICE_ZERO.$sku);
                        continue;
                    }
                    $this->sqlHelper->sqlUpdatePrice($sku,$priceAttributeId[0]["attribute_id"],$price);
                    $this->produtoInterno->sku = $sku;
                    $this->setStock($data[16]);    
                    $this->produtoInterno->setStock($logger,"expert");
                    print_r("updated - stock\n");
                }else {
                    //Add Product
                    print_r("Not found - Set data new product - ");
                    //notValidProduct
                    if ($this->notValidProduct($data[2])) {
                        print_r(" not valid product\n");
                        continue;
                    }
                    if (!$this->setData($data,$logger)){
                        print_r(" - ERROR WITH DATA\n");
                        continue;
                    }
                    print_r("add product - ");
                    $this->produtoInterno -> add_product($logger, $this->produtoInterno->sku);
                    print_r("\n");
                    
                }
            } else {
                print_r("Sku invalido\n");
                $logger->info(Cat::ERROR_WRONG_SKU.$sku);
            }
        }



    }

    private function downloadCsv($logger){
        print_r("ok\nDownloading new Csv\n");
        $ch = curl_init("https://experteletro.pt/webservice.php?key=42b91123-75ba-11ea-8026-a4bf011b03ee&pass=bWlndWVs");
        $fp = fopen($this->directory->getRoot()."/app/code/Mlp/Cli/Csv/Expert/Expert.csv", 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,0);
        curl_setopt($ch,CURLOPT_TIMEOUT,0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if (curl_exec($ch)){
            print_r("OK\n");
            curl_close($ch);
            fclose($fp);
        }else {
            print_r("Download Error");
            $logger->info(Cat::ERROR_DOWNLOAD_CSV);
            unlink($this->directory->getRoot()."/app/code/Mlp/Cli/Csv/Expert/Expert.csv");
        }
    }

    private function setStock($stock){
        if (preg_match("/Disponivel/i",$stock) == 1){
            $this->produtoInterno->stock = 3;
            $this->produtoInterno->status = Status::STATUS_ENABLED;
        }else {
            $this->produtoInterno->stock = 0;
            $this->produtoInterno->status = Status::STATUS_DISABLED;
        }
    }

    private function setData($data,$logger)
    {
        /*
        0 - Referencia
        1 - EAN
        2 - familia
        3 - PArt
        4 - Marca
        5 - Nome
        6 - caracteristicas
        7 - Preço custo
        8 - reducao
        9 - preço comercial
        10 - Atualização
        11 - Resumo
        12 - Atributos
        13 - imagens
        14 - galeria
        15 - filtros
        16 - disponibilidade
        17 - expert url
        18 - eficienciaenergetica
        19 - eficienciaenergeticaimg
        19 - fichaue
        20 - desenhostec
        21 - criacao
         */
        $functionTim = function ($data){
            return trim($data);
        };
    
        $data = array_map($functionTim,$data);
        
        $this->produtoInterno->sku = $data[1];
        $this->produtoInterno->manufacturer = $data[4];
        $this->produtoInterno->price = $this->produtoInterno->getPrice((int)trim($data[7]),$logger,$this->produtoInterno->sku);

        
        $this->setStock($data[16]);
        if($this->produtoInterno->price == 0){
            print_r(" - price 0 - ");
            $logger->info(Cat::ERROR_PRICE_ZERO.$this->produtoInterno->sku);
            return  0;
        }

        if($this->produtoInterno->stock == 0){
            print_r(" - NO STOCK - ");
            return 0;
        }

        $this->produtoInterno->name = $data[5];
        $this->produtoInterno->description = $data[6];
        $this->produtoInterno->meta_description = $data[6];
        
        $this->produtoInterno->length = null;
        $this->produtoInterno->width = null;
        $this->produtoInterno->height = null;
        $this->produtoInterno->weight = null;
        $this->produtoInterno->image = $data[13];
        $this->produtoInterno->classeEnergetica = $data[18];
        $this->produtoInterno->imageEnergetica = $data[19];

        
        
        
        [$this->produtoInterno->gama,$this->produtoInterno->familia,
            $this->produtoInterno->subFamilia] = ExpertCategories::setExpertCategories($data[2],$logger,
                                                            $this->produtoInterno->sku,$data[15],$this->produtoInterno->name);
        
        return 1;
    }

    private function notValidProduct($categories) {
        $pieces = explode("->",$categories);
            $gama = $pieces[0];
            $familia = $pieces[1];
            $subFamilia = $pieces[2];
        switch ($gama) {
            case "Audiovisual":
                switch ($familia) {
                    case 'TV':
                        switch ($subFamilia) {
                            case 'Acessórios':
                            case 'Cabos':
                                return true;
                                break;
                            default:
                                return false;
                        }
                    case 'Sistema Áudio':
                        switch ($subFamilia) {
                            case 'Acessórios':
                            case 'Electrónica Auto':
                            case 'Jukebox':
                                return true;
                            default:
                                return false;
                        }
                    case 'Leitores e Gravadores':
                        return true;
                    default:
                        return false;
                        break;
                }
            case "Climatização":
                switch ($subFamilia) {
                    case 'Acessórios':
                    case 'Consumíveis':
                        return true;
                    default:
                        return false;
                }
            case "Comunicações":
                switch ($subFamilia) {
                    case 'Telemóveis':
                    case 'Smartwatches':
                        return false;
                    default:
                        return true;
                }
            case 'Energia':
            case 'Expert':
            case 'Foto e Vídeo':
            case 'Impressoras':
                return true;

            case "Eletrodomésticos":
                switch ($familia) {
                    case 'Encastre':
                        switch ($subFamilia) {
                            case 'Acessórios':
                            case 'Consumíveis':
                            case 'Torneiras':
                                return true;
                            default:
                                return false;
                        }
                    case 'Frio':
                        switch ($subFamilia) {
                            case 'Acessórios':
                            case 'Câmara de Maturação':
                            case 'Consumíveis':
                                return true;
                            default:
                                return false;
                        }
                    case 'Máquina Lavar Loiça':
                        switch ($subFamilia) {
                            case 'Acessórios':
                            case 'Consumíveis':
                                return true;
                            default:
                                return false;
                        }
                    case 'Máquinas de Roupa':
                        switch ($subFamilia) {
                            case 'Acessórios':
                            case 'Consumíveis':
                                return true;
                            default:
                                return false;
                        }
                    case 'Fogão':
                    default:
                        return false;
                }

            case 'Informática':
                switch ($subFamilia) {
                    case 'Notebooks':
                    case 'Tablets':
                        return false;
                    default:
                        return true;
                }
            case 'Pequenos Domésticos':
                switch ($subFamilia) {
                    case 'Acessórios e Peças':
                    case 'Consumíveis':
                    case 'Fun Cooking e Diversos':
                    case 'Puericultura':
                    case 'Acessórios':
                    case 'Outros':
                    case 'Sacos':
                        return true;
                    default:
                        return false;
                }
            default:
                return false;
                
            }
    }
    private function addImages($logger) 
    {
        $row = 0;
        foreach ($this->loadCsv->loadCsv('/Expert/Expert.csv',";") as $data) {
            $row++;
            $sku = trim($data[1]);
            print_r($row." - ");
            $this->setData($data,$logger);
            if (in_array(strlen($sku),[11,12,13])){
                print_r("invalid sku - \n");
                continue;
            }
            try {
                print_r($this->produtoInterno->sku);
                $product = $this -> productRepository -> get($this->produtoInterno->sku, true, null, true);
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
}


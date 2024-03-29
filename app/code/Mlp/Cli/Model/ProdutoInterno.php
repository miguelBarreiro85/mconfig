<?php
/**
 * Created by PhpStorm.
 * User: miguel
 * Date: 19-03-2019
 * Time: 10:10
 */

namespace Mlp\Cli\Model;

use Magento\Catalog\Api\Data\ProductInterface;
use Mlp\Cli\Helper\CategoriesConstants as Cat;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product\Media\Config;
use Magento\Catalog\Model\Product\OptionFactory;
use Magento\Catalog\Model\ProductFactory as ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Validation\ValidationException;
use \Mlp\Cli\Helper\Category as CategoryManager;
use \Mlp\Cli\Helper\Data as DataAttributeOptions;
use \Mlp\Cli\Helper\Attribute as Attribute;
use Mlp\Cli\Helper\Expert\ExpertCategories;
use \Mlp\Cli\Helper\ProductOptions as ProductOptions;
use \Magento\Catalog\Api\CategoryLinkManagementInterface;
use Magento\Catalog\Model\CategoryLinkManagement;

class ProdutoInterno
{
    //atributos
    public $sku;
    public $name;
    public $gama;
    public $familia;
    public $subFamilia;
    public $description;
    public $meta_description;
    public $manufacturer;
    public $length;
    public $width;
    public $height;
    public $weight;
    public $price;
    public $status;
    public $image;
    public $classeEnergetica;
    public $imageEnergetica;
    public $stock;
    //stock
    //Classes
    private $productFactory;
    private $categoryManager;
    private $dataAttributeOptions;
    private $attributeManager;
    private $config;
    private $optionFactory;
    private $productRepositoryInterface;
    private $directory;
    private $filterGroupBuilder;
    private $sourceItemRepositoryI;
    private $sourceItemIF;
    private $searchCriteriaBuilder;
    private $sourceItemSaveI;
    private $filterBuilder;
    private $imagesHelper;
    private $productResource;
    private $productOptions;
    private $registry;
    private $categoryLinkManagement;

    public function __construct(\Magento\Framework\Registry $registry,
                                ProductFactory $productFactory,
                                CategoryManager $categoryManager,
                                DataAttributeOptions $dataAttributeOptions,
                                Attribute $attributeManager,
                                Config $config,
                                OptionFactory $optionFactory,
                                ProductRepositoryInterface $productRepositoryInterface,
                                 \Magento\Catalog\Model\ResourceModel\Product $productResource,
                                \Magento\Framework\Filesystem\DirectoryList $directory,
                                 \Magento\Framework\Api\Search\FilterGroupBuilder $filterGroupBuilder,
                                 \Magento\InventoryApi\Api\SourceItemRepositoryInterface $sourceItemRepositoryI,
                                 \Magento\InventoryApi\Api\Data\SourceItemInterfaceFactory $sourceItemIF,
                                 \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
                                 \Magento\InventoryApi\Api\SourceItemsSaveInterface $sourceItemSaveI,
                                 \Magento\Framework\Api\FilterBuilder  $filterBuilder,
                                \Mlp\Cli\Helper\imagesHelper $imagesHelper,
                                \Mlp\Cli\Helper\ProductOptions $productOptions,
                                CategoryLinkManagement $categoryLinkManagement)
    {

        $this->directory = $directory;
        $this->productFactory = $productFactory;
        $this->categoryManager = $categoryManager;
        $this->dataAttributeOptions = $dataAttributeOptions;
        $this->attributeManager = $attributeManager;
        $this->config = $config;
        $this->optionFactory = $optionFactory;
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->sourceItemRepositoryI = $sourceItemRepositoryI;
        $this->sourceItemIF = $sourceItemIF;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sourceItemSaveI = $sourceItemSaveI;
        $this->filterBuilder = $filterBuilder;
        $this->imagesHelper = $imagesHelper;
        $this->productResource = $productResource;
        $this->productOptions = $productOptions;
        $this->registry = $registry;
        $this->categoryLinkManagement = $categoryLinkManagement;
    }

    public function setData($sku, $name, $gama, $familia, $subfamilia,
                            $description, $meta_description, $manufacturer,
                            $length, $width, $height, $weight, $price) {
        $this->sku = $sku;
        $this->name = $name;
        $this->gama = $gama;
        $this->familia = $familia;
        $this->subfamilia = $subfamilia;
        $this->description = $description;
        $this->meta_description = $meta_description;
        $this->manufacturer = $manufacturer;
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->weight = $weight;
        $this->price = $price;

    }

    public function addSpecialAttributesSorefoz(\Magento\Catalog\Model\Product $product,$logger){
        $attributes = $this->attributeManager->getSpecialAttributes($this->gama, $this->familia, $this->subFamilia, $this->description, $this->name);
        if (isset($attributes)){
            foreach ($attributes as $attribute) {
                $product->setCustomAttribute($attribute['code'], $attribute['value']);
                try {
                    $this -> productResource -> saveAttribute($product, $attribute['code']);
                } catch (\Exception $e) {
                    print_r($e->getMessage());
                }
            }
        }
        try {
            //$product->save();
        } catch (\Exception $exception) {
            $logger->info(" - " . $this->sku . " Save product: Exception:  " . $exception->getMessage());
            print_r("- " . $exception->getMessage() . " Save product exception" . "\n");
        }
    }
    
    public function add_product($logger, $imgName) {
        $product = $this->productFactory->create();
        $product->setSku($this->sku);
        $product->setName($this->name);
        $product->setTypeId(\Magento\Catalog\Model\Product\Type::TYPE_SIMPLE);
        //Set Categories
        //[$pGama,$pFamilia,$pSubFamilia] = $this->categoryManager->setCategories($this->gama, $this->familia, $this->subFamilia, $this->name);

        $product->setCustomAttribute('description', $this->description);
        $product->setCustomAttribute('meta_description', $this->meta_description);
        if(strlen($this->manufacturer) != 0){
            try{
                $optionId = $this->dataAttributeOptions->createOrGetId('manufacturer', strval($this->manufacturer));
                $product->setCustomAttribute('manufacturer', $optionId);
            }catch (\Exception $e){
                $logger->info(Cat::ERROR_VERIFICAR_MANUFACTURER.$this->sku);
            }
        } else {
            $logger->info(Cat::ERROR_VERIFICAR_MANUFACTURER.$this->sku);
        }
        $product->setCustomAttribute('ts_dimensions_length', $this->length);
        $product->setCustomAttribute('ts_dimensions_width', $this->width);
        $product->setCustomAttribute('ts_dimensions_height', $this->height);
        $product->setCustomAttribute('tax_class_id', 2); //taxable goods id
        
        $product->setWeight($this->weight);
        $product->setWebsiteIds([1]);
        //$attributeSetId = $this->attributeManager->getAttributeSetId($this->familia, $this->subFamilia);
        //$product->setAttributeSetId($attributeSetId); // Attribute set id
        
        $product->setAttributeSetId(4); //Default

        $product->setVisibility(4); // visibilty of product (catalog / search / catalog, search / Not visible individually)
        $product->setTaxClassId(2); // Tax class id
        $product->setTypeId('simple'); // type of product (simple/virtual/downloadable/configurable)
        $product->setCreatedAt(date("Y/m/d"));
        $product->setCustomAttribute('news_from_date', date("Y/m/d"));
        $this->imagesHelper->getImages($imgName,$this->image,$this->imageEnergetica);
    
        $product->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
        //Preço
        $product->setPrice($this->price);

        //Salvar produto
        try {
            print_r("saving product.. - ");
            //adicionar o atributo eficiencia_energetica
            if (in_array($this->subFamilia, Cat::CATEGORIES_ENERGY_LABEL) || in_array($this->familia, Cat::CATEGORIES_ENERGY_LABEL)) {
                $this->imagesHelper->setImageEtiqueta($product, $logger, $imgName . "_e");
                $this->classeEnergetica ?? $logger->info(Cat::WARN_CLASSE_ENERGETICA.$this->sku);
            }
            $this->imagesHelper->setImage($product, $logger, $imgName);
            $product = $this->productRepositoryInterface->save($product);
            empty($this->classeEnergetica) ?? $this->setClasseEnergetica($product);
            //Só podemos adicionar as categorias depois de guardar o produto
            $this->setCategories($product, $logger, $this->gama, $this->familia, $this->subFamilia);
            print_r($product->getSku()." - ");
        } catch (\Exception $exception) {
            $logger->info(Cat::ERROR_SAVE_PRODUCT." - ".$this->sku.
                " : code : ".$exception->getCode()." : Message : ".$exception->getMessage());
        } 
        //Adicionar opções de garantia e instalação
        /*
        try{
            $this->productOptions->add_warranty_option($product,$this->gama, $this->familia, $this->subFamilia);
            $value = $this->productOptions->getInstallationValue($this->gama, $this->familia, $this->subFamilia);
            if ($value > 0){
                $this->productOptions->add_installation_option($product,$value);
            }
            print_r("saving Options.. - ");
            $this->productRepositoryInterface->save($product);

            return $product;
        }catch (\Exception $e){
            $logger->info(Cat::ERROR_ADD_PRODUCT_OPTIONS.$this->sku);
        }
        */

    }
    private function deleteProduct($logger){
        $searchCriteria = $this->searchCriteriaBuilder->addFilter(ProductInterface::NAME,$this->name,'like')->create();
                $products = $this->productRepositoryInterface->getList($searchCriteria)->getItems();
                if($products){
                    foreach($products as $productToDelete){
                        $this->registry->unregister('isSecureArea');
                        $this->registry->register('isSecureArea', true);
                        $logger->info(Cat::WARN_DELETING_PRODUCT." - ".$productToDelete->getSku()." - ".$productToDelete->getName());
                        $this->productRepositoryInterface->delete($productToDelete);
                    }
                }else {
                    $logger->info(Cat::WARN_DIDNT_FOUND_PRODUCTS. " - ".$this->name);
                }
                
                $this->registry->unregister('isSecureArea');
                try {
                    print_r("saving product.. - ");
                    $product = $this->productRepositoryInterface->save($product);
                    print_r($product->getSku()." - ");
                }catch (\Exception $e) {
                    print_r("- " . $exception->getMessage() . " Save product exception" . "\n");
                    $logger->info(Cat::ERROR_SAVE_PRODUCT." - ".$this->sku);
                    return null;
                }
    }
    public function setCategories(\Magento\Catalog\Model\Product $product, $logger, $pGama, $pFamilia, $pSubFamilia)
    {
        $categories = array_filter([$pGama, $pFamilia, $pSubFamilia]); //remove as categorias que não existam
        $categoriesList = $this->categoryManager->getCategoriesArray();
        foreach($categories as $cat) {
            if (!array_key_exists($cat, $categoriesList)){
                try{
                    $this->categoryManager->createCategory($pGama, $pFamilia, $pSubFamilia, $categoriesList);
                    $categoriesList = $this->categoryManager->getCategoriesArray();
                    //Se criar as categorias pode sair do ciclo
                    break;
                }catch (\Exception $ex){
                    print_r(" - Erro ao adicionar nova categoria ". $ex->getMessage());
                }
            }
        }
        $catIds = array_map(fn($cat) => $categoriesList[$cat], $categories); //Array com os Ids
        if (!$this->categoryLinkManagement->assignProductToCategories($product->getSku(), $catIds)){
            print_r(" - Erro ao atribuir categoria: ".$product->getSku());
            $logger->info(Cat::VERIFICAR_CATEGORIAS.$product->getSku());
        }
    }

    public function setClasseEnergetica($product){
        $attributeEficiencia = $this->attributeManager->getEficiencia($this->classeEnergetica);
        $product->setCustomAttribute($attributeEficiencia['code'], $attributeEficiencia['value']);
        $this -> productResource -> saveAttribute($product, $attributeEficiencia['code']);
    }
    public function setStock($logger, $source)
    {
        $filterSku = $this->filterBuilder
            -> setField("sku")
            -> setValue($this->sku)
            -> create();
        $sourceFilter = $this->filterBuilder
            -> setField("source_code")
            -> setValue($source)
            -> create();

        $filterGroup1 = $this->filterGroupBuilder->setFilters([$filterSku])->create();
        $filterGroup2 = $this->filterGroupBuilder->setFilters([$sourceFilter])->create();
        $searchC = $this->searchCriteriaBuilder->setFilterGroups([$filterGroup1, $filterGroup2]) -> create();
        $sourceItem = $this -> sourceItemRepositoryI->getList($searchC) -> getItems();

        if (empty($sourceItem)) {
            $item = $this -> sourceItemIF -> create();
            $item -> setQuantity($this->stock);
            $item -> setStatus(1);
            $item -> setSku($this->sku);
            $item -> setSourceCode($source);
            try {
                $this -> sourceItemSaveI -> execute([$item]);
            } catch (CouldNotSaveException $e) {
                print_r($e->getMessage());
                $logger->info(Cat::ERROR_UPDATE_STOCK.$this->sku);
            } catch (InputException $e) {
                print_r($e->getMessage());
                $logger->info(Cat::ERROR_UPDATE_STOCK.$this->sku);
            } catch (ValidationException $e) {
                print_r($e->getMessage());
                $logger->info(Cat::ERROR_UPDATE_STOCK.$this->sku);
            }
        } else {
            foreach ($sourceItem as $item) {
                $item -> setQuantity($this->stock);
                try {
                    $this -> sourceItemSaveI -> execute([$item]);
                } catch (CouldNotSaveException $e) {
                    print_r($e->getMessage());
                    $logger->info(Cat::ERROR_UPDATE_STOCK.$this->sku." : ".$e->getMessage());
                } catch (InputException $e) {
                    print_r($e->getMessage());
                    $logger->info(Cat::ERROR_UPDATE_STOCK.$this->sku." : ".$e->getMessage());
                } catch (ValidationException $e) {
                    print_r($e->getMessage());
                    $logger->info(Cat::ERROR_UPDATE_STOCK.$this->sku." : ".$e->getMessage());
                }
            }
        }
    }

    public function updatePrice($logger){
        try{
            $product = $this->productRepositoryInterface->get($this->sku, true, null, true);
            

            //Podemos ver se já temos o produto em stock noutro lado, se tivermos, vemos qual é o mais barato, 
            //esta função só é chamada se houver produto em stock....

            $filterSku = $this->filterBuilder
            -> setField("sku")
            -> setValue($this->sku)
            -> create();

            $searchC = $this->searchCriteriaBuilder->addFilters([$filterSku]) -> create();
            $sourceItems = $this -> sourceItemRepositoryI->getList($searchC) -> getItems();
            $newPrice = $this->price;
            //Para Garantirmos que o preço é sempre o mais baixo e que existe em stock no fornecedor            
            foreach($sourceItems as $item){
                if ($item->getQuantity() > 0 && $product->getPrice() < $this->price){
                    $newPrice = $product->getPrice();
                }
            }
            $product->setPrice($newPrice);
            $this->productRepositoryInterface->save($product);
        }catch (\Exception $ex){
            print_r("update price exception - " . $ex->getMessage() . "\n");
            $logger->info(Cat::ERROR_UPDATE_PRICE.$product->getSku()." - ".$ex->getMessage());
        }
    }

    public function getPrice($precoCusto,$logger,$sku) {    
        try{
            if($precoCusto == 0) {
                $logger->info(Cat::ERROR_PRICE_ZERO.$sku);
                return(0);
            }
            if ($precoCusto < 20){
                $preco = $precoCusto * 1.50 * 1.23;
                return ceil($preco);
            }
            if ($precoCusto < 50){
                $preco = $precoCusto * 1.45 * 1.23;
                return ceil($preco);
            }
            if ($precoCusto < 100) {
                $preco = $precoCusto * 1.40 * 1.23;
                return ceil($preco);
            }
            if ($precoCusto < 250) {
                $preco = $precoCusto * 1.35 * 1.23;
                return ceil($preco);
            }
            if ($precoCusto < 350) {
                $preco = $precoCusto * 1.30 * 1.23;
                return ceil($preco);
            }
            if ($precoCusto < 400) {
                $preco = $precoCusto * 1.25 * 1.23;
                return ceil($preco);
            }
            if ($precoCusto < 500) {
                $preco = $precoCusto * 1.20 * 1.23;
                return ceil($preco);
            }
            if ($precoCusto < 700) {
                $preco = $precoCusto * 1.15 * 1.23;
                return ceil($preco);
            }else {
                $preco = $precoCusto * 1.10 * 1.23;
                return ceil($preco);
            }
        }catch (\Exception $e){
            $logger->info(Cat::ERROR_PRICE_ZERO.$sku." : ".$e->getMessage());
        }
        
    }

    public function add_description($logger,$description) {
        try {
            $product = $this->productRepositoryInterface->get($this->sku);
            $product->setCustomAttribute('description', $description);
            $this->productRepositoryInterface->save($product);
        }catch(\Exception $e){
            print_r($e->getMessage());
        }        
    }

    public function updateProductImages($product, $logger, $imgName, $img, $imgEtiqueta=false){
        try {
            $baseMediaPath = $this->directory->getRoot()."/pub/media/catalog/product/";
            $mediaAttributeValues = $product->getMediaAttributeValues();
            if ($mediaAttributeValues){
                if(!empty($imgEtiqueta) && (strcmp($mediaAttributeValues["energy_image"],"no_selection") == 0 || !file_exists( $baseMediaPath.$mediaAttributeValues["energy_image"]))){
                    $this->imagesHelper->getImages($this->sku,null,$imgEtiqueta);
                    $this->imagesHelper->setImageEtiqueta($product, $logger, $imgName . "_e");
                }
                if(strcmp($mediaAttributeValues["image"], "no_selection") == 0 || !file_exists( $baseMediaPath.$mediaAttributeValues["image"])){
                    $this->imagesHelper->getImages($this->sku,$img,null);
                    $this->imagesHelper->setImage($product, $logger, $imgName);
                }
            }
               
        }catch(\Exception $e){
            print_r($e->getMessage());
            $logger->info(Cat::ERROR_UPDATE_IMAGES." : ".$product->getSku());
        }        
    }
}




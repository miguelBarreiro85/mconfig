<?php


namespace Mlp\Cli\Helper;

use Mlp\Cli\Helper\CategoriesConstants as Cat;


class imagesHelper
{
    private $config;
    private $directory;

    public function __construct(\Magento\Framework\Filesystem\DirectoryList $directory,
                                \Magento\Catalog\Model\Product\Media\Config $config)
    {
        $this->directory = $directory;
        $this->config = $config;
    }

    public function getImages($sku, $img = null, $etiqueta = null){
        try {
            if (preg_match('/^http/', $etiqueta) == 1) {
                $ch = curl_init($etiqueta);
                $fp = fopen($this->directory->getRoot()."/pub/media/catalog/product/" . $sku. '_e', 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch,CURLOPT_TIMEOUT,0);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                if (curl_exec($ch)){
                    curl_close($ch);
                    fclose($fp);
                }else {
                    unlink($this->directory->getRoot()."/pub/media/catalog/product/" . $sku . "_e");
                }
            }

        } catch (\Exception $ex) {
            print_r($ex->getMessage());
        }
        try {
            if (preg_match('/^http/', $img) == 1) {
                $ch = curl_init($img);
                $fp = fopen($this->directory->getRoot()."/pub/media/catalog/product/" . $sku, 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,0);
                curl_setopt($ch,CURLOPT_TIMEOUT,0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                if (curl_exec($ch)){
                    curl_close($ch);
                    fclose($fp);
                    if (strcmp(hash_file("md5",$this->directory->getRoot()."/pub/media/catalog/product/" . $sku), "6bc6b80e1e2cc5f3f06b7028427fa4a1") == 0){
                        unlink($this->directory->getRoot()."/pub/media/catalog/product/" . $sku);
                    }
                }else {
                    unlink($this->directory->getRoot()."/pub/media/catalog/product/" . $sku);
                }


            }

        } catch (\Exception $ex) {
            print_r($ex->getMessage());
        }
    }

    protected function getImageName($ImgName, $baseMediaPath) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        try{
            $type = finfo_file($finfo, $this->directory->getRoot()."/pub/media/".$baseMediaPath. "/" . $ImgName);
        }catch (\Exception $exception){

        }
        if (isset($type) && in_array($type, array("image/png", "image/jpeg", "image/gif"))) {
            //por o ficheiro com extensao    
            $extension = preg_split('/\//',$type);
            $newImgName = $ImgName.".".$extension[1];
            rename($this->directory->getRoot()."/pub/media/catalog/product/".$ImgName,
                    $this->directory->getRoot()."/pub/media/catalog/product/".$newImgName);
            return $newImgName;
        }else {
            return false;
        }
    }
    public function setImage($product, $logger, $ImgName)
    {
        $baseMediaPath = $this->config->getBaseMediaPath(); 
        $newImgName = $this->getImageName($ImgName, $baseMediaPath);
        if($newImgName){
            //this is a image
            try {
             $product->addImageToMediaGallery($baseMediaPath . "/" . $newImgName, ['image', 'small_image', 'thumbnail'], false, false);
             print_r(" - Setting Image - ");
            } catch (\RuntimeException $exception) {
             print_r("run time exception" . $exception->getMessage() . "\n");
            } catch (\Exception $localizedException) {
             $logger->info(Cat::SEM_IMAGEM_PRODUTO . $product->getSku());
            }
        } else {
            $logger->info(Cat::SEM_IMAGEM_PRODUTO . $product->getSku());
        }

    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     * 
     */
      
    public function setImageEtiqueta($product, $logger, $ImgName){
        $baseMediaPath = $this->config->getBaseMediaPath(); 
        $newImgName = $this->getImageName($ImgName, $baseMediaPath);
        if($newImgName){
            try {
                $product->addImageToMediaGallery($baseMediaPath . "/" . $newImgName, ['energy_image'], false, false);
                print_r(" - Setting Etiqueta - ");
            } catch (\RuntimeException $exception) {
                print_r("run time exception" . $exception->getMessage() . "\n");
            } catch (\Exception $localizedException) {
                print_r($localizedException->getMessage());
                $logger->info(Cat::SEM_IMAGEM_ETIQUETA . $product->getSku());
            }
        }else {
            $logger->info(Cat::SEM_IMAGEM_ETIQUETA . $product->getSku());
        }
        
    }
}

<?php


namespace Mlp\Cli\Helper;


use Magento\Catalog\Model\ResourceModel\Product;
use Mlp\Cli\Helper\CategoriesConstants as Cat;

class ProductOptions
{

    private $productInt;
    private $optionFactory;
    private $optionRepository;
    private $productResource;
    private $customOption;
    private $productRepository;

    public function __construct(\Magento\Catalog\Api\Data\ProductInterface  $productInt,
                                \Magento\Catalog\Model\ResourceModel\Product $productResource,
                                \Magento\Catalog\Model\Product\OptionFactory $optionFactory,
                                \Magento\Catalog\Model\Product\Option\Repository $optionRepository,
                                \Magento\Catalog\Api\Data\CustomOptionInterface $customOption,
                                \Magento\Catalog\Api\ProductRepositoryInterface $productRepository)
    {
        $this->productResource = $productInt;
        $this->optionFactory = $optionFactory;
        $this->optionRepository = $optionRepository;
        $this->productResource = $productResource;
        $this->customOption = $customOption;
    }

    public function add_warranty_option(\Magento\Catalog\Api\Data\ProductInterface  $product,$gama, $familia, $subfamilia){
        $one_year = self::get_one_year_warranty_price((int)$product->getPrice(), $gama, $familia, $subfamilia);
        $three_years = self::get_three_years_warranty_price((int)$product->getPrice(), $gama);
        //Se os valores forem 0 não adiciona
        if ($one_year == 0 && $three_years == 0){
            return;
        }
        elseif ($one_year != 0 && $three_years != 0) {
            $options = [
                [
                    'title' => 'Extensão de garantia',
                    'type' => 'checkbox',
                    'is_require' => false,
                    'sort_order' => 4,
                    'values' => [
                        [
                            'title' => '1 ano',
                            'price' => $one_year,
                            'price_type' => 'fixed',
                            'sort_order' => 0,
                        ],
                        [
                            'title' => '3 anos',
                            'price' => $three_years,
                            'price_type' => 'fixed',
                            'sort_order' => 1,
                        ],
                    ],
                ],
            ];
        }elseif ($one_year == 0 && $three_years != 0){
            $options = [
                [
                    'title' => 'Extensão de garantia',
                    'type' => 'checkbox',
                    'is_require' => false,
                    'sort_order' => 4,
                    'values' => [
                        [
                            'title' => '3 anos',
                            'price' => $three_years,
                            'price_type' => 'fixed',
                            'sort_order' => 1,
                        ],
                    ],
                ],
            ];
        }
        if(!isset($options)){
            return;
        }
        foreach ($options as $arrayOption) {
            $option = $this->optionFactory->create();
            $option->setProductId($product->getId())
                ->setStoreId($product->getStoreId())
                ->addData($arrayOption);
            $option->save();
            $product->addOption($option);
        }
    }
    public function add_installation_option(\Magento\Catalog\Api\Data\ProductInterface  $product, $value){
        $options = [
            [
                'title' => 'Serviço de instalação',
                'type' => 'checkbox',
                'is_require' => false,
                'sort_order' => 4,
                'values' => [
                    [
                        'title' => 'Instalação de equipamento',
                        'price' => $value,
                        'price_type' => 'fixed',
                        'sort_order' => 0,
                    ],
                ],
            ],
        ];

        foreach ($options as $arrayOption) {
            $option = $this->optionFactory->create();
            $option->setProductId($product->getId())
                ->setStoreId($product->getStoreId())
                ->addData($arrayOption);
            $option->save();
            $product->addOption($option);
        }
    }
    public static function get_one_year_warranty_price($preco, $gama, $familia, $subfamilia)
    {
        switch ($gama) {
            case Cat::GRANDES_DOMESTICOS;
                if ($preco <= 200) {
                    return 14;
                } elseif ($preco > 200 && $preco <= 400) {
                    return 19;
                } elseif ($preco > 400 && $preco <= 600) {
                    return 29;
                } elseif ($preco > 600 && $preco <= 1000) {
                    return 49;
                } elseif ($preco > 1000 && $preco <= 1500) {
                    return 59;
                } elseif ($preco > 1500) {
                    return 79;
                }
                break;
            case Cat::IMAGEM_E_SOM:
                switch ($familia) {
                    case Cat::CAMARAS:
                        if ($preco <= 100) {
                            return 19;
                        } elseif ($preco > 100 && $preco <= 200) {
                            return 24;
                        } elseif ($preco > 200 && $preco <= 400) {
                            return 39;
                        } elseif ($preco > 400 && $preco <= 600) {
                            return 49;
                        } elseif ($preco > 600 && $preco <= 800) {
                            return 69;
                        } elseif ($preco > 800) {
                            return 89;
                        }
                        break;
                    default:
                        if ($preco <= 200) {
                            return 19;
                        } elseif (200 < $preco && $preco <= 400) {
                            return 29;
                        } elseif ($preco > 400 && $preco <= 600) {
                            return 49;
                        } elseif ($preco > 600 && $preco <= 1000) {
                            return 69;
                        } elseif ($preco > 1000 && $preco <= 1500) {
                            return 79;
                        } elseif ($preco > 1500) {
                            return 119;
                        }
                        break;
                }
            case Cat::INFORMATICA:
                if ($preco <= 200) {
                    return 24;
                } elseif ($preco > 200 && $preco <= 400) {
                    return 39;
                } elseif ($preco > 400 && $preco <= 600) {
                    return 49;
                } elseif ($preco > 600 && $preco <= 1000) {
                    return 69;
                } elseif ($preco > 1000 && $preco <= 1500) {
                    return 89;
                } elseif ($preco > 1500) {
                    return 99;
                }
                break;
            case Cat::COMUNICACOES:
                if (strcmp($familia, Cat::TELEFONES_FIXOS) == 0 || strcmp($subfamilia, Cat::TELEMOVEIS) == 0){
                    if ($preco <= 150) {
                        return 19;
                    } elseif ($preco > 150 && $preco <= 300) {
                        return 24;
                    } elseif ($preco > 300 && $preco <= 400) {
                        return 39;
                    } elseif ($preco > 400 && $preco <= 500) {
                        return 49;
                    } elseif ($preco > 500 && $preco <= 700) {
                        return 69;
                    } elseif ($preco > 700 && $preco <= 900) {
                        return 79;
                    } elseif ($preco > 900) {
                        return 89;
                    }
                }else{
                    return 0;
                }
                break;
            case Cat::PEQUENOS_DOMESTICOS:
                if ($preco <= 50) {
                    return 9;
                } elseif ($preco > 50 && $preco <= 100) {
                    return 14;
                } elseif ($preco > 100 && $preco <= 200) {
                    return 19;
                } elseif ($preco > 200 && $preco <= 500) {
                    return 29;
                }
                break;
            case Cat::CLIMATIZACAO:
                switch ($familia){
                    case Cat::AR_CONDICIONADO:
                        if ($preco <= 200) {
                            return 14;
                        } elseif ($preco > 200 && $preco <= 400) {
                            return 19;
                        } elseif ($preco > 400 && $preco <= 600) {
                            return 29;
                        } elseif ($preco > 600 && $preco <= 1000) {
                            return 49;
                        } elseif ($preco > 1000 && $preco <= 1500) {
                            return 59;
                        } elseif ($preco > 1500) {
                            return 79;
                        }
                        break;
                    default:
                        return 0;
                }
                break;
            default:
                return 0;
        }
    }
    public static function get_three_years_warranty_price($preco, $gama){
        switch ($gama) {
            case Cat::GRANDES_DOMESTICOS:
                if ($preco <= 200) {
                    return 29;
                } elseif ($preco > 200 && $preco <= 400) {
                    return 49;
                } elseif ($preco > 400 && $preco <= 600) {
                    return 69;
                } elseif ($preco > 600 && $preco <= 1000) {
                    return 99;
                } elseif ($preco > 1000 && $preco <= 1500) {
                    return 119;
                } elseif ($preco > 1500) {
                    return 149;
                }
                break;
            case Cat::IMAGEM_E_SOM:
                if ($preco <= 200) {
                    return 39;
                } elseif (200 < $preco && $preco <= 400) {
                    return 59;
                } elseif ($preco > 400 && $preco <= 600) {
                    return 69;
                } elseif ($preco > 600 && $preco <= 1000) {
                    return 99;
                } elseif ($preco > 1000 && $preco <= 1500) {
                    return 119;
                } elseif ($preco > 1500) {
                    return 169;
                }
                break;
            default:
                return 0;
        }
    }
    public static function getInstallationValue($gama,$familia,$subFamilia)
    {
        switch ($gama){
            case Cat::ENCASTRE:
                switch ($familia) {
                    case cat::PLACAS:
                        switch ($subFamilia) {
                            case Cat::PLACAS_GAS:
                            case Cat::PLACAS_CRISTAL_GAS:
                            case Cat::PLACAS_DOMINO:
                            case Cat::PLACAS_MISTAS:
                                return 59.90;
                            case Cat::PLACAS_INDUCAO:
                            case Cat::PLACAS_VITROCERAMICAS:
                            case Cat::PLACAS_CONVENCIONAIS_ELETRICAS:
                                return 39.90;
                            default:
                                return 0;
                        }
                    case Cat::FORNOS:
                        switch ($subFamilia) {
                            case Cat::FORNOS_GAS:
                                return 59.90;
                            default:
                                return 39.90;
                        }
                    case Cat::EXAUSTORES:
                        return 49.90;
                    default:
                        return 0;
                }
            case Cat::GRANDES_DOMESTICOS:
                switch ($familia) {
                    case Cat::FOGOES:
                        return 39.90;
                    case Cat::ESQUENTADORES_TERMOACUMULADORES:
                        switch ($subFamilia) {
                            case Cat::CALDEIRAS_GAS:
                                return 0;
                            default:
                                return 59.90;
                                break;
                        }
                        return 74.90;
                    default:
                        return 0;
                        break;
                } 
            case Cat::CLIMATIZACAO:
                switch ($familia) {
                    case Cat::AR_CONDICIONADO:
                        return 0;
                    default:
                        return 0;
                }
            default:
                return 0;
        }
    }

}

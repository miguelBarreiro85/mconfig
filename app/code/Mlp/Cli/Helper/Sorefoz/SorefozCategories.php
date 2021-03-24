<?php 

namespace Mlp\Cli\Helper\Sorefoz;

use Mlp\Cli\Helper\CategoriesConstants as Cat;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use PhpParser\Node\Stmt\ElseIf_;

class SorefozCategories {

    public static function getCategories($gama,$familia,$subFamilia,$logger,$sku,$name)
    {
        switch ($gama) {
            case 'ACESSÓRIOS E BATERIAS':
                $gama = Cat::ELECTRICIDADE;
                switch ($familia) {
                    case 'ACESSÓRIOS E BATERIAS':
                        switch ($subFamilia) {
                            case 'ACESSÓRIOS':
                                $familia = Cat::OUTROS_ACESSORIOS;
                                return [$gama,$familia,null];
                            case 'BATERIAS':
                                $familia = Cat::PILHAS_BATERIAS;
                                $subFamilia = Cat::BATERIAS;
                                return [$gama,$familia,$subFamilia];
                            case 'LAMPADAS':
                                $familia = Cat::ILUMINACAO;
                                $subFamilia = Cat::LAMPADAS;
                                return [$gama,$familia,$subFamilia];
                            case 'PROD. P/MAQ.ROUPA E LOUÇA':
                            case 'PROD. P/QUEIMA':
                            case 'PROD. P/FRIGORIFICOS':
                                $gama = Cat::GRANDES_DOMESTICOS;
                                $familia = Cat::ACESSORIOS_GRANDES_DOMESTICOS;
                                return [$gama,$familia,null];
                            default:
                                $familia = Cat::OUTROS_ACESSORIOS;
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    default:
                        $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                        return [$gama,null,null];
                }
            case 'TELEFONES E TELEMÓVEIS':
            case 'SERVIÇOS TV/INTERNET/OUTROS':
                $gama = Cat::COMUNICACOES;
                switch ($familia) {
                    case 'SERVIÇOS INTERNET':
                    case 'SERVIÇOS TELEVISÃO':
                        $familia = Cat::SERVICOS_COMUNICACOES;
                        return [$gama,$familia,null];
                    case 'TELEFONES FIXOS':
                        $familia = Cat::TELEFONES_FIXOS;
                        return [$gama,$familia,null];
                    case 'TELEMÓVEIS / CARTÕES':
                        $familia = Cat::TELEMOVEIS;
                        return [$gama,$familia,null];
                    default:
                        $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                        return [$gama,null,null];
                }
                
            case 'GRANDES DOMÉSTICOS':
                $gama = Cat::GRANDES_DOMESTICOS;
                switch ($familia) {
                    case 'TERMOACUMULADORES':
                        $familia = Cat::ESQUENTADORES_TERMOACUMULADORES;
                        switch ($subFamilia) {
                            case 'TERMOACUMULADORES - ELÉCTRICOS':
                                $subFamilia = Cat::TERMOACUMULADORES_ELECTRICOS;
                                return [$gama, $familia, $subFamilia];
                            case 'BOMBA DE CALOR':
                                $subFamilia = Cat::BOMBA_CALOR;
                                return [$gama, $familia, $subFamilia];
                            case 'ACUMULADORES DE ÁGUA':
                                $subFamilia = Cat::ACUMULADORES_AGUA;
                                return [$gama, $familia, $subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama, $familia, null];
                        }
                    case 'ESQUENTADORES/CALDEIRAS':
                        $familia = Cat::ESQUENTADORES_TERMOACUMULADORES;
                        switch ($subFamilia) {
                            case 'ESQUENTADORES - ELÉCTRICOS':
                                $subFamilia = Cat::ESQUENTADORES_ELECTRICOS;
                                return [$gama, $familia, $subFamilia];
                            case 'ESQUENTADORES C/GÁS':
                                $subFamilia = Cat::ESQUENTADORES_C_GAS;
                                return [$gama, $familia, $subFamilia];
                            case 'CALDEIRAS C/GÁS':
                                $subFamilia = Cat::CALDEIRAS_GAS;
                                return [$gama, $familia, $subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama, $familia, null];
                        }
                    case 'MICROONDAS':
                        $familia = Cat::MICROONDAS;
                        switch ($subFamilia) {
                            case 'MO - COM GRILL':
                                $subFamilia = Cat::MICROONDAS_GRILL;
                                return [$gama, $familia, $subFamilia];
                            case 'MO - SEM GRILL':
                                $subFamilia = Cat::MO_SEM_GRILL;
                                return [$gama, $familia, $subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama, $familia, null];
                        }
                    case 'ENCASTRE - FORNOS':
                        $gama = Cat::ENCASTRE;
                        $familia = Cat::FORNOS;
                        switch ($subFamilia) {
                            case 'INDEPENDENTES - ELÉCTRICOS':
                                $subFamilia = Cat::FORNOS_MULTIFUNC;
                                return [$gama, $familia, $subFamilia];
                            case 'PIROLITICOS':
                                $subFamilia = Cat::FORNOS_PIROLITICOS;
                                return [$gama, $familia, $subFamilia];
                            case 'INDEPENDENTES C/GÁS':
                                $subFamilia = Cat::FORNOS_GAS;
                                return [$gama, $familia, $subFamilia];
                            case 'POLIVALENTES':
                                $subFamilia = Cat::FORNOS_POLIVALENTES;
                                return [$gama, $familia, $subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'ENCASTRE - MESAS':
                        $gama = Cat::ENCASTRE;
                        $familia = Cat::PLACAS;
                        switch ($subFamilia) {
                            case 'CONVENCIONAIS C/GÁS':
                                $subFamilia = Cat::PLACAS_GAS;
                                return [$gama,$familia,$subFamilia];
                            case 'DE INDUÇÃO':
                                $subFamilia = Cat::PLACAS_INDUCAO;
                                return [$gama,$familia,$subFamilia];
                            case 'VITROCERÂMICAS C/GÁS':
                                $subFamilia = Cat::PLACAS_CRISTAL_GAS;
                                return [$gama,$familia,$subFamilia];
                            case 'VITROCERÂMICAS - ELÉCTRICAS':
                                $subFamilia = Cat::PLACAS_VITROCERAMICAS;
                                return [$gama,$familia,$subFamilia];
                            case 'DOMINÓS C/GÁS':
                            case 'DOMINÓS - ELÉCTRICOS':                                
                                $subFamilia = Cat::PLACAS_DOMINO;
                                return [$gama,$familia,$subFamilia];
                            case 'CONVENCIONAIS - ELÉCTRICAS':
                                $subFamilia = Cat::PLACAS_CONVENCIONAIS_ELETRICAS;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'ENCASTRE - EXAUSTOR/EXTRATORES':
                        $gama = Cat::ENCASTRE;
                        $familia = Cat::EXAUSTORES;
                        switch($subFamilia){
                            case 'EXAUST.DE CHAMINÉ':
                                if(preg_match('/TECTO/',$name) == 1){
                                    $subFamilia = Cat::EXAUSTORES_TETO;
                                    return [$gama,$familia,$subFamilia];       
                                }else {
                                    $subFamilia = Cat::EXAUSTORES_CHAMINE;
                                    return [$gama,$familia,$subFamilia];
                                }
                            case 'EXAUST.TELESCÓPICOS':
                                $subFamilia = Cat::EXAUSTORES_TELESCOPICOS;
                                return [$gama,$familia,$subFamilia];
                            case 'EXAUST.CONVENCIONAIS':
                                if(preg_match('/BANCADA/',$name) == 1) {
                                    $subFamilia = Cat::EXAUSTORES_BANCADA;
                                    return [$gama,$familia,$subFamilia]; 
                                }else {
                                    $subFamilia = Cat::EXAUSTORES_CONVENCIONAIS;
                                    return [$gama,$familia,$subFamilia];
                                }
                            case 'EXTRACTORES':
                                $subFamilia = Cat::EXTRACTORES;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'ENCASTRE - FRIO':
                        $gama = Cat::ENCASTRE;
                        $familia = Cat::FRIO_ENC;
                        switch($subFamilia){
                            case 'COMBINADOS':
                                $subFamilia = Cat::COMBINADOS_ENC;
                                return [$gama,$familia,$subFamilia];
                            case 'CONGELADORES VERTICAIS':
                                $subFamilia = Cat::CONGELADORES_ENC;
                                return [$gama,$familia,$subFamilia];
                            case 'FRIGORIFICOS':
                                $subFamilia = Cat::FRIGORIFICOS_ENC;
                                return [$gama,$familia,$subFamilia];
                            case 'GARRAFEIRAS':
                                $subFamilia = Cat::GARRAFEIRAS_ENC;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];    
                        }
                    case 'ENCASTRE - MAQ.LOUÇA':
                        $gama = Cat::ENCASTRE;
                        $familia = Cat::MAQ_DE_LOUCA_ENC;
                        switch ($subFamilia) {
                            case 'MAQ.LAVAR LOUÇA 60 Cm':
                                $subFamilia = Cat::MAQ_DE_LOUCA_ENC_60;
                                break;
                            case 'MAQ.LAVAR LOUÇA 45 Cm':
                                $subFamilia = Cat::MAQ_DE_LOUCA_ENC_45;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];       
                        }
                        return [$gama,$familia,$subFamilia];
                    case 'ENCASTRE - MAQ.L.ROUPA':
                        $gama = Cat::ENCASTRE;
                        $familia = Cat::MAQ_ROUPA_ENC;
                        switch($subFamilia){
                            case 'MAQ.LAVAR/SECAR ROUPA':
                                $subFamilia = Cat::MAQ_LAVAR_SECAR_ROUPA_ENC;
                                return [$gama,$familia,$subFamilia];
                            case 'MAQ.LAVAR ROUPA':
                                $subFamilia = Cat::MAQ_LAVAR_ROUPA_ENC;
                                return [$gama,$familia,$subFamilia];
                            case 'MAQ.SECAR ROUPA':
                                $subFamilia = Cat::MAQ_SECAR_ROUPA_ENC;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'ENCASTRE - MICROONDAS':
                        $gama = Cat::ENCASTRE;
                        $familia = Cat::MICROONDAS_ENC;
                        return [$gama,$familia,null];
                    case 'ENCASTRE - OUTRAS':
                        $gama = Cat::ENCASTRE;
                        $familia = Cat::OUTRO_ENC;
                        return [$gama,$familia,null];
                    case 'FOGÕES':
                        $familia = Cat::FOGOES;
                        switch ($subFamilia) {
                            case 'FOGÕES - LENHA':
                                $subFamilia = Cat::FOGOES_LENHA;
                                return [$gama,$familia,$subFamilia];
                                break;
                            case 'FOGÕES C/GÁS':
                                $subFamilia = Cat::FOGOES_GAS;
                                return [$gama, $familia, $subFamilia];
                            case 'FOGÕES - ELÉCTRICOS':
                                $subFamilia = Cat::FOGOES_ELECTRICOS;
                                return [$gama, $familia, $subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'MAQUINAS LAVAR ROUPA':
                        $gama = Cat::GRANDES_DOMESTICOS;
                        $familia = Cat::MAQ_ROUPA;
                        switch($subFamilia){
                            case 'MLR CARGA FRONTAL':
                            case 'MLR CARGA SUPERIOR':
                                $subFamilia = Cat::MAQ_LAVAR_ROUPA;
                                return [$gama,$familia,$subFamilia];
                            case 'MLR LAVAR E SECAR ROUPA':
                                $subFamilia = Cat::MAQ_LAVAR_SECAR_ROUPA;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'MAQUINAS SECAR ROUPA':
                        $gama = Cat::GRANDES_DOMESTICOS;
                        $familia = Cat::MAQ_ROUPA;
                        switch ($subFamilia) {
                            case 'MSR POR EXAUSTÃO':
                                $subFamilia = Cat::MAQ_SECAR_ROUPA_VENT;
                                return [$gama,$familia,$subFamilia];
                            case 'MSR POR CONDENSAÇÃO':
                                if (preg_match('/B.CAL/',$name)==1){
                                    $subFamilia = Cat::MAQ_SECAR_ROUPA_BC;
                                    return [$gama,$familia,$subFamilia];
                                }else {
                                    $subFamilia = Cat::MAQ_SECAR_ROUPA_COND;
                                    return [$gama,$familia,$subFamilia];
                                }
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                            }         
                    case 'CONGELADORES':
                        $familia = Cat::FRIO;
                        switch ($subFamilia) {
                            case 'VERTICAIS':
                                $subFamilia = Cat::CONGELADORES_VERTICAIS;
                                return [$gama,$familia,$subFamilia];
                            case 'HORIZONTAIS':
                                $subFamilia = Cat::CONGELADORES_HORIZONTAIS;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'FRIGORIFICOS/COMBINADOS':
                        $familia = Cat::FRIO;
                        switch ($subFamilia) {
                            case 'GARRAFEIRA':
                                $subFamilia = Cat::GARRAFEIRAS;
                                return [$gama,$familia,$subFamilia];
                            case 'FRIGORIF.2 PORTAS':
                                $subFamilia = Cat::FRIGORIF_2_PORTAS;
                                return [$gama,$familia,$subFamilia];
                            case 'FRIGORIF.2P NO FROST':
                                $subFamilia = Cat::FRIGORIF_2P_NO_FROST;
                                return [$gama,$familia,$subFamilia];
                            case 'COMB.CONVENCIONAIS':
                                $subFamilia = Cat::COMBINADOS_CONVENCIONAIS;
                                return [$gama,$familia,$subFamilia];
                            case 'FRIGORIF.AMERICANOS':
                                $subFamilia = Cat::FRIGORIF_AMERICANOS;
                                return [$gama,$familia,$subFamilia];
                            case 'COMBINADOS NO FROST':
                                $subFamilia = Cat::COMBINADOS_NO_FROST;
                                return [$gama,$familia,$subFamilia];
                            case 'FRIGORIF.1 PORTA':
                                $subFamilia = Cat::FRIGORIF_1_PORTA;
                                return [$gama,$familia,$subFamilia];
                            case 'FRIGORIF.1P NO FROST':
                                $subFamilia = Cat::FRIGORIF_1_PORTA_NF;
                                return [$gama,$familia,$subFamilia];
                            case 'FRIGOBAR':
                                $subFamilia = Cat::FRIGOBAR;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'MAQUINAS LAVAR LOUÇA':
                        $familia = Cat::MAQ_DE_LOUCA;
                        switch ($subFamilia) {
                            case 'MLL DE 60 Cm':
                                $subFamilia = Cat::MLL_DE_60;
                                return [$gama,$familia,$subFamilia];
                            case 'MLL DE 45 Cm':
                                $subFamilia = Cat::MLL_DE_45;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }    
                    case 'ENCASTRE - CONJUNTOS':
                        $familia = Cat::ENCASTRE;
                        $subFamilia = Cat::CONJUNTOS_ENC;
                        return [$gama,$familia,$subFamilia];        
                    default:
                        $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                        return [$gama,null.null];        
                }
            case 'IMAGEM E SOM':
                $gama = Cat::IMAGEM_E_SOM;
                switch ($familia) {
                    case 'AUDIO PORTATIL':
                        $familia = Cat::AUDIO_PORTATIL;
                        switch ($subFamilia) {
                            case 'RADIOS PORTATEIS':
                                $subFamilia = Cat::RADIOS_PORTATEIS;
                                return [$gama,$familia,$subFamilia];
                            case 'RADIOS C/CD':
                                $subFamilia = Cat::RADIO_CDS;
                                return [$gama,$familia,$subFamilia];
                            case 'RADIO RELOGIO':
                                $subFamilia = Cat::RADIO_DESPERTADOR;
                                return [$gama,$familia,$subFamilia];
                            case 'RADIOS GRAVADORES':
                            case 'GRAVADORES':
                                $subFamilia = Cat::GRAVADORES;
                                return [$gama,$familia,$subFamilia];
                            case 'LEITORES DE MP4':
                            case 'LEITORES DE MP3':
                                $subFamilia = Cat::LEITOR_MP3_MP4;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'CÂMARAS':
                        switch ($subFamilia) {
                            case 'VIDEO CARTÃO MEMÓRIA':
                                $subFamilia = Cat::OUTROS_ACESSORIOS_IMAGEM_SOM;
                                $familia = Cat::ACESSORIOS_IMAGEM_E_SOM;
                                return [$gama,$familia,$subFamilia];
                            case 'FOTOS DIGITAL COMPACTA':
                                $familia = Cat::CAMARAS_FOTOGRAFICAS;
                                $subFamilia = Cat::FOTOS_DIGITAL_COMPACTA;
                                return [$gama,$familia,$subFamilia];
                            case 'FOTOS DIGITAL REFLEX':
                            case 'FOTOS DIGITAL REFLEX':
                                $familia = Cat::CAMARAS_FOTOGRAFICAS;
                                $subFamilia = Cat::CAMARAS_REFLEX;
                                return [$gama,$familia,$subFamilia];
                            case 'VIDEO HDD':
                                $familia = Cat::CAMARAS_VIDEO;
                                $subFamilia = Cat::CAMARAS_VIDEO_HD;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }                
                    case 'TELEVISÃO':   
                        $familia = Cat::TELEVISAO;
                        switch ($subFamilia) {
                            case 'TV LED+46"':
                                $subFamilia = Cat::TVS_GRANDES;
                                return [$gama,$familia,$subFamilia];
                            case 'TV LED 27"':
                            case 'TV LED 32"':
                            case 'TV LCD 19"':
                            case 'TV LED 19"':
                            case 'TV LED 23"':
                            case 'TV LED 24"':
                            case 'TV LED 20"':
                            case 'TV LED 22"':
                            case 'TV LED 37"':
                                $subFamilia = Cat::TVS_PEQUENAS;
                                return [$gama,$familia,$subFamilia];
                            case 'TV LED 40"':
                            case 'TV LED 42"':
                            case 'TV LED 46"':
                            case 'TVS MEDIAS 40" A 46"':
                                $subFamilia = Cat::TVS_MEDIAS;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                            }
                    case 'EQUIPAMENTOS AUDIO':
                        $familia = Cat::EQUIPAMENTOS_AUDIO;
                        switch ($subFamilia) {
                            case 'OUTRO HI-FI':
                                if (preg_match('/AURIC/', $name) == 1
                                    || preg_match('/^AUSCULT/', $name) == 1) {
                                    $familia = Cat::AUDIO_PORTATIL;
                                    $subFamilia = Cat::AUSCULTADORES;
                                    return [$gama,$familia,$subFamilia];        
                                } else if(preg_match('/^COLUNA/', $name) == 1
                                    ||preg_match('/^SIST.AUDIO/', $name) == 1){
                                    $familia = Cat::EQUIPAMENTOS_AUDIO;
                                    $subFamilia = Cat::SOUND_BARS;
                                    return [$gama,$familia,$subFamilia];
                                } else if(preg_match('/^SOUND BAR/', $name) == 1) {
                                    $familia = Cat::EQUIPAMENTOS_AUDIO;
                                    $subFamilia = Cat::SOUND_BARS;
                                    return [$gama,$familia,$subFamilia];
                                }
                            default:
                                $subFamilia = Cat::OUTRO_HIFI;
                                return [$gama,$familia,$subFamilia];
                            }
                    case 'SIST.HOME CINEMA':
                        $gama = Cat::IMAGEM_E_SOM;
                        $familia = Cat::EQUIPAMENTOS_AUDIO;
                        $subFamilia = Cat::SIST_HOME_CINEMA;
                        return [$gama,$familia,$subFamilia];
                    case 'ACESSÓRIOS IMAGEM E SOM':
                        $gama = Cat::IMAGEM_E_SOM;
                        $familia = Cat::ACESSORIOS_IMAGEM_E_SOM;
                        switch ($subFamilia) {
                            case 'MÓVEIS / SUPORTES':
                                $subFamilia = Cat::MOVEIS_SUPORTES;
                                return [$gama,$familia,$subFamilia];
                                break;
                            case 'TELAS PROJEÇÃO':
                                $subFamilia = Cat::TELAS_PROJEÇÃO;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    default:
                        $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                        return [$gama,null,null];
                    }
                            
            case 'INFORMÁTICA':
                $gama = Cat::INFORMATICA;
                switch ($familia) {
                    case 'GPS':
                        $familia=Cat::GPS;
                        return [$gama,$familia,null];
                    case 'IMPRESSORAS':
                        $familia = Cat::IMPRESSORAS;
                        switch ($subFamilia) {
                            case 'MULTIFUNÇÕES J.TINTA':
                                $subFamilia = Cat::IMPRESSORAS_MULTI_FUNC;
                                return [$gama,$familia,$subFamilia];
                                break;
                            case 'MULTIFUNÇÕES LASER':
                                $subFamilia = Cat::IMPRESSORAS_MULTI_FUNC_LASER;
                                return [$gama,$familia,$subFamilia];
                                break;
                            case 'LASER':
                                $subFamilia = Cat::IMPRESSORAS_LASER;
                                return [$gama,$familia,$subFamilia];
                                break;
                            case 'JACTO DE TINTA':
                                $subFamilia = Cat::IMPRESSORAS_JACTO_DE_TINTA;
                                return [$gama,$familia,$subFamilia];
                                break;
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'ACESSÓRIOS':
                        switch ($subFamilia) {
                            case 'ACESSÓRIOS DE SOM':
                                if (preg_match('/^COLUNA/', $name) == 1) {
                                    $gama = Cat::IMAGEM_E_SOM;
                                    $familia = Cat::AUDIO_PORTATIL;
                                    $subFamilia = Cat::COLUNAS;
                                    return [$gama,$familia,$subFamilia];
                                }
                                if (preg_match('/^AUSC/', $name) == 1) {
                                    $gama = Cat::IMAGEM_E_SOM;
                                    $familia = Cat::AUDIO_PORTATIL;
                                    $subFamilia = Cat::COLUNAS;
                                    return [$gama,$familia,$subFamilia];
                                }
                            default:
                                $familia = Cat::ACESSORIOS_INFORMATICA;
                                return [$gama,$familia,null];
                        }
                        
                    case "COMPUTADORES E TABLET'S":
                        $familia = Cat::COMPUTADORES_E_TABLETS;
                        switch ($subFamilia) {
                            case 'DE SECRETÁRIA':
                                $subFamilia = Cat::DESKTOPS;
                                return [$gama,$familia,$subFamilia];
                            case "TABLET'S":
                                $subFamilia = Cat::TABLETS;
                                return [$gama,$familia,$subFamilia];
                            case 'PORTÁTEIS':
                                $subFamilia = Cat::PORTATEIS_NOTEBOOKS;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case "MONITORES":
                        $familia = Cat::MONITORES;
                        switch ($subFamilia) {
                            case 'COM SINTONIZADOR TV':
                                $gama = Cat::IMAGEM_E_SOM;
                                $familia = Cat::TELEVISAO;
                                $subFamilia = Cat::TV_HOTELARIA;
                                return [$gama,$familia,$subFamilia];
                            case 'PROJECTORES INFORMÁTICA':
                                $subFamilia = Cat::PROJECTORES;
                                return [$gama,$familia,$subFamilia];
                            case 'SEM SINTONIZADOR TV':
                                $subFamilia = Cat::MONITORES_PC;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    
                    case 'MEMÓRIAS':
                        $familia = Cat::MEMORIAS;
                        switch ($subFamilia) {
                            case 'MEMÓRIAS USB':
                                $subFamilia = Cat::PENS_USB;
                                return [$gama,$familia,$subFamilia];
                                break;
                            case 'CARTÕES DE MEMÓRIA':
                                $subFamilia = Cat::CARTOES_MEMORIA;
                                return [$gama,$familia,$subFamilia];
                                break;
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    default:
                        $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                        return [$gama,null,null];
                }
                
            case 'CLIMATIZAÇÃO':
                $gama = Cat::CLIMATIZACAO;
                switch ($familia) {
                    case 'TRATAMENTO DE AR':
                        $familia = Cat::TRATAMENTO_DE_AR;
                        switch ($subFamilia) {
                            case 'DESUMIDIFICADORES':
                                $subFamilia = Cat::DESUMIDIFICADORES;
                                return [$gama,$familia,$subFamilia];
                            case 'HUMIDIFICADORES':
                                $subFamilia = Cat::HUMIDIFICADORES;
                                return [$gama,$familia,$subFamilia];
                            case 'PURIFICADORES DE AR':
                                $subFamilia = Cat::PURIFICADORES_AR;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                            }
                    case 'VENTILAÇÃO':
                        $familia = Cat::VENTILACAO;
                        switch ($subFamilia) {
                            case 'VENTOINHAS':
                                 $subFamilia = Cat::VENTOINHAS;
                                 return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'SISTEMAS AQUEC.SOLAR':
                        $familia = Cat::SISTEMAS_AQUECIMENTO_SOLAR;
                        switch ($subFamilia) {
                            case 'ACESSÓRIOS AQUEC.SOLAR':
                                $familia = Cat::ACESSORIOS_CLIMATIZACAO;
                                return [$gama,$familia,null];
                            case 'ACUM.DE ÁGUA':
                                $subFamilia = Cat::ACUMULADORES_AGUA;
                                return [$gama,$familia,$subFamilia];
                            case 'PAINEIS SOLARES':
                                $subFamilia = Cat::PAINEIS_SOLARES;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'AQUECIMENTO':
                        $familia = Cat::AQUECIMENTO;
                        if (preg_match('/^CLIMATIZADOR/', $name) == 1) {
                            $gama = Cat::CLIMATIZACAO;
                            $familia = Cat::AR_CONDICIONADO;
                            $subFamilia = Cat::CLIMATIZADORES;
                            return [$gama,$familia,$subFamilia];
                        }
                        switch ($subFamilia) {
                            case 'SALAMANDRAS':
                                $subFamilia = Cat::SALAMANDRAS;
                                return [$gama,$familia,$subFamilia];
                            case 'RADIADORES A OLEO':
                                $subFamilia = Cat::RADIADORES_A_OLEO;
                                return [$gama,$familia,$subFamilia];
                            case 'TEXTIL':
                                $subFamilia = Cat::TEXTIL;
                                return [$gama,$familia,$subFamilia];
                            case 'CONVECTORES/TERMOVENT.':
                                $subFamilia = Cat::CONVECTORES_TERMOVENT;
                                return [$gama,$familia,$subFamilia];
                            case 'A GÁS':
                                $subFamilia = Cat::AQUECEDORES_GAS;
                                return [$gama,$familia,$subFamilia];
                            case 'ELÉCTRICO':
                                $subFamilia = Cat::ELECTRICO;
                                return [$gama,$familia,$subFamilia];
                            case 'RECUPERADORES':
                                $subFamilia = Cat::RECUPERADORES;
                                return [$gama,$familia,$subFamilia];
                            case 'OUTRO AQUECIMENTO':
                                if (preg_match('/^TOALHEIRO/', $name) == 1) {
                                    $gama = Cat::CLIMATIZACAO;
                                    $familia = Cat::AQUECIMENTO;
                                    $subFamilia = Cat::TOALHEIROS;
                                    return [$gama,$familia,$subFamilia];
                                }else{
                                    $subFamilia = Cat::OUTRO_AQUECIMENTO;
                                    return [$gama,$familia,$subFamilia];
                                }
                            case 'EMISSORES TÉRMICOS':
                                $subFamilia = Cat::EMISSORES_TERMICOS;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];                              
                        }
                    case 'AR CONDICIONADO':
                        $familia = Cat::AR_CONDICIONADO;
                        switch ($subFamilia) {
                            case 'AR COND.INVERTER':
                            case 'AR COND.MULTI-SPLIT':
                                 $subFamilia = Cat::AC_FIXO;
                                 return [$gama,$familia,$subFamilia];
                            case 'AR COND.PORTATIL':
                                $subFamilia = Cat::AC_PORTATIL;
                                return [$gama,$familia,$subFamilia];
                            case 'AR COND.BOMBA DE CALOR':
                                $subFamilia = Cat::AC_FIXO;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    default:
                        $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                        return [$gama,null,null];
                }
                
            case 'PEQUENOS DOMÉSTICOS':
                $gama = Cat::PEQUENOS_DOMESTICOS;
                switch ($familia) {
                    case 'ARTIGOS DE MENAGE':
                        $familia = Cat::ARTIGOS_DE_MENAGE;
                        switch ($subFamilia) {
                            case 'PEQ.APARELHOS COZINHA':
                                $subFamilia = Cat::PEQ_APARELHOS_COZINHA;
                                return [$gama,$familia,$subFamilia];
                            case 'PANELAS DE PRESSÃO':
                                $subFamilia = Cat::PANELAS_DE_PRESSAO;
                                return [$gama,$familia,$subFamilia];
                            case 'CAÇAROLAS':
                                $subFamilia = Cat::CACAROLAS;
                                return [$gama,$familia,$subFamilia];
                            case 'PANELAS/TABULEIROS':
                                $subFamilia = Cat::PANELAS_TABULEIROS;
                                return [$gama,$familia,$subFamilia];
                            case 'TRENS DE COZINHA':
                                $subFamilia = Cat::TRENS_COZINHA;
                                return [$gama,$familia,$subFamilia];
                            case 'FRIGIDEIRAS':
                                $subFamilia = Cat::FRIGIDEIRAS;
                                return [$gama,$familia,$subFamilia];
                            case 'TACHOS':
                                $subFamilia = Cat::TACHOS;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'ASSEIO PESSOAL':
                        $familia = Cat::ASSEIO_PESSOAL;
                        switch ($subFamilia) {
                            case 'SECADORES DE CABELO':
                                $subFamilia = Cat::SECADORES_DE_CABELO;
                                return [$gama,$familia,$subFamilia];
                            case 'APARADORES':
                            case 'MAQUINAS DE BARBEAR':
                                $subFamilia = Cat::CUIDADOS_MASCULINOS;
                                return [$gama,$familia,$subFamilia];
                            case 'ESCOVAS DE DENTES':
                                $subFamilia = Cat::ESCOVAS_DE_DENTES;
                                return [$gama,$familia,$subFamilia];
                            case 'MODELADORES':
                                $subFamilia = Cat::MODELADORES;
                                return [$gama,$familia,$subFamilia];
                            case 'DEPILADORAS':
                                $subFamilia = Cat::DEPILADORAS;
                                return [$gama,$familia,$subFamilia];
                            case 'SAÚDE E BELEZA':
                                $subFamilia = Cat::SAUDE_BELEZA;
                                return [$gama,$familia,$subFamilia];
                            case 'BALANÇAS DE W.C.':
                                $subFamilia = Cat::BALANÇAS_DE_WC;
                                return [$gama,$familia,$subFamilia];
                            case 'MASSAJADORES':
                                $subFamilia = Cat::SAUDE_BELEZA;
                                return [$gama,$familia,$subFamilia];
                            case 'PEDICURE/MANICURE':
                                $subFamilia = Cat::SAUDE_BELEZA;
                                return [$gama,$familia,$subFamilia];
                            case 'APARELHOS PARA BEBÉ':
                                $subFamilia = Cat::SAUDE_BELEZA;
                                return [$gama,$familia,$subFamilia];
                            case 'TERMOMETRO/MEDID.TENSÃO':
                                $subFamilia = Cat::SAUDE_BELEZA;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'CUIDADO DE ROUPA':
                        $familia = Cat::CUIDADO_DE_ROUPA;
                        switch($subFamilia) {
                            case 'FERROS A VAPOR':
                                $subFamilia = Cat::FERROS_A_VAPOR;
                                return [$gama,$familia,$subFamilia];
                            case 'FERROS COM CALDEIRA':
                                $subFamilia = Cat::FERROS_CALDEIRA;
                                return [$gama,$familia,$subFamilia];
                            case 'FERROS SECOS':
                                $subFamilia = Cat::FERROS_A_SECO;
                                return [$gama,$familia,$subFamilia];
                            case 'TÁBUAS DE PASSAR':
                                $subFamilia = Cat::TABUAS_PASSAR_FERRO;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'APARELHOS DE COZINHA':
                        $familia = Cat::APARELHOS_DE_COZINHA;
                        switch ($subFamilia) {
                            case 'FORNOS':
                                $subFamilia = Cat::FORNOS_DE_BANCADA;
                                return [$gama,$familia,$subFamilia];
                            case 'MAQ.CAFE EXPRESSO':
                                $subFamilia = Cat::MAQ_CAFE;
                                return [$gama,$familia,$subFamilia];
                            case 'MAQUINAS DE COZINHA':
                                $subFamilia = Cat::MAQ_DE_COZINHA;
                                return [$gama,$familia,$subFamilia];
                            case 'GELEIRAS / REFRIGERADORES':
                                $subFamilia = Cat::GELEIRAS_CONGELADORES;
                                return [$gama,$familia,$subFamilia];
                            case 'SANDWICHEIRAS':
                                $subFamilia = Cat::SANDWICHEIRAS;
                                return [$gama,$familia,$subFamilia];
                            case 'GRELHADORES':
                                $subFamilia = Cat::GRELHADORES;
                                return [$gama,$familia,$subFamilia];
                            case 'VARINHAS MAGICAS':
                                $subFamilia = Cat::VARINHAS_MAGICAS;
                                return [$gama,$familia,$subFamilia];
                            case 'BATEDEIRAS':
                                $subFamilia = Cat::BATEDEIRAS;
                                return [$gama,$familia,$subFamilia];
                            case 'JARROS E FERV./PURIF. ÁGUA':
                                $subFamilia = Cat::JARROS_E_FERV_PURIF_ÁGUA;
                                return [$gama,$familia,$subFamilia];
                            case 'FOGAREIROS':
                                $subFamilia = Cat::FOGAREIROS;
                                return [$gama,$familia,$subFamilia];
                            case 'FRITADEIRAS':
                                $subFamilia = Cat::FRITADEIRAS;
                                return [$gama,$familia,$subFamilia];
                            case 'ROBOT DE COZINHA':
                                $subFamilia = Cat::ROBOTS_DE_COZINHA;
                                return [$gama,$familia,$subFamilia];
                            case 'CAFETEIRAS':
                                $subFamilia = Cat::CAFETEIRAS;
                                return [$gama,$familia,$subFamilia];
                            case 'TORRADEIRAS':
                                $subFamilia = Cat::TORRADEIRAS;
                                return [$gama,$familia,$subFamilia];
                            case 'CENTRIFUGADORAS':
                                $subFamilia = Cat::CENTRIFUGADORAS;
                                return [$gama,$familia,$subFamilia];
                            case 'LIQUIDIFICADORAS':
                                $subFamilia = Cat::LIQUIDIFICADORAS;
                                return [$gama,$familia,$subFamilia];
                            case 'ESPREMEDORES':
                                $subFamilia = Cat::ESPREMEDORES;
                                return [$gama,$familia,$subFamilia];
                            case 'MOINHOS DE CAFE':
                                $subFamilia = Cat::MOINHOS_DE_CAFE;
                                return [$gama,$familia,$subFamilia];
                            case 'CÁPSULAS DE CAFÉ':
                                $subFamilia = Cat::CAPSULAS_CAFE;
                                return [$gama,$familia,$subFamilia];
                            case 'ABRE-LATAS E FACAS':
                                $subFamilia = Cat::ABRE_LATAS_FACAS;
                                return [$gama,$familia,$subFamilia];
                            case 'BALANÇAS DE COZINHA':
                                $subFamilia = Cat::BALANÇAS_DE_COZINHA;
                                return [$gama,$familia,$subFamilia];
                            case 'FIAMBREIRAS':
                                $subFamilia = Cat::FIAMBREIRAS;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'APARELHOS DE LIMPEZA':
                        $familia = Cat::APARELHOS_DE_LIMPEZA;
                        switch ($subFamilia) {
                            case 'ASPIRADOR SEM SACO':
                                $subFamilia = Cat::ASPIRADOR_SEM_SACO;
                                return [$gama,$familia,$subFamilia];
                            case 'ASPIRADOR VERTICAL':
                                $subFamilia = Cat::ASPIRADOR_VERTICAL;
                                return [$gama,$familia,$subFamilia];
                            case 'ASPIRADOR COM SACO':
                                $subFamilia = Cat::ASPIRADOR_COM_SACO;
                                return [$gama,$familia,$subFamilia];
                            case 'MINI ASPIRADORES':
                                $subFamilia = Cat::MINI_ASPIRADORES;
                                return [$gama,$familia,$subFamilia];
                            case 'ENCERADORAS':
                                $subFamilia = Cat::ASPIRADOR_COM_SACO;
                                return [$gama,$familia,$subFamilia];
                            case 'ASPIRADOR ESCOVA':
                                $subFamilia = Cat::ASPIRADOR_ESCOVA;
                                return [$gama,$familia,$subFamilia];
                            case 'MAQ.LAVAR VIDROS':
                                $subFamilia = Cat::MAQ_LAVAR_VIDROS;
                                return [$gama,$familia,$subFamilia];
                            case 'MAQ.LIMPEZA A VAPOR':
                                $subFamilia = Cat::MAQ_LIMPEZA_VAPOR;
                                return [$gama,$familia,$subFamilia];
                            case 'MAQ.LAVAR ALTA PRESSÃO':
                                $subFamilia = Cat::MAQ_LAVAR_PRESSAO;
                                return [$gama,$familia,$subFamilia];
                            default:
                                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                return [$gama,$familia,null];
                        }
                    case 'MAQUINAS DE COSTURA':
                        $familia = Cat::CUIDADO_DE_ROUPA;    
                        $subFamilia = Cat::MAQ_COSTURA;
                        return [$gama,$familia,$subFamilia];
                    default:
                        $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                        return [$gama,null,null];
                }
            case 'CAR AUDIO':
                $gama = Cat::IMAGEM_E_SOM;
                switch ($familia) {
                    case 'ALTIFALANTES':
                        $familia = Cat::CAR_AUDIO;
                        $subFamilia = Cat::ALTIFALANTES;
                        return [$gama,$familia,$subFamilia];
                    case 'AUTO-RADIOS':
                        $familia = Cat::CAR_AUDIO;
                        $subFamilia = Cat::AUTO_RADIOS;
                        return [$gama,$familia,$subFamilia];
                    case 'SISTEMAS DE NAVEGAÇÃO':
                        $familia = Cat::CAR_AUDIO;
                        $subFamilia = Cat::SISTEMAS_NAVEGAÇÃO;
                        return [$gama,$familia,$subFamilia];
                    case 'COLUNAS':
                        $familia = Cat::CAR_AUDIO;
                        $subFamilia = Cat::COLUNAS_AUTO;
                        return [$gama,$familia,$subFamilia];
                    case 'AMPLIFICADORES';
                        $familia = Cat::CAR_AUDIO;
                        $subFamilia = Cat::AMPLIFICADORES_AUTO;
                    default:
                        $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                        return [$gama,$familia,null];
                }
            default:
                $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                return [null,null,null];
        
        }
    }
}
<?php 

namespace Mlp\Cli\Helper\Expert;

use Mlp\Cli\Helper\CategoriesConstants as Cat;

class ExpertCategories {
    
    
    public static function setExpertCategories($categories,$logger,$sku,$attributes,$name) {
            $pieces = explode("->",$categories);
            $gama = $pieces[0];
            $familia = $pieces[1];
            $subFamilia = $pieces[2];
            switch($gama) {
                //Informática->Monitores->LFD
                case 'Impressoras':
                case 'Informática':
                    $gama = Cat::INFORMATICA;
                    switch ($familia) {
                        case 'Computadores e Tablets':
                            $familia = Cat::COMPUTADORES_E_TABLETS;
                            switch ($subFamilia) {
                                case 'Notebooks':
                                    $subFamilia = Cat::PORTATEIS_NOTEBOOKS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Tablets':
                                    $subFamilia = Cat::TABLETS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Acessórios Tablets':
                                    $subFamilia = Cat::ACESSORIOS_TABLETS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Acessórios Notebooks':
                                    $subFamilia = Cat::ACESSORIOS_NOTEBOOKS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Outros':
                                    $subFamilia = Cat::ACESSORIOS_NOTEBOOKS;
                                    return [$gama,$familia,null];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,null];
                            }
                        case 'Monitores':
                            $familia = Cat::MONITORES;
                            switch ($subFamilia) {
                                case 'LFD':
                                case 'TFT':
                                case 'LED':
                                    $subFamilia = Cat::MONITORES_PC;
                                    return [$gama,$familia,$subFamilia];
                                case 'Curvo':
                                    $subFamilia = Cat::MONITORES_PC_CURVO;
                                    return [$gama,$familia,$subFamilia];
                                case 'LED TV':
                                    $subFamilia = Cat::MONITORES_C_TV;
                                    return [$gama,$familia,$subFamilia];
                                case 'Tácteis':
                                    $subFamilia = Cat::MONITORES_TACTEIS;
                                    return [$gama,$familia,$subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,null];
                            }
                            break;
                        case 'Impressoras':
                            //Informática->Impressoras->Jacto de Tinta
                            switch ($subFamilia) {
                                case 'Acessórios':
                                case 'Consumíveis':
                                    $subFamilia = Cat::ACESSORIOS_IMPRESSORAS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Jacto de Tinta':
                                    $familia = Cat::IMPRESSORAS;
                                    $subFamilia = Cat::IMPRESSORAS_JACTO_DE_TINTA;
                                    return [$gama,$familia,$subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,null];
                                    
                            }
                        case 'Jacto de Tinta':
                            $familia = Cat::IMPRESSORAS;
                            $subFamilia = Cat::IMPRESSORAS_JACTO_DE_TINTA;
                            return [$gama,$familia,$subFamilia];
                        case 'Integração e Periféricos':
                            $familia = Cat::ACESSORIOS_INFORMATICA;
                            switch ($subFamilia) {
                                case 'UPS':
                                    $subFamilia = Cat::UPS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Webcams':
                                    $subFamilia = Cat::WEB_CAMS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Armazenamento Dados':
                                    $familia = Cat::MEMORIAS;
                                    $subFamilia = null;
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,$subFamilia];
                                case 'Leitor de cartões':
                                    $subFamilia = Cat::LEITOR_CARTOES;
                                    return [$gama,$familia,$subFamilia];
                                case 'Colunas':
                                    $gama = Cat::IMAGEM_E_SOM;
                                    $familia = Cat::EQUIPAMENTOS_AUDIO;
                                    $subFamilia = Cat::SOUND_BARS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Outros':
                                case 'Periféricos':
                                case 'Teclados e Ratos':
                                case 'drives':
                                case 'Hubs USB':
                                    $subFamilia = Cat::OUTROS_ACESSORIOS_INFORMATICA;
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,$subFamilia];
                                case 'Adaptadores e Cabos':
                                case 'Redes':
                                    $subFamilia = Cat::REDES_CABOS;
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,$subFamilia];
                                case 'Transporte':
                                    $subFamilia = Cat::MALAS_BOLSAS_INFORMATICA;
                                    return [$gama,$familia,$subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,null]; 
                            }
                        case 'Software':
                            $familia = Cat::INFORMATICA_SOFTWARE;
                            switch ($subFamilia) {
                                case 'Segurança':
                                    $subFamilia = Cat::INFORMATICA_SOFTWARE_SEGURANCA;
                                    return [$gama,$familia,$subFamilia];
                                case 'POS':
                                    $subFamilia = Cat::INFORMATICA_SOFTWARE_POS;
                                    return [$gama,$familia,$subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,null];
                                    break;
                            }
                        case 'Gaming':
                            $familia = Cat::GAMING;
                            switch ($subFamilia) {
                                case 'Acessórios Playstation':
                                    $subFamilia = Cat::ACESSORIOS_PLAYSTATION;
                                    return [$gama, $familia, $subFamilia];
                                case 'Consolas Playstation':
                                    $subFamilia = Cat::CONSOLAS_PLAYSTATION;
                                    return [$gama, $familia, $subFamilia];
                                case 'Jogos Playstation':
                                    $subFamilia = Cat::JOGOS_PLAYSTATION;
                                    return [$gama, $familia, $subFamilia];
                                case 'Acessórios PC Gaming':
                                    $subFamilia = Cat::ACESSORIOS_PC_GAMING;
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        default:
                            $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                            return [$gama,null,null];
                    }
                
                case 'Audiovisual':
                    $gama = Cat::IMAGEM_E_SOM;
                    switch ($familia) {
                        case 'TV':
                            switch ($subFamilia) {
                                case 'Suportes':
                                    $familia = Cat::ACESSORIOS_IMAGEM_E_SOM;
                                    $subFamilia = Cat::MOVEIS_SUPORTES;
                                    return [$gama,$familia,$subFamilia];
                                case 'Acessórios':
                                    $familia = Cat::ACESSORIOS_IMAGEM_E_SOM;
                                    $subFamilia = Cat::ACESSORIOS_TV;
                                    return [$gama,$familia,$subFamilia];
                                case 'Cabos':    
                                    $familia = Cat::ACESSORIOS_IMAGEM_E_SOM;
                                    $subFamilia = Cat::CABOS_TV;
                                    return [$gama,$familia,$subFamilia];
                                case 'De 50 a 65 Polegadas':
                                    $familia = Cat::TELEVISAO;
                                    $subFamilia = Cat::TVS_GRANDES;
                                    return [$gama,$familia,$subFamilia];
                                case 'Até 49 Polegadas':
                                    $familia = Cat::TELEVISAO;
                                    if (preg_match('/Ecr..:(\d\d)/',$attributes,$dimensaoEcra) == 1) {
                                        if ((int)$dimensaoEcra[1] <= 40 ){
                                            $subFamilia = Cat::TVS_PEQUENAS;
                                            return [$gama,$familia,$subFamilia];
                                        }elseif((int)$dimensaoEcra[1] <= 46) {
                                            $subFamilia = Cat::TVS_MEDIAS;
                                            return [$gama,$familia,$subFamilia];
                                        }else {
                                            $subFamilia = Cat::TVS_GRANDES;
                                            return [$gama,$familia,$subFamilia];
                                        }
                                    }else{
                                        $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                        return [$gama,$familia,null];
                                    }
                                case 'Mais de 65 Polegadas':
                                    $familia = Cat::TELEVISAO;
                                    $subFamilia = Cat::TVS_GRANDES;
                                    return [$gama,$familia,$subFamilia];
                                case 'Hotelaria':
                                    $familia = Cat::TELEVISAO;
                                    $subFamilia = Cat::TV_HOTELARIA;
                                    return [$gama,$familia,$subFamilia];
                                case 'LED':
                                    $familia = Cat::TELEVISAO;
                                    if (preg_match('/Ecr..:(\d\d)/',$attributes,$dimensaoEcra) == 1) {
                                        if ((int)$dimensaoEcra[1] <= 40 ){
                                            $subFamilia = Cat::TVS_PEQUENAS;
                                            return [$gama,$familia,$subFamilia];
                                        }elseif ((int)$dimensaoEcra[1] <= 46) {
                                            $subFamilia = Cat::TVS_MEDIAS;
                                            return [$gama,$familia,$subFamilia];
                                        }else {
                                            $subFamilia = Cat::TVS_GRANDES;
                                            return [$gama,$familia,$subFamilia];
                                        }
                                    }else{
                                        $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                        return [$gama,$familia,null];
                                    }
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,null];
                            }
                        case 'Projectores':
                            $familia = Cat::PROJECTORES;
                            switch ($subFamilia) {
                                case 'Portátil':
                                    $subFamilia = Cat::PROJECTORES_PORTATEIS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Mesa':
                                    $subFamilia = Cat::PROJECTORES_MESA;
                                    return [$gama, $familia, $subFamilia];
                                case 'Acessórios':
                                    $subFamilia = Cat::ACESSORIOS_PROJECTORES;
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];  
                            }
                        case 'Home Cinema':
                            $familia = Cat::EQUIPAMENTOS_AUDIO;
                            switch ($subFamilia) {
                                case 'Kit Colunas':
                                    $subFamilia = Cat::SIST_HOME_CINEMA;
                                    return [$gama, $familia, $subFamilia];
                                    
                                case 'Sound Bars':
                                    $subFamilia = Cat::SOUND_BARS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Receptores AV':
                                    $subFamilia = Cat::RECEPTORES_AV;
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        case 'Sistema Áudio':
                            $familia = Cat::EQUIPAMENTOS_AUDIO;
                            switch ($subFamilia) {
                                case 'Mini':
                                case 'Micro':
                                    $subFamilia = Cat::APARELHAGENS_MICROS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Outros':
                                case 'Gira Discos':
                                case 'Walkmans e Discmans':
                                case 'Jukebox':
                                    $subFamilia = Cat::OUTRO_HIFI;
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, $subFamilia];
                                case 'Amplificadores':
                                    $subFamilia = Cat::AMPLIFICADORES_HIFI;
                                    return [$gama, $familia, $subFamilia];
                                case 'Colunas':
                                    $familia = Cat::COLUNAS;
                                    $subFamilia = null;
                                    return [$gama, $familia, $subFamilia];
                                case 'Rádio':
                                    $familia = Cat::AUDIO_PORTATIL;
                                    $subFamilia = Cat::RADIOS_PORTATEIS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Rádio CD':
                                    $familia = Cat::AUDIO_PORTATIL;
                                    $subFamilia = Cat::RADIO_CDS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Auscultadores':
                                    $familia = Cat::AUSCULTADORES;
                                    $subFamilia = null;
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        case 'Leitores e Gravadores':
                            $familia = Cat::DVD_BLURAY_TDT;
                            switch ($subFamilia) {
                                case 'BlueRay':
                                case 'DVD':
                                case 'CD':
                                    $subFamilia = Cat::LEITOR_DVD;
                                    return [$gama, $familia, $subFamilia];
                                case 'Acessórios':
                                    $subFamilia = Cat::ACESSORIOS_LEITORES_GRAVADORES;
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        case 'Sistema Áudio':
                            switch ($subFamilia) {
                                case 'Electrónica Auto':
                                    $familia = Cat::CAR_AUDIO;
                                    $subFamilia = Cat::AUTO_RADIOS;
                                    return [$gama, $familia, $subFamilia];     
                                case 'Gira Discos':
                                    $familia = Cat::EQUIPAMENTOS_AUDIO;
                                    $subFamilia = Cat::GIRA_DISCOS;
                                    return [$gama, $familia, $subFamilia]; 
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        case 'Monitores':
                            $familia = Cat::TELEVISAO;
                            $subFamilia = Cat::TV_HOTELARIA;
                            return [$gama, $familia, $subFamilia];
                        default:
                            $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                            return [$gama, null, null];
                    }
                case 'Comunicações':
                    $gama = Cat::COMUNICACOES;
                    switch ($familia) {
                        case 'Comunicações Móveis':
                            switch ($subFamilia) {
                                case 'Car Kits':
                                    $gama = Cat::IMAGEM_E_SOM;
                                    $familia = Cat::CAR_AUDIO;
                                    $subFamilia = Cat::CAR_KITS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Alimentação':
                                    $familia = Cat::ACESSORIOS_COMUNICACOES;
                                    $subFamilia = Cat::ALIMENTACAO_COMUNICACOES;
                                    return [$gama, $familia, $subFamilia];
                                case 'Telemóveis':
                                    $familia = Cat::TELEMOVEIS;
                                    $subFamilia = null;
                                    return [$gama, $familia, $subFamilia];
                                case 'Auriculares':
                                    $familia = Cat::ACESSORIOS_COMUNICACOES;
                                    $subFamilia = Cat::AURICULARES;
                                    return [$gama, $familia, $subFamilia];
                                case 'Bolsas/Protecções':
                                    $familia = Cat::ACESSORIOS_COMUNICACOES;
                                    $subFamilia = Cat::BOLSAS_PROTECCOES;
                                    return [$gama, $familia, $subFamilia];
                                case 'Colunas':
                                    $gama = Cat::IMAGEM_E_SOM;
                                    $familia = Cat::COLUNAS;
                                    $subFamilia = null;
                                    return [$gama, $familia, $subFamilia];
                                case 'Outros Acessórios':
                                    $familia = Cat::ACESSORIOS_COMUNICACOES;
                                    $subFamilia = Cat::OUTROS_ACESSORIOS_COMUNICACOES;
                                    return [$gama, $familia, $subFamilia];
                                case 'Smartwatches':
                                    $familia = Cat::SMARTWATCHES;
                                    $subFamilia = null;
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                            # code...
                        case 'Comunicações Fixas':
                            switch ($subFamilia) {
                                case 'Telefones':
                                    $familia = Cat::COMUNICACOES_FIXAS;
                                    $subFamilia = Cat::TELEFONES_FIXOS;
                                    return [$gama, $familia, $subFamilia];
                                
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                                    break;
                            }
                        
                        default:
                            $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                            return [$gama, null, null];
                    }
                case 'Foto e Vídeo':
                    $gama = Cat::IMAGEM_E_SOM;
                    switch ($familia) {
                        case 'Câmaras Fotográficas':
                            //Foto e Vídeo->Câmaras de Vídeo->Drones
                            $familia = Cat::CAMARAS_FOTOGRAFICAS;
                            switch ($subFamilia) {
                                case 'Compactas':
                                    $subFamilia = Cat::FOTOS_DIGITAL_COMPACTA;
                                    return [$gama, $familia, $subFamilia];
                                case 'Objectivas':
                                    $familia = Cat::ACESSORIOS_CAMARAS_FOTOGRAFICAS;
                                    $subFamilia = Cat::OBJECTIVAS_CAMARAS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Reflex':
                                    $subFamilia = Cat::CAMARAS_REFLEX;
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                            break;
                        case 'Câmaras de Vídeo':
                            $familia = Cat::CAMARAS_VIDEO;
                            switch ($subFamilia) {
                                case 'Câmeras de Vigilância':
                                    $subFamilia = Cat::CAMARAS_VIGILANCIA;
                                    return [$gama, $familia, $subFamilia];
                                case 'Drones':
                                    $subFamilia = Cat::DRONES;
                                    return [$gama, $familia, $subFamilia];
                                case 'Standard':
                                    $subFamilia = Cat::CAMARAS_VIDEO_STANDARD;
                                    return [$gama, $familia, $subFamilia];
                                case 'HD - Alta definição':
                                    $subFamilia = Cat::CAMARAS_VIDEO_HD;
                                    return [$gama, $familia, $subFamilia];
                                case 'Acessórios de vídeo':
                                    $subFamilia = Cat::ACESSORIOS_CAM_VIDEO;
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        
                        
                        case 'Acessórios':
                            $familia = Cat::ACESSORIOS_IMAGEM_E_SOM;
                            switch ($subFamilia) {
                                case 'Bolsas':
                                    $subFamilia = Cat::BOLSAS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Impressoras Fotog.':
                                    $gama = Cat::INFORMATICA;
                                    $familia = Cat::IMPRESSORAS;
                                    $subFamilia = Cat::IMPRESSORAS_FOTOS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Tripés/Monopés':
                                case 'Flash':
                                case 'Kits':
                                case 'Lentes':
                                case 'Filtros':
                                case 'Outros':
                                case 'Alimentação':
                                    $subFamilia = Cat::OUTROS_ACESSORIOS_IMAGEM_SOM;
                                    return [$gama, $familia, $subFamilia];
                                
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        case 'Cartões de Memória':
                            $gama = Cat::INFORMATICA;
                            $familia = Cat::MEMORIAS;
                            $subFamilia = Cat::CARTOES_MEMORIA;
                            return [$gama, $familia, $subFamilia];
                        case 'Pilhas e Carregadores':
                            $gama = Cat::ELECTRICIDADE;
                            $familia = Cat::PILHAS_BATERIAS;
                            $subFamilia = Cat::PILHAS_RECARREGAVEIS;
                            return [$gama, $familia, $subFamilia];
                        default:
                            $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                            return [$gama, null, null];
                            
                        
                    }
                case 'Energia':
                    //Energia->Pilhas e Carregadores->Lítio
                    $gama = Cat::ELECTRICIDADE;
                    switch ($familia) {
                        case 'Fichas / Tomadas':
                            $familia = Cat::FICHAS_TOMADAS;
                            switch ($subFamilia) {
                                case 'Tomadas':
                                    $subFamilia = Cat::TOMADAS;
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        case 'Iluminação':
                            $familia = Cat::ILUMINACAO;
                            switch ($subFamilia) {
                                case 'Lanternas':
                                    $subFamilia = Cat::LANTERNAS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Lâmpadas':
                                    $subFamilia = Cat::LAMPADAS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Diversos':
                                    $subFamilia = Cat::DIVERSOS_ILUMINACAO;
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        case 'Pilhas e Carregadores':
                            $familia = Cat::PILHAS_BATERIAS;
                            switch ($subFamilia) {
                                case 'Lítio':
                                case 'Standard':
                                case 'Específicas':
                                case 'Super Alcalinas':
                                case 'Alcalinas':
                                case 'Micro Alcalinas':
                                    $subFamilia = Cat::PILHAS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Recarregáveis':
                                case 'Carregadores':
                                    $subFamilia = Cat::PILHAS_RECARREGAVEIS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Comando':
                                    $subFamilia = Cat::PILHAS_COMANDO;
                                    return [$gama, $familia, $subFamilia];
                                case 'Baterias':
                                    $subFamilia = Cat::BATERIAS;
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        case 'Extensões / Cabos':
                            $familia = Cat::EXTENSOES_CABOS;
                            switch ($subFamilia) {
                                case 'Extensões Múltiplas':
                                    $subFamilia = Cat::EXTENSOES_MULTIPLAS;
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        case 'Acessórios':
                            switch ($subFamilia) {
                                case 'Alimentação':
                                    $familia = Cat::ACESSORIOS_ILUMINACAO;
                                    return [$gama, $familia, null];
                                
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        default:
                            $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                            return [$gama, null, null];
                            break;
                    }
                case 'Eletrodomésticos':
                    $gama = Cat::GRANDES_DOMESTICOS;
                    switch ($familia) {
                        case 'Máquina Lavar Loiça':
                            switch ($subFamilia) {
                                case 'Acessórios':
                                case 'Consumíveis':
                                    $familia = Cat::ACESSORIOS_GRANDES_DOMESTICOS;
                                    $subFamilia = null;
                                    return [$gama, $familia, $subFamilia];
                                
                                case '10 Conjuntos':
                                case '6 Conjuntos':
                                    $familia = Cat::MAQ_DE_LOUCA;
                                    $subFamilia = Cat::MLL_DE_45;
                                    return [$gama, $familia, $subFamilia];
                                case '12 Conjuntos':
                                case '13 Conjuntos':
                                case '14 Conjuntos':
                                case '15 Conjuntos':
                                case '16 Conjuntos':
                                    $familia = Cat::MAQ_DE_LOUCA;
                                    $subFamilia = Cat::MLL_DE_60;
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $familia = Cat::MAQ_DE_LOUCA;
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];                     
                            }
                            
                        case 'Máquinas de Roupa':
                            $familia = Cat::MAQ_ROUPA;
                            switch ($subFamilia) {
                                case 'Máquina Lavar Roupa':
                                case 'Máquinas TwinWash':
                                    $subFamilia = Cat::MAQ_LAVAR_ROUPA;
                                    return [$gama, $familia, $subFamilia];
                                case 'Máquina Secar Roupa':
                                    if(preg_match('/SecagemExaust/',$attributes) == 1){
                                        $subFamilia = Cat::MAQ_SECAR_ROUPA_VENT;
                                        return [$gama, $familia, $subFamilia];
                                    }elseif(preg_match('/SecagemCondensa/',$attributes) == 1){
                                        $subFamilia = Cat::MAQ_SECAR_ROUPA_COND;
                                        return [$gama, $familia, $subFamilia];
                                    }elseif(preg_match('/SecagemBomba/',$attributes) == 1){
                                        $subFamilia = Cat::MAQ_SECAR_ROUPA_BC;
                                        return [$gama, $familia, $subFamilia];
                                    }else{
                                        $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                        return [$gama, $familia, null];
                                    }
                                case 'Acessórios':
                                case 'Consumíveis':
                                    $subFamilia = Cat::ACESSORIOS_MAQ_ROUPA;
                                    return [$gama, $familia, $subFamilia];
                                case 'Máquina Lavar e Secar Roupa':
                                    $subFamilia = Cat::MAQ_LAVAR_SECAR_ROUPA;
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        case 'Frio':
                            $familia = Cat::FRIO;
                            switch ($subFamilia) {
                                case 'Produtores de Gelo':
                                    $gama = Cat::PEQUENOS_DOMESTICOS;
                                    $familia = Cat::APARELHOS_DE_COZINHA;
                                    $subFamilia = Cat::MAQ_DE_COZINHA;
                                    return [$gama, $familia, $subFamilia];
                                case 'Frigorifico 2 portas':
                                    $subFamilia = Cat::FRIGORIF_2_PORTAS;
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, $subFamilia];
                                case 'Congelador Vertical':
                                    $subFamilia = Cat::CONGELADORES_VERTICAIS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Side By Side':
                                    $subFamilia = Cat::FRIGORIF_AMERICANOS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Frigorifico 1 porta':
                                    $subFamilia = Cat::FRIGORIF_1_PORTA;
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, $subFamilia];
                                case 'Arca Horizontal':
                                    $subFamilia = Cat::CONGELADORES_HORIZONTAIS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Garrafeira':
                                    $subFamilia = Cat::GARRAFEIRAS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Acessórios':
                                case 'Consumíveis':
                                    $subFamilia = Cat::ACESSORIOS_FRIO;
                                    return [$gama, $familia, $subFamilia];
                                case 'Combinados':
                                    $subFamilia = Cat::COMBINADOS_CONVENCIONAIS;
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        case 'Fogão':
                            $familia = Cat::FOGOES;
                            switch ($subFamilia) {
                                case 'Mistos':
                                case 'Gás':
                                    $subFamilia = Cat::FOGOES_GAS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Vitrocerâmica':
                                case 'Eléctricos':
                                case 'Indução':
                                    $subFamilia = Cat::FOGOES_ELECTRICOS;
                                    return [$gama, $familia, $subFamilia];
                                
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        case 'Encastre':
                            $gama = Cat::ENCASTRE;
                            switch ($subFamilia) {
                                case 'Máquinas de Secar Roupa':
                                    $familia = Cat::MAQ_ROUPA_ENC;
                                    $subFamilia = Cat::MAQ_SECAR_ROUPA_ENC;
                                    return [$gama, $familia, $subFamilia];
                                case 'Chaminés':
                                    $familia = Cat::EXAUSTORES;
                                    $subFamilia = Cat::EXAUSTORES_CHAMINE;
                                    return [$gama, $familia, $subFamilia];
                                case 'Exaustores':
                                    $familia = Cat::EXAUSTORES;
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                                case 'Máquinas Lavar Roupa':
                                    $familia = Cat::MAQ_ROUPA_ENC;
                                    $subFamilia = Cat::MAQ_LAVAR_ROUPA_ENC;
                                    return [$gama, $familia, $subFamilia];
                                case 'Máquina de Café':
                                    $familia = Cat::MAQ_CAFE_ENC;
                                    return [$gama, $familia, null];
                                case 'Fornos':
                                    $familia = Cat::FORNOS;
                                    if (preg_match('/Limpeza:Piro/',$attributes) == 1) {
                                        $subFamilia = Cat::FORNOS_PIROLITICOS;
                                        return [$gama, $familia, $subFamilia];
                                    }
                                    elseif (preg_match('/Tipo:(\w+)\s*/',$attributes,$tipoForno) == 1){
                                        switch ($tipoForno[1]) {
                                            case 'G':
                                                $subFamilia = Cat::FORNOS_GAS;
                                                return [$gama, $familia, $subFamilia];
                                            default:
                                                $subFamilia = Cat::FORNOS_MULTIFUNC;
                                                return [$gama, $familia, $subFamilia];
                                        }
                                    }
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                                case 'Acessórios':
                                case 'Consumíveis':
                                    $familia = Cat::ACESSORIOS_ENC;
                                    return [$gama, $familia, null];
                                case 'Placas':
                                    $familia = Cat::PLACAS;
                                    if (preg_match('/Tipo de Queimadores:(\w+)\s*/ui', $attributes, $tipoPlaca) == 1
                                     && preg_match('/Qte.+:(\d)\s*/', $attributes, $numeroQueimadores) == 1) {
                                        if ($numeroQueimadores[1] <= 2) {
                                            $subFamilia = Cat::PLACAS_DOMINO;
                                            return [$gama, $familia, $subFamilia];
                                        }else {
                                            switch ($tipoPlaca[1]) {
                                                case 'Gás':
                                                    $subFamilia = Cat::PLACAS_GAS;
                                                    return [$gama, $familia, $subFamilia];
                                                case 'Indução':
                                                    $subFamilia = Cat::PLACAS_INDUCAO;
                                                    return [$gama, $familia, $subFamilia];
                                                case 'Misto':
                                                    $subFamilia = Cat::PLACAS_MISTAS;
                                                    return [$gama, $familia, $subFamilia];
                                                case 'Vitrocerâmica':
                                                    $subFamilia = Cat::PLACAS_VITROCERAMICAS;
                                                    return [$gama, $familia, $subFamilia];
                                                case 'Elétrico':
                                                    $subFamilia = Cat::PLACAS_CONVENCIONAIS_ELETRICAS;
                                                    return [$gama, $familia, $subFamilia];
                                                default:
                                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                                    return [$gama, $familia, null];
                                                    break;
                                            }
                                        }
                                    }else {
                                        $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                        return [$gama, $familia, null];
                                    }
                                    
                                case 'Máquinas Lavar Loiça':
                                    $familia = Cat::MAQ_DE_LOUCA_ENC;
                                    return [$gama, $familia, null];
                                case 'Microondas':
                                    $familia = Cat::MICROONDAS_ENC;
                                    return [$gama, $familia, null];
                                case 'Máquinas de Lavar/Secar Roupa':
                                    $familia = Cat::MAQ_ROUPA_ENC;
                                    $subFamilia = Cat::MAQ_LAVAR_SECAR_ROUPA_ENC;
                                    return [$gama, $familia, $subFamilia];
                                case 'Lava-Loiças':
                                    $familia = Cat::LAVA_LOUCAS;
                                    return [$gama, $familia, null];
                                case 'Frio':
                                    $familia = Cat::FRIO_ENC;
                                    if (preg_match('/Combinado/',$name) == 1) {
                                        $subFamilia = Cat::COMBINADOS_ENC;
                                        return [$gama, $familia, $subFamilia];
                                    }elseif (preg_match('/Arca Vert/', $name) == 1 || 
                                        preg_match('/Congelador/',$name) == 1) {
                                            $subFamilia = Cat::CONGELADORES_ENC;
                                            return [$gama, $familia, $subFamilia];
                                        }
                                    elseif (preg_match('/Frigor/',$name)==1) {
                                        $subFamilia = Cat::FRIGORIFICOS_ENC;
                                        return [$gama, $familia, $subFamilia];   
                                    }elseif(preg_match('/Garrafeira/',$name)==1){
                                        $subFamilia = Cat::GARRAFEIRAS_ENC;
                                        return [$gama, $familia, $subFamilia];   
                                    }else {
                                        $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                        return [$gama, $familia, null];
                                    }
                                case 'Torneiras':
                                    $familia = Cat::MISTURADORAS;
                                    return [$gama, $familia, null];
                                //Exaustores nao sabemos a subfamilia (telescopicos integrar etc... extratores)                                
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                                    
                            }
                        default:
                            $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                            return [$gama, null, null];
                    }
                case 'Climatização':
                    $gama = Cat::CLIMATIZACAO;
                    switch ($familia) {
                        case 'Climatização de Água':
                            $gama = Cat::GRANDES_DOMESTICOS;
                            $familia = Cat::ESQUENTADORES_TERMOACUMULADORES;
                            switch ($subFamilia) {
                                case 'Termoacumuladores':
                                    $subFamilia = Cat::TERMOACUMULADORES_ELECTRICOS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Esquentadores':
                                    $subFamilia = Cat::ESQUENTADORES_C_GAS;
                                    return [$gama, $familia, $subFamilia];
                                case 'Bombas Calor':
                                    $subFamilia = Cat::BOMBA_CALOR;
                                    return [$gama, $familia, $subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama, $familia, null];
                            }
                        case 'Climatização':
                            $gama = Cat::CLIMATIZACAO;
                            switch ($subFamilia) {
                                case 'Toalheiros':
                                    $familia = Cat::AQUECIMENTO;
                                    $subFamilia = Cat::TOALHEIROS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Humidificadores':
                                    $familia = Cat::TRATAMENTO_DE_AR;
                                    $subFamilia = Cat::HUMIDIFICADORES;
                                    return [$gama,$familia,$subFamilia];
                                case 'Ar Condicionado':
                                    $familia = Cat::AR_CONDICIONADO;
                                    if(preg_match('/Portátil/',$name) == 1) {
                                        $subFamilia = Cat::AC_PORTATIL;
                                        return [$gama,$familia,$subFamilia];
                                    }else {
                                        $subFamilia = Cat::AC_FIXO;
                                        return [$gama,$familia,$subFamilia];
                                    }
                                case 'Aquecimento':
                                    $familia = Cat::AQUECIMENTO;
                                    $subFamilia = Cat::ELECTRICO;
                                    return [$gama,$familia,$subFamilia];
                                case 'Aquecimento Cama':
                                    $familia = Cat::AQUECIMENTO;
                                    $subFamilia = Cat::TEXTIL;
                                    return [$gama,$familia,$subFamilia];
                                case 'Desumidificadores':
                                    $familia = Cat::TRATAMENTO_DE_AR;
                                    $subFamilia = Cat::DESUMIDIFICADORES;
                                    return [$gama,$familia,$subFamilia];
                                case 'Acessórios':
                                case 'Consumíveis':
                                    $familia = Cat::ACESSORIOS_CLIMATIZACAO;
                                    $subFamilia = null;
                                    return [$gama,$familia,$subFamilia];
                                case 'Purificador de Ar':
                                    $familia = Cat::TRATAMENTO_DE_AR;
                                    $subFamilia = Cat::PURIFICADORES_AR;
                                    return [$gama,$familia,$subFamilia];
                                case 'Ventilação':
                                    $familia = Cat::VENTILACAO;
                                    $subFamilia = null;
                                    return [$gama,$familia,$subFamilia];
                                case 'Ar Condicionado Portátil':
                                    $familia = Cat::AR_CONDICIONADO;
                                    $subFamilia = Cat::AC_PORTATIL;
                                    return [$gama,$familia,$subFamilia];
                                case 'Acessórios Ar Condicionado':
                                    $familia = Cat::ACESSORIOS_CLIMATIZACAO;
                                    return [$gama,$familia,null];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,$subFamilia];
                            }
                        
                        default:
                            $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                            return [$gama,$familia,$subFamilia];
                    }
                case 'Pequenos Domésticos':
                    $gama = Cat::PEQUENOS_DOMESTICOS;
                    switch ($familia) {
                        case 'Cozinha':
                            $familia = Cat::APARELHOS_DE_COZINHA;
                            switch ($subFamilia) {
                                case 'Ménage':
                                    $familia = Cat::ARTIGOS_DE_MENAGE;
                                    if (preg_match('/LE CREUSET/',$name) == 1){
                                        $subFamilia = Cat::LE_CREUSET;
                                        return [$gama,$familia,$subFamilia];
                                    }elseif (preg_match('/Panela Press/',$name) == 1){
                                        $subFamilia = Cat::PANELAS_DE_PRESSAO;
                                        return [$gama,$familia,$subFamilia];
                                    }elseif (preg_match('/Panela/',$name) == 1){
                                        $subFamilia = Cat::PANELAS_TABULEIROS;
                                        return [$gama,$familia,$subFamilia];
                                    }elseif (preg_match('/Frigideira/',$name) == 1) {
                                        $subFamilia = Cat::FRIGIDEIRAS;
                                        return [$gama,$familia,$subFamilia];
                                    }elseif(preg_match('/Ca..arola/',$name) == 1) {
                                        $subFamilia = Cat::CACAROLAS;
                                        return [$gama,$familia,$subFamilia];
                                    }elseif(preg_match('/Trem/',$name) == 1) {
                                        $subFamilia = Cat::TRENS_COZINHA;
                                        return [$gama,$familia,$subFamilia];
                                    }else {
                                        $subFamilia = Cat::OUTROS_ARTIGOS_MENAGE;
                                        return [$gama,$familia,$subFamilia];
                                    }   
                                case 'Cozedura a Vapor/Panelas Elétricas':
                                    $subFamilia = Cat::MAQ_DE_COZINHA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Torradeiras':
                                    $subFamilia = Cat::TORRADEIRAS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Acessórios e Peças':
                                    $subFamilia = Cat::ACESSORIOS_COZINHA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Consumíveis':
                                    $subFamilia = Cat::ACESSORIOS_COZINHA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Fogareiros':
                                    $subFamilia = Cat::FOGAREIROS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Mini-Fornos':
                                    $subFamilia = Cat::FORNOS_DE_BANCADA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Fun Cooking e Diversos':
                                    $subFamilia = Cat::OUTROS_EQUIPAMENTOS_COZINHA;
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,$subFamilia];
                                case 'Liquidificadoras':
                                    $subFamilia = Cat::LIQUIDIFICADORAS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Puericultura':
                                    $familia = Cat::PUERICULTURA;
                                    $subFamilia = null;
                                    return [$gama,$familia,$subFamilia];
                                case 'Sanduicheiras':
                                    $subFamilia = Cat::SANDWICHEIRAS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Fritadeiras':
                                    $subFamilia = Cat::FRITADEIRAS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Balanças de Cozinha':
                                    $subFamilia = Cat::BALANÇAS_DE_COZINHA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Moínhos de Café':
                                    $subFamilia = Cat::MOINHOS_DE_CAFE;
                                    return [$gama,$familia,$subFamilia];
                                case 'Jarros Eléctricos':
                                    $subFamilia = Cat::JARROS_E_FERV_PURIF_ÁGUA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Varinhas':
                                    $subFamilia = Cat::VARINHAS_MAGICAS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Batedeiras':
                                    $subFamilia = Cat::BATEDEIRAS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Máq. de Café':
                                    $subFamilia = Cat::MAQ_CAFE;
                                    return [$gama,$familia,$subFamilia];
                                case 'Robots':
                                    $subFamilia = Cat::MAQ_DE_COZINHA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Grelhadores':
                                    $subFamilia = Cat::GRELHADORES;
                                    return [$gama,$familia,$subFamilia];
                                case 'Picadoras':
                                    $subFamilia = Cat::APARELHOS_DE_COZINHA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Espremedores':
                                    $subFamilia = Cat::ESPREMEDORES;
                                    return [$gama,$familia,$subFamilia];
                                case 'Centrifugadoras':
                                    $subFamilia = Cat::CENTRIFUGADORAS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Máq. de Pão':
                                    $subFamilia = Cat::APARELHOS_DE_COZINHA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Fiambreira':
                                    $subFamilia = Cat::FIAMBREIRAS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Máq. Embalar a Vácuo':
                                    $subFamilia = Cat::MAQ_DE_COZINHA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Difusor de Aromas':
                                    $gama = Cat::CLIMATIZACAO;
                                    $familia = Cat::TRATAMENTO_DE_AR;
                                    $subFamilia = Cat::DIFUSOR_AROMAS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Mata Insetos':
                                    $gama = Cat::PEQUENOS_DOMESTICOS;
                                    $familia = Cat::APARELHOS_DE_LIMPEZA;
                                    $subFamilia = Cat::MATA_INSETOS;
                                    return [$gama,$familia,$subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,null];
                            }
                        case 'Cuidados Pessoais':
                            $familia = Cat::ASSEIO_PESSOAL;
                            switch ($subFamilia) {
                                case 'Escovas de Dentes':
                                    $subFamilia = Cat::ESCOVAS_DE_DENTES;
                                    return [$gama,$familia,$subFamilia];
                                case 'Depiladoras':
                                    $subFamilia = Cat::DEPILADORAS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Acessórios':
                                    $subFamilia = Cat::ACESSORIOS_ASSEIO;
                                    return [$gama,$familia,$subFamilia];
                                case 'Cuidados Masculinos':
                                    $subFamilia = Cat::CUIDADOS_MASCULINOS;
                                    return [$gama,$familia,$subFamilia];
                                case 'Saúde':
                                    $subFamilia = Cat::SAUDE_BELEZA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Secadores':
                                    $subFamilia = Cat::SECADORES_DE_CABELO;
                                    return [$gama,$familia,$subFamilia];
                                case 'Modeladores':
                                    $subFamilia = Cat::MODELADORES;
                                    return [$gama,$familia,$subFamilia];
                                case 'Balanças WC':
                                    $subFamilia = Cat::BALANÇAS_DE_WC;
                                    return [$gama,$familia,$subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,null];
                            }
                        case 'Tratamento de Tecidos':
                            $familia = Cat::CUIDADO_DE_ROUPA;
                            switch ($subFamilia) {
                                case 'Máq. de Costura':
                                    $familia = Cat::MAQ_COSTURA;
                                    $subFamilia = null;
                                    return [$gama,$familia,$subFamilia];
                                case 'Tábuas de Engomar':
                                    $subFamilia = Cat::TABUAS_PASSAR_FERRO;
                                    return [$gama,$familia,$subFamilia];
                                case 'Acessórios':
                                    $subFamilia = Cat::ACESSORIOS_CUIDADOS_ROUPA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Ferro c/ Caldeira':
                                    $subFamilia = Cat::FERROS_CALDEIRA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Ferro Simples':
                                    $subFamilia = Cat::FERROS_A_VAPOR;
                                    return [$gama,$familia,$subFamilia];
                                case 'Tira Borbotos':
                                    $subFamilia = Cat::TIRA_BORBOTOS;
                                    return [$gama,$familia,$subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,null];
                            }
                        case 'Limpeza de Pavimentos':
                            $familia = Cat::APARELHOS_DE_LIMPEZA;
                            switch ($subFamilia) {
                                case 'Sacos':
                                    $subFamilia = Cat::SACOS_ASPIRADOR;
                                    return [$gama,$familia,$subFamilia];
                                case 'Máquinas a Vapor':
                                    $subFamilia = Cat::MAQ_LIMPEZA_VAPOR;
                                    return [$gama,$familia,$subFamilia];
                                case 'Lavadoras a Pressão':
                                    $subFamilia = Cat::MAQ_LAVAR_PRESSAO;
                                    return [$gama,$familia,$subFamilia];
                                case 'Acessórios':
                                case 'Consumíveis':
                                    $subFamilia = Cat::ACESSORIOS_APARELHOS_LIMPEZA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Robot':
                                    $subFamilia = Cat::ASPIRADORES_ROBOT;
                                    return [$gama,$familia,$subFamilia];    
                                case 'Mini-Aspiradores':
                                    $subFamilia = Cat::MINI_ASPIRADORES;
                                    return [$gama,$familia,$subFamilia];
                                case 'Outros':
                                    $subFamilia = Cat::OUTROS_APARELHOS_LIMPEZA;
                                    return [$gama,$familia,$subFamilia];
                                case 'Aspiradores':
                                    if (preg_match('/c\/ Saco/',$name) ==1 || preg_match('/Saco:Com saco/',$attributes) == 1) {
                                        $subFamilia = Cat::ASPIRADOR_COM_SACO;
                                        return [$gama,$familia,$subFamilia];
                                    }else {
                                        $subFamilia = Cat::ASPIRADOR_SEM_SACO;
                                        return [$gama,$familia,$subFamilia];
                                    }
                                case 'Aspiradores Verticais':
                                    $subFamilia = Cat::ASPIRADOR_VERTICAL;
                                    return [$gama,$familia,$subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,null];
                            }
                        case 'Microondas':
                            $gama = Cat::GRANDES_DOMESTICOS;
                            $familia = Cat::MICROONDAS;
                            switch ($subFamilia) {
                                case 'Com Grill':
                                    $subFamilia = Cat::MO_COM_GRILL;
                                    return [$gama,$familia,$subFamilia];
                                case 'Simples':
                                case 'Combinado':
                                    $subFamilia = Cat::MO_SEM_GRILL;
                                    return [$gama,$familia,$subFamilia];
                                case 'Consumíveis':
                                    $subFamilia = Cat::ACESSORIOS_MICROONDAS;
                                    return [$gama,$familia,$subFamilia];
                                default:
                                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                                    return [$gama,$familia,null];        
                                    break;
                            }
                        default:
                            $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                            return [$gama,null,null];
                    }
                default:
                    $logger->info(Cat::WARN_SUBFAMILY_NF.$sku." : ".$name);
                    return [null,null,null];
            }

            
        }
}
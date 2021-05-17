<?php

namespace Mlp\Cli\Helper;
use Mlp\Cli\Helper\CategoriesConstants as Cat;

class Manufacturer
{


    public static function getExpertManufacturer($manufacturer){

        return $manufacturer;
    }
    
    public static function getSorefozManufacturer($manufacturer)  {
        switch ($manufacturer) {
            case 'TOSHIBA  - INFORMATICA':
                return Cat::TOSHIBA;
            case 'SONY  - MAGNÉTICOS':
            case 'SONY  - PILHAS':
                return Cat::SONY;
            case 'SAMSUNG  - LINHA CASTANHA':
            case 'SAMSUNG  - INFORMATICA':
            case 'SAMSUNG  - LINHA BRANCA':
            case 'SAMSUNG  - AR CONDICIONADO':
                return Cat::SAMSUNG;
            case 'LG  - LINHA CASTANHA':
            case 'LG  - INFORMATICA':
            case 'LG  - LINHA BRANCA':
            case 'LG  - AR CONDICIONADO';
                return Cat::LG;
            case 'BROTHER  INFORMÁTICA':
                return Cat::BROTHER;
            case 'PHILIPS D.A.P.':
                return Cat::PHILIPS;
            case 'HOTPOINT / ARISTON':
            case 'HOTPOINT / ARISTON PAE':
                return Cat::HOTPOINT;
            case 'WHIRLPOOL  - PROFISSIONAL':
            case 'WHIRLPOOL  - AR CONDICIONADO':
                return Cat::WHIRLPOOL;
            case 'FAGOR  - CONFORT':
            case 'FAGOR  P.A.E.':
                return Cat::FAGOR;
            case 'EDESA  - CONFORT':
                return Cat::EDESA;
            case 'BOSCH  P.A.E.':
                return Cat::BOSCH;
            case 'SIEMENS  P.A.E.':
                return Cat::SIEMENS;
            case 'BRIEL  - CAFÉ':
                return Cat::BRIEL;
            case 'AEG  D.A.P.':
            case 'AEG  - CLIMATIZAÇÃO':
            case 'AEG  - USO PESSOAL':
                return Cat::AEG;
            case 'ZANUSSI  D.A.P.':
                return Cat::ZANUSSI;
            case 'ELECTROLUX  D.A.P.':
                return Cat::ELECTROLUX;
            case 'BRAUN  - CASA E COZINHA':
                return Cat::BRAUN;
            case 'NOS  - ZON/OPTIMUS':
                return Cat::NOS;
            default:
                return $manufacturer;
        }
    }
    public static function getOrimaManufacturer($manufacturer) {
        switch($manufacturer){
            case 'Orima':
                return Cat::ORIMA;
            case 'Lg | Linha Castanha':
            case 'Lg | Linha Branca':
            case 'Lg | Linha Conforto':
                return Cat::LG;
            case 'Bosch | Pequenos Domesticos':
            case 'Bosch | Linha Branca':
                return Cat::BOSCH;
            case 'Samsung | Linha Branca':
            case 'Samsung | Linha Castanha':
                return Cat::SAMSUNG;
            case 'Siemens | Linha Branca':
                return Cat::SIEMENS;
            case 'AEG | PEQUENOS DOMESTICOS':
            case 'Aeg':
                return Cat::AEG;
            case 'Black&decker':
                return Cat::BLACKDECKER;   
            default:
                return strtoupper($manufacturer);
        }
    }
}

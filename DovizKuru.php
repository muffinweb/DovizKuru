<?php 

namespace Muffinweb;

class Kur
{
    public static function piyasasi($args = array())
    {
        /**
         * types: json, array, object
         * return: true, false
         */
        $defaultArgs = [
            'type' => 'json',
            'return' => false
        ];

        //Argument Applier

        $args_result = array_replace($defaultArgs, $args);

        if(!function_exists('simplexml_load_string')){
            die("YOU NEED TO ACTIVATE SIMPLEXML Module in PHP.INI FILE or LOAD IT");
        }else{ 
            $tcmb_kur = file_get_contents("https://www.tcmb.gov.tr/kurlar/today.xml");
            $xml = (array) simplexml_load_string($tcmb_kur);
            $currencies = (array) $xml["Currency"];
            $currency_list = [];

            foreach($currencies as $money){
                //SimpleXML Objecti Array'a Cevirme
                $toArr = (array) $money;

                $newItem = [
                    'Isim' => $toArr['Isim'], 
                    'Kod' => $toArr['@attributes']['Kod'],
                    'Birim' => $toArr['Unit'],
                    'Alis' => $toArr['ForexBuying'],
                    'Satis' => $toArr['ForexSelling'],
                ];

                if($args_result['type'] == 'object'){
                    $currency_list[] = (object) $newItem;
                }else{
                    $currency_list[] =  $newItem;
                }
            }

            if($args_result['type'] == 'json'){
                header('Content-type: application/json');
                echo json_encode($currency_list);
            } else if($args_result['type'] == 'array'){
                if($args_result['return'] === true){
                    return $currency_list;
                }else {
                    echo '<pre>', print_r($currency_list, true);
                }
            } else if($args_result['type'] == 'object'){
                if($args_result['return'] === true){
                    return (object) $currency_list;
                }else {
                    echo '<pre>', print_r((object) $currency_list, true);
                }
            } else {
                die("Whattaa!");
            }
        }
    }
}

?>
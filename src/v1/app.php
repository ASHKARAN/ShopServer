<?php
namespace Shop;


use Shop\Classes\Errors;

class app {


    public static function generateRandomString($length = 10 , $numericOnly = false) {
        $characters = '0123456789qwertyuiopasdfghjklzxcvbnm';
        if($numericOnly)
            $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }






    public static function returnORPrint($data , $system = false) {
        if($system) return $data;
        echo  json_encode($data);
        exit;
    }

    // TODO inja bayad connection database ro ham close konim
    // TODO inja bayad connection redis ro ham close konim
    public static function GeneralResponse($state) {
       return array(
           "Message" => $state?"Success":"Failed" ,
           "Error"   => $state
       );

    }

    public static function validateJSON($json , $values) {
        foreach ($values as $value) {
            if(!array_key_exists($value , $json)) {
                new Errors("Not Enough Data");
            }
        }
        return true ;
    }

    /**
     * Include all files inside core folder
     */
    public static function LoadAllPHPFiles($directory) {


        if(is_dir($directory)) {
            $scan = scandir($directory);
            unset($scan[0], $scan[1]); //unset . and ..
            foreach($scan as $file) {
                if(is_dir($directory."/".$file)) {
                    if(!file_exists($directory."/".$file."/.PreventAutoImport"))
                        app::LoadAllPHPFiles($directory."/".$file);
                } else {
                    if(strpos($file, '.php') !== false) {
                        include_once($directory."/".$file);
                    }
                }
            }
        }
    }



}

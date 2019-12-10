<?php

namespace Shop;


use Shop\Classes\Errors;

/**
 *  Main App Starter
 *
 */
class Router {
    /**
     *  Navigate the user to the target
     * @param String $route
     */

    public function __construct($route , $action, $value ) {
        $json_str = file_get_contents('php://input');
        $json = json_decode($json_str);
        if($json_str != '{}')
            if(!is_object($json))
            new Errors("Not Enough Data");

        if($json === null)
            new Errors("Not Enough Data");
        try {
            $class = "Shop\Controllers\\".$route ;
            $instance = null;
            if(class_exists($class))   {
                $instance = new $class(false);
                if(method_exists($instance, $action))
                    $instance->{$action}($json);
                else new Errors("Wrong Action");

            }else new  Errors("Wrong Controller");
        }
        catch(\Exception $exc) {
            new Errors("Wrong Action");
        }

    }
}

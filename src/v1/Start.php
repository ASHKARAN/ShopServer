<?php
namespace  Shop;

use Shop\app;
use Shop\Config;
use Shop\Classes\Errors;
use Shop\Router;

class Start
{


    public function __construct()
    {
        $this->start();
    }


    private function start() {

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: X-Requested-With');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: X-Requested-With');
            header("HTTP/1.1 200 OK");
            die();
        }

        date_default_timezone_set('Asia/Tehran');



        include_once("Config.php");
        include_once("MyPDO.php");
        include_once("MyRedis.php");
        include_once("app.php");
        include_once("Router.php");
        include_once("LoginRestricted.php");
        include_once("HttpStatusCode.php");


        app::LoadAllPHPFiles( __DIR__ ."/core");


        //Display Errors On OutPut
        if(Config::$DEBUG_MODE) {
            ini_set('display_errors', 1);
            error_reporting( E_ALL );
        }
        else {
            ini_set('display_errors', 0);
        }


        #require __DIR__ . '/vendor/autoload.php';




        if(!isset($_GET["ROUTE"]) || $_GET['ROUTE'] == "" || !isset($_GET["ACTION"]) || $_GET['ACTION'] == "")   {
            new  Errors("Route Not Found" , null , HTTP_BAD_REQUEST ) ;
        }
        else {
            $route     = $_GET["ROUTE"];
            $action    = $_GET["ACTION"];
            $value     = $_GET["VALUE"];
            new  Router($route , $action, $value);
        }


    }
}
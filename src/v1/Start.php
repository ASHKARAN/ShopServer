<?php
namespace  Shop;

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


    }
}
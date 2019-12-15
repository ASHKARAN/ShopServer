<?php


namespace Shop\Controllers;


use Shop\app;
use Shop\Classes\Errors;
use Shop\MyPDO;

class Login
{


    /** this function tries to register a new user
     * @param $json
     * @param bool $system
     */
    public function Registration($json, $system = false){
        app::validateJSON($json , ["Email" , "Password"]);
        $salt = app::generateRandomString(80);
        $password = $json->Password . $salt;

        $response = MyPDO::doQuery("INSERT INTO Users (Email , Password , Salt) VALUES (? , MD5(?) , ? )" , [$json->Email , $password , $salt]);

        if($response instanceof \PDOException) {
            if($response->getCode() == 23000) {
                new Errors("Email Already exists" , $response , HTTP_NOT_ACCEPTABLE);
            }
        }
        else if($response == 1) {
            $UserModel = new \UsersModel();
            $message = $UserModel->GetUserByID(MyPDO::getLastInsertId(MyPDO::getInstance()));
            //TODO JWT
            return app::returnORPrint($message , $system);

        }

        new Errors("Unknown Error" , null , HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * this function tries to login with username and password
     * @param $json
     * @param bool $system
     */
    public function Login($json, $system = false){
        app::validateJSON($json , ["Email" , "Password"]);
        $response = MyPDO::doSelect("SELECT * FROM Users WHERE Email = ? AND Password = MD5(CONCAT(? , Salt))" , [$json->Email, $json->Password] , true, "" , false , false);

        if($response instanceof \PDOException) {
            new Errors("Error Happened" , $response , HTTP_NOT_ACCEPTABLE);
        }
        else if(count($response) > 1) {
            unset($response['Password']);
            unset($response['Salt']);
            //TODO JWT
        }
        return app::returnORPrint($response , $system);

    }

    public function LoginWithSession($json, $system = false){


    }
    public function ForgetPassword($json, $system = false) {

    }
    public function Activation($json, $system = false) {

    }
}
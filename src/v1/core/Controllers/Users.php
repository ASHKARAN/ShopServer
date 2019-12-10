<?php
namespace Shop\Controllers;

use Shop\app;

class Users
{

    public function GetAllUsers($json, $system = false) {
        $UserModel = new \UsersModel();
        return app::returnORPrint($UserModel->GetAllUsers() , $system);
    }

    public function GetUserByID($json) {
        echo  __FUNCTION__ . " Called";
    }
    public function DeleteUser($json) {
        echo  __FUNCTION__ . " Called";
    }
    public function UpdateUser($json) {
        echo __FUNCTION__ .  " Called";
    }
}
<?php


use Shop\app;
use Shop\MyPDO;

class UsersModel
{


    public function GetAllUsers(){
        return array(
            "ali" , "mamad" , "omid" , "reza"
        );
    }


    public function GetUserByID($UserID , $system = true) {

        $user = MyPDO::doSelect("SELECT 
                `UserID`, `Email`,  `Username`,  `Sex`, `UserType`, `RegistrationDate`, `PhoneNumber`, `EmailVerified` 
                FROM `Users` WHERE UserID = ?" , [$UserID] , true, "" , false, false);
        return app::returnORPrint($user, $system);

    }


}
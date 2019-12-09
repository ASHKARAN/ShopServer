<?php
namespace Shop;

if (!function_exists('getallheaders')) {
    function getallheaders() {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}


$headers = getallheaders();

if(isset($headers['ApiVersion'])) {

    if((@include "src/".$headers['ApiVersion'] . "/Start.php") === false){
        $error = array(
            "Error"   => true,
            "Message" => "ApiVersion not found"
        );
        http_response_code(400);
        echo json_encode($error);
        die();
    }
    else {
        new Start();
    }
}
else {
    $error = array(
        "Error"   => true,
        "Message" => "ApiVersion not sent"
    );
    http_response_code(400);
    echo json_encode($error);
    die();
}

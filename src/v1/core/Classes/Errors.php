<?php

namespace Shop\Classes;

use Shop\app;

class Errors
{
    private $Error = true;
    private $ErrorMessage = null;
    private $ErrorAction = null;
    private $Data = null;
    private $TimeStamp = 0;
    private $HttpStatusCode = HTTP_INTERNAL_SERVER_ERROR;
    private $Exception = null;


    public function __construct(string $ErrorMessage = null, \Exception $Exception = null,  $HttpStatusCode = HTTP_INTERNAL_SERVER_ERROR,
                                string $ErrorAction = null, array $Data = null,
                                $system = false, $registerError = true, $notifyError = false)
    {

        http_response_code($HttpStatusCode);
        $this->ErrorMessage = $ErrorMessage;
        $this->ErrorAction = $ErrorAction;
        $this->Data = $Data;
        $this->TimeStamp = round(microtime(true) * 1000);
        $this->HttpStatusCode = $HttpStatusCode;
        $this->Exception = $Exception;

        if($registerError) $this->registerError();
        if($notifyError)   $this->notifyError();

        $this->Exception = null;
        return app::returnORPrint(get_object_vars($this) , $system);
    }

    /**
     * TODO inja bayad user id ro ham bekhunim bezarim
     * TODO inja DebugBackTrace ro json_encode kardam, behtare ke array store konim na string
     * insert error on elastic search server
     */
    public function registerError() {

//
//        $body            = json_decode(file_get_contents('php://input'), true);
//        $params = [
//            'index' => 'errors',
//            'body'  => array(
//                "User" => -1,
//                "ErrorMessage" => $this->ErrorMessage,
//                "ErrorAction" => $this->ErrorAction,
//                "Data" => $this->Data,
//                "TimeStamp" => $this->TimeStamp,
//                "HttpStatusCode" => $this->HttpStatusCode,
//                "Exception" => $this->Exception,
//                "DebugBackTrace" => json_encode(debug_backtrace()),
//                "RequestQuery" => $_REQUEST,
//                "RequestBody" => $body,
//                "RequestHeaders" => getallheaders()
//            )
//        ];
//
//
//        try {
//            $response = MyElastic::getInstance()->index($params);
//            echo json_encode($response);
//        }
//        catch(BadRequest400Exception $exception) {
//            echo print_r($exception);
//        }
//        exit;

    }

    /**
     * send notification to Administrator for this error with email or sms or telegram
     */
    public function notifyError(){

    }

}
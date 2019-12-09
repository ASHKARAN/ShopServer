<?PHP
namespace Shop;

use SPTA\Classes\Errors;
use PDO;
use PDOException;

class MyPDO extends PDO {

    static private $instance = null;


    public function __construct() {
        try {

            parent::__construct("mysql:host=" . Config::$SERVER . ";dbname=" .
                Config::$DBNAME, Config::$USERNAME, Config::$PASSWORD );
            self::$instance = $this;
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//نمایش ارور ها
            self::$instance->exec("set names utf8");//اتصال برای نمایش کاراکتر فارسی
        } catch (PDOException $e) {
            print_r($e);
            exit;

        }
    }

    private function __clone()
    {
    }

    public static function getInstance(): PDO{


        if (self::$instance==null) {
            try {

                self::$instance =  new MyPDO("mysql:host=" . Config::$SERVER . ";dbname=" . Config::$DBNAME, Config::$USERNAME, Config::$PASSWORD);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->exec("set names utf8");

            } catch (PDOException $e) {

                print_r($e);
                exit;


            }
        }

        return self::$instance;
    }



    public static function getRowCount($stmt)
    {
        //نمایش تعداد سطرهایی که در جواب دیتابیس برگرداند
        return $stmt->rowCount() ;
    }


    public static function getError($stmt)
    {
        //دریافت ارور دیتابیس
        return $stmt->errorInfo() ;
    }

    public static function getLastInsertId($conn) {
        return  $conn->lastInsertId();
    }




    /**
     * TODO inja bayad data ro az cache ham bekhunim
     * @param String $sql SQL Query
     * @param Array $values array to bind with sql query
     * @param Boolean $autoErroResponder automatically send json response on error
     * @param Boolean $fetchAll fetch all items
     * @param Integer $fetchStyle
     * @return Array or \PDOException
     */
    public static  function doSelect($sql, $values = array(), $useRedis = true, $redisKey = "", $autoErroResponder = false , $fetchAll = true, $fetchStyle = PDO::FETCH_ASSOC)
    {

        //mitonim az redis estefade konim
        if(Config::$REDISENABLED) {

        }
        $conn = MyPDO::getInstance();
        $stmt =  $conn->prepare($sql);
        $result = null;
        if($values != NULL) {
            foreach ($values as $key => $value) {
                $stmt->bindValue($key + 1, $value);
            }
        }
        try {
            $stmt->execute();
            if ($fetchAll) {
                $result = $stmt->fetchAll($fetchStyle);
            } else {
                $result = $stmt->fetch($fetchStyle);
            }
            return $result;
        } catch (\PDOException $ex) {
            if($autoErroResponder) new Errors("Internal Server Error" , false , Config::$DEBUG_MODE?$ex:"" );
            else return $ex;
        }
    }



    /**
     * TODO inja bayad redis ro ham update konim
     * @param String $sql SQL Query
     * @param Array $values array to bind with sql query
     * @param Boolean $autoErroResponder automatically send json response on error
     * @return \Exception|PDOException
     */
    public static  function doQuery($sql, $values = [] , $updateRedis = true, $redisKey = "", $autoErroResponder = false )
    {
        $stmt = self::getInstance()->prepare($sql);
        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
        try {
            $stmt->execute();
        } catch (\PDOException $ex) {
            if($autoErroResponder)  new Errors("Internal Server Error" , false ,  Config::$DEBUG_MODE?$ex: "");
            else return $ex;
        }
        return $stmt->rowCount();


    }




}
?>

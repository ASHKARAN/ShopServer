<?PHP
namespace Shop;


class MyRedis {

    static private $instance = null;

    private function __clone()
    {
    }

    public static function getInstance(): Client{


        if (self::$instance==null) {

            $options = [
                'parameters' => [
                    'password' => Config::$REDISPASSWORD
                ],
            ];


            $client = new Client([
                'scheme' => Config::$REDISSCHEMA,
                'host'   => Config::$REDISHOST,
                'port'   => Config::$REDISPOSRT,
            ], $options);
            self::$instance = $client;
        }

        return self::$instance;
    }


}
?>

<?php

namespace Shop;


class Config
{


    public static $APPNAME = "SPTA";
    public static $VERSION = 1;
    public static $DEBUG_MODE = true ;


    public static $DBNAME   = "shop";
    public static $USERNAME = "shop";
    public static $PASSWORD = "shop";
    public static $SERVER   = "localhost";

    public static $JWTPASSWORD = "1234567";

    public static $REDISPASSWORD = "spta";
    public static $REDISENABLED = true;
    public static $REDISSCHEMA = "tcp";
    public static $REDISHOST = "127.0.0.1";
    public static $REDISPOSRT = 6379;




}
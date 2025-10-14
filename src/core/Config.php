<?php

namespace Core;

use Exception;

final class Config{

    public static array $config = [];
    private static bool $configLoaded = false;
    public static function load(){
        if(static::$configLoaded){
            return;
        }

        $configFilePath = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';
        if(!file_exists($configFilePath)){
            throw new Exception("Unable to load config file at {$configFilePath}");
        }

        static::$config = require $configFilePath;

        static::$configLoaded = true; 
    }

    public static function get(string $key =""): string | array{

        $value = static::$config;
        $keys = explode(".", $key);
        foreach($keys as $configKey){
            if(!isset($value[$configKey])){
                return $value;
            }

            $value =$value[$configKey];
        }

        return $value;
    }
}
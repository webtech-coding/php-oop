<?php

namespace Core;

class Gate{
    public static array $gates = [];

    public static function define(string $name, callable $callbaack): void{
        if(!$name || !$callbaack){
            throw new \Exception("gate name and callback are required");
        }
        self::$gates[$name] = $callbaack;
    }

    public static function verify(string $name, $user, ...$parms): bool{
        if(!isset(self::$gates[$name])){
            throw new \Exception("Gate name {$name} not defined");
        }

        return (bool)call_user_func(self::$gates[$name], $user, ...$parms);
    }

    public static function denies(string $name, $user, ...$parms): bool{
        return !self::verify($name, $user, ...$parms);
    }   
}
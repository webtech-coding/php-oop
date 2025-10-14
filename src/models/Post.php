<?php

namespace Models;

use Database\Model;
use PDO;

class Post extends Model{
    protected static string $table = "posts";
    protected static array $fillable = ['title','content','user_id'];

    public static function getRecentPosts(int $limit = 10, int $offset = 0,):array{
        $table = static::$table;
       
        $sql = "SELECT *FROM $table ORDER BY created_at DESC LIMIT {$limit} ";
        return self::query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

}

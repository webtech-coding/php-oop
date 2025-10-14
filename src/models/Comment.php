<?php

namespace Models;

use Database\Model;
use PDO;

class Comment extends Model{
    protected static string $table = "comments";
    protected static array $fillable = ['comment','rating','post_id', 'user_id'];

    public static function getPostComment(int $post_id):array{
        $table = static::$table;
        $sql = "SELECT *FROM $table WHERE post_id=:post_id";
        $result = self::query($sql, ['post_id'=>$post_id])->fetchAll(PDO::FETCH_OBJ);
       
        return $result ?? [];
    }


}

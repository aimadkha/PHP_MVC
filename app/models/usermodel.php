<?php


namespace PHPMVC\Models;


class UserModel extends AbstractModel
{
    public $user_id;
    public $user_name;
    public $user_pass;
    public $user_email;
    public $user_address;
    public $user_first_name;
    public $user_last_name;


    protected static $tableName = 'users';
    protected static $tableSchema = array(
        'user_name' => self::DATA_TYPE_STR,
        'user_email' => self::DATA_TYPE_STR,
        'user_pass' => self::DATA_TYPE_STR,
        'user_address' => self::DATA_TYPE_STR,
        'user_first_name' => self::DATA_TYPE_STR,
        'user_last_name' => self::DATA_TYPE_STR,
    );

    protected static $primaryKey = 'user_id';
}
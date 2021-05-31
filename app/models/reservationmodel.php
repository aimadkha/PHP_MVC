<?php


namespace PHPMVC\Models;


class ReservationModel extends AbstractModel
{
    public $reservation_id;
    public $product_id;
    public $user_id;
    public $duration;


    protected static $tableName = 'reservation';
    protected static $tableSchema  = array(
        'product_id' => self::DATA_TYPE_INT,
        'user_id' => self::DATA_TYPE_INT,
        'duration' => self::DATA_TYPE_INT,
    );
    protected static $primaryKey = 'reservation_id';
}
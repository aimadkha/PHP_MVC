<?php


namespace PHPMVC\Models;



class ProductModel extends AbstractModel
{
    public $product_id;
    public $product_name;
    public $product_price;
    public $product_description;
    public $product_category;
    public $product_img;

    protected static $tableName = 'products';
    protected static $tableSchema  = array(
        'product_name' => self::DATA_TYPE_STR,
        'product_price' => self::DATA_TYPE_DECIMAL,
        'product_description' => self::DATA_TYPE_STR,
        'product_category' => self::DATA_TYPE_STR,
        'product_img' => self::DATA_TYPE_STR,
    );
    protected static $primaryKey = 'product_id';

//    public function __construct($name, $price, $desc, $category, $image)
//    {
//        $this->name = $name;
//        $this->price = $price;
//        $this->desc = $desc;
//        $this->category = $category;
//        $this->image = $image;
//
//    }

}
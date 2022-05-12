<?php

namespace components\product;

use http\Exception\RuntimeException;
use mysql_xdevapi\Exception;

class ProductFactory
{
    private readonly array $dict;

    public function __construct(array $objectList) {

        //$aux = array();
        //foreach ($objectList as $key => $value) {
        //    $aux[$key] = $value;
        //}
        //$this->dict = $aux;
        $this->dict = $objectList;
    }

    public function getRules($params) {
        if (array_key_exists("type", $params)) {
            return $this->dict[$params["type"]]::listRules();
        }

        return false;
    }

    public function newProduct($params)
    {
        if (array_key_exists("type", $params)) {
            return new $this->dict[$params["type"]]($params);
        }

        return false;
    }

}
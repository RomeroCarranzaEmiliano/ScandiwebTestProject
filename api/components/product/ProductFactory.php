<?php

namespace components\product;

class ProductFactory
{
    private readonly array $dict;

    public function __construct(array $objectList) {
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
<?php

namespace core;

class Validator
{
    private array $rules;
    private array $err;

    public function __construct()
    {
        $this->rules = array(
            "required" => function($field) { return $this->requiredVal($field); },
            "stringNonEmpty" => function ($field) { return $this->stringNonEmptyVal($field); },
            "noSpacesString" => function ($field) { return $this->noSpacesStringVal($field); },
            "price" => function ($field) { return $this->priceVal($field); },
            "measurement" => function ($field) { return $this->measurementVal($field); },
            "integer" => function ($field) { return $this->integerVal($field); }
        );
        $this->err = array(
            "required" => "The data is required",
            "stringNonEmpty" => "The data must be a non empty string",
            "noSpacesString" => "The data must be a string without spaces",
            "price" => "The data must be a valid price",
            "measurement" => "The data must be a valid measurement",
            "integer" => "The data must be an integer"
        );
    }

    public function validate($data, $attributes): bool
    {
        $err = array();
        foreach ($attributes as $key => $value) {
            $err[$key] = "";
            if (in_array("required", $value) and array_key_exists($key, $data) == false) {
                $err[$key] = $err[$key].$this->err["required"];
            } else if (in_array("required", $value) and array_key_exists($key, $data) == true)  {
                $err[$key] = $err[$key].$this->validateField($data[$key], $value);
            } else {
                unset($err[$key]);
            }

        }

        //var_dump($err);

        $resultAsStr = implode('', $err);
        if ($resultAsStr == "") {
            return true;
        } else {
            return false;
        }

    }

    private function validateField($field, $rules): string
    {
        $err = "";
        foreach ($rules as $key) {
            $valid = $this->rules[$key]($field);
            if (!$valid) {
                $err = $err.$this->err[$key];
            }
        }

        return $err;
    }

    private function requiredVal($field): bool
    {
        $valid = false;

        if ($field != null and $field != "") {
            $valid = true;
        }

        return $valid;
    }

    private function integerVal($field): bool
    {
        $valid = false;

        if (preg_match("/^\d+$/", $field)) {
            $valid = true;
        }

        return $valid;
    }

    private function stringNonEmptyVal($field): bool
    {
        $valid = false;

        if (is_string($field) and strlen($field) > 0) {
            $valid = true;
        }

        return $valid;
    }

    private function noSpacesStringVal($field): bool
    {
        $valid = false;

        if (is_string($field) and preg_match("/^\S+$/", $field)) {
            $valid = true;
        }

        return $valid;
    }

    private function priceVal($field): bool
    {
        $valid = false;

        if (preg_match("/\d{1,3}(?:[.,]\d{3})*(?:[.,]\d{2})/", $field)) {
            $valid = true;
        }

        return $valid;
    }

    private function measurementVal($field): bool
    {
        $valid = false;

        if (preg_match("/^[1-9]\d*$|^[0-9]+\.[0-9]+$/", $field)) {
            $valid = true;
        }

        return $valid;
    }



}
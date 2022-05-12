<?php
namespace components\product;

abstract class Product
{
    private $id;
    private string $sku;
    private string $name;
    private float $price;
    private static array $rules = array(
        "sku" => ["required", "stringNonEmpty", "noSpacesString"],
        "name" => ["required", "stringNonEmpty"],
        "price" => ["required", "price"],
    );

    public function __construct($id, $sku, $name, $price)
    {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;

    }

    public static abstract function listRules(): array;

    public static function getRules(): array {
        return Product::$rules;
    }

    public abstract function asDict(): array;

    /**
     * @return int
     */
    public function getId(): int|null
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }


}
<?php
namespace components\product;

abstract class Product
{
    private $id;
    private string $sku;
    private string $name;
    private float $price;
    private readonly array $rules;

    public function __construct($id, $sku, $name, $price, $rules)
    {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;

        $finalRules = array(
            "sku" => ["required", "stringNonEmpty", "noSpacesString"],
            "name" => ["required", "stringNonEmpty"],
            "price" => ["required", "price"],

            "size" => ["integer"],

            "height" => ["measurement"],
            "width" => ["measurement"],
            "length" => ["measurement"],

            "weight" => ["measurement"]
        );
        foreach ($rules as $key => $value) {
            $finalRules[$key] = $value;
        }

        $this->rules = $finalRules;
    }

    public function getRules(): array {
        return $this->rules;
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
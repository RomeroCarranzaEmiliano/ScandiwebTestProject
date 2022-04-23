<?php
namespace api\componets\product;

require_once  "api\components\product\Product.php";
class Book extends Product
{
    private float $weight;

    public function __construct($id, $sku, $name, $price, $weight)
    {
        $this->weight = $weight;
        parent::__construct($id, $sku, $name, $price);
    }

    public function asDict(): array
    {
        return array(
            "id" => $this->getId(),
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "price" => $this->getPrice(),
            "type" => "Book",
            "weight" => $this->weight
        );
    }

    public function getParams()
    {
        return [
            ":weight" => $this->weight,
            ":sku" => $this->getSku(),
            ":name" => $this->getName(),
            ":price" => $this->getPrice()
        ];

    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight(float $weight): void
    {
        $this->weight = $weight;
    }

}
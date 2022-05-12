<?php
namespace components\product;

require_once  "components\product\Product.php";
class Book extends Product
{
    private float $weight;
    private static array $rules = array(
        "weight" => ["required", "measurement"]
    );

    public function __construct(array $params)
    {
        $this->weight = $params["weight"];

        parent::__construct($params["id"] ?? null, $params["sku"], $params["name"], $params["price"]);
    }

    public static function listRules(): array
    {
        $rules = array();
        foreach (Book::$rules as $key => $value) {
            $rules[$key] = $value;
        }
        foreach (parent::getRules() as $key => $value) {
            $rules[$key] = $value;
        }

        return $rules;
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
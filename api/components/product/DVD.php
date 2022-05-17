<?php
namespace components\product;

require_once  __DIR__."/Product.php";
class DVD extends Product
{
    private int $size;
    private static array $rules = array(
        "size" => ["required", "integer"]
    );

    public function __construct(array $params)
    {
        $this->size = $params["size"];

        parent::__construct($params["id"] ?? null, $params["sku"], $params["name"], $params["price"]);
    }

    public static function listRules(): array
    {
        $rules = array();
        foreach (DVD::$rules as $key => $value) {
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
            "type" => "DVD",
            "size" => $this->size
        );
    }

    public function getParams()
    {
        return [
            ":size" => $this->size,
            ":sku" => $this->getSku(),
            ":name" => $this->getName(),
            ":price" => $this->getPrice()
        ];

    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

}
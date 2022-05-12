<?php
namespace components\product;

require_once  "components\product\Product.php";
class DVD extends Product
{
    private int $size;

    public function __construct(array $params)
    {
        $this->size = $params["size"];

        $typeRules = array(
            "size" => ["required", "integer"]
        );

        parent::__construct($params["id"] ?? null, $params["sku"], $params["name"], $params["price"], $typeRules);
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
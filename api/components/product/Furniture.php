<?php
namespace components\product;

require_once  "components\product\Product.php";
class Furniture extends Product
{
    private float $height;
    private float $width;
    private float $length;
    private static array $rules = array(
        "height" => ["required", "measurement"],
        "width" => ["required", "measurement"],
        "length" => ["required", "measurement"]
    );

    public function __construct(array $params)
    {
        $this->height = $params["height"];
        $this->width = $params["width"];
        $this->length = $params["length"];

        parent::__construct($params["id"] ?? null, $params["sku"], $params["name"], $params["price"]);
    }

    public static function listRules(): array
    {
        $rules = array();
        foreach (Furniture::$rules as $key => $value) {
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
            "type" => "Furniture",
            "height" => $this->height,
            "width" => $this->width,
            "length" => $this->length
        );
    }

    public function getParams()
    {
        return [
            ":height" => $this->height,
            ":width" => $this->width,
            ":length" => $this->length,
            ":sku" => $this->getSku(),
            ":name" => $this->getName(),
            ":price" => $this->getPrice()
        ];

    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @param float $height
     */
    public function setHeight(float $height): void
    {
        $this->height = $height;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @param float $width
     */
    public function setWidth(float $width): void
    {
        $this->width = $width;
    }

    /**
     * @return float
     */
    public function getLength(): float
    {
        return $this->length;
    }

    /**
     * @param float $length
     */
    public function setLength(float $length): void
    {
        $this->length = $length;
    }
}
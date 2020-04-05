<?php

/**
 * Class Product
 */
class Product
{
    /**
     * @var string
     */
    public $name = '';
    /**
     * @var string
     */
    public $code = '';
    /**
     * @var float|int
     */
    public $price = 0;

    /**
     * Product constructor.
     * @param string $name
     * @param string $code
     * @param float $price
     */
    public function __construct(string $name, string $code, float $price)
    {
        $this->name = $name;
        $this->code = $code;
        $this->price = $price;
    }
}

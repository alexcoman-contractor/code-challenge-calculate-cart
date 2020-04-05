<?php

/**
 * Class Offer
 */
class Offer
{
    /**
     * @var float|int
     */
    public $buyCount = 0;
    /**
     * @var string
     */
    public $buyProductCode = '';
    /**
     * @var float|int
     */
    public $getCount = 0;
    /**
     * @var string
     */
    public $getProductCode = '';

    /**
     * Offer constructor.
     * @param float $buyCount
     * @param string $buyProductCode
     * @param float $getCount
     * @param string $getProductCode
     */
    public function __construct(float $buyCount, string $buyProductCode, float $getCount, string $getProductCode)
    {
        $this->buyCount = $buyCount;
        $this->buyProductCode = $buyProductCode;
        $this->getCount = $getCount;
        $this->getProductCode = $getProductCode;
    }
}

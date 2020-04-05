<?php

/**
 * Class DeliveryRule
 */
class DeliveryRule
{
    /**
     * @var float|int
     */
    public $basketCost = 0;
    /**
     * @var float|int
     */
    public $deliveryCost = 0;

    /**
     * DeliveryRule constructor.
     * @param float $basketCost
     * @param float $deliveryCost
     */
    public function __construct(float $basketCost, float $deliveryCost)
    {
        $this->basketCost = $basketCost;
        $this->deliveryCost = $deliveryCost;
    }
}

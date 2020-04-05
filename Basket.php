<?php

/**
 * Class Basket
 */
class Basket
{
    /**
     * @var array
     */
    private $addedProducts;
    /**
     * @var array
     */
    private $items;
    /**
     * @var array
     */
    private $deliveryChargeRules;
    /**
     * @var array
     */
    private $offers;

    /**
     * @var int
     */
    private $total = 0;

    /**
     * Basket constructor.
     * @param array $items
     * @param array $deliveryChargeRules
     * @param array $offers
     */
    public function __construct(array $items, array $deliveryChargeRules, array $offers)
    {
        $this->items = $items;
        $this->deliveryChargeRules = $deliveryChargeRules;
        $this->offers = $offers;
    }

    /**
     * @param string $productCode
     */
    public function add(string $productCode)
    {
        $this->addedProducts[] = $productCode;
    }

    /**
     * @return float
     */
    public function total()
    {
        $this
            ->calculateTotalWithoutDelivery()
            ->calculateDiscounts()
            ->calculateDelivery();

        return (float)number_format($this->total, 2);
    }

    /**
     * @return $this
     */
    private function calculateTotalWithoutDelivery()
    {
        $totalWithoutDiscounts = 0;

        foreach ($this->addedProducts as $itemCode) {
            $product = $this->items[$itemCode];
            $totalWithoutDiscounts += $product->price;
        }

        $this->total = $totalWithoutDiscounts;

        return $this;
    }

    /**
     * @return $this
     */
    private function calculateDiscounts()
    {
        $discounts = 0;

        foreach ($this->offers as $offer) {
            if (in_array($offer->buyProductCode, $this->addedProducts)) {
                $items = array_count_values($this->addedProducts);

                // 1 + 0,5 doesn't mean, 2 + 1, so we need to consider half parts as one
                $getCount = ceil($offer->getCount);
                // Check if we have enough products in our basket to apply the offer
                if ($items[$offer->buyProductCode] >= $offer->buyCount + $getCount) {
                    $offerApplyCount = floor($items[$offer->buyProductCode] / ($offer->buyCount + $getCount));
                    $discounts += $offerApplyCount * $offer->getCount * $this->items[$offer->buyProductCode]->price;
                }
            }
        }

        $this->total = $this->total - $discounts;

        return $this;
    }

    /**
     * @return $this
     */
    private function calculateDelivery()
    {
        foreach ($this->deliveryChargeRules as $deliveryChargeRule) {
            if ($deliveryChargeRule->basketCost > $this->total) {
                $this->total = $this->total + $deliveryChargeRule->deliveryCost;
                break;
            }
        }

        return $this;
    }
}

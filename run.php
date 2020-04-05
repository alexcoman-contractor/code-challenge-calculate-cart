<?php

define('__ROOT__', dirname((__FILE__)));
require_once(__ROOT__.'/Basket.php');
require_once(__ROOT__.'/DeliveryRule.php');
require_once(__ROOT__.'/Offer.php');
require_once(__ROOT__.'/Product.php');

$testArray = [
    ['B01', 'G01'],
    ['R01', 'R01'],
    ['R01', 'G01'],
    ['B01', 'B01', 'R01', 'R01', 'R01'],
];

foreach ($testArray as $test) {
    $basket = new Basket(
        [
            'R01' => new Product('Red Widget', 'R01', 32.95),
            'G01' => new Product('Green Widget', 'G01', 24.95),
            'B01' => new Product('Blue Widget', 'B01', 7.95),
        ],
        [
            new DeliveryRule(50, 4.95),
            new DeliveryRule(90, 2.95)
        ],
        [
            new Offer(1, 'R01', 0.5, 'R01')
        ]
    );

    foreach ($test as $item) {
        $basket->add($item);
    }

    echo 'Total: ' . $basket->total() . PHP_EOL;
}

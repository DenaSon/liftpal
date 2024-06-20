<?php

use MojtabaaHN\PersianNumberToWords\Dictionary;
use MojtabaaHN\PersianNumberToWords\PersianNumberToWords;

$instance = new PersianNumberToWords(new Dictionary());

$testArray = \MojtabaaHN\PersianNumberToWords\Tests\TestArray::TESTS;

foreach ($testArray as $index => $testItem) {
    it("assert converts {$testItem[0]} to string with no errors")
        ->assertEquals($testItem[1], $instance->convert($testItem[0]));
}


<?php
namespace tests\unit;

use PHPUnit\Framework\TestCase;
use app\services\Fiscalization;
use app\models\schema_fiscalization\Position;

class PriceWithoutDiscountFiscalizationTest extends TestCase
{

    public function testCreateObject()
    {
        $fiscalization = new class extends Fiscalization {
            public function __construct()
            {
            }
        };
        $this->assertInstanceOf(Fiscalization::class, $fiscalization);
    }

    public function getDateIfRealProvider()
    {
        return [
            [15]
        ];
    }

    /**
     * @dataProvider getDateIfRealProvider
     * @param $expected
     */
    public function testGetPriceWithoutDiscountAmount($expected)
    {
        $position = new class extends Position {
            public $price = 25;
            public $discount_value = 10;
            public $discount_type = 'amount';
        };

        $fiscalization = new class extends Fiscalization {
            public function __construct()
            {
            }
            public function calcPriceWithoutDiscount(Position $position){
               return parent::calcPriceWithoutDiscount($position);
              }
        };

        $this->assertEquals($expected, $fiscalization->calcPriceWithoutDiscount($position));

    }

    /**
     * @dataProvider getDateIfRealProvider
     * @param $expected
     */
    public function testGetPriceWithoutDiscountPercent($expected)
    {
        $position = new class extends Position {
            public $price = 50;
            public $discount_value = 70;
            public $discount_type = 'percent';
        };

        $fiscalization = new class extends Fiscalization {
            public function __construct()
            {
            }
            public function calcPriceWithoutDiscount(Position $position){
                return parent::calcPriceWithoutDiscount($position);
            }
        };

        $this->assertEquals($expected, $fiscalization->calcPriceWithoutDiscount($position));

    }

}


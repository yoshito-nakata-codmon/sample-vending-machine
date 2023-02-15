<?php

declare(strict_types=1);

namespace src\domain\models;

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . "/../../../vendor/autoload.php");

class CoinTest extends TestCase
{
    public function test_values_asc()
    {
        $this->assertEquals([
            1,
            5,
            10,
            50,
            100,
            500,
            1000,
        ], Coin::values());
    }

    public function test_values_desc()
    {
        $this->assertEquals([
            1000,
            500,
            100,
            50,
            10,
            5,
            1,
        ], Coin::values(true));
    }

    public function test_fromAmount()
    {
        $this->assertEquals(
            Coin::from(100),
            Coin::fromAmount(100)
        );
    }

    public function test_fromAmount_NG()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('硬貨の金額が不正: 30');
        Coin::fromAmount(30);
    }
}
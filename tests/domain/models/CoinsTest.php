<?php

declare(strict_types=1);

namespace src\domain\models;

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . "/../../../vendor/autoload.php");

class CoinsTest extends TestCase
{
    /** @dataProvider ofAmountDataProvider */
    public function test_ofAmount($expected, $amount)
    {
        $this->assertEquals($expected, Coins::ofAmount($amount));
    }

    private function ofAmountDataProvider(): array
    {
        return [
            "全種類含むケース" => [new Coins([
                Coin::from(1000),
                Coin::from(500),
                Coin::from(100),
                Coin::from(50),
                Coin::from(10),
                Coin::from(5),
                Coin::from(1),
            ]), 1666],
            "1種類を複数含むケース" => [new Coins([
                Coin::from(100),
                Coin::from(100),
                Coin::from(10),
                Coin::from(10),
            ]), 220],
            "0円のケース" => [new Coins([]), 0],
        ];
    }

    public function test_ofAmount_NG()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('金額不正: -1');
        Coins::ofAmount(-1);
    }

    public function test_concat()
    {
        $coins1 = new Coins([
            Coin::from(100),
            Coin::from(100),
            Coin::from(50),
        ]);
        $coins2 = new Coins([
            Coin::from(10),
            Coin::from(500),
            Coin::from(50),
            Coin::from(10),
        ]);
        $coinsEmpty = new Coins();

        $this->assertEquals(
            new Coins([
                Coin::from(100),
                Coin::from(100),
                Coin::from(50),
                Coin::from(10),
                Coin::from(500),
                Coin::from(50),
                Coin::from(10),
            ]),
            $coins1->concat($coins2)->concat($coinsEmpty)
        );
    }
}
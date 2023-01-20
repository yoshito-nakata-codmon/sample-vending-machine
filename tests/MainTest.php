<?php

require_once(__DIR__ . "/../vendor/autoload.php");
require_once(__DIR__ . "/../src/main.php");

use PHPUnit\Framework\TestCase;

class MainTest extends TestCase
{
    public const COLA = 'cola'; // コーラ120円
    public const COFFEE = 'coffee'; // コーヒー150円
    public const ENERGY_DRINK = 'energy_drink'; // エナジードリンク210円

    public const NO_CHANGE = 'nochange'; // おつりなし

    // 120円支払ってコーラを買う
    public const INPUT_A = ['coins' => [
      '100' => 1,
      '10' => 2,
    ],
    'menu' => MainTest::COLA];

    // 200円支払ってコーヒーを買う
    public const INPUT_B = ['coins' => [
      '100' => 2,
    ],
    'menu' => MainTest::COFFEE];

    // 1000円支払ってエナジードリンクを買う
    public const INPUT_C = ['coins' => [
      '1000' => 1,
    ],
    'menu' => MainTest::ENERGY_DRINK];

    /**
     * @group round1
     * @dataProvider provider_もっとも通常のパターン
     */
    public function test_round1_もっとも通常のパターン($coins, $menu, $expectedChange)
    {
        // Given: provider
        // When
        $actual = Main::runSimply($coins, $menu);

        // Then
        $this->assertSame($actual, $expectedChange);
    }

    public function provider_もっとも通常のパターン()
    {
        // $coins, $menu, $expectedChange
        return [
            "120円支払ってコーラを買う" => [MainTest::INPUT_A["coins"], MainTest::INPUT_A["menu"], MainTest::NO_CHANGE],
            "200円支払ってコーヒーを買う" => [MainTest::INPUT_B["coins"], MainTest::INPUT_B["menu"], "50 1"],
            "1000円支払ってエナジードリンクを買う" => [MainTest::INPUT_C["coins"], MainTest::INPUT_C["menu"], "500 1 100 2 50 1 10 4"],
        ];
    }
}

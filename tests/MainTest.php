<?php

require_once(__DIR__ . "/../vendor/autoload.php");
require_once(__DIR__ . "/../src/main.php");

use PHPUnit\Framework\TestCase;

class MainTest extends TestCase
{
  const COLA = 'cola'; // コーラ120円
  const COFFEE = 'coffee'; // コーヒー150円
  const ENERGY_DRINK = 'energy_drink'; // エナジードリンク210円
  
  const NO_CHANGE = 'nochange'; // おつりなし

  // 120円支払ってコーラを買う
  const INPUT_A = ['coins' => [
    '100' => 1,
    '10' => 2,
  ],
  'menu' => MainTest::COLA];

  // 200円支払ってコーヒーを買う
  const INPUT_B = ['coins' => [
    '100' => 2,
  ],
  'menu' => MainTest::COFFEE];

  // 1000円支払ってエナジードリンクを買う
  const INPUT_C = ['coins' => [
    '1000' => 1,
  ],
  'menu' => MainTest::ENERGY_DRINK];

  /**
   * @dataProvider provider_もっとも通常のパターン
   */
  public function test_もっとも通常のパターン($userInput, $expectedChange)
  {
    // Given
    $vendingMachineCoins = [
      '500' => 999,
      '100' => 999,
      '50' => 999,
      '10' => 999,
    ];
    $expectedChange = MainTest::NO_CHANGE;

    // When
    $actual = Main::run($vendingMachineCoins, $userInput);

    // Then
    $this->assertSame($actual, $expectedChange);
  }

  public function provider_もっとも通常のパターン()
  {
      // $userInput, $expectedChange
      return [
          "120円支払ってコーラを買う" => [MainTest::INPUT_A, MainTest::NO_CHANGE],
          "200円支払ってコーヒーを買う" => [MainTest::INPUT_B, "50 1"],
          "1000円支払ってエナジードリンクを買う" => [MainTest::INPUT_C, "500 1 100 2 50 1 10 4"],
      ];
  }
}
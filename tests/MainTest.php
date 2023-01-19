<?php

require_once(__DIR__ . "/../vendor/autoload.php");
require_once(__DIR__ . "/../src/main.php");

use PHPUnit\Framework\TestCase;

class MainTest extends TestCase
{

  const COLA = 'cola'; // 120円
  const PET_COFFEE = 'pet_coffee'; // 150円
  const ENERGY_DRINK = 'energy_drink'; // 210円
  
  const NO_CHANGE = 'nochange';

  // 120円支払ってコーラを買う
  const INPUT_A = ['coins' => [
    '100' => 1,
    '10' => 2,
  ],
  'menu' => MainTest::COLA];

  // 200円支払ってコーラを買う
  const INPUT_B = ['coins' => [
    '100' => 2,
  ],
  'menu' => MainTest::COLA];

  // 1000円支払ってコーラを買う
  const INPUT_C = ['coins' => [
    '1000' => 1,
  ],
  'menu' => MainTest::COLA];

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
    $actual = Main::runSingle($vendingMachineCoins, $userInput);

    // Then
    $this->assertSame($actual, $expectedChange);
  }

  public function provider_もっとも通常のパターン()
  {
      // $vendingMachineCoins, $userInput
      return [
          "120円支払ってコーラを買う" => [MainTest::INPUT_A, MainTest::NO_CHANGE],
          "200円支払ってコーラを買う" => [MainTest::INPUT_B, ['50' => 1, '10' => 3]],
          "1000円支払ってコーラを買う" => [MainTest::INPUT_C, ['500' => 1, '100' => 3, '50' => 1, '10' => 3]],
      ];
  }
}
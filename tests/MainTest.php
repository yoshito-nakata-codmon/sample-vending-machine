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

  public function test_もっとも通常のパターン_120円払ってコーラを買う()
  {
    // Given
    $vendingMachineCoins = [
      '500' => 999,
      '100' => 999,
      '50' => 999,
      '10' => 999,
    ];
    $userInputs = [
      MainTest::INPUT_A, // 120円支払ってコーラを買う
    ];
    $expectedChange = MainTest::NO_CHANGE;

    // When
    $actual = Main::run($vendingMachineCoins, $userInputs);

    // Then
    $this->assertSame($actual, $expectedChange);

  }
}
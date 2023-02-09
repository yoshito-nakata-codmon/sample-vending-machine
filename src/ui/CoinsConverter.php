<?php

declare(strict_types=1);

namespace src\ui;

use src\domain\models\Coins;

class CoinsConverter
{
  public static function toString(Coins $coins): string {
    if($coins->isEmpty()) return "nochange";

    $coinsStrArray = [];
    foreach($coins->getMap() as $key => $value) {
      $coinsStrArray[] = "$key $value";
    }

    return implode(' ', $coinsStrArray);
  }
}
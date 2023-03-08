<?php

namespace src\domain\models;

use Exception;

enum Coin: int
{
    case YEN_1000 = 1000;
    case YEN_500 = 500;
    case YEN_100 = 100;
    case YEN_50 = 50;
    case YEN_10 = 10;
    case YEN_5 = 5;
    case YEN_1 = 1;

    /**
     * @throws Exception
     */
    public static function fromAmount(int $amount): Coin
    {
        try {
            return Coin::from($amount);
        } catch(\ValueError $e) {
            throw new Exception('硬貨の金額が不正: '."$amount");
        }
    }

    public static function values(bool $desc = false): array
    {
        $values = array_map(function(Coin $coinType): int {
            return $coinType->value;
        }, self::cases());

        if($desc) {
            rsort($values, SORT_NUMERIC);
        } else {
            sort($values, SORT_NUMERIC);
        }

        return $values;
    }

    /**
     * @throws Exception
     */
    public function smaller(): ?Coin
    {
        $values = self::values(true);
        $index = array_search($this->value, $values);
        if(array_key_exists($index + 1, $values)) {
            return Coin::fromAmount($values[$index + 1]);
        } else {
            return null;
        }
    }
}

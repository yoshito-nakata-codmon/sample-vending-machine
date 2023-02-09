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
        return match(true) {
            $amount === 1000 => self::YEN_1000,
            $amount === 500 => self::YEN_500,
            $amount === 100 => self::YEN_100,
            $amount === 50 => self::YEN_50,
            $amount === 10 => self::YEN_10,
            $amount === 5 => self::YEN_5,
            $amount === 1 => self::YEN_1,
            default => throw new Exception('硬貨の金額が不正: '."$amount")
        };
    }

    public static function values(bool $desc = false): array
    {
        $types = self::cases();
        $values = [];
        foreach ($types as $coinType) {
            $values[] = $coinType->value;
        }
        if($desc) {
            rsort($values, SORT_NUMERIC);
        } else {
            sort($values, SORT_NUMERIC);
        }
        return $values;
    }
}

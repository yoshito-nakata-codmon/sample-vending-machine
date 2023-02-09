<?php

namespace src\domain\models;

use Exception;

enum Menu: int
{
    case COLA = 120;
    case COFFEE = 150;
    case ENERGY_DRINK = 210;

    /**
     * @throws Exception
     */
    public static function fromName(string $name): Menu
    {
        return match(true) {
            $name === 'cola' => self::COLA,
            $name === 'coffee' => self::COFFEE,
            $name === 'energy_drink' => self::ENERGY_DRINK,
            default => throw new Exception('取り扱っていない商品: '."$name")
        };
    }
}

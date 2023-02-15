<?php

declare(strict_types=1);

namespace src\domain\models;

use Exception;

class Coins
{
    private array $list;

    public function __construct(array $list = [])
    {
        $this->list = $list;
    }

    public function add(Coin $coin): Coins
    {
        $this->list[] = $coin;
        return $this;
    }

    /**
     * @throws Exception
     */
    public static function ofAmount(int $amount): Coins
    {
        if($amount < 0) throw new \Exception('金額不正: '.$amount);

        $coinValuesDesc = Coin::values(true);

        $coins = new Coins();
        $remaining = $amount;
        foreach ($coinValuesDesc as $coinValue) {
            $count = floor($remaining / $coinValue);
            $reminder = $remaining % $coinValue; // 余り
            for ($i = 0; $i < $count; $i++) {
                $coins->add(Coin::fromAmount($coinValue));
            }
            $remaining = $reminder;
            if($remaining === 0) break;
        }

        return $coins;
    }

    public function sum(): int
    {
        $sum = 0;
        foreach ($this->list as $coin) {
            $sum += $coin->value;
        }
        return $sum;
    }

    public function isEmpty(): bool
    {
        return empty($this->list);
    }

    public function getList(): array
    {
        return $this->list;
    }

    public function getMap(): array
    {
        $map = [];
        foreach($this->list as $coin) {
          if(isset($map[$coin->value])) {
            $map[$coin->value] += 1;
          } else {
            $map[$coin->value] = 1;
          }
        }
        return $map;
    }
}
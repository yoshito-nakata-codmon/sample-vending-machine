<?php

namespace src\infrastructure\repositories;

use src\domain\models\Coin;
use src\domain\repositories\ICoinRepository;

class CoinRepositoryOnArg implements ICoinRepository
{
    private array $map;

    public function __construct(?array $coinMap = null)
    {
        if (is_null($coinMap)) {
            $coinMap = [
                '500' => 999,
                '100' => 999,
                '50' => 999,
                '10' => 999,
                '5' => 999,
                '1' => 999,
            ];
        }
        foreach ($coinMap as $key => $value) {
            $this->map[intval($key)] = $value;
        }
    }

    public function pop(Coin $coin): ?Coin{
        if(array_key_exists($coin->value, $this->map)
            && $this->map[$coin->value] > 0) {
            $this->map[$coin->value]--;
            return $coin;
        } else {
            return null;
        }
    }
}
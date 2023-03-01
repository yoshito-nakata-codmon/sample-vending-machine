<?php

namespace src\infrastructure\repositories;

use src\domain\models\Coin;
use src\domain\repositories\ICoinRepository;

class CoinRepositoryOnArgs implements ICoinRepository
{
    private array $map;

    public function __construct(array $coinMap)
    {
        foreach ($coinMap as $key => $value) {
            $this->map[intval($key)] = $value;
        }
    }

    public function pop(Coin $coin): ?Coin{
        if($this->map[$coin->value] > 0) {
            $this->map[$coin->value]--;
            return $coin;
        } else {
            return null;
        }
    }
}
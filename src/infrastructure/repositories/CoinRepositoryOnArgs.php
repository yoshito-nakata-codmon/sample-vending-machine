<?php

namespace src\infrastructure\repositories;

use src\domain\repositories\ICoinRepository;

class CoinRepositoryOnArgs implements ICoinRepository
{
    private array $map;

    public function __construct(array $coinMap)
    {
        $this->map = $coinMap;
    }
}
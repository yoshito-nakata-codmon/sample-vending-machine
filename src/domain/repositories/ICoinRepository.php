<?php

namespace src\domain\repositories;

use src\domain\models\Coin;

interface ICoinRepository
{
    public function pop(Coin $coin): ?Coin;
}
<?php

declare(strict_types=1);

namespace src\domain\services;

use Exception;
use src\domain\models\Coin;
use src\domain\models\Coins;
use src\domain\repositories\ICoinRepository;

class CoinManager
{
    private ICoinRepository $coinRepository;

    public function __construct(ICoinRepository $coinRepository)
    {
        $this->coinRepository = $coinRepository;
    }

    /**
     * @throws Exception
     */
    public function get(Coin $coin): Coins
    {
        $requiredAmount = $coin->value;
        $returnCoins = new Coins();

        $requiredCoin = $coin;
        while($requiredAmount > 0) {
            $maybeCoin = $this->coinRepository->pop($requiredCoin);
            if($maybeCoin) {
                $requiredAmount -= $maybeCoin->value;
                $returnCoins->add($maybeCoin);
            } else {
                $requiredCoin = $requiredCoin->smaller();
                if(!$requiredCoin) {
                    throw new Exception('おつりが足りなくて払えない');
                }
            }
        }

        return $returnCoins;
    }
}
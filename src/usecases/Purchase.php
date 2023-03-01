<?php

declare(strict_types=1);

namespace src\usecases;

use Exception;
use src\domain\models\Coins;
use src\domain\models\Menu;
use src\domain\repositories\ICoinRepository;
use src\domain\services\CoinManager;

class Purchase
{
    private ICoinRepository $coinRepository;

    public function __construct(ICoinRepository $coinRepository)
    {
        $this->coinRepository = $coinRepository;
    }

    /**
     * @throws Exception
     */
    public function run(Coins $coins, string $menuStr): Coins
    {
        // 投入金額を計算する
        $inputAmount = $coins->sum();

        // 注文金額を確認する
        $menu = Menu::fromName($menuStr);
        $orderAmount = $menu->value;

        // おつりの金額を計算する
        $change = $inputAmount - $orderAmount;
        if ($change < 0) {
            throw new Exception('不足金額: ' . "$change");
        }

        // おつりの硬貨構成を決める
        $changeCoins = Coins::ofAmount($change);

        // 必要な硬貨を取得する
        $coinManager = new CoinManager($this->coinRepository);
        $changeCoinsSubstance = new Coins();
        foreach ($changeCoins->getList() as $coin) {
            $changeCoinsSubstance = $changeCoinsSubstance->concat($coinManager->get($coin));
        }

        return $changeCoinsSubstance;
    }
}
<?php

declare(strict_types=1);

namespace src\usecases;

use Exception;
use src\domain\models\Coins;
use src\domain\models\Menu;

class Purchase
{
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

        // おつりの硬貨構成を決めて返却
        return Coins::ofAmount($change);
    }
}
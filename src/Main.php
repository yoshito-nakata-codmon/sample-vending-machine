<?php

class Main
{
  /**
   * 処理の開始地点
   *
   * @param array $vendingMachineCoins 自販機に補充される硬貨
   * @param array $userInputs (複数の)客の投入額と注文
   * @return string おつり。大きな硬貨順に枚数を並べる``なしの場合はnochange  
   * ex.)
   * - 100円3枚、50円1枚、10円3枚なら"100 3 50 1 10 3"
   */
  public static function run(array $vendingMachineCoins, array $userInputs): string
  {
    return "";
  }
}

# sample-vending-machine

## 準備

本PRをclone後、プロジェクト直下で下記を実行。

```shell
composer install
```

## 課題

### 1. `test_もっとも通常のパターン`がパスするように`src`以下を修正する。

```shell
# 確認コマンド
composer test-round1
```

次の条件が通るように、`runSimply`を修正。

```php
// 100円が1枚、10円が2枚
$coins = [
  '100' => 1,
  '10' => 2,
];

// コーラは120円とする
$menu = 'cola';

// 購入処理
$change = Main::runSimply($coins, $menu);

echo($change); // "nochange" (おつりがない場合)
```


## linter (php-cs-fixer)

プロジェクト直下で`composer lint`を実行。`src`内が勝手にフォーマットされます。


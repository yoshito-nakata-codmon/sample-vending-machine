<?php

declare(strict_types=1);

namespace src\domain\services;

use PHPUnit\Framework\TestCase;
use src\domain\models\Coin;
use src\domain\models\Coins;
use src\domain\repositories\ICoinRepository;

require_once(__DIR__ . "/../../../vendor/autoload.php");

class CoinManagerTest extends TestCase
{
    public function setUp(): void
    {
        $this->coinRepositoryMock = $this->createMock(ICoinRepository::class);
        $this->coinManager = new CoinManager($this->coinRepositoryMock);
    }

    public function test_get()
    {

        $this->coinRepositoryMock->expects($this->any())
            ->method('pop')
            ->with($this->equalTo(Coin::from(500)))
            ->willReturn(Coin::from(500));

        $coin = Coin::from(500);
        $actual = $this->coinManager->get($coin);

        $expected = new Coins([
            Coin::from(500)
        ]);
        $this->assertEquals($expected, $actual);
    }

    public function test_get_short()
    {
        $map = [
            [Coin::from(500), null],
            [Coin::from(100), Coin::from(100)],
        ];
        $this->coinRepositoryMock
            ->method('pop')
            ->will($this->returnValueMap($map));

        $coin = Coin::from(500);
        $actual = $this->coinManager->get($coin);

        $expected = new Coins([
            Coin::from(100),
            Coin::from(100),
            Coin::from(100),
            Coin::from(100),
            Coin::from(100),
        ]);
        $this->assertEquals($expected, $actual);
    }

    public function test_get_shortAll()
    {
        $map = [
            [Coin::from(5), null],
            [Coin::from(1), null],
        ];
        $this->coinRepositoryMock
            ->method('pop')
            ->will($this->returnValueMap($map));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('おつりが足りなくて払えない');

        $coin = Coin::from(5);
        $this->coinManager->get($coin);
    }
}
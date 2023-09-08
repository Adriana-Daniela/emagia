<?php
declare(strict_types=1);

namespace Adriana\Emagia\Tests\Application;

use Adriana\Emagia\Application\GameFight;
use Adriana\Emagia\Application\GameRoundExecutor;
use Adriana\Emagia\Application\PlayerSelector;
use Adriana\Emagia\Domain\Model\Player\Beast;
use Adriana\Emagia\Domain\Model\Player\Hero;
use PHPUnit\Framework\TestCase;

class GameFightTest extends TestCase
{
    private ?GameFight $gameFight;

    protected function setUp(): void
    {
        $playerSelector = new PlayerSelector();
        $gameRoundExecutor = new GameRoundExecutor();
        $this->gameFight = new GameFight($playerSelector, $gameRoundExecutor);
    }

    public function testStartFight(): void
    {
        $beast = new Beast();
        $hero = new Hero();

        $gameResult = $this->gameFight->startFight($hero, $beast);

        $this->assertNotEmpty($gameResult->getWinner());
        $this->assertNotEmpty($gameResult->getTurns());
    }

    protected function tearDown(): void
    {
        $this->gameFight = null;
    }
}

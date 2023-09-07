<?php
declare(strict_types=1);

namespace Adriana\Emagia\Presentation\Controller;

use Adriana\Emagia\Application\GameFight;
use Adriana\Emagia\Domain\Model\Player\Beast;
use Adriana\Emagia\Domain\Model\Result\GameResult;
use Adriana\Emagia\Domain\Model\Player\Hero;

class GameController
{
    public function __construct(private readonly GameFight $gameFight)
    {
    }

    public function start(): void
    {
        $game = $this->gameFight->startFight(new Hero(), new Beast());

        $this->render($game);
    }

    public function render(GameResult $gameResult): void
    {
        $view = str_replace(
            '%WINNER%',
            $gameResult->getWinner(),
            file_get_contents(__DIR__ . '/../Templates/game.html')
        );

        $turns = '';
        foreach ($gameResult->getTurns() as $turn) {
            $turns .= $turn . "<br/>";
        }

        $view = str_replace(
            '%TURNS%',
            $turns,
            $view
        );

        echo $view;
    }
}

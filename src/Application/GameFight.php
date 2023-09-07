<?php
declare(strict_types=1);

namespace Adriana\Emagia\Application;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Result\GameResult;

class GameFight
{
    public function __construct(
        private readonly PlayerSelectorInterface $playerSelector,
        private readonly GameRoundExecutor $gameRoundExecutor
    ) {
    }

    private const HERO_WON = 'Hero won!';

    private const BEAST_WON = 'Beast won!';

    public function startFight(AbstractCharacter $hero, AbstractCharacter $beast): GameResult
    {
        $beastAttack = $this->playerSelector->getFirstAttacker($beast, $hero);

        return $this->fightUntilGameOver($beastAttack, $hero, $beast, new GameResult());
    }

    public function fightUntilGameOver(
        bool $beastAttack,
        AbstractCharacter $hero,
        AbstractCharacter $beast,
        GameResult $gameResult
    ): GameResult {
        for ($turn = 1; $turn <= 20; $turn++) {
            $gameResult->addTurn($this->gameRoundExecutor->executeRound($turn, $beastAttack, $beast, $hero));

            // switch roles
            $beastAttack = !$beastAttack;

            if ($beast->getHealth() === 0) {
                return $gameResult->setWinner(self::HERO_WON);
            }

            if ($hero->getHealth() === 0) {
                return $gameResult->setWinner(self::BEAST_WON);
            }
        }

        if ($beast->getHealth() > $hero->getHealth()) {
            return $gameResult->setWinner(self::BEAST_WON);
        }

        return $gameResult->setWinner(self::HERO_WON);
    }
}

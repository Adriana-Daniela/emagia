<?php
declare(strict_types=1);

namespace Adriana\Emagia\Application;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Result\GameResult;
use Adriana\Emagia\Domain\Model\Result\GameTurnResult;

class GameFight
{
    public function __construct(private readonly PlayerSelector $playerSelector)
    {
    }

    private const HERO_WON = 'Hero won!';

    private const BEAST_WON = 'Beast won!';

    public function startFight(AbstractCharacter $hero, AbstractCharacter $beast): GameResult
    {
        $beastAttack = $this->playerSelector->getFirstAttacker($beast, $hero);

        return $this->fightUntilGameOver($beastAttack, $hero, $beast, new GameResult());
    }

    public function fightUntilGameOver(bool $beastAttack, AbstractCharacter $hero, AbstractCharacter $beast, GameResult $gameResult): GameResult
    {
        for ($turn = 1; $turn <= 20; $turn++) {
            $turnResult = (new GameTurnResult())
                ->setTurnNumber($turn)
                ->setAttacker($beastAttack ? $beast->getName() : $hero->getName())
                ->setDefender($beastAttack ? $hero->getName() : $beast->getName())
                ->setDefenderHealthBefore($beastAttack ? $hero->getHealth() : $beast->getHealth());

            if ($beastAttack) {
                $beast->attack($hero, $turnResult);
            } else {
                $hero->attack($beast, $turnResult);
            }

            $turnResult->setDefenderHealthAfter($beastAttack ? $hero->getHealth() : $beast->getHealth());

            $gameResult->addTurn($turnResult);

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

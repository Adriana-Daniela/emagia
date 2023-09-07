<?php
declare(strict_types=1);

namespace Adriana\Emagia\Application;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Result\GameTurnResult;

class GameRoundExecutor
{
    public function executeRound(
        int $turn,
        bool $beastAttack,
        AbstractCharacter $beast,
        AbstractCharacter $hero
    ): GameTurnResult {
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

        return $turnResult;
    }
}

<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Skill;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Result\GameTurnResult;

class RapidStrikeSkill extends AbstractSkill
{
    protected int $usageProbability = 10;

    public function trigger(AbstractCharacter $attacker, AbstractCharacter $defender, int $damage, GameTurnResult $gameTurnResult): int
    {
        // additional attack
        return $attacker->executeAttack($defender, $gameTurnResult);
    }

    public function __toString(): string
    {
        return 'Rapid Strike';
    }
}

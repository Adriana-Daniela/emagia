<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Skill;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Result\GameTurnResult;

class MagicShieldSkill extends AbstractSkill
{
    protected int $usageProbability = 20;

    public function trigger(AbstractCharacter $attacker, AbstractCharacter $defender, int $damage, GameTurnResult $gameTurnResult): int
    {
        return (int) round($damage / 2);
    }

    public function __toString(): string
    {
        return 'Magic Shield';
    }
}

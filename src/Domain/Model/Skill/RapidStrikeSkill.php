<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Skill;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Result\GameTurnResult;

class RapidStrikeSkill extends StrikeSkill
{
    protected int $usageProbability = 10;

    public function __toString(): string
    {
        return 'Rapid Strike';
    }
}

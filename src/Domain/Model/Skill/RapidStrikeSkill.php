<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Skill;

class RapidStrikeSkill extends StrikeSkill
{
    protected int $usageProbability = 10;

    public function __toString(): string
    {
        return 'Rapid Strike';
    }
}

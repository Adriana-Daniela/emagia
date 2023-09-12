<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Skill;

class RapidStrikeSkill extends StrikeSkill
{
    public function __construct(int $usageProbability = 10)
    {
        parent::__construct($usageProbability);
    }

    public function __toString(): string
    {
        return 'Rapid Strike';
    }
}

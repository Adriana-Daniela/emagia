<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Skill;

class RapidStrikeSkill extends StrikeSkill
{
    protected int $usageProbability;

    public function __construct($usageProbability = 10)
    {
        $this->usageProbability = $usageProbability;
        parent::__construct($this->usageProbability);
    }

    public function __toString(): string
    {
        return 'Rapid Strike';
    }
}

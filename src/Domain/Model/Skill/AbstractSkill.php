<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Skill;

abstract class AbstractSkill implements SkillInterface
{
    protected int $usageProbability;

    public function __construct($usageProbability = 0)
    {
        $this->usageProbability = $usageProbability;
    }

    public function isTriggered(): bool
    {
        $luckDistribution = array_fill(0, $this->usageProbability, true);
        $luckDistribution = array_merge(
            $luckDistribution,
            array_fill(
                $this->usageProbability,
                100 - $this->usageProbability,
                false
            )
        );

        $luckIndex = random_int(0, 99);

        return $luckDistribution[$luckIndex];
    }
}

<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Skill;

interface SkillInterface
{
    public function isTriggered(): bool;
}

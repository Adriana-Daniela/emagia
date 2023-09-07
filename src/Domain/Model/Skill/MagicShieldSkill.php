<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Skill;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Result\DefenceResult;

class MagicShieldSkill extends AbstractSkill implements DefenceSkillInterface
{
    protected int $usageProbability = 20;

    public function trigger(AbstractCharacter $attacker, AbstractCharacter $defender, int $damage): DefenceResult
    {
        $newDamage = (int)($damage / 2);

        return (new DefenceResult())
            ->setDamage($newDamage)
            ->setNote(sprintf(
                '%s\'s special skill %s decreased damage from %s to %s',
                $defender->getName(),
                $this->__toString(),
                $damage,
                $newDamage
            ));
    }

    public function __toString(): string
    {
        return 'Magic Shield';
    }
}

<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Skill;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Result\GameTurnResult;

class StrikeSkill extends AbstractSkill implements AttackSkillInterface
{
    public function isTriggered(): bool
    {
        return true;
    }

    public function trigger(AbstractCharacter $attacker, AbstractCharacter $defender, int $damage, GameTurnResult $gameTurnResult): int
    {
        if ($this->attackFails($defender)) {
            // no damage if lucky
            return 0;
        }

        $damage = $this->calculateDamage($attacker, $defender);

        return $defender->defend($attacker, $damage, $gameTurnResult);
    }

    /**
     * @param AbstractCharacter $defender
     * @return bool
     */
    private function attackFails(AbstractCharacter $defender): bool
    {
        $luckDistribution = array_fill(0, (int)($defender->getLuck() * 100), true);
        $luckDistribution = array_merge(
            $luckDistribution,
            array_fill(
                (int)($defender->getLuck() * 100),
                100 - (int)($defender->getLuck() * 100),
                false
            )
        );

        $luckIndex = random_int(0, 99);

        return $luckDistribution[$luckIndex];
    }

    /**
     * @param AbstractCharacter $attacker
     * @param AbstractCharacter $defender
     * @return int
     */
    private function calculateDamage(AbstractCharacter $attacker, AbstractCharacter $defender): int
    {
        return $attacker->getStrength() - $defender->getDefence();
    }

    public function __toString(): string
    {
        return 'Strike';
    }
}

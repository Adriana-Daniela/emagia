<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Skill;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Result\AttackResult;

class StrikeSkill extends AbstractSkill implements AttackSkillInterface
{
    public function __construct(int $usageProbability = 100)
    {
        parent::__construct($usageProbability);
    }

    public function trigger(AbstractCharacter $attacker, AbstractCharacter $defender): AttackResult
    {
        if ($this->attackFails($defender)) {
            // no damage if lucky
            return (new AttackResult())
                ->setDamage(0)
                ->setNote(sprintf(
                    '%s attacked %s with %s, but defendant was lucky and no damage was caused!',
                    $attacker->getName(),
                    $defender->getName(),
                    $this->__toString(),
                ));
        }

        $damage = $this->calculateDamage($attacker, $defender);

        return (new AttackResult())
            ->setDamage($damage)
            ->setNote(sprintf(
                '%s attacked %s with %s and caused %d damage',
                $attacker->getName(),
                $defender->getName(),
                $this->__toString(),
                $damage
            ));
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
        return max(0, $attacker->getStrength() - $defender->getDefence());
    }

    public function __toString(): string
    {
        return 'Strike';
    }
}

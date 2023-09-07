<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Player;

use Adriana\Emagia\Domain\Model\Result\GameTurnResult;
use Adriana\Emagia\Domain\Model\Skill\AttackSkillInterface;
use Adriana\Emagia\Domain\Model\Skill\DefenceSkillInterface;

abstract class AbstractCharacter implements CharacterStatsInterface
{
    use CharacterStatsTrait;

    /**
     * @var array<DefenceSkillInterface>
     */
    protected array $defenceSkills = [];

    /**
     * @var array<AttackSkillInterface>
     */
    protected array $attackSkills = [];

    abstract public function getName(): string;

    public function attack(AbstractCharacter $defender, GameTurnResult $gameTurnResult): void
    {
        foreach ($this->attackSkills as $attackSkill) {
            if ($attackSkill->isTriggered()) {
                $damage = $attackSkill->trigger($this, $defender, $this->calculateDamage($defender), $gameTurnResult);

                $gameTurnResult->setUsedSkills($gameTurnResult->getUsedSkills() + [$attackSkill]);
                $gameTurnResult->setDamage($gameTurnResult->getDamage() + $damage);
            }
        }

        $damage = $this->executeAttack($defender, $gameTurnResult);

        $gameTurnResult->setDamage($gameTurnResult->getDamage() + $damage);
    }

    /**
     * @param AbstractCharacter $defender
     * @param GameTurnResult $gameTurnResult
     * @return int
     * @throws \Exception
     */
    public function executeAttack(AbstractCharacter $defender, GameTurnResult $gameTurnResult): int
    {
        if ($this->attackFails($defender)) {
            // no damage if lucky
            return 0;
        }

        $damage = $this->calculateDamage($defender);

        return $defender->defend($this, $damage, $gameTurnResult);
    }

    /**
     * @param AbstractCharacter $defender
     * @return bool
     * @throws \Exception
     */
    private function attackFails(AbstractCharacter $defender): bool
    {
        $luckDistribution = array_fill(0, (int)($defender->getLuck() * 100), true);
        $luckDistribution = array_merge(
            $luckDistribution,
            array_fill(
                (int)($defender->getLuck() * 100) + 1,
                100 - (int)($defender->getLuck() * 100),
                false
            )
        );

        $luckIndex = random_int(0, 99);

        return $luckDistribution[$luckIndex];
    }

    /**
     * @param AbstractCharacter $defender
     * @return int
     */
    private function calculateDamage(AbstractCharacter $defender): int
    {
        return $this->getStrength() - $defender->getDefence();
    }

    public function defend(AbstractCharacter $attacker, int $damage, GameTurnResult $gameTurnResult): int
    {
        foreach ($this->defenceSkills as $defenceSkill) {
            if ($defenceSkill->isTriggered()) {
                $damage = $defenceSkill->trigger($attacker, $this, $damage, $gameTurnResult);

                $gameTurnResult->setUsedSkills($gameTurnResult->getUsedSkills() + [$defenceSkill]);
            }
        }

        $this->setHealth($this->getHealth() - $damage);

        return $damage;
    }
}

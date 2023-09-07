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
            if (!$attackSkill->isTriggered()) {
                continue;
            }

            $damage = $attackSkill->trigger($this, $defender, 0, $gameTurnResult);

            $gameTurnResult->addUsedSkill($attackSkill);

            $defender->defend($this, $damage, $gameTurnResult);
        }
    }

    public function defend(AbstractCharacter $attacker, int $damage, GameTurnResult $gameTurnResult): int
    {
        foreach ($this->defenceSkills as $defenceSkill) {
            if (!$defenceSkill->isTriggered()) {
                continue;
            }

            $damage = $defenceSkill->trigger($attacker, $this, $damage, $gameTurnResult);

            $gameTurnResult->addUsedSkill($defenceSkill);
        }

        $this->setHealth($this->getHealth() - $damage);
        $gameTurnResult->addDamage($damage);

        return $damage;
    }
}

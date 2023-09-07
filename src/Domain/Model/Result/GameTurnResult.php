<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Result;

use Adriana\Emagia\Domain\Model\Skill\SkillInterface;

class GameTurnResult
{
    private int $turnNumber;
    private string $attacker;
    private string $defender;
    /**
     * @var array<SkillInterface>
     */
    private array $usedSkills = [];
    private int $damage = 0;
    private int $defenderHealthBefore;
    private int $defenderHealthAfter;

    /**
     * @param int $turnNumber
     * @return GameTurnResult
     */
    public function setTurnNumber(int $turnNumber): GameTurnResult
    {
        $this->turnNumber = $turnNumber;

        return $this;
    }

    /**
     * @param string $attacker
     * @return GameTurnResult
     */
    public function setAttacker(string $attacker): GameTurnResult
    {
        $this->attacker = $attacker;

        return $this;
    }

    /**
     * @param string $defender
     * @return GameTurnResult
     */
    public function setDefender(string $defender): GameTurnResult
    {
        $this->defender = $defender;

        return $this;
    }

    /**
     * @param SkillInterface $usedSkill
     * @return GameTurnResult
     */
    public function addUsedSkill(SkillInterface $usedSkill): GameTurnResult
    {
        $this->usedSkills[] = $usedSkill;

        return $this;
    }

    /**
     * @param int $damage
     * @return GameTurnResult
     */
    public function addDamage(int $damage): GameTurnResult
    {
        $this->damage += $damage;

        return $this;
    }

    /**
     * @param int $defenderHealthBefore
     * @return GameTurnResult
     */
    public function setDefenderHealthBefore(int $defenderHealthBefore): GameTurnResult
    {
        $this->defenderHealthBefore = $defenderHealthBefore;

        return $this;
    }

    /**
     * @param int $defenderHealthAfter
     * @return GameTurnResult
     */
    public function setDefenderHealthAfter(int $defenderHealthAfter): GameTurnResult
    {
        $this->defenderHealthAfter = $defenderHealthAfter;

        return $this;
    }

    public function __toString(): string
    {
        return sprintf(
            '%d: %s attacked %s with damage %d, %s\'s health lowered from %d to %d (used skills: %s)',
            $this->turnNumber,
            $this->attacker,
            $this->defender,
            $this->damage,
            $this->defender,
            $this->defenderHealthBefore,
            $this->defenderHealthAfter,
            implode(',', $this->usedSkills)
        );
    }
}

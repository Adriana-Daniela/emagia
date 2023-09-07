<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Result;

class AttackResult
{
    private int $damage;
    private string $note;

    /**
     * @return int
     */
    public function getDamage(): int
    {
        return $this->damage;
    }

    /**
     * @param int $damage
     * @return AttackResult
     */
    public function setDamage(int $damage): AttackResult
    {
        $this->damage = $damage;

        return $this;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @param string $note
     * @return AttackResult
     */
    public function setNote(string $note): AttackResult
    {
        $this->note = $note;

        return $this;
    }
}

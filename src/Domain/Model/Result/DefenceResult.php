<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Result;

class DefenceResult
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
     * @return DefenceResult
     */
    public function setDamage(int $damage): DefenceResult
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
     * @return DefenceResult
     */
    public function setNote(string $note): DefenceResult
    {
        $this->note = $note;

        return $this;
    }
}

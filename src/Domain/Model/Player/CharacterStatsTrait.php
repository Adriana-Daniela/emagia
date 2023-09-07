<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Player;

trait CharacterStatsTrait
{
    private int $health;
    private int $strength;
    private int $defence;
    private int $speed;
    private float $luck;

    public function getHealth(): int
    {
        return $this->health;
    }

    public function setHealth(int $health): self
    {
        if ($health < 0) {
            $health = 0;
        }

        $this->health = $health;

        return $this;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getDefence(): int
    {
        return $this->defence;
    }

    public function setDefence(int $defence): self
    {
        $this->defence = $defence;

        return $this;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getLuck(): float
    {
        return $this->luck;
    }

    public function setLuck(float $luck): self
    {
        $this->luck = $luck;

        return $this;
    }
}

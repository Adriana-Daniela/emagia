<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Player;

interface CharacterStatsInterface
{
    public function getHealth(): int;

    public function setHealth(int $health): self;

    public function getStrength(): int;

    public function setStrength(int $strength): self;

    public function getDefence(): int;

    public function setDefence(int $defence): self;

    public function getSpeed(): int;

    public function setSpeed(int $speed): self;

    public function getLuck(): float;

    public function setLuck(float $luck): self;
}

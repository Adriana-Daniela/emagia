<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Player;

class Beast extends AbstractCharacter
{
    public function __construct()
    {
        $this->setHealth(random_int(60, 90))
            ->setStrength(random_int(60, 90))
            ->setDefence(random_int(40, 60))
            ->setSpeed(random_int(40, 60))
            ->setLuck(random_int(25, 40) / 100);
    }

    public function getName(): string
    {
        return 'Beast';
    }
}

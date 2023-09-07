<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Player;

use Adriana\Emagia\Domain\Model\Skill\StrikeSkill;

class Beast extends AbstractCharacter
{
    public function __construct()
    {
        $this->setHealth(random_int(60, 90))
            ->setStrength(random_int(60, 90))
            ->setDefence(random_int(40, 60))
            ->setSpeed(random_int(40, 60))
            ->setLuck(random_int(25, 40) / 100);

        $this->attackSkills[] = new StrikeSkill();
    }

    public function getName(): string
    {
        return 'Beast';
    }
}

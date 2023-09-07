<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Player;

use Adriana\Emagia\Domain\Model\Skill\MagicShieldSkill;
use Adriana\Emagia\Domain\Model\Skill\MagicShieldSkillWithOutput;
use Adriana\Emagia\Domain\Model\Skill\RapidStrikeSkill;
use Adriana\Emagia\Domain\Model\Skill\StrikeSkill;

class Hero extends AbstractCharacter
{
    public function __construct()
    {
        $this->setHealth(random_int(70, 100))
            ->setStrength(random_int(70, 80))
            ->setDefence(random_int(45, 55))
            ->setSpeed(random_int(40, 50))
            ->setLuck(random_int(10, 30) / 100);

        $this->defenceSkills[] = new MagicShieldSkill();
        $this->attackSkills[] = new StrikeSkill();
        $this->attackSkills[] = new RapidStrikeSkill();
    }

    public function getName(): string
    {
        return 'Hero';
    }
}

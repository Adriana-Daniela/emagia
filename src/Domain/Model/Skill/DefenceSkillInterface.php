<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Skill;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Result\DefenceResult;

interface DefenceSkillInterface extends SkillInterface
{
    public function trigger(AbstractCharacter $attacker, AbstractCharacter $defender, int $damage): DefenceResult;
}

<?php
declare(strict_types=1);

namespace Adriana\Emagia\Domain\Model\Skill;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Result\GameTurnResult;

interface SkillInterface
{
    public function isTriggered(): bool;

    public function trigger(AbstractCharacter $attacker, AbstractCharacter $defender, int $damage, GameTurnResult $gameTurnResult): int;
}

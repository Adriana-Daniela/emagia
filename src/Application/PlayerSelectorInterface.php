<?php
declare(strict_types=1);

namespace Adriana\Emagia\Application;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;

interface PlayerSelectorInterface
{
    public function getFirstAttacker(AbstractCharacter $beast, AbstractCharacter $hero): bool;
}

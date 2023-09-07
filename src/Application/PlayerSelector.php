<?php
declare(strict_types=1);

namespace Adriana\Emagia\Application;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;

class PlayerSelector implements PlayerSelectorInterface
{
    /**
     * @param AbstractCharacter $beast
     * @param AbstractCharacter $hero
     * @return bool
     */
    public function getFirstAttacker(AbstractCharacter $beast, AbstractCharacter $hero): bool
    {
        if ($beast->getSpeed() > $hero->getSpeed()) {
            return true;
        }

        if ($beast->getSpeed() === $hero->getSpeed()) {
            if ($beast->getLuck() > $hero->getLuck()) {
                return true;
            }
        }

        return false;
    }
}

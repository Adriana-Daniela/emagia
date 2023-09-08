<?php
declare(strict_types=1);

namespace Adriana\Emagia\Tests\Application;

use Adriana\Emagia\Application\PlayerSelector;
use Adriana\Emagia\Domain\Model\Player\Beast;
use Adriana\Emagia\Domain\Model\Player\Hero;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class PlayerSelectorTest extends TestCase
{
    #[DataProvider('playersProvider')]
    public function testCanGetFirstAttacker(
        int $beastSpeed,
        int $heroSpeed,
        float $beastLuck,
        float $heroLuck,
        bool $isBeastFirstAttacker
    ): void
    {
        $playerSelector = new PlayerSelector();

        $beast = new Beast();
        $hero = new Hero();

        $beast->setSpeed($beastSpeed)->setLuck($beastLuck);
        $hero->setSpeed($heroSpeed)->setLuck($heroLuck);

        $firstAttacker = $playerSelector->getFirstAttacker($beast, $hero);

        $this->assertSame($isBeastFirstAttacker, $firstAttacker);
    }

    /**
     * @return array
     */
    public static function playersProvider(): array
    {
        return [
            'beast is faster, beast strikes first' => [
                'beastSpeed' => 57,
                'heroSpeed' => 42,
                'beastLuck' => 0.25,
                'heroLuck' => 0.3,
                'isBeastFirstAttacker' => true,
            ],
            'hero is faster, hero strikes first' => [
                'beastSpeed' => 42,
                'heroSpeed' => 49,
                'beastLuck' => 0.25,
                'heroLuck' => 0.3,
                'isBeastFirstAttacker' => false,
            ],
            'same speed but lucky beast, beast strikes first' => [
                'beastSpeed' => 45,
                'heroSpeed' => 45,
                'beastLuck' => 0.4,
                'heroLuck' => 0.1,
                'isBeastFirstAttacker' => true,
            ],
            'same speed but lucky hero, hero strikes first' => [
                'beastSpeed' => 45,
                'heroSpeed' => 45,
                'beastLuck' => 0.25,
                'heroLuck' => 0.3,
                'isBeastFirstAttacker' => false,
            ],
            'same speed, same luck, hero strikes first' => [
                'beastSpeed' => 45,
                'heroSpeed' => 45,
                'beastLuck' => 0.25,
                'heroLuck' => 0.25,
                'isBeastFirstAttacker' => false,
            ],
        ];
    }
}

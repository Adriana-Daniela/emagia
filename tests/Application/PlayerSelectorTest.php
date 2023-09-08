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
    #[DataProvider('playersDataProvider')]
    public function testCanGetFirstAttacker(
        bool $expectedFirstAttacker,
        int $beastSpeed,
        int $heroSpeed,
        float $beastLuck,
        float $heroLuck
    ): void
    {
        $playerSelector = new PlayerSelector();

        $beast = new Beast();
        $hero = new Hero();

        $beast->setSpeed($beastSpeed)->setLuck($beastLuck);
        $hero->setSpeed($heroSpeed)->setLuck($heroLuck);

        $actualFirstAttacker = $playerSelector->getFirstAttacker($beast, $hero);

        $this->assertSame($expectedFirstAttacker, $actualFirstAttacker);
    }

    /**
     * @return array
     */
    public static function playersDataProvider(): array
    {
        return [
            'beast is faster, beast strikes first' => [
                'expectedFirstAttacker' => true,
                'beastSpeed' => 57,
                'heroSpeed' => 42,
                'beastLuck' => 0.25,
                'heroLuck' => 0.3,
            ],
            'hero is faster, hero strikes first' => [
                'isBeastFirstAttacker' => false,
                'beastSpeed' => 42,
                'heroSpeed' => 49,
                'beastLuck' => 0.25,
                'heroLuck' => 0.3,
            ],
            'same speed but lucky beast, beast strikes first' => [
                'isBeastFirstAttacker' => true,
                'beastSpeed' => 45,
                'heroSpeed' => 45,
                'beastLuck' => 0.4,
                'heroLuck' => 0.1,
            ],
            'same speed but lucky hero, hero strikes first' => [
                'isBeastFirstAttacker' => false,
                'beastSpeed' => 45,
                'heroSpeed' => 45,
                'beastLuck' => 0.25,
                'heroLuck' => 0.3,
            ],
            'same speed, same luck, hero strikes first' => [
                'isBeastFirstAttacker' => false,
                'beastSpeed' => 45,
                'heroSpeed' => 45,
                'beastLuck' => 0.25,
                'heroLuck' => 0.25,
            ],
        ];
    }
}

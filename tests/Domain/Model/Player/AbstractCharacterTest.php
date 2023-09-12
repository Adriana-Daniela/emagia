<?php
declare(strict_types=1);

namespace  Adriana\Emagia\Tests\Domain\Model\Player;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Player\Beast;
use Adriana\Emagia\Domain\Model\Player\Hero;
use Adriana\Emagia\Domain\Model\Result\GameTurnResult;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AbstractCharacterTest extends TestCase
{
    #[DataProvider('attackDataProvider')]
    public function testAttack(
        int $expectedDamage,
        AbstractCharacter $attacker,
        AbstractCharacter $defender
    ): void
    {
        $attacker->attack($defender, new GameTurnResult());

        $this->assertSame($defender->getHealth(), $expectedDamage);
    }

    #[DataProvider('defendDataProvider')]
    public function testDefend(
        int $expectedDamage,
        AbstractCharacter $attacker,
        AbstractCharacter $defender
    ): void
    {
        $defender->defend($attacker, 0, new GameTurnResult());

        $this->assertSame($defender->getHealth(), $expectedDamage);
    }

    public static function attackDataProvider(): array
    {
        return [
            'Beast attacks and wins' => [
                'expectedDamage' => 20,
                'attacker' => (new Beast())
                    ->setLuck(1)
                    ->setStrength(70)
                    ->setDefence(50),
                'defender' => (new Hero())
                    ->setLuck(0)
                    ->setStrength(60)
                    ->setDefence(50),

            ],
//            'Hero attacks and wins' => [
//
//            ],
//            'Hero attacks, uses RapidStrike skill and wins' => [
//
//            ]
        ];
    }

    public static function defendDataProvider(): array
    {
        return [
            'Beast defends and wins' => [
                'expectedDamage' => 20,
                'attacker' => (new Beast())
                    ->setLuck(0)
                    ->setStrength(70)
                    ->setDefence(50),
                'defender' => (new Hero())
                    ->setLuck(1)
                    ->setStrength(80)
                    ->setDefence(10),
            ],
//            'Hero defends and wins' => [
//
//            ],
//            'Hero defends with MagicShield and wins' => [
//
//            ]
        ];
    }
}

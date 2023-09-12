<?php
declare(strict_types=1);

namespace Adriana\Emagia\Tests\Domain\Model\Skill;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Player\Beast;
use Adriana\Emagia\Domain\Model\Player\Hero;
use Adriana\Emagia\Domain\Model\Skill\StrikeSkill;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class StrikeSkillTest extends TestCase
{
    #[DataProvider('strikeSkillIsTriggeredDataProvider')]
    public function testStrikeSkillIsTriggered(bool $expectedIsTriggered, int $usageProbability): void
    {
        $strikeSkill = new StrikeSkill($usageProbability);

        $isStrikeSkillActuallyTriggered = $strikeSkill->isTriggered();

        $this->assertSame($expectedIsTriggered, $isStrikeSkillActuallyTriggered);
    }

    #[DataProvider('strikeSkillTriggerDataProvider')]
    public function testStrikeSkillTrigger(
        int $expectedDamage,
        AbstractCharacter $attacker,
        AbstractCharacter $defender
    ): void
    {
        $strikeSkill = new StrikeSkill();

        $attackResult = $strikeSkill->trigger($attacker, $defender);

        $this->assertSame($expectedDamage, $attackResult->getDamage());
    }

    /**
     * @return array[]
     */
    public static function strikeSkillTriggerDataProvider(): array
    {
        return [
            'defender\'s health is damaged if attacker gets lucky' => [
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
        ];
    }

    /**
     * @return array[]
     */
    public static function strikeSkillIsTriggeredDataProvider(): array
    {
        return [
            'rapid strike skill is used' => [
                'expectedIsTriggered' => true,
                'usageProbability' => 100,
            ],
            'rapid strike skill is not used' => [
                'expectedIsTriggered' => false,
                'usageProbability' => 0,
            ],
        ];
    }
}

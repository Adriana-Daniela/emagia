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
        $strikeSkill = new StrikeSkill(100);

        $attackResult = $strikeSkill->trigger($attacker, $defender);

        $this->assertSame($expectedDamage, $attackResult->getDamage());
    }

    /**
     * @return array[]
     */
    public static function strikeSkillTriggerDataProvider(): array
    {
        return [
            'defender\'s health is not damaged if he gets lucky' => [
                'expectedDamage' => 0,
                'attacker' => (new Beast())
                    ->setLuck(0)
                    ->setStrength(70)
                    ->setDefence(50),
                'defender' => (new Hero())
                    ->setLuck(1)
                    ->setStrength(60)
                    ->setDefence(50),
            ],
            'attacker\'s luck does not influence defender\'s health if defender is also lucky' => [
                'expectedDamage' => 0,
                'attacker' => (new Beast())
                    ->setLuck(1)
                    ->setStrength(70)
                    ->setDefence(50),
                'defender' => (new Hero())
                    ->setLuck(1)
                    ->setStrength(60)
                    ->setDefence(50),
            ],
            'defender\'s health is reduced if defender\'s unlucky' => [
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
            'attacker is not lucky but defender\'s health is reduced if defender is unlucky' => [
                'expectedDamage' => 20,
                'attacker' => (new Beast())
                    ->setLuck(0)
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

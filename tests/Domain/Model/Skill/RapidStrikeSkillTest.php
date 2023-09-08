<?php
declare(strict_types=1);

namespace Domain\Model\Skill;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Player\Beast;
use Adriana\Emagia\Domain\Model\Player\Hero;
use Adriana\Emagia\Domain\Model\Skill\RapidStrikeSkill;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RapidStrikeSkillTest extends TestCase
{
    #[DataProvider('rapidStrikeSkillIsTriggeredDataProvider')]
    public function testRapidStrikeSkillIsTriggered(bool $expectedIsTriggered, int $usageProbability): void
    {
        $rapidStrikeSkill = new RapidStrikeSkill($usageProbability);

        $isRapidStrikeSkillActuallyTriggered = $rapidStrikeSkill->isTriggered();

        $this->assertSame($expectedIsTriggered, $isRapidStrikeSkillActuallyTriggered);
    }

    #[DataProvider('rapidSkillTriggerDataProvider')]
    public function testRapidStrikeSkillTrigger(
        int $expectedDamage,
        AbstractCharacter $attacker,
        AbstractCharacter $defender
    ): void
    {
        $rapidStrikeSkill = new RapidStrikeSkill();

        $actualAttackResult = $rapidStrikeSkill->trigger($attacker, $defender);

        $this->assertSame($expectedDamage, $actualAttackResult->getDamage());
    }

    /**
     * @return array[]
     */
    public static function rapidSkillTriggerDataProvider(): array
    {
        return [
            'defender\'s health is not damaged if he gets lucky' => [
                'expectedDamage' => 0,
                'attacker' => (new Beast())
                    ->setLuck(0.1)
                    ->setStrength(70)
                    ->setDefence(50),
                'defender' => (new Hero())
                    ->setLuck(0.9)
                    ->setStrength(60)
                    ->setDefence(50),
            ],
        ];
    }

    /**
     * @return array[]
     */
    public static function rapidStrikeSkillIsTriggeredDataProvider(): array
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

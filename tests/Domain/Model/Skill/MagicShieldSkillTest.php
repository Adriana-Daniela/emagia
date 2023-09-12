<?php
declare(strict_types=1);

namespace Adriana\Emagia\Tests\Domain\Model\Skill;

use Adriana\Emagia\Domain\Model\Player\AbstractCharacter;
use Adriana\Emagia\Domain\Model\Player\Beast;
use Adriana\Emagia\Domain\Model\Player\Hero;
use Adriana\Emagia\Domain\Model\Skill\MagicShieldSkill;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MagicShieldSkillTest extends TestCase
{
    #[DataProvider('magicShieldSkillIsTriggeredDataProvider')]
    public function testIsTriggered(bool $expectedIsTriggered, int $usageProbability): void
    {
        $magicShieldSkill = new MagicShieldSkill($usageProbability);

        $isMagicShieldSkillActuallyTriggered = $magicShieldSkill->isTriggered();

        $this->assertSame($expectedIsTriggered, $isMagicShieldSkillActuallyTriggered);
    }

    #[DataProvider('magicShieldSkillTriggerDataProvider')]
    public function testMagicShieldSkillTrigger(
        int $expectedDamage,
        AbstractCharacter $attacker,
        AbstractCharacter $defender,
        int $originalDamage,
    ): void
    {
        $magicShieldSkill = new MagicShieldSkill(100);

        $actualDefenceResult = $magicShieldSkill->trigger($attacker, $defender, $originalDamage);

        $this->assertSame($expectedDamage, $actualDefenceResult->getDamage());
    }

    /**
     * @return array[]
     */
    public static function magicShieldSkillTriggerDataProvider(): array
    {
        return [
            'Magic shield skill causes half damage' => [
                'expectedDamage' => 30,
                'attacker' => new Beast(),
                'defender' => new Hero(),
                'originalDamage' => 60,
            ],
            'Magic shield skill causes half damage with odd nr' => [
                'expectedDamage' => 30,
                'attacker' => new Beast(),
                'defender' => new Hero(),
                'originalDamage' => 61,
            ],
            'Magic shield skill with low damage' => [
                'expectedDamage' => 0,
                'attacker' => new Beast(),
                'defender' => new Hero(),
                'originalDamage' => 1,
            ],
            'Magic shield skill with 0 original damage' => [
                'expectedDamage' => 0,
                'attacker' => new Beast(),
                'defender' => new Hero(),
                'originalDamage' => 0,
            ],
        ];
    }

    /**
     * @return array[]
     */
    public static function magicShieldSkillIsTriggeredDataProvider(): array
    {
        return [
            'magic shield skill is used' => [
                'expectedIsTriggered' => true,
                'usageProbability' => 100,
            ],
            'magic shield skill is not used' => [
                'expectedIsTriggered' => false,
                'usageProbability' => 0,
            ],
        ];
    }
}

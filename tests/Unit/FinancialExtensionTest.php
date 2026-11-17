<?php

namespace Xefi\Faker\PtPt\Tests\Unit;

use Xefi\Faker\Calculators\Iban;

final class FinancialExtensionTest extends TestCase
{
    public function testNib(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $nib = $this->faker->nib();

            $this->assertMatchesRegularExpression('/^\d{21}$/', $nib);
            $this->assertTrue($this->isValidNib($nib), "NIB '{$nib}' has invalid check digits.");
        }
    }

    public function testKnownNibIsValid(): void
    {
        $this->assertTrue($this->isValidNib('000201231234567890154'));
        $this->assertFalse($this->isValidNib('000201231234567890155'));
    }

    public function testIban(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $iban = $this->faker->iban();

            $this->assertEquals(25, strlen($iban));
            $this->assertStringStartsWith('PT50', $iban);
            $this->assertTrue(Iban::isValid($iban));
            $this->assertTrue($this->isValidNib(substr($iban, 4)));
        }
    }

    private function isValidNib(string $nib): bool
    {
        return strlen($nib) === 21 && Iban::mod97($nib) === 1;
    }
}

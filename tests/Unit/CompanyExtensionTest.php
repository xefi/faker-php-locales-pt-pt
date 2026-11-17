<?php

namespace Xefi\Faker\PtPt\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\PtPt\Extensions\CompanyExtension;

final class CompanyExtensionTest extends TestCase
{
    protected array $companies = [];

    protected function setUp(): void
    {
        parent::setUp();

        $companyExtension = new CompanyExtension(new Randomizer());
        $this->companies = (new ReflectionClass($companyExtension))->getProperty('companies')->getValue($companyExtension);
    }

    public function testCompany(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->companies); $i++) {
            $results[] = $this->faker->unique()->company();
        }

        $this->assertEqualsCanonicalizing($this->companies, $results);
    }

    public function testNif(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $nif = $this->faker->nif();

            $this->assertMatchesRegularExpression('/^[569]\d{8}$/', $nif);
            $this->assertTrue($this->isValidNif($nif), "NIF '{$nif}' has an invalid check digit.");
        }
    }

    public function testKnownNifIsValid(): void
    {
        $this->assertTrue($this->isValidNif('500100144'));
        $this->assertFalse($this->isValidNif('500100145'));
    }

    public function testVat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $vat = $this->faker->vat();

            $this->assertMatchesRegularExpression('/^PT[569]\d{8}$/', $vat);
            $this->assertTrue($this->isValidNif(substr($vat, 2)));
        }
    }

    private function isValidNif(string $nif): bool
    {
        $sum = 0;
        for ($i = 0; $i < 8; $i++) {
            $sum += (int) $nif[$i] * (9 - $i);
        }

        $remainder = $sum % 11;

        return ($remainder < 2 ? 0 : 11 - $remainder) === (int) $nif[8];
    }
}

<?php

namespace Xefi\Faker\PtPt\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\PtPt\Extensions\ColorsExtension;

final class ColorsExtensionTest extends TestCase
{
    protected array $safeColorNames = [];
    protected array $colorNames = [];

    protected function setUp(): void
    {
        parent::setUp();

        $colorsExtension = new ColorsExtension(new Randomizer());
        $reflection = new ReflectionClass($colorsExtension);

        $this->safeColorNames = $reflection->getProperty('safeColorNames')->getValue($colorsExtension);
        $this->colorNames = $reflection->getProperty('colorNames')->getValue($colorsExtension);
    }

    public function testSafeColorNames(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->safeColorNames); $i++) {
            $results[] = $this->faker->unique()->safeColorName();
        }

        $this->assertEqualsCanonicalizing($this->safeColorNames, $results);
    }

    public function testColorNames(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->colorNames); $i++) {
            $results[] = $this->faker->unique()->colorName();
        }

        $this->assertEqualsCanonicalizing($this->colorNames, $results);
    }

    public function testSafeColorNamesAreColorNames(): void
    {
        foreach ($this->safeColorNames as $safeColorName) {
            $this->assertContains($safeColorName, $this->colorNames);
        }
    }
}

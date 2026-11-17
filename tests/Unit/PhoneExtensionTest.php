<?php

namespace Xefi\Faker\PtPt\Tests\Unit;

final class PhoneExtensionTest extends TestCase
{
    public function testPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^(2[1-689]|9[1236])\d{7}$/', $this->faker->phoneNumber());
        }
    }

    public function testCellPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^9[1236]\d{7}$/', $this->faker->cellPhoneNumber());
        }
    }

    public function testSpacedLandlinePhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^2[1-689]\d \d{3} \d{3}$/', $this->faker->spacedLandlinePhoneNumber());
        }
    }

    public function testIndicatoredPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\+351(2[1-689]|9[1236])\d{7}$/', $this->faker->indicatoredPhoneNumber());
        }
    }

    public function testSpacedIndicatoredCellPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\+3519[1236]\d \d{3} \d{3}$/', $this->faker->spacedIndicatoredCellPhoneNumber());
        }
    }
}

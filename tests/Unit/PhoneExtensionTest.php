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
            $this->assertMatchesRegularExpression('/^\+351 9[1236]\d \d{3} \d{3}$/', $this->faker->spacedIndicatoredCellPhoneNumber());
        }
    }

    public function testIndicatorIsSeparatedFromTheNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertStringStartsWith('+351 ', $this->faker->spacedIndicatoredPhoneNumber());
            $this->assertStringStartsWith('+351-', $this->faker->dashedIndicatoredPhoneNumber());
            $this->assertStringStartsWith('+351.', $this->faker->dottedIndicatoredPhoneNumber());
            $this->assertMatchesRegularExpression('/^\+351\d+$/', $this->faker->indicatoredPhoneNumber());
        }
    }
}

<?php

namespace Xefi\Faker\PtPt\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\PtPt\Extensions\AddressExtension;

final class AddressExtensionTest extends TestCase
{
    protected array $regions = [];
    protected array $districts = [];
    protected array $cities = [];
    protected array $streetTypes = [];
    protected array $streetNames = [];

    protected function setUp(): void
    {
        parent::setUp();

        $extension = new AddressExtension(new Randomizer());
        $reflection = new ReflectionClass($extension);

        $this->regions = $reflection->getProperty('regions')->getValue($extension);
        $this->districts = $reflection->getProperty('districts')->getValue($extension);
        $this->cities = $reflection->getProperty('cities')->getValue($extension);
        $this->streetTypes = $reflection->getProperty('streetTypes')->getValue($extension);
        $this->streetNames = $reflection->getProperty('streetNames')->getValue($extension);
    }

    public function testRegion(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->regions); $i++) {
            $results[] = $this->faker->unique()->region();
        }

        $this->assertEqualsCanonicalizing($this->regions, $results);
    }

    public function testDistrict(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->districts); $i++) {
            $results[] = $this->faker->unique()->district();
        }

        $this->assertCount(18, $this->districts);
        $this->assertEqualsCanonicalizing($this->districts, $results);
    }

    public function testCity(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->cities); $i++) {
            $results[] = $this->faker->unique()->city();
        }

        $this->assertEqualsCanonicalizing($this->cities, $results);
    }

    public function testPostcode(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^[1-9]\d{3}-\d{3}$/', $this->faker->postcode());
        }
    }

    public function testHouseNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->houseNumber();

            $this->assertIsInt($result);
            $this->assertGreaterThanOrEqual(1, $result);
            $this->assertLessThanOrEqual(500, $result);
        }
    }

    public function testStreetName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$type, $name] = explode(' ', $this->faker->streetName(), 2);

            $this->assertContains($type, $this->streetTypes);
            $this->assertContains($name, $this->streetNames);
        }
    }

    public function testStreetAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^[\p{L}\d ]+, \d{1,3}$/u', $this->faker->streetAddress());
        }
    }

    public function testFullAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->fullAddress();

            $this->assertMatchesRegularExpression('/^[\p{L}\d ]+, \d{1,3}, [1-9]\d{3}-\d{3} [\p{L} -]+$/u', $result);
            $this->assertContains(preg_replace('/^.* \d{4}-\d{3} /u', '', $result), $this->cities);
        }
    }
}

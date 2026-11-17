<?php

namespace Xefi\Faker\PtPt\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Extensions\PersonExtension;

final class PersonExtensionTest extends TestCase
{
    protected array $firstNameMale = [];
    protected array $firstNameFemale = [];
    protected array $lastName = [];
    protected array $titleMale = [];
    protected array $titleFemale = [];

    protected function setUp(): void
    {
        parent::setUp();

        $personExtension = new \Xefi\Faker\PtPt\Extensions\PersonExtension(new Randomizer());
        $reflection = new ReflectionClass($personExtension);

        $this->firstNameMale = $reflection->getProperty('firstNameMale')->getValue($personExtension);
        $this->firstNameFemale = $reflection->getProperty('firstNameFemale')->getValue($personExtension);
        $this->lastName = $reflection->getProperty('lastName')->getValue($personExtension);
        $this->titleMale = $reflection->getProperty('titleMale')->getValue($personExtension);
        $this->titleFemale = $reflection->getProperty('titleFemale')->getValue($personExtension);
    }

    public function testFirstNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameFemale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing($this->firstNameFemale, $results);
    }

    public function testFirstNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameMale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing($this->firstNameMale, $results);
    }

    public function testFirstName(): void
    {
        $results = [];
        $firstNames = array_unique(array_merge($this->firstNameMale, $this->firstNameFemale));
        for ($i = 0; $i < count($firstNames); $i++) {
            $results[] = $this->faker->unique()->firstName();
        }

        $this->assertEqualsCanonicalizing($firstNames, $results);
    }

    public function testLastName(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->lastName); $i++) {
            $results[] = $this->faker->unique()->lastName();
        }

        $this->assertEqualsCanonicalizing($this->lastName, $results);
    }

    public function testName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name());

            $this->assertContains($firstName, array_merge($this->firstNameMale, $this->firstNameFemale));
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testNameMale(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name(PersonExtension::GENDER_MALE));

            $this->assertContains($firstName, $this->firstNameMale);
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testNameFemale(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name(PersonExtension::GENDER_FEMALE));

            $this->assertContains($firstName, $this->firstNameFemale);
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testTitleFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleFemale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing($this->titleFemale, $results);
    }

    public function testTitleMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleMale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing($this->titleMale, $results);
    }

    public function testTitle(): void
    {
        $titles = array_unique(array_merge($this->titleFemale, $this->titleMale));

        $results = [];
        for ($i = 0; $i < count($titles); $i++) {
            $results[] = $this->faker->unique()->title();
        }

        $this->assertEqualsCanonicalizing($titles, $results);
    }

    public function testPersonalNif(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $nif = $this->faker->personalNif();

            $this->assertMatchesRegularExpression('/^[123]\d{8}$/', $nif);
            $this->assertTrue($this->isValidNif($nif), "NIF '{$nif}' has an invalid check digit.");
        }
    }

    public function testKnownNifIsValid(): void
    {
        $this->assertTrue($this->isValidNif('123456789'));
        $this->assertFalse($this->isValidNif('123456788'));
    }

    public function testCartaoCidadao(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $document = $this->faker->cartaoCidadao();

            $this->assertMatchesRegularExpression('/^\d{8} \d Z[A-Z]\d$/', $document);
            $this->assertTrue($this->isValidCartaoCidadao(str_replace(' ', '', $document)), "Document '{$document}' has an invalid check digit.");
        }
    }

    public function testCartaoCidadaoUnformatted(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $document = $this->faker->cartaoCidadao(false);

            $this->assertMatchesRegularExpression('/^\d{9}Z[A-Z]\d$/', $document);
            $this->assertTrue($this->isValidCartaoCidadao($document), "Document '{$document}' has an invalid check digit.");
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

    private function isValidCartaoCidadao(string $document): bool
    {
        $sum = 0;
        $secondDigit = false;

        for ($i = strlen($document) - 1; $i >= 0; $i--) {
            $value = ctype_digit($document[$i]) ? (int) $document[$i] : ord($document[$i]) - 55;

            if ($secondDigit) {
                $value *= 2;
                if ($value > 9) {
                    $value -= 9;
                }
            }

            $sum += $value;
            $secondDigit = !$secondDigit;
        }

        return $sum % 10 === 0;
    }
}

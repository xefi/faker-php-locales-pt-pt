<?php

namespace Xefi\Faker\PtPt\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\PtPt\Extensions\TextExtension;

final class TextExtensionTest extends TestCase
{
    protected array $paragraphs = [];

    protected function setUp(): void
    {
        parent::setUp();

        $textExtension = new TextExtension(new Randomizer());
        $this->paragraphs = (new ReflectionClass($textExtension))->getProperty('paragraphs')->getValue($textExtension);
    }

    public function testWords(): void
    {
        $sentences = array_merge(...$this->paragraphs);
        $words = array_merge(...$sentences);
        $result = preg_split('/\s+/', $this->faker->words(count($words)));

        $words = array_map(function ($word) {
            return mb_strtolower(preg_replace('/[.,]/', '', $word));
        }, $words);

        $this->assertEqualsCanonicalizing($words, $result);
    }

    public function testSentences(): void
    {
        $sentences = array_map(function ($sentence) {
            return implode(' ', $sentence);
        }, array_merge(...$this->paragraphs));

        for ($i = 0; $i < 20; $i++) {
            $this->assertContains($this->faker->sentences(1), $sentences);
        }
    }

    public function testParagraphs(): void
    {
        $paragraphs = array_map(function ($sentences) {
            return implode(' ', array_merge(...$sentences));
        }, $this->paragraphs);

        for ($i = 0; $i < 20; $i++) {
            $this->assertContains($this->faker->paragraphs(1), $paragraphs);
        }
    }

    public function testNoWordStartsWithANonAsciiCapital(): void
    {
        foreach (array_merge(...array_merge(...$this->paragraphs)) as $word) {
            $this->assertSame(strtolower($word), mb_strtolower($word), "'{$word}' would not be lowercased by strtolower().");
        }
    }
}

<?php

/**
 * Copyright (c) 2018-2026 Andrew G. Johnson <andrew@andrewgjohnson.com>
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the
 * Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
 * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace AndrewGJohnson\AgjGd\Tests;

use PHPUnit\Framework\TestCase;

class Linebreaks4imagettftextTest extends TestCase
{
    private const FONT_PATH  = __DIR__ . '/../../NotoSans-Regular.ttf';
    private const FONT_SIZE  = 10;
    private const FONT_ANGLE = 0;

    public function testFunctionExists(): void
    {
        $this->assertTrue(function_exists('AndrewGJohnson\\AgjGd\\linebreaks4imagettftext'));
    }

    public function testReverseCompatibility(): void
    {
        $this->assertTrue(function_exists('andrewgjohnson\\linebreaks4imagettftext'));

        $current = new \ReflectionFunction('AndrewGJohnson\\AgjGd\\linebreaks4imagettftext');
        $old     = new \ReflectionFunction('andrewgjohnson\\linebreaks4imagettftext');

        $this->assertSame(
            $current->getReturnType(),
            $old->getReturnType(),
            'Return types do not match (reverse compatibility)'
        );

        $this->assertSame(
            $this->getParameterSignature($current),
            $this->getParameterSignature($old),
            'Parameters do not match (reverse compatibility)'
        );
    }

    public function testReturnsString(): void
    {
        $result = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
            self::FONT_SIZE,
            self::FONT_ANGLE,
            self::FONT_PATH,
            'Hello world!',
            10000
        );
        $this->assertIsString($result);
    }

    public function testEmptyStringReturnsEmptyString(): void
    {
        $result = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
            self::FONT_SIZE,
            self::FONT_ANGLE,
            self::FONT_PATH,
            '',
            10000
        );
        $this->assertSame('', $result);
    }

    // A single word should always be returned unchanged regardless of maximumWidth.
    public function testSingleWordReturnedUnchanged(): void
    {
        $word   = 'Hello';
        $result = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
            self::FONT_SIZE,
            self::FONT_ANGLE,
            self::FONT_PATH,
            $word,
            1
        );
        $this->assertSame($word, $result);
    }

    public function testTextFittingMaximumWidthHasNoLineBreaks(): void
    {
        $result = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
            self::FONT_SIZE,
            self::FONT_ANGLE,
            self::FONT_PATH,
            'Hello world!',
            10000
        );
        $this->assertStringNotContainsString("\n", $result);
        $this->assertStringNotContainsString("\r", $result);
    }

    public function testTextExceedingMaximumWidthGetsLineBreak(): void
    {
        $result = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
            self::FONT_SIZE,
            self::FONT_ANGLE,
            self::FONT_PATH,
            'Hello world!',
            1,
            "\n"
        );
        $this->assertStringContainsString("\n", $result);
    }

    public function testCustomLineBreakCharacter(): void
    {
        $customBreak = '<br>';
        $result      = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
            self::FONT_SIZE,
            self::FONT_ANGLE,
            self::FONT_PATH,
            'Hello world!',
            1,
            $customBreak
        );
        $this->assertStringContainsString($customBreak, $result);
        $this->assertStringNotContainsString(PHP_EOL, $result);
    }

    public function testAllWordsArePresentInOutput(): void
    {
        $words  = ['Hello', 'world', 'foo', 'bar'];
        $text   = implode(' ', $words);
        $result = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
            self::FONT_SIZE,
            self::FONT_ANGLE,
            self::FONT_PATH,
            $text,
            1,
            "\n"
        );
        foreach ($words as $word) {
            $this->assertStringContainsString($word, $result);
        }
    }

    // With forceBreakOnSingleWords disabled a long word that does not fit should still appear intact on a line; with
    // the flag enabled the word should be split across lines.
    public function testForceBreakOnSingleWordsSplitsLongWord(): void
    {
        $longWord  = 'Pneumonoultramicroscopicsilicovolcanoconiosis';
        $halfWidth = (int)($this->getTextWidth($longWord) / 2);
        $text      = 'A ' . $longWord;

        $withoutForce = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
            self::FONT_SIZE,
            self::FONT_ANGLE,
            self::FONT_PATH,
            $text,
            $halfWidth,
            "\n",
            false,
            false
        );

        $withForce = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
            self::FONT_SIZE,
            self::FONT_ANGLE,
            self::FONT_PATH,
            $text,
            $halfWidth,
            "\n",
            false,
            true
        );

        $foundIntact = false;
        foreach (explode("\n", $withoutForce) as $line) {
            if (strpos($line, $longWord) !== false) {
                $foundIntact = true;
                break;
            }
        }

        $this->assertTrue(
            $foundIntact,
            'Without forceBreakOnSingleWords the long word should appear intact on a single line'
        );

        $this->assertGreaterThan(
            count(explode("\n", $withoutForce)),
            count(explode("\n", $withForce)),
            'With forceBreakOnSingleWords there should be more lines because the word is split'
        );
    }

    // With attemptToBreakOnHyphens enabled, a hyphenated word that would overflow should be split at a hyphen so that
    // the line ends with a trailing hyphen character.
    public function testAttemptToBreakOnHyphensBreaksAtHyphen(): void
    {
        // maximumWidth is exactly the pixel width of 'A B-', so 'A B-C' overflows and the hyphen-break logic commits
        // 'A B-' and carries 'C' to the next line.
        $text         = 'A B-C';
        $maximumWidth = $this->getTextWidth('A B-');

        $withHyphens = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
            self::FONT_SIZE,
            self::FONT_ANGLE,
            self::FONT_PATH,
            $text,
            $maximumWidth,
            "\n",
            true
        );

        $withoutHyphens = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
            self::FONT_SIZE,
            self::FONT_ANGLE,
            self::FONT_PATH,
            $text,
            $maximumWidth,
            "\n",
            false
        );

        $this->assertNotSame(
            $withoutHyphens,
            $withHyphens,
            'attemptToBreakOnHyphens should produce a different result when a break at a hyphen is possible'
        );

        $hasLineEndingWithHyphen = false;
        foreach (explode("\n", $withHyphens) as $line) {
            if (substr($line, -1) === '-') {
                $hasLineEndingWithHyphen = true;
                break;
            }
        }

        $this->assertTrue(
            $hasLineEndingWithHyphen,
            'With attemptToBreakOnHyphens at least one line should end with a trailing hyphen'
        );
    }

    // When the last word would appear alone on the final line (a widow), preventWidows should pull the previous word
    // down so the two words share the last line.
    public function testPreventWidowsMovesPreviousWordToLastLine(): void
    {
        $word1        = 'Hello';
        $word2        = 'world';
        $word3        = 'x';
        $text         = $word1 . ' ' . $word2 . ' ' . $word3;
        // Width fits 'Hello world!' exactly, so 'Hello world x' overflows and 'x' becomes a widow.
        $maximumWidth = $this->getTextWidth($word1 . ' ' . $word2);

        $withoutPrevent = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
            self::FONT_SIZE,
            self::FONT_ANGLE,
            self::FONT_PATH,
            $text,
            $maximumWidth,
            "\n",
            false,
            false,
            false
        );

        $withPrevent = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
            self::FONT_SIZE,
            self::FONT_ANGLE,
            self::FONT_PATH,
            $text,
            $maximumWidth,
            "\n",
            false,
            false,
            true
        );

        $linesWithout = explode("\n", $withoutPrevent);
        $this->assertSame(
            $word3,
            end($linesWithout),
            'Without preventWidows the last word should appear alone on the final line'
        );

        $linesWith = explode("\n", $withPrevent);
        $lastLine  = end($linesWith);
        $this->assertStringContainsString(
            $word2,
            $lastLine,
            'With preventWidows the second-to-last word should be moved to the final line'
        );
        $this->assertStringContainsString(
            $word3,
            $lastLine,
            'With preventWidows the last word should still appear on the final line'
        );
    }

    private function getParameterSignature(\ReflectionFunction $function): array
    {
        $parameters = [];

        foreach ($function->getParameters() as $parameter) {
            $isDefaultValueAvailable = $parameter->isDefaultValueAvailable();

            $parameters[] = [
                'defaultValue'            => $isDefaultValueAvailable ? $parameter->getDefaultValue() : null,
                'isDefaultValueAvailable' => $parameter->isDefaultValueAvailable(),
                'isOptional'              => $parameter->isOptional(),
                'isPassedByReference'     => $parameter->isPassedByReference(),
                'isVariadic'              => $parameter->isVariadic(),
                'name'                    => $parameter->getName(),
                'position'                => $parameter->getPosition()
            ];
        }

        return $parameters;
    }

    private function getTextWidth(string $text): int
    {
        $bbox  = imagettfbbox(self::FONT_SIZE, self::FONT_ANGLE, self::FONT_PATH, $text);
        $left  = min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $right = max($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        return $right - $left;
    }
}

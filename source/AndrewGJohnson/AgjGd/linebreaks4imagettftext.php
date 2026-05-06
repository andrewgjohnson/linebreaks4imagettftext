<?php

/**
 * Linebreaks4imagettftext v1.1.0
 *
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
 *
 * PHP version 5
 *
 * @category  Andrewgjohnson
 * @package   Linebreaks4imagettftext
 * @author    Andrew G. Johnson <andrew@andrewgjohnson.com>
 * @copyright 2018-2026 Andrew G. Johnson <andrew@andrewgjohnson.com>
 * @license   https://opensource.org/licenses/mit/ The MIT License
 * @link      https://github.com/andrewgjohnson/linebreaks4imagettftext
 */

namespace AndrewGJohnson\AgjGd;

if (!function_exists('AndrewGJohnson\\AgjGd\\linebreaks4imagettftext')) {
    /**
     * Linebreaks4imagettftext is a function to automatically insert line breaks into your text while using PHP’s
     * imagettftext() function.
     *
     * Examples:
     * ```
     * <?php
     * // You can use linebreaks4imagettftext() to add line breaks ("\n") to long strings to help format text when using
     * // imagettftext()
     * $string = 'This is a long sentence that could not fit on a single line.';
     * $stringWithLineBreaks = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(20, 0, $font, $string, imagesx($im) * 0.8);
     *
     * // This will work but there will are no line breaks so your text will likely overflow horizontally
     * imagettftext($im, 20, 0, imagesx($im) * 0.1, 0, $color, $font, $string);
     *
     * // This will work and you will not have to worry about text overflowing regardless of string length
     * imagettftext($im, 20, 0, imagesx($im) * 0.1, 0, $color, $font, $stringWithLineBreaks);
     * ?>
     * ```
     *
     * @param float  $size                    The font size in points.
     * @param float  $angle                   The angle in degrees, with 0 degrees being left-to-right reading text.
     * Higher values represent a counter-clockwise rotation. For example, a value of 90 would result in bottom-to-top
     * reading text.
     * @param string $fontFilename            The path to the TrueType font you wish to use.
     *
     * Depending on which version of the GD library PHP is using, when fontfile does not begin with a leading / then
     * .ttf will be appended to the filename and the library will attempt to search for that filename along a
     * library-defined font path.
     *
     * When using versions of the GD library lower than 2.0.18, a space character, rather than a semicolon, was used as
     * the 'path separator' for different font files. Unintentional use of this feature will result in the warning
     * message: Warning: Could not find/open font. For these affected versions, the only solution is moving the font to
     * a path which does not contain spaces.
     *
     * In many cases where a font resides in the same directory as the script using it the following trick will
     * alleviate any include problems.
     *
     * ```
     * <?php
     * // Set the environment variable for GD
     * putenv('GDFONTPATH=' . realpath('.'));
     *
     * // Name the font to be used (note the lack of the .ttf extension)
     * $font = 'SomeFont';
     * ?>
     * ```
     * @param string $text                    The text string in UTF-8 encoding.
     *
     * May include decimal numeric character references (of the form: &#8364;) to access characters in a font beyond
     * position 127. The hexadecimal format (like &#xA9;) is supported. Strings in UTF-8 encoding can be passed
     * directly.
     *
     * Named entities, such as &copy;, are not supported. Consider using html_entity_decode() to decode these named
     * entities into UTF-8 strings.
     *
     * If a character is used in the string which is not supported by the font, a hollow rectangle will replace the
     * character.
     * @param int    $maximumWidth            The maximum width (in pixels) a line should be before adding a line break.
     * @param string $lineBreakCharacter      The character(s) to use when adding a line break.
     * @param bool   $attemptToBreakOnHyphens Whether or not to attempt to break words on the hyphen(s) appearing
     * within.
     * @param bool   $forceBreakOnSingleWords Whether or not to force breaks into single words that extend beyond a
     * single line.
     * @param bool   $preventWidows           Whether or not to try to prevent widows which are single words appearing
     * alone on a final line.
     *
     * @return string Returns a string that is nearly identical to $text with the only difference being newly added line
     * breaks.
     */
    function linebreaks4imagettftext(
        $size,
        $angle,
        $fontFilename,
        $text,
        $maximumWidth,
        $lineBreakCharacter = PHP_EOL,
        $attemptToBreakOnHyphens = false,
        $forceBreakOnSingleWords = false,
        $preventWidows = false
    ) {
        // Define the _linebreaks4imagettftext_ttfWidth function for later use
        if (!function_exists('AndrewGJohnson\\AgjGd\\_linebreaks4imagettftext_ttfWidth')) {
            /**
             * Calculte the width in pixels of a string rendered by imagettftext().
             *
             * @param float  $size         The font size in points.
             * @param float  $angle        The angle in degrees, with 0 degrees being left-to-right reading text. Higher
             * values represent a counter-clockwise rotation. For example, a value of 90 would result in bottom-to-top
             * reading text.
             * @param string $fontFilename The path to the TrueType font you wish to use.
             *
             * Depending on which version of the GD library PHP is using, when fontfile does not begin with a leading /
             * then .ttf will be appended to the filename and the library will attempt to search for that filename along
             * a library-defined font path.
             *
             * When using versions of the GD library lower than 2.0.18, a space character, rather than a semicolon, was
             * used as the 'path separator' for different font files. Unintentional use of this feature will result in
             * the warning message: Warning: Could not find/open font. For these affected versions, the only solution is
             * moving the font to a path which does not contain spaces.
             *
             * In many cases where a font resides in the same directory as the script using it the following trick will
             * alleviate any include problems.
             *
             * ```
             * <?php
             * // Set the environment variable for GD
             * putenv('GDFONTPATH=' . realpath('.'));
             *
             * // Name the font to be used (note the lack of the .ttf extension)
             * $font = 'SomeFont';
             * ?>
             * ```
             * @param string $text         The text string in UTF-8 encoding.
             *
             * May include decimal numeric character references (of the form: &#8364;) to access characters in a font
             * beyond position 127. The hexadecimal format (like &#xA9;) is supported. Strings in UTF-8 encoding can be
             * passed directly.
             *
             * Named entities, such as &copy;, are not supported. Consider using html_entity_decode() to decode these
             * named entities into UTF-8 strings.
             *
             * If a character is used in the string which is not supported by the font, a hollow rectangle will replace
             * the character.
             *
             * @return false|int Returns the width in pixels of a string rendered by imagettftext(). Returns FALSE on
             * error.
             */
            function _linebreaks4imagettftext_ttfWidth(
                $size,
                $angle,
                $fontFilename,
                $text
            ) {
                $imagettfbbox = imagettfbbox(
                    $size,
                    $angle,
                    $fontFilename,
                    $text
                );
                if ($imagettfbbox === false) {
                    return false;
                } else {
                    $left  = min($imagettfbbox[0], $imagettfbbox[2], $imagettfbbox[4], $imagettfbbox[6]);
                    $right = max($imagettfbbox[0], $imagettfbbox[2], $imagettfbbox[4], $imagettfbbox[6]);
                    return $right - $left;
                }
            }
        }

        // Create an array with all the string’s words.
        $words = explode(' ', $text);

        // Process all words to generate $textWithLineBreaks.
        $textWithLineBreaks = '';

        $currentLine = '';
        foreach ($words as $position => $word) {
            // Place the first word into $currentLine without further processing. If it is too wide, later logic can
            // only force-break it when another word causes the loop to enter the normal processing branch.
            if ($position === 0) {
                $currentLine = $word;
            } else {
                $addedWord = false;

                // Check whether adding the new word to the current line still fits within the maximum width.
                $textWidth = _linebreaks4imagettftext_ttfWidth(
                    $size,
                    $angle,
                    $fontFilename,
                    $currentLine . ' ' . $word
                );
                if ($textWidth <= $maximumWidth) {
                    $currentLine .= ' ';
                    $currentLine .= $word;

                    $addedWord = true;
                }

                // If the final word would appear alone on the last line, try moving the previous word down with it.
                if (!$addedWord && $preventWidows && $position === count($words) - 1) {
                    $lastSpacePosition = strrpos($currentLine, ' ');

                    if ($lastSpacePosition !== false) {
                        $previousLine = substr($currentLine, 0, $lastSpacePosition);
                        $lastWord     = substr($currentLine, $lastSpacePosition + 1);
                        $testLine     = $lastWord . ' ' . $word;
                        $textWidth    = _linebreaks4imagettftext_ttfWidth(
                            $size,
                            $angle,
                            $fontFilename,
                            $testLine
                        );

                        if ($textWidth <= $maximumWidth) {
                            $textWithLineBreaks .= $previousLine;
                            $textWithLineBreaks .= $lineBreakCharacter;

                            $currentLine = $testLine;

                            $addedWord = true;
                        }
                    }
                }

                if (!$addedWord && $attemptToBreakOnHyphens) {
                    // Attempt to split the word on hyphens and fit as much of it as possible on the current line.
                    if (strpos($word, '-') !== false) {
                        $hyphenParts = explode('-', $word);
                        $rebuiltWord = '';

                        foreach ($hyphenParts as $index => $part) {
                            // Rebuild the word progressively, re-adding hyphens between parts.
                            $candidate = ($rebuiltWord === '' ? $part : $rebuiltWord . '-' . $part);

                            $testLine  = $currentLine . ' ' . $candidate;
                            $textWidth = _linebreaks4imagettftext_ttfWidth(
                                $size,
                                $angle,
                                $fontFilename,
                                $testLine
                            );

                            if ($textWidth <= $maximumWidth) {
                                $rebuiltWord = $candidate;
                                continue;
                            }

                            // If we have something that fits, commit it.
                            if ($rebuiltWord !== '') {
                                $currentLine .= ' ' . $rebuiltWord . '-';

                                $textWithLineBreaks .= $currentLine;
                                $textWithLineBreaks .= $lineBreakCharacter;

                                // Remaining parts become the next word.
                                $remainingParts = array_slice($hyphenParts, $index);
                                $word           = implode('-', $remainingParts);

                                $currentLine = $word;

                                $addedWord = true;
                            }

                            break;
                        }
                    }
                }

                if (!$addedWord && $forceBreakOnSingleWords) {
                    // Only force-break a word when it is starting a new line. If the word failed to fit because the
                    // current line already contains text, commit the current line first, then process the word from an
                    // empty line.
                    if ($currentLine !== '') {
                        $textWithLineBreaks .= $currentLine;
                        $textWithLineBreaks .= $lineBreakCharacter;

                        $currentLine = '';
                    }

                    $remainingCharacters = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);

                    if ($remainingCharacters !== false) {
                        while (count($remainingCharacters) > 0) {
                            $candidateCharacters = array();
                            $candidateWord       = '';

                            foreach ($remainingCharacters as $index => $character) {
                                $testCandidateCharacters   = $candidateCharacters;
                                $testCandidateCharacters[] = $character;

                                $testCandidateWord      = implode('', $testCandidateCharacters);
                                $hasRemainingCharacters = ($index < count($remainingCharacters) - 1);
                                $testWord               = $testCandidateWord . ($hasRemainingCharacters ? '-' : '');

                                $testLine  = ($currentLine === '' ? $testWord : $currentLine . ' ' . $testWord);
                                $textWidth = _linebreaks4imagettftext_ttfWidth(
                                    $size,
                                    $angle,
                                    $fontFilename,
                                    $testLine
                                );

                                if ($textWidth <= $maximumWidth) {
                                    $candidateCharacters = $testCandidateCharacters;
                                    $candidateWord       = $testCandidateWord;
                                    continue;
                                }

                                break;
                            }

                            if ($candidateWord === '') {
                                // If even one character plus a hyphen cannot fit, commit the current line and retry.
                                if ($currentLine !== '') {
                                    $textWithLineBreaks .= $currentLine;
                                    $textWithLineBreaks .= $lineBreakCharacter;

                                    $currentLine = '';
                                    continue;
                                }

                                // If a single character still cannot fit on an empty line, use the whole remaining
                                // word to avoid an infinite loop.
                                $currentLine = implode('', $remainingCharacters);

                                $addedWord = true;
                                break;
                            }

                            $remainingCharacters = array_slice(
                                $remainingCharacters,
                                count($candidateCharacters)
                            );

                            if (count($remainingCharacters) > 0) {
                                // More characters remain, so append a hyphen and commit this forced-break segment.
                                $currentLine = $currentLine === ''
                                    ? $candidateWord . '-'
                                    : $currentLine . ' ' . $candidateWord . '-';

                                $textWithLineBreaks .= $currentLine;
                                $textWithLineBreaks .= $lineBreakCharacter;

                                $currentLine = '';
                                continue;
                            }

                            $currentLine = $currentLine === '' ? $candidateWord : $currentLine . ' ' . $candidateWord;

                            $addedWord = true;
                        }
                    }
                }

                // If the word still has not been added, start a new line with this word.
                if (!$addedWord) {
                    // The text is too wide with the added word, so add a line break and start a new line with only
                    // that word.
                    $textWithLineBreaks .= $currentLine;
                    $textWithLineBreaks .= $lineBreakCharacter;

                    $currentLine = $word;
                }
            }
        }

        // Append the final line to the processed text.
        $textWithLineBreaks .= $currentLine;

        // Return $text with line breaks added.
        return $textWithLineBreaks;
    }
}

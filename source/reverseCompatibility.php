<?php

/**
 * Linebreaks4imagettftext v1.1.1
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

namespace andrewgjohnson;

if (!function_exists('andrewgjohnson\\linebreaks4imagettftext')) {
    /**
     * This function exists to support reverse compabitility. Please use \AndrewGJohnson\AgjGd\linebreaks4imagettftext()
     * rather than \andrewgjohnson\linebreaks4imagettftext().
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
        return \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
            $size,
            $angle,
            $fontFilename,
            $text,
            $maximumWidth,
            $lineBreakCharacter,
            $attemptToBreakOnHyphens,
            $forceBreakOnSingleWords,
            $preventWidows
        );
    }
}

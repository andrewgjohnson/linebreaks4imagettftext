<?php

/**
 * Linebreaks4imagettftext v2.0.0
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
 * PHP version 8
 *
 * This file exists to support reverse compatibility with the oldest namespace this project used. As of v2.0.0 the
 * implementation lives in the \AndrewGJohnson\AgjGd class provided by the andrewgjohnson/agjgd package and the function
 * below is a thin wrapper that forwards to it.
 *
 * Please use \AndrewGJohnson\AgjGd::linebreaks4imagettftext() rather than
 * \andrewgjohnson\linebreaks4imagettftext().
 *
 * This file deliberately does not declare strict_types so that loosely-typed calls written against the standalone
 * function keep coercing their arguments the way they always did.
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
     * This function exists to support reverse compatibility.
     *
     * @deprecated 2.0.0 Use \AndrewGJohnson\AgjGd::linebreaks4imagettftext() instead.
     *
     * @param float   $size                    The font size in points.
     * @param float   $angle                   The angle in degrees.
     * @param string  $fontFilename            The path to the TrueType font you wish to use.
     * @param string  $text                    The text string in UTF-8 encoding.
     * @param int     $maximumWidth            The maximum width (in pixels) a line should be before adding a line
     * break.
     * @param ?string $lineBreakCharacter      The character(s) to use when adding a line break.
     * @param ?bool   $attemptToBreakOnHyphens Whether or not to attempt to break words on the hyphen(s) appearing
     * within.
     * @param ?bool   $forceBreakOnSingleWords Whether or not to force breaks into single words that extend beyond a
     * single line.
     * @param ?bool   $preventWidows           Whether or not to try to prevent widows.
     *
     * @return string Returns $text with line breaks added.
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
        return \AndrewGJohnson\AgjGd::linebreaks4imagettftext(
            $size,
            $angle,
            $fontFilename,
            $text,
            $maximumWidth,
            // A null line break character arrived at the standalone function untyped and concatenated as an empty
            // string rather than the PHP_EOL default, so an empty string is passed along.
            $lineBreakCharacter ?? '',
            $attemptToBreakOnHyphens ?? false,
            $forceBreakOnSingleWords ?? false,
            $preventWidows ?? false
        );
    }
}

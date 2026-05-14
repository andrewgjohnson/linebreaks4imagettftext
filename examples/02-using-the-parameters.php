<?php

/**
 * Linebreaks4imagettftext Example (Using the Parameters)
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

// Include the linebreaks4imagettftext source if you’re not using Composer
if (file_exists('../source/AndrewGJohnson/AgjGd/linebreaks4imagettftext.php')) {
    require_once '../source/AndrewGJohnson/AgjGd/linebreaks4imagettftext.php';
} elseif (!function_exists('AndrewGJohnson\\AgjGd\\linebreaks4imagettftext')) {
    die('linebreaks4imagettftext not found');
}

// Set the parameters for our image
$width          = 325;
$height         = 700;
$imagePadding   = 20;
$fontSize       = 10;
$fontAngle      = 0;
$fontPath       = dirname(__FILE__) . '/NotoSans-Regular.ttf';
$hyphenatedWord = 'Jack-of-all-trades';
$longWord       = 'The longest English language word is “Pneumonoultramicroscopicsilicovolcanoconiosis.”';
$commonPhrase   = 'Hello world!';

// Create our image
$im = imagecreatetruecolor($width, $height);

// Fill our image with the background color
imagefill($im, 0, 0, imagecolorallocate($im, 0xEE, 0xEE, 0xEE));

// Place the examples onto our image
$yCoordinate = $imagePadding * 2;

foreach (
    array(
        array(
            'color'                   => imagecolorallocate($im, 0x00, 0x00, 0x00), // Black
            'string'                  => '$attemptToBreakOnHyphens parameter',
            'attemptToBreakOnHyphens' => false,
            'forceBreakOnSingleWords' => false,
            'preventWidows'           => false
        ),
        array(
            'color'                   => imagecolorallocate($im, 0x00, 0x00, 0xFF), // Blue
            'string'                  => '(false, false, false)' . str_repeat(' ' . $hyphenatedWord, 7),
            'attemptToBreakOnHyphens' => false,
            'forceBreakOnSingleWords' => false,
            'preventWidows'           => false
        ),
        array(
            'color'                   => imagecolorallocate($im, 0x00, 0x99, 0x00), // Green
            'string'                  => '(true, false, false)' . str_repeat(' ' . $hyphenatedWord, 7),
            'attemptToBreakOnHyphens' => true,
            'forceBreakOnSingleWords' => false,
            'preventWidows'           => false
        ),
        array(
            'color'                   => imagecolorallocate($im, 0x00, 0x00, 0x00), // Black
            'string'                  => '$forceBreakOnSingleWords parameter',
            'attemptToBreakOnHyphens' => false,
            'forceBreakOnSingleWords' => false,
            'preventWidows'           => false
        ),
        array(
            'color'                   => imagecolorallocate($im, 0x00, 0x99, 0x99), // Cyan
            'string'                  => '(false, false, false)' . str_repeat(' ' . $longWord, 2),
            'attemptToBreakOnHyphens' => false,
            'forceBreakOnSingleWords' => false,
            'preventWidows'           => false
        ),
        array(
            'color'                   => imagecolorallocate($im, 0xFF, 0x00, 0x00), // Red
            'string'                  => '(false, true, false)' . str_repeat(' ' . $longWord, 2),
            'attemptToBreakOnHyphens' => false,
            'forceBreakOnSingleWords' => true,
            'preventWidows'           => false
        ),
        array(
            'color'                   => imagecolorallocate($im, 0x00, 0x00, 0x00), // Black
            'string'                  => '$preventWidows parameter',
            'attemptToBreakOnHyphens' => false,
            'forceBreakOnSingleWords' => false,
            'preventWidows'           => false
        ),
        array(
            'color'                   => imagecolorallocate($im, 0xFF, 0x00, 0xFF), // Purple
            'string'                  => '(false, false, false)' . str_repeat(' ' . $commonPhrase, 6),
            'attemptToBreakOnHyphens' => false,
            'forceBreakOnSingleWords' => false,
            'preventWidows'           => false
        ),
        array(
            'color'                   => imagecolorallocate($im, 0x99, 0x99, 0x00), // Yellow
            'string'                  => '(false, false, true)' . str_repeat(' ' . $commonPhrase, 6),
            'attemptToBreakOnHyphens' => false,
            'forceBreakOnSingleWords' => false,
            'preventWidows'           => true
        )
    ) as $example
) {
    $transformedString = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
        $fontSize,
        $fontAngle,
        $fontPath,
        $example['string'],
        imagesx($im) - ($imagePadding * 2),
        PHP_EOL,
        $example['attemptToBreakOnHyphens'],
        $example['forceBreakOnSingleWords'],
        $example['preventWidows']
    );

    imagettftext(
        $im,
        $fontSize,
        $fontAngle,
        $imagePadding,
        $yCoordinate,
        $example['color'],
        $fontPath,
        $transformedString
    );

    $textDimensions = imagettfbbox($fontSize, $fontAngle, $fontPath, $transformedString);
    $textTop        = min($textDimensions[1], $textDimensions[3], $textDimensions[5], $textDimensions[7]);
    $textBottom     = max($textDimensions[1], $textDimensions[3], $textDimensions[5], $textDimensions[7]);
    $textHeight     = $textBottom - $textTop;

    $yCoordinate += $textHeight + $imagePadding;
}

// Display our image and destroy the GD resource
header('Content-Type: image/png');
imagepng($im);
version_compare(PHP_VERSION, '8.0.0', '<') && imagedestroy($im);

<?php

/**
 * Linebreaks4imagettftext Example (Before and After)
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

// Set the parameters for our images
$fontPath     = dirname(__FILE__) . '/arial.ttf';
$fontSize     = 10;
$fontAngle    = 0;
$text         = file_get_contents(dirname(__FILE__) . '/a-tale-of-two-cities.txt');
$textPadding  = 10;
$imageWidth   = 300;
$imageHeight  = 600;
$imagePadding = 25;

// Generate the before image
$beforeIm = imagecreatetruecolor($imageWidth, $imageHeight);

// Set the before image’s background color
$lightRed = imagecolorallocate($beforeIm, 0xFF, 0xDD, 0xDD);
imagefill($beforeIm, 0, 0, $lightRed);

// Add the before image’s text
$darkRed = imagecolorallocate($beforeIm, 0x66, 0x00, 0x00);
imagettftext(
    $beforeIm,
    $fontSize,
    $fontAngle,
    $textPadding,
    $textPadding + $fontSize,
    $darkRed,
    $fontPath,
    $text
);

// Generate the after image
$afterIm = imagecreatetruecolor($imageWidth, $imageHeight);

// Set the after image’s background color
$lightGreen = imagecolorallocate($afterIm, 0xDD, 0xFF, 0xDD);
imagefill($afterIm, 0, 0, $lightGreen);

// Add the after image’s text
$darkGreen = imagecolorallocate($afterIm, 0x00, 0x66, 0x00);
imagettftext(
    $afterIm,
    $fontSize,
    $fontAngle,
    $textPadding,
    $textPadding + $fontSize,
    $darkGreen,
    $fontPath,
    \AndrewGJohnson\AgjGd\linebreaks4imagettftext(
        $fontSize,
        $fontAngle,
        $fontPath,
        $text,
        imagesx($afterIm) - $textPadding - $textPadding
    )
);

// Generate a single larger image to house both the before and after images
$combinedIm = imagecreatetruecolor(
    $imagePadding + $imageWidth + $imagePadding + $imageWidth + $imagePadding,
    $imagePadding + $imageHeight + $imagePadding
);

// Set the combined image’s background color
$backgroundColor = imagecolorallocate($afterIm, 0xEE, 0xEE, 0xEE);
imagefill($combinedIm, 0, 0, $backgroundColor);

// Add the before image on the left
imagecopyresampled(
    $combinedIm,
    $beforeIm,
    $imagePadding,
    $imagePadding,
    0,
    0,
    imagesx($beforeIm),
    imagesy($beforeIm),
    imagesx($beforeIm),
    imagesy($beforeIm)
);

// Add the after image on the right
imagecopyresampled(
    $combinedIm,
    $afterIm,
    $imagePadding + $imageWidth + $imagePadding,
    $imagePadding,
    0,
    0,
    imagesx($afterIm),
    imagesy($afterIm),
    imagesx($afterIm),
    imagesy($afterIm)
);

// Display our combined image
header('Content-Type: image/png');
imagepng($combinedIm);

// Destroy the GD resources
version_compare(PHP_VERSION, '8.0.0', '<') && imagedestroy($beforeIm);
version_compare(PHP_VERSION, '8.0.0', '<') && imagedestroy($afterIm);
version_compare(PHP_VERSION, '8.0.0', '<') && imagedestroy($combinedIm);

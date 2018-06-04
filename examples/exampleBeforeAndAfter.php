<?php

/**
 * Linebreaks4imagettftext Example (Before and After)
 *
 * Copyright (c) 2018 Andrew G. Johnson <andrew@andrewgjohnson.com>
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in the
 * Software without restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the
 * Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN
 * AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * PHP version 5
 *
 * @category  Andrewgjohnson
 * @package   Linebreaks4imagettftext
 * @author    Andrew G. Johnson <andrew@andrewgjohnson.com>
 * @copyright 2018 Andrew G. Johnson <andrew@andrewgjohnson.com>
 * @license   https://opensource.org/licenses/mit/ The MIT License
 * @link      https://github.com/andrewgjohnson/linebreaks4imagettftext
 */

// include the linebreaks4imagettftext source if you're not using Composer
if (file_exists('../source/linebreaks4imagettftext.php')) {
    include_once '../source/linebreaks4imagettftext.php';
} else {
    die('linebreaks4imagettftext.php not found');
}

// set the parameters for our images

$fontPath     = rtrim(dirname(__FILE__), '/\\') . '/arial.ttf';
$fontSize     = 10;
$fontAngle    = 0;
$text         = file_get_contents(rtrim(dirname(__FILE__), '/\\') . '/aTaleOfTwoCities.txt');
$textPadding  = 10;
$imageSize    = 300;
$imagePadding = 25;

// generate the "before" image

$before = imagecreatetruecolor($imageSize, $imageSize);

$lightRed = imagecolorallocate($before, 0xFF, 0xDD, 0xDD);
imagefill($before, 0, 0, $lightRed);

$darkRed = imagecolorallocate($before, 0x66, 0x00, 0x00);
imagettftext(
    $before,
    $fontSize,
    $fontAngle,
    $textPadding,
    $textPadding + $fontSize,
    $darkRed,
    $fontPath,
    $text
);

// generate the "after" image

$after = imagecreatetruecolor($imageSize, $imageSize);

$lightGreen = imagecolorallocate($after, 0xDD, 0xFF, 0xDD);
imagefill($after, 0, 0, $lightGreen);

$darkGreen = imagecolorallocate($after, 0x00, 0x66, 0x00);
imagettftext(
    $after,
    $fontSize,
    $fontAngle,
    $textPadding,
    $textPadding + $fontSize,
    $darkGreen,
    $fontPath,
    \andrewgjohnson\linebreaks4imagettftext(
        $fontSize,
        $fontAngle,
        $fontPath,
        $text,
        imagesx($after) - $textPadding - $textPadding
    )
);

// combine them into a single image

$both = imagecreatetruecolor(
    $imagePadding + $imageSize + $imagePadding + $imageSize + $imagePadding,
    $imagePadding + $imageSize + $imagePadding
);

$darkBlue = imagecolorallocate($after, 0x00, 0x00, 0x66);
imagefill($both, 0, 0, $darkBlue);

imagecopyresampled(
    $both,
    $before,
    $imagePadding,
    $imagePadding,
    0,
    0,
    imagesx($before),
    imagesy($before),
    imagesx($before),
    imagesy($before)
);
imagecopyresampled(
    $both,
    $after,
    $imagePadding + $imageSize + $imagePadding,
    $imagePadding,
    0,
    0,
    imagesx($after),
    imagesy($after),
    imagesx($after),
    imagesy($after)
);

// display our image and destroy the GD resources

header('Content-Type: image/png');
imagepng($both);
imagedestroy($before);
imagedestroy($after);
imagedestroy($both);

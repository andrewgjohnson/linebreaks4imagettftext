# linebreaks4imagettftext

[![MIT License](https://img.shields.io/badge/license-MIT-0366d6.png?colorB=0366d6&style=flat-square)](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/LICENSE)
[![Current Release](https://img.shields.io/github/release/andrewgjohnson/linebreaks4imagettftext.png?colorB=0366d6&style=flat-square&logoColor=white&logo=github)](https://github.com/andrewgjohnson/linebreaks4imagettftext/releases)
[![Contributors](https://img.shields.io/github/contributors/andrewgjohnson/linebreaks4imagettftext.png?colorB=0366d6&style=flat-square&logoColor=white&logo=github)](https://github.com/andrewgjohnson/linebreaks4imagettftext/graphs/contributors)
[![Packagist Downloads](https://img.shields.io/packagist/dt/andrewgjohnson/linebreaks4imagettftext.png?colorB=0366d6&style=flat-square&logoColor=white&logo=packagist)](https://packagist.org/packages/andrewgjohnson/linebreaks4imagettftext/stats)
[![Issues](https://img.shields.io/github/issues/andrewgjohnson/linebreaks4imagettftext.png?colorB=0366d6&style=flat-square&logoColor=white&logo=github)](https://github.com/andrewgjohnson/linebreaks4imagettftext/issues)
[![Patreon](documentation/images/patreon-badge.png)](https://patreon.com/agjopensource)

<p align="center"><a href="https://linebreaks4imagettftext.agjgd.org/" title=""><img src="documentation/images/avatar.png" alt="" title="" width="400" id="avatar" /></a></p>

## Description

**linebreaks4imagettftext** is a function to automatically insert line breaks into your text while using PHP’s imagettftext() function.

[![Patreon - Become a Patron](https://raster.shields.io/badge/Patreon%20-become%20a%20Patron-FD334A.png?style=for-the-badge&logo=patreon&logoColor=FD334A)](https://patreon.com/agjopensource)

**linebreaks4imagettftext** is an [agjgd](https://agjgd.org) project.

## Example

    // You can use linebreaks4imagettftext() to add line breaks ("\n") to long strings to help format text when using imagettftext()
    $string = 'This is a long sentence that could not fit on a single line.';
    $stringWithLineBreaks = \AndrewGJohnson\AgjGd\linebreaks4imagettftext(20, 0, $font, $string, imagesx($im) * 0.8);

    // This will work but there will be no line breaks so your text will likely overflow horizontally
    imagettftext($im, 20, 0, imagesx($im) * 0.1, 0, $color, $font, $string);

    // This will work and you will not have to worry about text overflowing regardless of string length
    imagettftext($im, 20, 0, imagesx($im) * 0.1, 0, $color, $font, $stringWithLineBreaks);

There are [other examples](https://github.com/andrewgjohnson/linebreaks4imagettftext/tree/master/examples) included in the GitHub repository and on [linebreaks4imagettftext.agjgd.org](https://linebreaks4imagettftext.agjgd.org/examples/).

## Usage

### With Composer

This project offers support for the [Composer](https://getcomposer.org/) dependency manager. You can find the linebreaks4imagettftext package online on [packagist.org](https://packagist.org/packages/andrewgjohnson/linebreaks4imagettftext).

#### Install using Composer

Either run this command:

    composer require andrewgjohnson/linebreaks4imagettftext

or add this to the `require` section of your composer.json file:

    "andrewgjohnson/linebreaks4imagettftext": "1.*"

### Without Composer

To use without Composer add an [include](http://php.net/manual/function.include.php) to the [`linebreaks4imagettftext.php` source file](https://raw.githubusercontent.com/andrewgjohnson/linebreaks4imagettftext/master/source/AndrewGJohnson/AgjGd/linebreaks4imagettftext.php).

    include_once 'source/AndrewGJohnson/AgjGd/linebreaks4imagettftext.php';

## Help Requests

Please post any questions in the [discussions area](https://github.com/andrewgjohnson/linebreaks4imagettftext/discussions) on GitHub if you need help.

If you discover a bug please [enter an issue](https://github.com/andrewgjohnson/linebreaks4imagettftext/issues/new) on GitHub. When submitting an issue please use our [issue template](https://github.com/andrewgjohnson/linebreaks4imagettftext/tree/master/.github/ISSUE_TEMPLATE).

## Contributing

Please read our [contributing guidelines](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/.github/CONTRIBUTING.md) if you want to contribute.

You can contribute financially by becoming a [patron](https://patreon.com/agjopensource) at [patreon.com/agjopensource](https://patreon.com/agjopensource) to support linebreaks4imagettftext and [other agjgd.org projects](https://agjgd.org/projects/).

[![Patreon - Become a Patron](https://raster.shields.io/badge/Patreon%20-become%20a%20Patron-FD334A.png?style=for-the-badge&logo=patreon&logoColor=FD334A)](https://patreon.com/agjopensource)

## Acknowledgements

This project was started by [Andrew G. Johnson (@andrewgjohnson)](https://github.com/andrewgjohnson).

Full list of contributors:
 * [Andrew G. Johnson (@andrewgjohnson)](https://github.com/andrewgjohnson)

Our [security policies and procedures](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/.github/SECURITY.md) comes via the [atomist/samples](https://github.com/atomist/samples/blob/master/.github/SECURITY.md) project. Our [issue templates](https://github.com/andrewgjohnson/linebreaks4imagettftext/tree/master/.github/ISSUE_TEMPLATE) comes via the [tensorflow/tensorflow](https://github.com/tensorflow/tensorflow/blob/master/SECURITY.md) project. Our [pull request template](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/.github/PULL_REQUEST_TEMPLATE.md) comes via the [stevemao/github-issue-templates](https://github.com/stevemao/github-issue-templates) project. The [Jekyll theme](https://github.com/andrewgjohnson/open-source-documentation-jekyll-theme) was released by [Andrew G. Johnson](https://github.com/andrewgjohnson).

## Changelog

You can find all notable changes in the [changelog](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/CHANGELOG.md).

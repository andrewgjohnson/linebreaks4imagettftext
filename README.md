# linebreaks4imagettftext

[![MIT License](https://img.shields.io/github/license/andrewgjohnson/linebreaks4imagettftext.png)](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/LICENSE)
[![Current Release](https://img.shields.io/github/release/andrewgjohnson/linebreaks4imagettftext.png)](https://github.com/andrewgjohnson/linebreaks4imagettftext/releases)
[![GitHub Stars](https://img.shields.io/github/stars/andrewgjohnson/linebreaks4imagettftext.png)](https://github.com/andrewgjohnson/linebreaks4imagettftext/stargazers)
[![Contributors](https://img.shields.io/github/contributors/andrewgjohnson/linebreaks4imagettftext.png)](https://github.com/andrewgjohnson/linebreaks4imagettftext/graphs/contributors)
[![Packagist Downloads](https://img.shields.io/packagist/dt/andrewgjohnson/linebreaks4imagettftext.png)](https://packagist.org/packages/andrewgjohnson/linebreaks4imagettftext/stats)
[![Issues](https://img.shields.io/github/issues/andrewgjohnson/linebreaks4imagettftext.png)](https://github.com/andrewgjohnson/linebreaks4imagettftext/issues)

## Description

**linebreaks4imagettftext** is a function to automatically insert line breaks into your text while using PHP's imagettftext function.

## Usage

### With Composer

This project offers support for the [Composer](https://getcomposer.org/) dependency manager.  You can find the linebreaks4imagettftext package online on [packagist.org](https://packagist.org/packages/andrewgjohnson/linebreaks4imagettftext).

#### Install using Composer

Either run this command:

    composer require andrewgjohnson/linebreaks4imagettftext

or add this to the `require` section of your composer.json file:

    "andrewgjohnson/linebreaks4imagettftext": "1.*"

### Without Composer

To use without Composer add an [include](http://php.net/manual/function.include.php) to the [`linebreaks4imagettftext.php` source file](https://raw.githubusercontent.com/andrewgjohnson/linebreaks4imagettftext/master/source/linebreaks4imagettftext.php).

    include_once 'source/linebreaks4imagettftext.php';

## Example

    // You can use \andrewgjohnson\linebreaks4imagettftext() to add line breaks ("\n") to long strings to help format text when using imagettftext()
    $string = 'It was the best of times, it was the worst of times, it was the age of wisdom, it was the age of foolishness, it was the epoch of belief, it was the epoch of incredulity, it was the season of Light, it was the season of Darkness, it was the spring of hope, it was the winter of despair, we had everything before us, we had nothing before us, we were all going direct to Heaven, we were all going direct the other way--in short, the period was so far like the present period, that some of its noisiest authorities insisted on its being received, for good or for evil, in the superlative degree of comparison only.';
    $stringWithLineBreaks = \andrewgjohnson\linebreaks4imagettftext(20, 0, $font, $string, 200);
    echo $stringWithLineBreaks; //"It was the best of times, it was the\nworst of times, it was the age of\nwisdom, it was the age of\nfoolishness, it was the epoch of\nbelief, it was the epoch of\nincredulity, it was the season of\nLight, it was the season of\nDarkness, it was the spring of\nhope, it was the winter of despair,\nwe had everything before us, we\nhad nothing before us, we were all\ngoing direct to Heaven, we were all\ngoing direct the other way--in short,\nthe period was so far like the\npresent period, that some of its\nnoisiest authorities insisted on its\nbeing received, for good or for evil,\nin the superlative degree of\ncomparison only."

    // This will work but there will be no line breaks so your text will likely overflow horizontally
    imagettftext($im, 20, 0, 0, 0, $color, $font, $string);

    // This will work and you will not have to worry about text overflowing
    imagettftext($im, 20, 0, 0, 0, $color, $font, $stringWithLineBreaks);

There are [other examples](https://github.com/andrewgjohnson/linebreaks4imagettftext/tree/master/examples) included in the GitHub repository and on [linebreaks4imagettftext.org](https://linebreaks4imagettftext.org/examples/).

## Help Requests

Please post any questions on [stackoverflow.com](https://stackoverflow.com/search?q=linebreaks4imagettftext) if you need help.

If you discover a bug please [enter an issue](https://github.com/andrewgjohnson/linebreaks4imagettftext/issues/new) on GitHub.  When submitting an issue please use our [issue template](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/ISSUE_TEMPLATE.md).

## Contributing

Please read our [contributing guidelines](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/CONTRIBUTING.md) if you want to contribute.

## Acknowledgements

This project was started by [Andrew G. Johnson (@andrewgjohnson)](https://github.com/andrewgjohnson).

Full list of contributors:
 * [Andrew G. Johnson (@andrewgjohnson)](https://github.com/andrewgjohnson)

Our [issue template](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/ISSUE_TEMPLATE.md) & [pull request template](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/PULL_REQUEST_TEMPLATE.md) come via the [stevemao/github-issue-templates](https://github.com/stevemao/github-issue-templates) project.

## Changelog

You can find all notable changes in the [changelog](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/CHANGELOG.md).

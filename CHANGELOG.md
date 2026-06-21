# Changelog

All notable changes to the [linebreaks4imagettftext project](https://github.com/andrewgjohnson/linebreaks4imagettftext) will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## [v1.1.2](https://github.com/andrewgjohnson/linebreaks4imagettftext/releases/tag/v1.1.2) (May 13, 2026)
 * Changed the font in the examples from Arial to [Noto Sans](https://fonts.google.com/noto/specimen/Noto+Sans) which uses the [SIL OFL 1.1](https://openfontlicense.org/open-font-license-official-text/)
 * Updated documentation website to replace deprecated `hljs.initHighlighting()` call with `hljs.highlightAll()` and removed obsolete Google Analytics script
 * Fixed broken link in [examples/README.md](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/examples/README.md) that was pointing to the wrong domain for the examples page
 * Fixed source file path for non-Composer usage in [README.md](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/README.md) and moved the Example section above the Usage section
 * Fixed grammar errors and typos in comments across [README.md](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/README.md), [linebreaks4imagettftext.php](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/source/AndrewGJohnson/AgjGd/linebreaks4imagettftext.php) and [reverseCompatibility.php](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/source/reverseCompatibility.php)
 * Updated [02-using-the-parameters.php](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/examples/02-using-the-parameters.php) with adjusted image dimensions and improved example strings
 * Added unit tests to [Linebreaks4imagettftextTest.php](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/tests/AndrewGJohnson/AgjGd/Linebreaks4imagettftextTest.php) covering return type, empty input, single word, line-break insertion, custom break characters, word preservation, `$forceBreakOnSingleWords`, `$attemptToBreakOnHyphens` and `$preventWidows`

## [v1.1.1](https://github.com/andrewgjohnson/linebreaks4imagettftext/releases/tag/v1.1.1) (May 9, 2026)
 * Added [.gitattributes](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/.gitattributes) file to help manage end-of-line characters
 * Added a `version_compare()` check before all `imagedestroy()` calls; the imagedestroy() function became an optional step that did nothing as of PHP 8.0 but as of PHP 8.5 when invoked it produces a deprecated notice

## [v1.1.0](https://github.com/andrewgjohnson/linebreaks4imagettftext/releases/tag/v1.1.0) (May 5, 2026)
 * Added [Contribute](https://linebreaks4imagettftext.agjgd.org/contribute/) page and updated [contributing guidelines](https://github.com/andrewgjohnson/linebreaks4imagettftext/blob/master/.github/CONTRIBUTING.md)
 * Added PHP_CodeSniffer support to enforce PSR-12 and PHP 5.0 compatibility
 * Added PHPUnit support for unit tests
 * Added `lint`, `lint:fix`, `phpunit` and `test` composer scripts
 * Added `$attemptToBreakOnHyphens`, `$forceBreakOnSingleWords` and `$preventWidows` parameters to support additional options when rendering text
 * Fixed support for older PHP versions; this project now truly supports PHP 5.0
 * Fixed a number of broken links
 * Changed to the `AndrewGJohnson\AgjGd` namespace but added reverse compatibility to support the original `andrewgjohnson` namespace

## [v1.0.3](https://github.com/andrewgjohnson/linebreaks4imagettftext/releases/tag/v1.0.3) (November 22, 2022)
 * Signed up for [Patreon](https://patreon.com/agjopensource) and added links to README.md
 * Added `.github` folder to unclutter the root directory
 * Added `CODEOWNERS` file
 * Added `FUNDING.yml` file
 * Added `SECURITY.md` file
 * Added `SUPPORT.md` file
 * Updated shields.io badge aesthetics on README.md
 * Removed the MIT logo from the shields.io badge for linebreaks4imagettftext's license
 * Added Patrons shields.io badge to README.md
 * Enabled GitHub [discussions area](https://github.com/andrewgjohnson/linebreaks4imagettftext/discussions) and now recommending it over StackOverflow
 * Removed `ISSUE_TEMPLATE.md` file for our single issue template and replaced with `ISSUE_TEMPLATE` folder to separate bug reports & feature requests within GitHub [issues](https://github.com/andrewgjohnson/linebreaks4imagettftext/issues)
 * Updated [avatar image](https://linebreaks4imagettftext.agjgd.org/documentation/images/avatar.png)
 * Moved all Twitter activity for all [agjgd projects](https://agjgd.org/projects/) (including linebreaks4imagettftext) to the [@agjgdphp Twitter account](https://twitter.com/agjgdphp) as there were issues with the individual accounts being frozen
 * Changed documentation website to [linebreaks4imagettftext.agjgd.org](https://linebreaks4imagettftext.agjgd.org)
 * Updated copyright years to 2022

## [v1.0.2](https://github.com/andrewgjohnson/linebreaks4imagettftext/releases/tag/v1.0.2) (December 15, 2018)
 * Fixed bug that would sometimes exclude a space when doing calculations
 * Added return type for PHPDoc
 * Cosmetic updates to https://linebreaks4imagettftext.agjgd.org/

## [v1.0.1](https://github.com/andrewgjohnson/linebreaks4imagettftext/releases/tag/v1.0.1) (June 4, 2018)
 * Enabled HTTPS on https://linebreaks4imagettftext.agjgd.org/
 * Switched YUI reset CSS from Yahoo hosted to inline
 * Switched to __DIR__ constant in examples to get current directory
 * Refactored example with more comments & better naming
 * Refactored source to pass phpcs line length limit of 85 characters

## [v1.0.0](https://github.com/andrewgjohnson/linebreaks4imagettftext/releases/tag/v1.0.0) (June 3, 2018)
 * Initial release of linebreaks4imagettftext

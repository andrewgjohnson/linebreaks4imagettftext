<?php

/**
 * Copyright (c) 2013-2026 Andrew G. Johnson <andrew@andrewgjohnson.com>
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
    public function testFunctionExists(): void
    {
        $this->assertTrue(
            function_exists('AndrewGJohnson\\AgjGd\\linebreaks4imagettftext'),
            'AndrewGJohnson\\AgjGd\\linebreaks4imagettftext function does not exist'
        );
    }

    public function testReverseCompatibility(): void
    {
        $this->assertTrue(
            function_exists('andrewgjohnson\\linebreaks4imagettftext'),
            'andrewgjohnson\\linebreaks4imagettftext function does not exist'
        );

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
}

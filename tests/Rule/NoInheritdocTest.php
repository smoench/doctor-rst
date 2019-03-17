<?php

declare(strict_types=1);

/*
 * This file is part of DOCtor-RST.
 *
 * (c) Oskar Stark <oskarstark@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Rule;

use App\Rule\NoInheritdoc;
use App\Tests\RstSample;
use PHPUnit\Framework\TestCase;

class NoInheritdocTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider checkProvider
     */
    public function check($expected, RstSample $sample)
    {
        $this->assertSame(
            $expected,
            (new NoInheritdoc())->check($sample->getContent(), $sample->getLineNumber())
        );
    }

    public function checkProvider()
    {
        return [
            [
                'Please do not use "@inheritdoc"',
                new RstSample('* {@inheritdoc}'),
            ],
            [
                null,
                new RstSample('fine'),
            ],
        ];
    }
}
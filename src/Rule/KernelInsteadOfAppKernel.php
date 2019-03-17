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

namespace App\Rule;

use App\Handler\RulesHandler;

class KernelInsteadOfAppKernel extends AbstractRule implements Rule
{
    public static function getGroups(): array
    {
        return [RulesHandler::GROUP_SONATA];
    }

    public function check(\ArrayIterator $lines, int $number)
    {
        $lines->seek($number);
        $line = $lines->current();

        if (preg_match('/app\/AppKernel\.php/', $line)) {
            return 'Please use "src/Kernel.php" instead of "app/AppKernel.php"';
        }

        if (preg_match('/AppKernel/', $line)) {
            return 'Please use "Kernel" instead of "AppKernel"';
        }
    }
}
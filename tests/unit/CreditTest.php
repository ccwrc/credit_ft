<?php

declare(strict_types=1);

namespace FT\tests\unit;

use FT\Credit;

use PHPUnit\Framework\TestCase;

class CreditTest extends TestCase
{
    public function testCreation(): void
    {
        $date = new \DateTime('now');
        $credit = new Credit(500, 50, 1, 'USD', $date);

        $this->assertInstanceOf(Credit::class, $credit);
    }

}

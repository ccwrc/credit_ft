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

    public function testFutureBehat(): void
    {
        $dateOfLoan = new \DateTime('l, 2018-01-01 12:00:00 T');
        $day20180102 = new \DateTime('l, 2018-01-02 12:00:05 T');
        $day20180103 = new \DateTime('l, 2018-01-03 12:00:05 T');
        $day20180104 = new \DateTime('l, 2018-01-04 12:00:05 T');

        $credit = new Credit(1700, 466.65, 0.45, 'zł', $dateOfLoan);
        $this->assertEquals(2167.10, $credit->getBalanceToDate($day20180102));
        $this->assertEquals(2167.55, $credit->getBalanceToDate($day20180103));

        $credit->loanRepaymentByCustomer(1000, 'zł', $day20180103);
        $this->assertEquals(1167.55, $credit->getBalanceToDate($day20180103));

        $this->assertEquals(1168, $credit->getBalanceToDate($day20180104));

        // back to past
        $this->assertEquals(2167.10, $credit->getBalanceToDate($day20180102));
    }
}

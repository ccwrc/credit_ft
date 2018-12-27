<?php

declare(strict_types=1);

namespace FT;

final class Credit
{
    /**
     * @var float $loanAmount Only positive value
     */
    private $loanAmount;
    /**
     * @var float $commissionAmount Only positive value
     */
    private $commissionAmount;
    /**
     * @var float $dailyInterest Only positive value
     */
    private $dailyInterest;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var \DateTimeImmutable
     */
    private $dateOfLoan;
    /**
     * @var float
     */
    private $sumOfCustomerPayment;
//    /**
//     * @var \DateTimeImmutable
//     */
//    private $lastSettlement;

    public function __construct(
        float $loanAmount,
        float $commissionAmount,
        float $dailyInterest,
        string $currency,
        \DateTimeImmutable $dateOfLoan
    ) {
        $this->loanAmount = \abs($loanAmount);
        $this->commissionAmount = \abs($commissionAmount);
        $this->dailyInterest = \abs($dailyInterest);
        $this->currency = $currency;
        $this->dateOfLoan = $dateOfLoan;
        $this->sumOfCustomerPayment = 0.00;
//        $this->lastSettlement = $dateOfLoan;
    }

    /**
     * @param float $amount
     * @param string $currency
     * @param \DateTimeImmutable $dateOfPayment
     * @throws \Exception
     */
    public function loanRepaymentByCustomer(
        float $amount,
        string $currency,
        \DateTimeImmutable $dateOfPayment
    ): void
    {
        if ($currency !== $this->currency) {
            throw new \Exception('some message');
        }
        //TODO logic
    }

    public function getBalance(): float
    {
        //TODO logic
        return 11.11;
    }

    //TODO calculation of interest from the date range
}

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
     * @var \DateTime
     */
    private $dateOfLoan;
    /**
     * @var float
     */
    private $sumOfCustomerPayment;
    /**
     * (key) serialized \DateTime object => (value) amount
     * @var array
     */
    private $loanRepaymentLogger;

    public function __construct(
        float $loanAmount,
        float $commissionAmount,
        float $dailyInterest,
        string $currency,
        \DateTime $dateOfLoan
    ) {
        $this->loanAmount = \abs($loanAmount);
        $this->commissionAmount = \abs($commissionAmount);
        $this->dailyInterest = \abs($dailyInterest);
        $this->currency = $currency;
        $this->dateOfLoan = $dateOfLoan;
        $this->sumOfCustomerPayment = 0.00;
        $this->loanRepaymentLogger = [];
    }

    /**
     * @param float $amount Only positive value
     * @param string $currency
     * @param \DateTime $paymentDate
     * @throws \Exception
     */
    public function loanRepaymentByCustomer(
        float $amount,
        string $currency,
        \DateTime $paymentDate
    ): void
    {
        if ($currency !== $this->currency
            || self::isFirstDateEarlier($paymentDate, $this->dateOfLoan)
            || array_key_exists(serialize($paymentDate), $this->loanRepaymentLogger)) {
            throw new \Exception('some message');
        }

        $this->loanRepaymentLogger[serialize($paymentDate)] = abs($amount);
        $this->sumOfCustomerPayment += abs($amount);
    }

    /**
     * @param \DateTime $date
     * @return float
     * @throws \Exception
     */
    public function getBalanceToDate(\DateTime $date): float
    {
        $sumOfCustomerPayment = 0;
        foreach ($this->loanRepaymentLogger as $dateKey => $amount) {
            if (self::isFirstDateEarlier(unserialize($dateKey), $date) || unserialize($dateKey) === $date) {
                $sumOfCustomerPayment += $amount;
            }
        }

        $sumOfDailyInterest = self::getSumOfDailyInterest($this->dateOfLoan, $date);
        $sumOfLoads = $sumOfDailyInterest + $this->commissionAmount + $this->loanAmount;

        return $sumOfLoads - $sumOfCustomerPayment;
    }

    /**
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return float
     * @throws \Exception
     */
    private function getSumOfDailyInterest(\DateTime $startDate, \DateTime $endDate): float
    {
        if (!self::isFirstDateEarlier($startDate, $endDate)) {
            throw new \Exception('some message');
        }
        $diff = $startDate->diff($endDate);
        $totalDays = (int)$diff->days;

        return $totalDays * $this->dailyInterest;
    }

    /**
     * @param \DateTime $firstDate
     * @param \DateTime $secondDate
     * @return bool
     */
    private static function isFirstDateEarlier(\DateTime $firstDate, \DateTime $secondDate): bool
    {
        $diff = \date_diff($firstDate, $secondDate, false);

        return !(1 === $diff->invert);
    }
}

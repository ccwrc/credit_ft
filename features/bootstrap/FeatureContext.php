<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;

use FT\Credit;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var Credit
     */
    private $credit;

    /**
     * @Given loan in the amount of :loanAmount, commission :commissionAmount, currency :currency date :dateOfLoan, daily interest :dailyInterest
     * @param float $loanAmount
     * @param float $commissionAmount
     * @param string $currency
     * @param string $dateOfLoan
     * @param float $dailyInterest
     * @throws \Exception
     */
    public function getCredit(
        float $loanAmount,
        float $commissionAmount,
        string $currency,
        string $dateOfLoan,
        float $dailyInterest
    ): void
    {
        $credit = new Credit(
            $loanAmount,
            $commissionAmount,
            $dailyInterest,
            $currency,
            new \DateTime("$dateOfLoan")
        );

        $this->credit = $credit;
    }

    /**
     * @When the customer pays a loan in the amount of :amount currency :currency on :paymentDate
     * @param float $amount
     * @param string $currency
     * @param string $paymentDate
     * @throws \Exception
     */
    public function clientRepaysPartOfTheLoan(
        float $amount,
        string $currency,
        string $paymentDate
    ): void
    {
        $this->credit->loanRepaymentByCustomer(
            $amount,
            $currency,
            new \DateTime("$paymentDate")
        );
    }

    /**
     * @Then the charges for the date :date are :amount
     * @param string $date
     * @param float $amount
     * @throws \Exception
     */
    public function checkBalance(
        string $date,
        float $amount
    ): void
    {
        Assert::assertEquals($amount, $this->credit->getBalanceToDate(new \DateTime("$date")));
    }

    /**
     * @Then the charges for the dates :date1, :date2 are :amount1 and :amount2
     * @param string $date1
     * @param string $date2
     * @param float $amount1
     * @param float $amount2
     * @throws \Exception
     */
    public function checkBalanceForDates(
        string $date1,
        string $date2,
        float $amount1,
        float $amount2
    ): void
    {
        Assert::assertEquals($amount1, $this->credit->getBalanceToDate(new \DateTime("$date1")));
        Assert::assertEquals($amount2, $this->credit->getBalanceToDate(new \DateTime("$date2")));
    }
}

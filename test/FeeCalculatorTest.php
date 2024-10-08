<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Fee\FeeCalculator;
use PragmaGoTech\Interview\Fee\JsonFeeStructureProvider;
use PragmaGoTech\Interview\Model\LoanProposal;

final class FeeCalculatorTest extends TestCase
{
    private FeeCalculator $calculator;

    protected function setUp(): void
    {
        $filePath = __DIR__ . '/../data/fee_structure.json';
        $feeProvider = new JsonFeeStructureProvider($filePath);
        $this->calculator = new FeeCalculator($feeProvider);
    }

    /**
     * @dataProvider loanDataProvider
     */
    public function testCalculateFeeForVariousLoanAmounts(int $term, float $amount, float $expectedFee): void
    {
        $loanProposal = new LoanProposal($term, $amount);
        $fee = $this->calculator->calculate($loanProposal);
        $this->assertEquals($expectedFee, $fee);
    }

    public static function loanDataProvider(): array
    {
        return [
            [12, 2000, 90],
            [24, 3000, 120],
            [12, 1500, 70],
            [24, 2750, 115],
            [24, 11500, 460],
            [12, 19250, 385],
            [12, 1000.50, 54.50],
        ];
    }
}

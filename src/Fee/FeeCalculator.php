<?php

namespace PragmaGoTech\Interview\Fee;

use PragmaGoTech\Interview\FeeStructureProvider;
use PragmaGoTech\Interview\Model\LoanProposal;

class FeeCalculator implements \PragmaGoTech\Interview\FeeCalculator
{
    private FeeStructureProvider $feeProvider;

    public function __construct(FeeStructureProvider $feeProvider)
    {
        $this->feeProvider = $feeProvider;
    }

    public function calculate(LoanProposal $application): float
    {
        $feeStructure = $this->feeProvider->getFeeStructure();
        $term = $application->term();
        $lower = 0;
        $finalFee = -1;

        foreach ($feeStructure[$application->term()] as $amount => $fee) {
            $upper = (float) $amount;
            if ($upper == $application->amount()) {
                $finalFee = $fee;
            } elseif ($application->amount() > $lower && $application->amount() < $upper) {
                $finalFee = $this->interpolate($application->amount(), $lower, $upper, $feeStructure[$term][$lower], $feeStructure[$term][$upper]);
            }
            $lower = $upper;
        }

        return $this->roundUpToNearestFive($finalFee, $application->amount());
    }

    private function interpolate(float $value, float $x1, float $x2, float $y1, float $y2): float
    {
        return $y1 + ($y2 - $y1) * (($value - $x1) / ($x2 - $x1));
    }

    private function roundUpToNearestFive(float $fee, float $loanAmount): float
    {
        $total = $loanAmount + $fee;

        if (($total / 5.0) == 0.0) {
            return $fee;
        }

        $nextMultipleOfFive = ceil($total / 5.0) * 5.0;

        return $nextMultipleOfFive - $loanAmount;
    }
}

<?php

namespace PragmaGoTech\Interview\Calculator;

use PragmaGoTech\Interview\Model\LoanProposal;

class FeeCalculator implements \PragmaGoTech\Interview\FeeCalculator
{
    public function calculate(LoanProposal $application): float
    {
//        $feeStructure = json_decode(file_get_contents('data/fee_structure.json'), true);
        return 0;
    }
}

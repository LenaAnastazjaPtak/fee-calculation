<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview;

use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Calculator\FeeCalculator;
use PragmaGoTech\Interview\Input\InputHandler;

class Application
{
    private InputHandler $inputHandler;

    public function __construct(InputHandler $inputHandler)
    {
        $this->inputHandler = $inputHandler;
    }

    public function run(): void
    {
        $loanAmount = $this->inputHandler->getLoanAmount();
        $term = $this->inputHandler->getLoanTerm();

        $calculator = new FeeCalculator();
        $loanProposal = new LoanProposal($term, $loanAmount);

        echo "The loan fee is:" . $calculator->calculate($loanProposal) . " PLN\n";
    }
}

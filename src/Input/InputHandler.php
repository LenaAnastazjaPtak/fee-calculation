<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Input;

class InputHandler
{
    public function getLoanAmount(): float
    {
        while (true) {
            $amountInput = readline("Enter the loan amount (1 000 - 20 000 PLN): ");
            $amount = (float)$amountInput;

            if ($amount >= 1000 && $amount <= 20000) {
                return $amount;
            } else {
                echo "Incorrect amount! Please enter an amount between PLN 1,000 and PLN 20,000.\n";
            }
        }
    }

    public function getLoanTerm(): int
    {
        while (true) {
            $termInput = readline("Enter the loan period (12 or 24 months): ");
            $term = (int)$termInput;

            if ($term === 12 || $term === 24) {
                return $term;
            } else {
                echo "Incorrect period! Please enter 12 or 24.\n";
            }
        }
    }
}

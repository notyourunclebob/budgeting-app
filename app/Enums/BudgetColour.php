<?php

namespace App\Enums;

enum BudgetColour: string
{
    case Under = 'under';
    case Max = 'max';
    case Over = 'over';

    public static function setColour($percentage): self
    {
        return match(true) {
            $percentage > 100 => self::Over,
            $percentage == 100 => self::Max,
            default => self::Under,
        };
    }

    public function colour(): string
    {
        return match($this) {
            self::Over => '#ef4444',
            self::Max => '#f59e0b',
            self::Under => '#22c55e',
        };
    }
}

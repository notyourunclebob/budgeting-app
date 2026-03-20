<?php

namespace App\Models;

use App\Enums\BudgetColour;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'limit',];

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function percentageUsed(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->limit > 0 ? round(($this->expenses_sum_amount / $this->limit) * 100, 2) : 0
        );
    }

    public function budgetColour(): Attribute
    {
        return Attribute::make(
            get: fn () => BudgetColour::setColour($this->percentage_used)
        );
    }
}

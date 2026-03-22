<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetRequest;
use App\Models\Budget;
use App\Models\Expense;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $budgets = Budget::withSum('expenses', 'amount')->get();

        return view('budget.index', ['budgets' => $budgets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('budget.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BudgetRequest $request)
    {
        $validated = $request->validated();

        Budget::create($validated);

        return redirect()->route('budget.create')->with('status', 'New budget created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Budget $budget)
    {
        $expenses = Expense::where('budget_id', $budget->id)->paginate(10);

        $budget->loadSum('expenses', 'amount');

        return view('budget.show', ['expenses' => $expenses], compact('budget'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget)
    {
        return view('budget.edit', compact('budget'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BudgetRequest $request, Budget $budget)
    {
        $validated = $request->validated();

        $budget->update($validated);

        return redirect()->route('budget.show', $budget)->with('status', 'Budget updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget)
    {
        $budget->delete();

        return redirect()->route('budget.index')->with('status', "Budget for $budget->title deleted");
    }
}

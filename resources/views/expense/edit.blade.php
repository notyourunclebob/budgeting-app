<x-layouts.app title="Edit expense">
    <main class="pt-12 space-y-12">
        <div>
            <a href="{{ route('expense.index', $expense) }}" class="button w-fit">Back to Expenses</a>
        </div>

        <x-status />

        <form class="card p-6 space-y-4" action="{{ route('expense.update', $expense) }}" method="post">
            @csrf
            @method('PUT')
            <div>
                <label for="description">Expense description</label>
                <input class="form-text w-full" type="text" name="description" value="{{ $expense->description }}" />
                @error('description')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="amount">Amount</label>
                <div class="form-money w-full">
                    <span>$</span>
                    <input class="w-full" type="number" step="0.01" name="amount" value="{{ $expense->amount }}" />
                </div>
                @error('amount')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-between items-end">
                <div>
                    <label for="budget_id">Budget category</label>
                    <div>
                        <select class="form-select" name="budget_id">
                            @foreach ($budgets as $budget)
                                <option value="{{ $budget->id }}"
                                    {{ $expense->budget_id === $budget->id ? 'selected' : '' }}>
                                    {{ $budget->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('budget_id')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <button class="button" type="submit">Confirm</button>
            </div>
        </form>
    </main>
</x-layouts.app>

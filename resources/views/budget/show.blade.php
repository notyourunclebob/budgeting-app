<x-layouts.app title="Budget Details">
    <main class="pt-12 space-y-12">
        <div>
            <a href="{{ route('budget.index') }}" class="button">Back to Budgets</a>
        </div>

        <x-status />

        <div class="card">
            <div class='card-body space-y-4'>
                <div class="flex justify-between">
                    <div class="text-xl">{{ $budget->title }}</div>
                    <div class="flex gap-2">
                        <a href="{{ route('budget.edit', $budget) }}" class="button">Edit</a>
                        <button
                            onclick="openModal('{{ route('expense.destroy', $budget) }}', '{{ addslashes($budget->title) }}')"
                            class="button bg-red-600 hover:bg-red-400">Delete</button>
                    </div>
                </div>
                <div>
                    <span>${{ $budget->expenses_sum_amount }} of </span>
                    <span>${{ $budget->limit }}/Month</span>
                </div>
                <div class="percent-bar">
                    <div class="percent-fill"
                        style="width: {{ $budget->percentage_used }}%; background-color: {{ $budget->budget_colour->colour() }}">
                    </div>
                </div>
            </div>
        </div>
        <table class="table">
            <tr>
                <th>Description</th>
                <th>Amount</th>
                <th>Category</th>
            </tr>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $expense->description }}</td>
                    <td>${{ $expense->amount }}</td>
                    <td>{{ $budget->title }}</td>
                </tr>
            @endforeach
        </table>
        <div>{{ $expenses->links() }}</div>

        @include('partials.modal-confirm')
    </main>
</x-layouts.app>

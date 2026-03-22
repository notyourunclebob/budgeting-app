<x-layouts.app title="Expenses">
    <main class="pt-12 space-y-12">
        <div>
            <a href="{{ route('expense.create') }}" class="button">Add expense</a>
        </div>

        <x-status />

        <table class="table">
            <tr>
                <th>Description</th>
                <th>Amount</th>
                <th>Category</th>
                <th></th>
            </tr>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $expense->description }}</td>
                    <td>${{ $expense->amount }}</td>
                    <td>{{ $expense->budget->title }}</td>
                    <td>
                        <div class="flex justify-end gap-2">
                            <a class="button">Edit</a>
                            <button class="button bg-red-600 hover:bg-red-400"
                                onclick="openModal('{{ route('expense.destroy', $expense) }}', '{{ addslashes($expense->description) }}')"
                                data-name="{{ $expense->description }}">Delete</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        <div>{{ $expenses->links() }}</div>
    </main>
    @include('partials.modal-confirm')
</x-layouts.app>

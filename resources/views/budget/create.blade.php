<x-layouts.app title="Create a new budget category">
    <main class="pt-12 space-y-12">
        <div>
            <a href="{{ route('budget.index') }}" class="button">Back to Budgets</a>
        </div>
        <form class="card p-6 space-y-4" action="{{ route('budget.store') }}" method="post">
            @csrf
            <div>
                <label for="title">Budget Title</label>
                <input class="form-text w-full" type="text" name="title" />
                @error('title')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="limit">Total Limit</label>
                <div class="form-money w-full">
                    <span>$</span>
                    <input class="w-full" type="text" name="limit" />
                </div>
                @error('limit')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-end">
                <button class="button" type="submit">Create</button>
            </div>
        </form>
    </main>
</x-layouts.app>

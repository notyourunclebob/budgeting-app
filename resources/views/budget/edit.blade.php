<x-layouts.app title="Edit budget details">
    <main class="pt-12 space-y-12">
        <div>
            <a href="{{ route('budget.show', $budget) }}" class="button w-fit">Back to Budget Details</a>
        </div>

        <x-status />

        <form class="card p-6 space-y-4" action="{{ route('budget.update', $budget) }}" method="post">
            @csrf
            @method('PUT')
            <div>
                <label for="title">Budget Title</label>
                <input class="form-text w-full" type="text" name="title" value="{{ $budget->title }}" />
                @error('title')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="limit">Total Limit</label>
                <div class="form-money w-full">
                    <span>$</span>
                    <input class="w-full" type="number" name="limit" value="{{ $budget->limit }}" />
                </div>
                @error('limit')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-end">
                <button class="button" type="submit">Confirm</button>
            </div>
        </form>
    </main>
</x-layouts.app>

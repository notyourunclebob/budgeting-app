<x-layouts.app title="Budgets">
    <div>
        <main class="w-full space-y-12 pb-12">
            <div class="pt-12">
                <a href="{{ route('budget.create') }}" class="button">Add Budget</a>
            </div>

            <x-status />

            @if ($budgets->isEmpty())
                <p>No budgets yet...</p>
            @else
                <div class="space-y-12">
                    @foreach ($budgets as $budget)
                        <div class="card">
                            <div class='card-body space-y-4'>
                                <div class="flex justify-between">
                                    <div class="text-xl">{{ $budget->title }}</div>
                                    <div>
                                        <span>${{ $budget->expenses_sum_amount }}</span>
                                        <span>/ ${{ $budget->limit }}</span>
                                    </div>
                                </div>
                                <div class="percent-bar">
                                    <div class="percent-fill"
                                        style="width: {{ $budget->percentage_used }}%; background-color: {{ $budget->budget_colour->colour() }}">
                                    </div>
                                </div>
                                <div class="flex justify-between text-se">
                                    <a href="#top">Back to top</a>
                                    <a href="{{ route('budget.show', $budget) }}">View details ></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </main>

    </div>
</x-layouts.app>

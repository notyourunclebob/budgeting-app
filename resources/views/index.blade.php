<x-layouts.app>
    <div>
        <main class="w-full space-y-12">
            <div>
                <a class="button">Add Budget</a>
            </div>
            @if ($budgets->isEmpty())
                <p>No budgets yet...</p>
            @else
                <div class="space-y-12">
                    @foreach ($budgets as $budget)
                        <div class="card space-y-4">
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
                        </div>
                    @endforeach
                </div>
            @endif

        </main>

    </div>
</x-layouts.app>

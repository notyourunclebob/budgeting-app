<?php
// App/View/Components/AppLayout.php
namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public function __construct(
        public string $title = 'Budgets'
    ) {}

    public function render()
    {
        return view('components.layouts.app');
    }
}

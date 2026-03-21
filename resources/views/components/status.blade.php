@if (Session::has('status'))
    <div class="p-3 text-gray-700 bg-gray-100 border-l-3 border-l-gray-500 mb-4">
        {{ Session::get('status') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="p-3 text-red-700 bg-red-100 border-l-3 border-l-red-500 mb-4">
        {{ Session::get('error') }}
    </div>
@endif

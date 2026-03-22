@if (Session::has('status'))
    <div class="alert text-seagreen">
        ✓ {{ Session::get('status') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert text-cherry">
        ✕ {{ Session::get('error') }}
    </div>
@endif

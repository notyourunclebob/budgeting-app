<div id="confirm-modal" class="modal-backdrop" style="display: none;">
    <div class="modal">
        <h2 class="text-xl font-semibold">Confirm Delete</h2>
        <p class="mb-4">Are you sure you want to delete <b>{{ $name }}</b>? This action cannot be undone.</p>
        <div class="flex justify-end gap-2">
            <button onclick="closeModal()" class="button">Cancel</button>
            <form id="confirm-modal-form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="button bg-red-600 hover:bg-red-400">Delete</button>
            </form>
        </div>
    </div>
</div>

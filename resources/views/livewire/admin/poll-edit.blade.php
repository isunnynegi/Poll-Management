<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Poll</h2>

    <form wire:submit.prevent="save">
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Question</label>
            <input type="text" wire:model="question" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            @error('question') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Options (ReadOnly for now)</label>
            @foreach($options as $index => $option)
                <div class="flex items-center mb-2">
                    <input type="text" value="{{ $option }}" disabled class="flex-1 bg-gray-100 border-gray-300 rounded-md shadow-sm sm:text-sm">
                </div>
            @endforeach
        </div>

        <div class="flex justify-end pt-4 border-t">
            <a href="{{ route('admin.dashboard') }}" class="mr-4 text-gray-600 hover:text-gray-800 py-2">Cancel</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow transition">
                Update Poll
            </button>
        </div>
    </form>
</div>

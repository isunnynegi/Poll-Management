<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Poll</h2>

    <form wire:submit.prevent="save">
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Question</label>
            <input type="text" wire:model="question" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="What is your favorite color?">
            @error('question') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Options</label>
            @foreach($options as $index => $option)
                <div class="flex items-center mb-2">
                    <input type="text" wire:model="options.{{ $index }}" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Option {{ $index + 1 }}">
                    @if(count($options) > 2)
                        <button type="button" wire:click="removeOption({{ $index }})" class="ml-2 text-red-600 hover:text-red-800">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    @endif
                </div>
                @error("options.{$index}") <span class="text-red-500 text-xs block mb-1">{{ $message }}</span> @enderror
            @endforeach

            <button type="button" wire:click="addOption" class="mt-2 text-sm text-blue-600 hover:text-blue-800 font-medium">
                + Add Another Option
            </button>
        </div>

        <div class="flex justify-end pt-4 border-t">
            <a href="{{ route('admin.dashboard') }}" class="mr-4 text-gray-600 hover:text-gray-800 py-2">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition">
                Create Poll
            </button>
        </div>
    </form>
</div>

<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">My Polls</h2>
        <a href="{{ route('admin.polls.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
            + Create New Poll
        </a>
    </div>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Votes</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Share Link</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($polls as $poll)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $poll->question }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $poll->votes_count }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-500">
                                    <div x-data="{ 
                                        copying: false,
                                        copy() {
                                            navigator.clipboard.writeText('{{ route('poll.view', $poll->slug) }}');
                                            this.copying = true;
                                            setTimeout(() => this.copying = false, 2000);
                                        }
                                    }" class="flex items-center space-x-2">
                                        <code class="bg-gray-100 px-2 py-1 rounded text-xs select-all">{{ route('poll.view', $poll->slug) }}</code>
                                        <button @click="copy()" class="text-gray-400 hover:text-blue-600 transition p-1 rounded hover:bg-gray-100">
                                            <svg x-show="!copying" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                            </svg>
                                            <svg x-show="copying" class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $poll->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $poll->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('poll.view', $poll->slug) }}" target="_blank" class="text-blue-600 hover:text-blue-900 mr-4">View Public</a>
                                    <a href="{{ route('admin.polls.results', $poll->id) }}" class="text-green-600 hover:text-green-900 mr-4">Results</a>
                                    <a href="{{ route('admin.polls.edit', $poll->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                    <button wire:click="deletePoll('{{ $poll->id }}')" class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No polls found. Create your first poll!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

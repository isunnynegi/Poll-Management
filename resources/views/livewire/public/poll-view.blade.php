<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="p-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ $poll->question }}</h2>

            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if(!$hasVoted)
                <form wire:submit.prevent="vote">
                    <div class="space-y-4 mb-8">
                        @foreach($poll->options as $option)
                            <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 transition group">
                                <input type="radio" wire:model="selectedOption" value="{{ $option->id }}" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="ml-4 text-lg text-gray-700 group-hover:text-blue-700">{{ $option->option_text }}</span>
                            </label>
                        @endforeach
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                        Cast My Vote
                    </button>
                </form>
            @else
                <div class="mt-8 space-y-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Poll Results</h3>
                    
                    @php
                        $totalVotes = array_sum(array_column($results, 'votes'));
                    @endphp

                    @foreach($results as $result)
                        @php
                            $percentage = $totalVotes > 0 ? round(($result['votes'] / $totalVotes) * 100) : 0;
                        @endphp
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-gray-700 font-medium">{{ $result['text'] }}</span>
                                <span class="text-sm font-semibold text-blue-600">{{ $result['votes'] }} votes ({{ $percentage }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden shadow-inner">
                                <div class="bg-blue-600 h-4 rounded-full transition-all duration-1000 ease-out shadow" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-8 pt-6 border-t text-center">
                        <p class="text-gray-500 italic">Results update in real-time as votes come in!</p>
                        <p class="text-sm text-gray-400 mt-2">Total votes: {{ $totalVotes }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

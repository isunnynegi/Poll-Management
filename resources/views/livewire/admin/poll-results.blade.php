<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
    <div class="flex justify-between items-center mb-8 border-b pb-6">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">{{ $poll->question }}</h2>
            <p class="text-slate-500 mt-2">Real-time voting results for this poll.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="text-slate-600 hover:text-slate-900 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Dashboard
        </a>
    </div>

    <div class="space-y-8">
        @php
            $totalVotes = array_sum(array_column($results, 'votes'));
        @endphp

        @foreach($results as $result)
            @php
                $percentage = $totalVotes > 0 ? round(($result['votes'] / $totalVotes) * 100) : 0;
            @endphp
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-lg font-semibold text-gray-700">{{ $result['text'] }}</span>
                    <div class="text-right">
                        <span class="block text-2xl font-bold text-blue-600">{{ $result['votes'] }}</span>
                        <span class="text-sm text-slate-400">{{ $percentage }}% of total</span>
                    </div>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-6 overflow-hidden shadow-inner relative">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-6 rounded-full transition-all duration-1000 ease-out shadow-lg" style="width: {{ $percentage }}%">
                        @if($percentage > 5)
                            <span class="absolute inset-0 flex items-center justify-center text-[10px] font-bold text-white uppercase tracking-wider">
                                {{ $percentage }}%
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-12 flex justify-center">
        <div class="bg-blue-50 px-6 py-4 rounded-2xl border border-blue-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <span class="block text-sm text-blue-400 font-semibold uppercase tracking-wider">Total Participation</span>
                <span class="text-2xl font-bold text-blue-900">{{ $totalVotes }} People Voted</span>
            </div>
        </div>
    </div>
</div>

<?php

namespace App\Repositories\Implementations;

use App\Models\Vote;
use App\Models\PollOption;
use App\Repositories\Interfaces\VoteRepositoryInterface;
use Illuminate\Support\Facades\DB;

class VoteRepository implements VoteRepositoryInterface
{
    public function create(array $data): Vote
    {
        return Vote::create($data);
    }

    public function hasVoted(string $pollId, ?string $userId, ?string $ip): bool
    {
        $query = Vote::where('poll_id', $pollId);

        if ($userId) {
            return $query->where('user_id', $userId)->exists();
        }

        return $query->where('voter_ip', $ip)->exists();
    }

    public function getResults(string $pollId): array
    {
        return PollOption::where('poll_id', $pollId)
            ->withCount('votes')
            ->get()
            ->map(function ($option) {
                return [
                    'id' => $option->id,
                    'text' => $option->option_text,
                    'votes' => $option->votes_count,
                ];
            })
            ->toArray();
    }
}

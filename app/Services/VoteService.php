<?php

namespace App\Services;

use App\Repositories\Interfaces\VoteRepositoryInterface;
use App\Events\VoteCast;
use Illuminate\Support\Facades\DB;
use App\Models\Vote;

class VoteService
{
    public function __construct(
        protected VoteRepositoryInterface $voteRepository
    ) {}

    public function castVote(string $pollId, string $optionId, ?string $userId, string $ip): ?Vote
    {
        if ($this->hasVoted($pollId, $userId, $ip)) {
            return null;
        }

        return DB::transaction(function () use ($pollId, $optionId, $userId, $ip) {
            $vote = $this->voteRepository->create([
                'poll_id' => $pollId,
                'poll_option_id' => $optionId,
                'user_id' => $userId,
                'voter_ip' => $ip,
            ]);

            broadcast(new VoteCast($pollId));

            return $vote;
        });
    }

    public function hasVoted(string $pollId, ?string $userId, ?string $ip): bool
    {
        return $this->voteRepository->hasVoted($pollId, $userId, $ip);
    }

    public function getResults(string $pollId): array
    {
        return $this->voteRepository->getResults($pollId);
    }
}

<?php

namespace App\Repositories\Interfaces;

use App\Models\Vote;

interface VoteRepositoryInterface
{
    public function create(array $data): Vote;
    public function hasVoted(string $pollId, ?string $userId, ?string $ip): bool;
    public function getResults(string $pollId): array;
}

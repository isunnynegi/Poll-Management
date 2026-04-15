<?php

namespace App\Repositories\Implementations;

use App\Models\Poll;
use App\Repositories\Interfaces\PollRepositoryInterface;
use Illuminate\Support\Collection;

class PollRepository implements PollRepositoryInterface
{
    public function getAllByAdmin(string $adminId): Collection
    {
        return Poll::where('created_by', $adminId)->withCount('votes')->get();
    }

    public function findBySlug(string $slug): ?Poll
    {
        return Poll::where('slug', $slug)->with('options')->first();
    }

    public function create(array $data): Poll
    {
        return Poll::create($data);
    }

    public function update(string $id, array $data): bool
    {
        $poll = Poll::findOrFail($id);
        return $poll->update($data);
    }

    public function delete(string $id): bool
    {
        return Poll::destroy($id);
    }

    public function findById(string $id): ?Poll
    {
        return Poll::with('options')->find($id);
    }
}

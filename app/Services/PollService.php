<?php

namespace App\Services;

use App\Repositories\Interfaces\PollRepositoryInterface;
use Illuminate\Support\Str;
use App\Models\Poll;

class PollService
{
    public function __construct(
        protected PollRepositoryInterface $pollRepository
    ) {}

    public function createPoll(array $data, string $adminId): Poll
    {
        $data['slug'] = Str::slug($data['question']) . '-' . Str::random(5);
        $data['created_by'] = $adminId;

        $poll = $this->pollRepository->create([
            'question' => $data['question'],
            'slug' => $data['slug'],
            'is_active' => true,
            'created_by' => $adminId
        ]);

        foreach ($data['options'] as $optionText) {
            $poll->options()->create(['option_text' => $optionText]);
        }

        return $poll;
    }

    public function updatePoll(string $id, array $data): bool
    {
        $poll = $this->pollRepository->findById($id);
        if (!$poll) return false;

        $poll->update(['question' => $data['question']]);

        // Simple strategy: rebuild options if changed significantly, or just update.
        // For this demo, let's just handle question update.
        return true;
    }

    public function deletePoll(string $id): bool
    {
        return $this->pollRepository->delete($id);
    }
}

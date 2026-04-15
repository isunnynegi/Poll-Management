<?php

namespace App\Repositories\Interfaces;

use App\Models\Poll;
use Illuminate\Support\Collection;

interface PollRepositoryInterface
{
    public function getAllByAdmin(string $adminId): Collection;
    public function findBySlug(string $slug): ?Poll;
    public function create(array $data): Poll;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
    public function findById(string $id): ?Poll;
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title',
        'slug',
        'main_image',
        'description',
        'body',
        'tech_stack',
        'link',
        'github',
        'sort_order',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected array $castHandlers = [];
    protected array $casts = [
        'tech_stack' => 'json-array',
    ];

    public function getLatest(int $limit = 7): array
    {
        return $this->orderBy('sort_order', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function getBySlug(string $slug): array|object|null
    {
        return $this->where('slug', $slug)->first();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class SkillModel extends Model
{
    protected $table = 'skills';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title',
        'icon',
        'external_icon_url',
        'sort_order',
    ];

    protected $useTimestamps = false;

    public function getAllOrdered(): array
    {
        return $this->orderBy('sort_order', 'ASC')
            ->orderBy('title', 'ASC')
            ->findAll();
    }
}

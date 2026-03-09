<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'text',
        'approved',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';

    public function getApproved(): array
    {
        return $this->where('approved', 1)
            ->orderBy('created_at', 'DESC')
            ->findAll(50);
    }
}

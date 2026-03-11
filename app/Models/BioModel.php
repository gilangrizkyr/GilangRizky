<?php

namespace App\Models;

use CodeIgniter\Model;

class BioModel extends Model
{
    protected $table = 'bio';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;

    protected $allowedFields = [
        'id',
        'name',
        'title',
        'photo',
        'lanyard_photo',
        'github_url',
        'instagram_url',
        'email',
    ];

    protected $useTimestamps = true;
    protected $updatedField = 'updated_at';
    protected $createdField = '';

    public function getBio(): array|object|null
    {
        return $this->find(1);
    }
}

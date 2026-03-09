<?php

namespace App\Controllers;

use App\Models\CommentModel;
use CodeIgniter\HTTP\ResponseInterface;

class CommentController extends BaseController
{
    public function store(): ResponseInterface
    {
        $model = new CommentModel();

        $name = trim($this->request->getPost('name') ?? 'Anonymous');
        $text = trim($this->request->getPost('text') ?? '');

        if (empty($text)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Komentar tidak boleh kosong.',
            ])->setStatusCode(422);
        }

        $model->insert([
            'name' => $name ?: 'Anonymous',
            'text' => $text,
            'approved' => 1,  // auto-approve untuk portfolio pribadi
        ]);

        $id = $model->getInsertID();

        return $this->response->setJSON([
            'success' => true,
            'comment' => [
                'id' => $id,
                'name' => $name ?: 'Anonymous',
                'text' => $text,
                'created_at' => date('Y-m-d H:i:s'),
                'time_ago' => 'Baru saja',
            ],
        ]);
    }
}

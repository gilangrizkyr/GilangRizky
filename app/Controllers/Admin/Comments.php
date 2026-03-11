<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;

class Comments extends BaseController
{
    public function index()
    {
        $model = new CommentModel();
        $data = [
            'title' => 'Moderate Comments',
            'comments' => $model->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/comments/index', $data);
    }

    public function approve($id)
    {
        $model = new CommentModel();
        if ($model->update($id, ['approved' => 1])) {
            return redirect()->to('/admin/comments')->with('success', 'Comment activated and live.');
        }
        return redirect()->to('/admin/comments')->with('error', 'Failed to approve');
    }

    public function deactivate($id)
    {
        $model = new CommentModel();
        if ($model->update($id, ['approved' => 0])) {
            return redirect()->to('/admin/comments')->with('success', 'Comment deactivated and hidden.');
        }
        return redirect()->to('/admin/comments')->with('error', 'Failed to deactivate');
    }

    public function delete($id)
    {
        $model = new CommentModel();
        if ($model->delete($id)) {
            return redirect()->to('/admin/comments')->with('success', 'Comment deleted');
        }
        return redirect()->to('/admin/comments')->with('error', 'Failed to delete');
    }
}

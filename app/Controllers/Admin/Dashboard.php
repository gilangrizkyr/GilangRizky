<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProjectModel;
use App\Models\CommentModel;
use App\Models\SkillModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $projectModel = new ProjectModel();
        $commentModel = new CommentModel();
        $skillModel = new SkillModel();

        $data = [
            'title' => 'Dashboard',
            'stats' => [
                'projects' => $projectModel->countAllResults(),
                'skills' => $skillModel->countAllResults(),
                'comments' => $commentModel->countAllResults(),
                'pending_comments' => $commentModel->where('approved', 0)->countAllResults(),
            ]
        ];

        return view('admin/dashboard', $data);
    }
}

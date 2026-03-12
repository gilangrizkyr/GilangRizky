<?php

namespace App\Controllers;

use App\Models\BioModel;
use App\Models\ProjectModel;
use App\Models\SkillModel;
use App\Models\CommentModel;

class HomeController extends BaseController
{
    public function index(): string
    {
        $bioModel = new BioModel();
        $projectModel = new ProjectModel();
        $skillModel = new SkillModel();
        $commentModel = new CommentModel();

        $data = [
            'bio' => $bioModel->getBio(),
            'projects' => $projectModel->getLatest(7),
            'skills' => $skillModel->getAllOrdered(),
            'comments' => $commentModel->getApproved(),
        ];

        return view('home/index', $data);
    }
}

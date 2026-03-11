<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\BioModel;

class ProjectController extends BaseController
{
    protected $bioModel;
    protected $projectModel;

    public function __construct()
    {
        $this->bioModel = new BioModel();
        $this->projectModel = new ProjectModel();
    }

    public function index(): string
    {
        $data = [
            'bio' => $this->bioModel->getBio(),
            'projects' => $this->projectModel->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return view('projects/index', $data);
    }

    public function show(string $slug): string
    {
        $project = $this->projectModel->getBySlug($slug);

        if (!$project) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Proyek '{$slug}' tidak ditemukan.");
        }

        $data = [
            'bio' => $this->bioModel->getBio(),
            'project' => $project
        ];

        return view('projects/show', $data);
    }
}

<?php

namespace App\Controllers;

use App\Models\ProjectModel;

class ProjectController extends BaseController
{
    public function index(): string
    {
        $model = new ProjectModel();
        $data = [
            'projects' => $model->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return view('projects/index', $data);
    }

    public function show(string $slug): string
    {
        $model = new ProjectModel();
        $project = $model->getBySlug($slug);

        if (!$project) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Proyek '{$slug}' tidak ditemukan.");
        }

        return view('projects/show', ['project' => $project]);
    }
}

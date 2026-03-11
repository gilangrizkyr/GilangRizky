<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProjectModel;

class Projects extends BaseController
{
    public function index()
    {
        $model = new ProjectModel();
        $data = [
            'title' => 'Manage Projects',
            'projects' => $model->orderBy('id', 'DESC')->findAll()
        ];
        return view('admin/projects/index', $data);
    }

    public function new()
    {
        return view('admin/projects/form', ['title' => 'Add New Project']);
    }

    public function create()
    {
        $model = new ProjectModel();

        if (
            !$this->validate([
                'title' => 'required|min_length[3]|max_length[255]',
                'description' => 'required',
            ])
        ) {
            return redirect()->back()->withInput()->with('error', 'Please check your inputs.');
        }

        $img = $this->request->getFile('main_image');
        $imgName = '';
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move('uploads/projects', $imgName);
            $imgName = '/uploads/projects/' . $imgName;
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => url_title($this->request->getPost('title'), '-', true),
            'description' => $this->request->getPost('description'),
            'main_image' => $imgName,
            'github' => $this->request->getPost('github'),
            'link' => $this->request->getPost('link'),
            'tech_stack' => array_map('trim', explode(',', $this->request->getPost('tech_stack') ?? '')),
        ];

        if ($model->insert($data)) {
            return redirect()->to('/admin/projects')->with('success', 'Project created successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to create project');
        }
    }

    public function edit($id)
    {
        $model = new ProjectModel();
        $project = $model->find($id);
        $ts = $project['tech_stack'];
        $project['tech_stack'] = is_array($ts) ? implode(',', $ts) : implode(',', json_decode($ts ?? '[]', true) ?? []);

        $data = [
            'title' => 'Edit Project',
            'project' => $project
        ];
        return view('admin/projects/form', $data);
    }

    public function update($id)
    {
        $model = new ProjectModel();

        if (
            !$this->validate([
                'title' => 'required|min_length[3]|max_length[255]',
                'description' => 'required',
            ])
        ) {
            return redirect()->back()->withInput()->with('error', 'Please check your inputs.');
        }

        $oldProject = $model->find($id);

        $img = $this->request->getFile('main_image');
        $imgName = $oldProject['main_image'];

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move('uploads/projects', $imgName);
            $imgName = '/uploads/projects/' . $imgName;

            // Delete old image if exists
            if (!empty($oldProject['main_image']) && file_exists(FCPATH . $oldProject['main_image'])) {
                @unlink(FCPATH . $oldProject['main_image']);
            }
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => url_title($this->request->getPost('title'), '-', true),
            'description' => $this->request->getPost('description'),
            'main_image' => $imgName,
            'github' => $this->request->getPost('github'),
            'link' => $this->request->getPost('link'),
            'tech_stack' => array_map('trim', explode(',', $this->request->getPost('tech_stack') ?? '')),
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('/admin/projects')->with('success', 'Project updated successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update project');
        }
    }

    public function delete($id)
    {
        $model = new ProjectModel();
        $project = $model->find($id);

        if ($project) {
            if (!empty($project['main_image']) && file_exists(FCPATH . $project['main_image'])) {
                @unlink(FCPATH . $project['main_image']);
            }
            $model->delete($id);
            return redirect()->to('/admin/projects')->with('success', 'Project deleted successfully');
        }

        return redirect()->to('/admin/projects')->with('error', 'Project not found');
    }
}

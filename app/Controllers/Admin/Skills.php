<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SkillModel;

class Skills extends BaseController
{
    public function index()
    {
        $model = new SkillModel();
        $data = [
            'title' => 'Manage Skills',
            'skills' => $model->getAllOrdered()
        ];
        return view('admin/skills/index', $data);
    }

    public function new()
    {
        return view('admin/skills/form', ['title' => 'Add New Skill']);
    }

    public function create()
    {
        $model = new SkillModel();
        $data = [
            'title' => $this->request->getPost('title'),
            'external_icon_url' => $this->request->getPost('external_icon_url'),
            'sort_order' => $this->request->getPost('sort_order'),
        ];

        if ($model->insert($data)) {
            return redirect()->to('/admin/skills')->with('success', 'Skill added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to add skill');
        }
    }

    public function edit($id)
    {
        $model = new SkillModel();
        $data = [
            'title' => 'Edit Skill',
            'skill' => $model->find($id)
        ];
        return view('admin/skills/form', $data);
    }

    public function update($id)
    {
        $model = new SkillModel();
        $data = [
            'title' => $this->request->getPost('title'),
            'external_icon_url' => $this->request->getPost('external_icon_url'),
            'sort_order' => $this->request->getPost('sort_order'),
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('/admin/skills')->with('success', 'Skill updated successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update skill');
        }
    }

    public function delete($id)
    {
        $model = new SkillModel();
        if ($model->delete($id)) {
            return redirect()->to('/admin/skills')->with('success', 'Skill deleted successfully');
        } else {
            return redirect()->to('/admin/skills')->with('error', 'Failed to delete skill');
        }
    }
}

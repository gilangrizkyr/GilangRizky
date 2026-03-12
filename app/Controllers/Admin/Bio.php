<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BioModel;

class Bio extends BaseController
{
    public function index()
    {
        $model = new BioModel();
        $data = [
            'title' => 'Manage Bio',
            'bio' => $model->getBio()
        ];
        return view('admin/bio', $data);
    }

    public function update()
    {
        $model = new BioModel();

        if (
            !$this->validate([
                'name' => 'required|min_length[3]',
                'title' => 'required',
                'email' => 'permit_empty|valid_email',
            ])
        ) {
            return redirect()->back()->withInput()->with('error', 'Invalid input data.');
        }

        $id = $this->request->getPost('id');
        $oldBio = $model->getBio();

        // Hero Photo
        $heroImg = $this->request->getFile('photo_upload');
        $heroPath = $this->request->getPost('photo');

        if ($heroImg && $heroImg->isValid() && !$heroImg->hasMoved()) {
            try {
                $imgName = $heroImg->getRandomName();
                $heroImg->move('uploads/profile', $imgName);
                $heroPath = '/uploads/profile/' . $imgName;

                $oldHero = $oldBio['photo'] ?? '';
                if (!empty($oldHero) && str_contains($oldHero, '/uploads/profile/') && file_exists(FCPATH . $oldHero)) {
                    @unlink(FCPATH . $oldHero);
                }
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Gagal upload foto ke server Vercel (Read-only). Silakan gunakan kolom "Photo URL" sebagai alternatif.');
            }
        }

        // Lanyard Photo
        $lanyardImg = $this->request->getFile('lanyard_photo_upload');
        $lanyardPath = $this->request->getPost('lanyard_photo');

        if ($lanyardImg && $lanyardImg->isValid() && !$lanyardImg->hasMoved()) {
            try {
                $imgName = $lanyardImg->getRandomName();
                $lanyardImg->move('uploads/profile', $imgName);
                $lanyardPath = '/uploads/profile/' . $imgName;

                $oldLanyard = $oldBio['lanyard_photo'] ?? '';
                if (!empty($oldLanyard) && str_contains($oldLanyard, '/uploads/profile/') && file_exists(FCPATH . $oldLanyard)) {
                    @unlink(FCPATH . $oldLanyard);
                }
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Gagal upload lanyard ke server Vercel (Read-only). Silakan gunakan kolom "Photo URL" sebagai alternatif.');
            }
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'title' => $this->request->getPost('title'),
            'github_url' => $this->request->getPost('github_url'),
            'instagram_url' => $this->request->getPost('instagram_url'),
            'email' => $this->request->getPost('email'),
            'photo' => $heroPath,
            'lanyard_photo' => $lanyardPath,
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('/admin/bio')->with('success', 'Bio updated successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update bio');
        }
    }
}

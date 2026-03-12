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
            $tempPath = $heroImg->getTempName();

            // Compress and Resize using CI4 Image service
            \Config\Services::image()
                ->withFile($tempPath)
                ->resize(1200, 1200, true, 'height')
                ->save($tempPath, 70);

            $type = $heroImg->getClientMimeType();
            $data = file_get_contents($tempPath);
            $heroPath = 'data:' . $type . ';base64,' . base64_encode($data);
        }

        // Lanyard Photo
        $lanyardImg = $this->request->getFile('lanyard_photo_upload');
        $lanyardPath = $this->request->getPost('lanyard_photo');

        if ($lanyardImg && $lanyardImg->isValid() && !$lanyardImg->hasMoved()) {
            $tempPath = $lanyardImg->getTempName();

            // Compress and Resize
            \Config\Services::image()
                ->withFile($tempPath)
                ->resize(800, 800, true, 'height')
                ->save($tempPath, 70);

            $type = $lanyardImg->getClientMimeType();
            $data = file_get_contents($tempPath);
            $lanyardPath = 'data:' . $type . ';base64,' . base64_encode($data);
        }

        // Open Graph Image
        $ogImg = $this->request->getFile('og_image_upload');
        $ogPath = $this->request->getPost('og_image');

        if ($ogImg && $ogImg->isValid() && !$ogImg->hasMoved()) {
            $tempPath = $ogImg->getTempName();

            // Compress and Resize (OG recommended 1200x630)
            \Config\Services::image()
                ->withFile($tempPath)
                ->resize(1200, 630, true)
                ->save($tempPath, 75);

            $type = $ogImg->getClientMimeType();
            $data = file_get_contents($tempPath);
            $ogPath = 'data:' . $type . ';base64,' . base64_encode($data);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'title' => $this->request->getPost('title'),
            'github_url' => $this->request->getPost('github_url'),
            'instagram_url' => $this->request->getPost('instagram_url'),
            'email' => $this->request->getPost('email'),
            'photo' => $heroPath,
            'lanyard_photo' => $lanyardPath,
            'og_image' => $ogPath,
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('/admin/bio')->with('success', 'Bio updated successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update bio');
        }
    }
}

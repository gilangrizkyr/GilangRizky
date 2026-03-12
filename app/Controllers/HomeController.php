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

    public function ogImage()
    {
        $bioModel = new BioModel();
        $bio = $bioModel->getBio();

        if (isset($bio['og_image']) && str_starts_with($bio['og_image'], 'data:image')) {
            // Extract data
            if (preg_match('/^data:image\/(\w+);base64,(.+)$/', $bio['og_image'], $matches)) {
                $type = $matches[1];
                $data = base64_decode($matches[2]);

                return $this->response
                    ->setHeader('Content-Type', 'image/' . ($type === 'jpeg' ? 'jpeg' : $type))
                    ->setHeader('Cache-Control', 'public, max-age=86400') // Cache for 1 day
                    ->setBody($data);
            }
        }

        // Fallback to static file if no DB image or invalid
        $file = FCPATH . 'assets/images/og-preview.png';
        if (file_exists($file)) {
            $data = file_get_contents($file);
            return $this->response
                ->setHeader('Content-Type', 'image/png')
                ->setBody($data);
        }

        return $this->response->setStatusCode(404);
    }
}

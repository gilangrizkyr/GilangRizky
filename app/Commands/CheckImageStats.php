<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\BioModel;
use App\Models\ProjectModel;

class CheckImageStats extends BaseCommand
{
    protected $group = 'Maintenance';
    protected $name = 'check:images';
    protected $description = 'Checks the dimensions and sizes of Base64 images in the database.';

    public function run(array $params)
    {
        $bioModel = new BioModel();
        $projectModel = new ProjectModel();

        CLI::write('Bio Images:', 'yellow');
        $bio = $bioModel->find(1);
        if ($bio) {
            foreach (['photo', 'lanyard_photo', 'og_image'] as $field) {
                if (isset($bio[$field]) && str_starts_with($bio[$field], 'data:image')) {
                    $this->report($field, $bio[$field]);
                }
            }
        }

        CLI::write("\nProject Images:", 'yellow');
        $projects = $projectModel->findAll();
        foreach ($projects as $p) {
            $img = is_array($p) ? ($p['main_image'] ?? '') : ($p->main_image ?? '');
            $title = is_array($p) ? ($p['title'] ?? '') : ($p->title ?? '');
            $id = is_array($p) ? ($p['id'] ?? '') : ($p->id ?? '');

            if ($img) {
                if (str_starts_with($img, 'data:image')) {
                    $this->report("Project $id ($title)", $img);
                } else {
                    CLI::write("- Project $id ($title): External URL | " . substr($img, 0, 50) . "...", 'cyan');
                }
            } else {
                CLI::write("- Project $id ($title): No Image", 'red');
            }
        }
    }

    private function report($label, $base64)
    {
        $size = strlen($base64);
        preg_match('/^data:image\/(\w+);base64,(.+)$/', $base64, $matches);
        $data = base64_decode($matches[2] ?? '');

        $width = 0;
        $height = 0;
        if ($data) {
            $img = @imagecreatefromstring($data);
            if ($img) {
                $width = imagesx($img);
                $height = imagesy($img);
                imagedestroy($img);
            }
        }

        CLI::write(sprintf("- %-25s: %d x %d | %d KB", $label, $width, $height, round($size / 1024)), 'green');
    }
}

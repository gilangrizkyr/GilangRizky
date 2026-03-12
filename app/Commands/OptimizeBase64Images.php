<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\BioModel;
use App\Models\ProjectModel;

class OptimizeBase64Images extends BaseCommand
{
    protected $group = 'Maintenance';
    protected $name = 'optimize:images';
    protected $description = 'Resizes and compresses existing Base64 images in the database to fix Vercel payload limits.';

    public function run(array $params)
    {
        $bioModel = new BioModel();
        $projectModel = new ProjectModel();

        CLI::write('Optimizing Bio images...', 'yellow');
        $bio = $bioModel->find(1);
        if ($bio) {
            $updated = false;
            foreach (['photo', 'lanyard_photo', 'og_image'] as $field) {
                if (isset($bio[$field]) && str_starts_with($bio[$field], 'data:image')) {
                    $oldSize = strlen($bio[$field]);
                    $bio[$field] = $this->optimize($bio[$field], ($field === 'lanyard_photo' ? 400 : 1200));
                    $newSize = strlen($bio[$field]);
                    CLI::write("- Managed $field: " . round($oldSize / 1024) . "KB -> " . round($newSize / 1024) . "KB", 'green');
                    $updated = true;
                }
            }
            if ($updated) {
                $bioModel->update(1, $bio);
                CLI::write('Bio updated.', 'cyan');
            }
        }

        CLI::write('Optimizing Projects images...', 'yellow');
        $projects = $projectModel->findAll();
        foreach ($projects as $p) {
            if (isset($p['main_image']) && str_starts_with($p['main_image'], 'data:image')) {
                $oldSize = strlen($p['main_image']);
                $p['main_image'] = $this->optimize($p['main_image'], 1200);
                $newSize = strlen($p['main_image']);
                CLI::write("- Project {$p['id']}: " . round($oldSize / 1024) . "KB -> " . round($newSize / 1024) . "KB", 'green');
                $projectModel->update($p['id'], ['main_image' => $p['main_image']]);
            }
        }

        CLI::write('Done!', 'white', 'green');
    }

    private function optimize(string $base64, int $maxWidth): string
    {
        try {
            // Extract data from URI: data:image/xxx;base64,xxxx
            if (!preg_match('/^data:image\/(\w+);base64,(.+)$/', $base64, $matches)) {
                return $base64;
            }

            $imgData = base64_decode($matches[2]);
            $tempFile = tempnam(sys_get_temp_dir(), 'img_opt');
            file_put_contents($tempFile, $imgData);

            $image = \Config\Services::image()
                ->withFile($tempFile);

            // Only resize if either dimension > maxWidth
            if ($image->getWidth() > $maxWidth || $image->getHeight() > $maxWidth) {
                $image->resize($maxWidth, $maxWidth, true, 'auto');
            }

            // Save as JPEG with 70% quality
            $image->save($tempFile, 70);

            $optimizedData = file_get_contents($tempFile);
            unlink($tempFile);

            return 'data:image/jpeg;base64,' . base64_encode($optimizedData);
        } catch (\Exception $e) {
            CLI::error('Failed to optimize: ' . $e->getMessage());
            return $base64;
        }
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IncreaseImageColumnSizes extends Migration
{
    public function up()
    {
        // Change 'photo' and 'lanyard_photo' in 'bio' table to TEXT for Base64 storage
        $fields = [
            'photo' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'lanyard_photo' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ];
        $this->forge->modifyColumn('bio', $fields);

        // Change 'main_image' in 'projects' table to TEXT for Base64 storage
        $fields = [
            'main_image' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ];
        $this->forge->modifyColumn('projects', $fields);
    }

    public function down()
    {
        // Revert back if needed (varchars)
        $fields = [
            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'lanyard_photo' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
        ];
        $this->forge->modifyColumn('bio', $fields);

        $fields = [
            'main_image' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
        ];
        $this->forge->modifyColumn('projects', $fields);
    }
}

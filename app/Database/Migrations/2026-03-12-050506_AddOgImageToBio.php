<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOgImageToBio extends Migration
{
    public function up()
    {
        $fields = [
            'og_image' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ];
        $this->forge->addColumn('bio', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('bio', 'og_image');
    }
}

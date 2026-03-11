<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLanyardPhotoToBio extends Migration
{
    public function up()
    {
        $this->forge->addColumn('bio', [
            'lanyard_photo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'photo'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('bio', 'lanyard_photo');
    }
}

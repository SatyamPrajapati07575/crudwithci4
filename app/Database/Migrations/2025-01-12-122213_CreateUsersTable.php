<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
            ],
            'desc' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'profile' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'gender' => [
                'type'       => 'ENUM',
                'constraint' => ['male', 'female', 'other'],
            ],
            'skills' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}

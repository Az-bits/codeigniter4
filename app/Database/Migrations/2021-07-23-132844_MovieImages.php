<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MovieImages extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
					'type'           => 'INT',
					'constraint'     => 5,
					'unsigned'       => true,
					'auto_increment' => true,
			],
			'movie_id'          => [
					'type'           => 'INT',
					'constraint'     => 5,
					'unsigned'       => true, 
			],
			'image'       => [
					'type'       => 'VARCHAR',
					'constraint' => '100',
			]
			
	]);
	$this->forge->addKey('id', true);
	$this->forge->createTable('movie_images');

	}

	public function down()
	{
		$this->forge->dropTable('movie_images');
	}
}

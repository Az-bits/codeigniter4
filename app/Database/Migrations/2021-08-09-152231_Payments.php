<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payments extends Migration
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
			'price'          => [
				'type'           => 'DECIMAL',
				'constraint'     => '10,2',
				'default'       => 5.00
			],
			'user_id' => [
				'type' => 'INT',
				'constraint'   => 5,
				'unsigned' => true,
			],
			'e_id' => [
				'type' => 'INT',
				'constraint'     => 5,
				'unsigned' => true,
			],
			'model'       => [
				'type'       => 'VARCHAR',
				'constraint' => '10',
			],
			'created_at' => [
				'type' => 'DATETIME',
			],
			'updated_at' => [
				'type' => 'DATETIME',
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('payments');
	}

	public function down()
	{
		$this->forge->dropTable('payments');
	}
}

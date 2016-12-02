<?php
class Migration_Create_workday extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'idWorkday' => array(
				'type' => 'INT',
				'constraint' => 4,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'workday' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'typeWorkday' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'status' => array(
				'type' => 'INT',
				'constraint' => 3,
			),
			'idTurn' => array(
				'type' => 'INT',
				'constraint' => 3,
			),
		));
		$this->dbforge->add_key('idWorkday');
		$this->dbforge->create_table('workday');
	}

	public function down()
	{
		$this->dbforge->drop_table('workday');
	}
}
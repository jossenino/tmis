<?php
class Migration_Create_turns extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'idTurn' => array(
				'type' => 'INT',
				'constraint' => 4,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'turn' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'typeTurn' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'status' => array(
				'type' => 'INT',
				'constraint' => 3,
			),
		));
		$this->dbforge->add_key('idTurn');
		$this->dbforge->create_table('turns');
	}

	public function down()
	{
		$this->dbforge->drop_table('turns');
	}
}
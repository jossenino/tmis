<?php
class Migration_Create_profiles extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'idProfile' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'profile' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'description' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
			),
		));
		$this->dbforge->add_key('idProfile');
		$this->dbforge->create_table('profiles');
	}

	public function down()
	{
		$this->dbforge->drop_table('profiles');
	}
}
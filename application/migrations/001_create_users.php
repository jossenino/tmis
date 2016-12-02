<?php
class Migration_Create_users extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'idUsers' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'userName' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'idProfile' => array(
				'type' => 'INT',
				'constraint' => 3,
			),
			'status' => array(
				'type' => 'INT',
				'constraint' => 3,
			),
			'idCompany' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
		));
		$this->dbforge->add_key('idUsers');
		$this->dbforge->create_table('users');
	}

	public function down()
	{
		$this->dbforge->drop_table('users');
	}
}

<?php
class Migration_Create_State extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'idCountry' => array(
        'type' => 'INT',
        'constraint' => 11
      ),
      'state' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'dateCreation' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      )
    ));
    $this->dbforge->add_key('id');
    $this->dbforge->create_table('state');
  }

  public function down()
  {
    $this->dbforge->drop_table('state');
  }
}
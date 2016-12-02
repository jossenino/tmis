
<?php
class Migration_Create_Country extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'country' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'dateCreation' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      )
    ));
    $this->dbforge->add_key('id');
    $this->dbforge->create_table('country');
  }

  public function down()
  {
    $this->dbforge->drop_table('country');
  }
}

<?php
class Migration_Create_City extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'idState' => array(
        'type' => 'INT',
        'constraint' => 11
      ),
      'city' => array('type' => 'VARCHAR',
        'constraint' => '150','type' => 'text',
      ),
      'dateCreation' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      )
    ));
    $this->dbforge->add_key('id');
    $this->dbforge->create_table('city');
  }

  public function down()
  {
    $this->dbforge->drop_table('city');
  }
}
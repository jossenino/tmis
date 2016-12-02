
<?php
class Migration_Create_navBar extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'url' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'nombreNavBar' => array(
        'type' => 'VARCHAR',
        'constraint' => '50',
      ),
      'idMenuSubMenu' => array(
        'type' => 'VARCHAR',
        'constraint' => '20',
      ),
      'iconClass' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'dropdown' => array(
        'type' => 'VARCHAR',
        'constraint' => '1',
      ),
      'order' => array(
        'type' => 'INT',
        'constraint' => '11',
      ),
      'status' => array(
        'type' => 'INT',
        'constraint' => 1,
      ),
    ));
    $this->dbforge->add_key('id');
    $this->dbforge->create_table('navBars');
  }

  public function down()
  {
    $this->dbforge->drop_table('navBars');
  }
}
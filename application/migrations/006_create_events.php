
<?php
class Migration_Create_events extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 10,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'title' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'description' => array(
        'type' => 'text',
      ),
      'url' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'color' => array(
        'type' => 'VARCHAR',
        'constraint' => '45',
      ),
      'date' => array(
        'type' => 'VARCHAR',
        'constraint' => '15',
      ),
      'endDate' => array(
        'type' => 'VARCHAR',
        'constraint' => '15',
      ),
      'typeEvent' => array(
        'type' => 'VARCHAR',
        'constraint' => '50',
      ),
      'status' => array(
        'type' => 'INT',
        'constraint' => 1,
      ),
      'idUsers' => array(
        'type' => 'INT',
        'constraint' => 11,
      ),
    ));
    $this->dbforge->add_key('id');
    $this->dbforge->create_table('events');
    $this->db->query('ALTER TABLE 'events' ADD FOREIGN KEY('idUsers') REFERENCES 'users'('idUsers') ON DELETE CASCADE ON UPDATE CASCADE');
  }

  public function down()
  {
    $this->dbforge->drop_table('events');
  }
}
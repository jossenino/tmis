
<?php
class Migration_Create_Schedule extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'idUsers' => array(
        'type' => 'INT',
        'constraint' => 11
      ),
      'idClient' => array(
        'type' => 'INT',
        'constraint' => 11
      ),
      'day' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'startDate' => array(
        'type' => 'VARCHAR',
        'constraint' => '20',
      ),
      'endDate' => array(
        'type' => 'VARCHAR',
        'constraint' => '20',
      ),
      'documento' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'hourValue' => array(
        'type' => 'VARCHAR',
        'constraint' => '20',
      ),
      'pay' => array(
        'type' => 'VARCHAR',
        'constraint' => '20',
      ),
      'total' => array(
        'type' => 'VARCHAR',
        'constraint' => '20',
      )
    ));
    $this->dbforge->add_key('id');
    $this->dbforge->create_table('schedule');
  }

  public function down()
  {
    $this->dbforge->drop_table('schedule');
  }
}
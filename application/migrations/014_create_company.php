
<?php
class Migration_Create_company extends CI_Migration {

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
      'companyName' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'typeDocument' => array(
        'type' => 'VARCHAR',
        'constraint' => '50',
      ),
      'numberDocument' => array(
        'type' => 'VARCHAR',
        'constraint' => '20',
      ),
      'class' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'phone' => array(
        'type' => 'VARCHAR',
        'constraint' => '30',
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'country' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'state' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'city' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'direction' => array(
        'type' => 'text',
      ),
      'status' => array(
        'type' => 'INT',
        'constraint' => 1,
      )
    ));
    $this->dbforge->add_key('id');
    $this->dbforge->create_table('companys');
  }

  public function down()
  {
    $this->dbforge->drop_table('companys');
  }
}
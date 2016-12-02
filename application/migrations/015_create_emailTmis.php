
<?php
class Migration_Create_emailTmis extends CI_Migration {

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
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'title' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
      'body' => array(
        'type' => 'text',
      ),
      'dateSend' => array(
        'type' => 'VARCHAR',
        'constraint' => '20',
      ),
      'status' => array(
        'type' => 'INT',
        'constraint' => 11
      ),
      'dateRead' => array(
        'type' => 'VARCHAR',
        'constraint' => '20',
      )
    ));
    $this->dbforge->add_key('id');
    $this->dbforge->create_table('emailTmis');
  }

  public function down()
  {
    $this->dbforge->drop_table('emailTmis');
  }
}
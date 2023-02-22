<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Migration_Blog extends CI_Migration {

    public function __construct() {

        parent::__construct();
        $this->load->dbforge();
    }

    public function up() {

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => 60
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id',TRUE);
        $this->dbforge->add_key('username');
        $this->dbforge->create_table('blogs',TRUE);
    }

    public function down() {

        $this->dbforge->drop_table( 'blogs', true );
    }
}
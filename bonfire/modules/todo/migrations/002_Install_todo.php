<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_todo extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`id` int(11) NOT NULL AUTO_INCREMENT');
			$this->dbforge->add_field("`todo_description` VARCHAR(255) NOT NULL");
			$this->dbforge->add_field("`todo_person` VARCHAR(255) NOT NULL");
			$this->dbforge->add_field("`created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'");
			$this->dbforge->add_field("`modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'");
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('todo');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('todo');

	}

	//--------------------------------------------------------------------

}
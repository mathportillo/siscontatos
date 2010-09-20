<?php

class configuracao extends Doctrine_record 
{
	public function setTableDefinition()
	{
		$this->hasColumn('nome', 'string', 255);
		$this->hasColumn('usuario_id' , 'integer', 4);
		$this->hasColumn('valor' ,'string', 255);
		
	}

	public function  setUp()
	{
	}
}

?>

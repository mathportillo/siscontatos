<?php

class Configuracao extends Doctrine_Record 
{
	public function setTableDefinition()
	{
		$this->hasColumn('nome', 'string', 255);
		$this->hasColumn('usuario_id' , 'integer', 4);
		$this->hasColumn('agenda_id','integer',4);
		$this->hasColumn('valor' ,'string', 255);
		$this->hasColumn('tipo','string',60);
	}

	public function  setUp()
	{
	}
}

?>

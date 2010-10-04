<?php

class Log extends Doctrine_Record
{
	public function SetTableDefinition()
	{
		$this->hasColumn('usuario_id','integer',4);	
		$this->hasColumn('agenda_id','integer',4);
		$this->hasColumn('observacao','string',255);
		$this->hasColumn('acao','string',255);
		$this->hasColumn('datahora','timestamp');		
	}
	
	public function SetUp()
		{
		$this->unique(array('usuario_id','agenda_id'));
		
		$this->hasOne('Usuario', array(
			'local' => 'usuario_id',
			'foreign' => 'id'
		));
		
		$this->hasOne('Agenda', array(
			'local' => 'agenda_id',
			'foreign' => 'id'
		));
	}
}
	
?>

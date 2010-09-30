<?

class Propriedade extends Doctrine_Record
{
	public function setTableDefinition()
	{
		$this->hasColumn('agenda_id', 'integer', 4);
		$this->hasColumn('nome', 'string', 30);
		$this->hasColumn('tipo', 'string', 10);
		$this->hasColumn('tamanho', 'integer', 4);
	}
	
	public function setUp()
	{
		
		$this->hasOne('Agenda', array(
			'local' => 'agenda_id',
			'foreign' => 'id'
		));
		
	}
}

?>
<?

class Agenda extends Doctrine_Record
{
	public function setTableDefinition()
	{
		$this->hasColumn('nome', 'string', 255);
	}

	public function setUp()
	{
		$this->hasMany('Contato as Contatos', array(
			'local' => 'id',
			'foreign' => 'agenda_id'
		));
		
		$this->hasMany('Permissao as Permissoes', array(
			'local' => 'id',
			'foreign' => 'agenda_id'
		));
	}
}

?>
<?

class Permissao extends Doctrine_Record
{
	public function setTableDefinition()
	{
		$this->hasColumn('usuario_id', 'integer', 4);
		$this->hasColumn('agenda_id', 'integer', 4);
		$this->hasColumn('pode_visualizar', 'boolean');
		$this->hasColumn('pode_editar', 'boolean');
		$this->hasColumn('pode_gerenciar', 'boolean');
	}

	public function setUp()
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
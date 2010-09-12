<?

class Contato extends Doctrine_Record
{
	public function setTableDefinition()
	{
		$this->hasColumn('nome', 'string', 255);
		$this->hasColumn('entidade', 'string', 255);
		$this->hasColumn('cargo', 'string', 255);
		$this->hasColumn('telefone1', 'string', 15);
		$this->hasColumn('telefone2', 'string', 15);
		$this->hasColumn('telefone3', 'string', 15);
		$this->hasColumn('celular1', 'string', 15);
		$this->hasColumn('celular2', 'string', 15);
		$this->hasColumn('fax', 'string', 15);
		$this->hasColumn('email1', 'string', 255);
		$this->hasColumn('email2', 'string', 255);
		$this->hasColumn('site', 'string', 255);
		$this->hasColumn('logradouro', 'string', 60);
		$this->hasColumn('numero', 'string', 10);
		$this->hasColumn('complemento', 'string', 60);
		$this->hasColumn('bairro', 'string', 60);
		$this->hasColumn('cep', 'string', 60);
		$this->hasColumn('cidade', 'string', 60);
		$this->hasColumn('estado', 'string', 60);
		$this->hasColumn('pais', 'string', 60);
		$this->hasColumn('observacao', 'string', 3000);
		$this->hasColumn('agenda_id', 'integer', 4);
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
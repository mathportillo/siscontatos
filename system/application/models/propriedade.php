<?php
class Propriedade extends Doctrine_Record
{
	public function setTableDefinition()
	{
		$this->hasColumn('agenda_id', 'integer', 5);
		$this->hasColumn('nome', 'string', 30);
		$this->hasColumn('tipo', 'string', 10);
		$this->hasColumn('tamanho', 'integer', 4);
	}
}
?>

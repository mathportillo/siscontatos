<?

class Agenda extends Doctrine_Record
{
	public static $_agenda_atual = null;
	
	public static function atual()
	{
		$CI =& get_instance();
		if ($CI->session->userdata('agenda') != '') {
			if (!self::$_agenda_atual) {
				$obj_agenda = Doctrine::getTable('Agenda')->find($CI->session->userdata('agenda'));
									
				if (!$obj_agenda) {
					self::$_agenda_atual = null;
					return self::$_agenda_atual;
				}
				self::$_agenda_atual = $obj_agenda;
				return self::$_agenda_atual;
			} else {
				return self::$_agenda_atual;
			}
		} else {
			self::$_agenda_atual = null;
			return self::$_agenda_atual;
		}
	}
	
	public function getPropriedades()
	{
		$obj_propriedades = Doctrine_Query::create()
							->from('Agenda a')
							->innerJoin('a.Propriedades p ON p.agenda_id = ' . $this->id)
							->execute();
		
		return $obj_propriedades;
	}
	
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
		
			$this->hasMany('Log as Logs',array(
			'local'=>'id',
			'foreign'=>'usuario_id'
		));
		
		$this->hasMany('Propriedade as Propriedades', array(
			'local' => 'id',
			'foreign' => 'agenda_id'
		));
		
	}
}

?>
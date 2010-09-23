<?

class Usuario extends Doctrine_Record
{
	public static $_usuario_atual = null;
	
	public static function atual()
	{
		$CI =& get_instance();
		if ($CI->session->userdata('id') != '') {
			if (!self::$_usuario_atual) {
				$obj_usuarios = Doctrine_Query::create()
									->from('Usuario u')
									->leftJoin('u.Permissoes p ON p.usuario_id = u.id AND p.agenda_id = ' . $CI->session->userdata('agenda'))
									->where('u.id = ' . $CI->session->userdata('id'))
									->execute();
									
				$obj_usuario = null;
				
				foreach ($obj_usuarios as $obj_usuario);
				if (!$obj_usuario || (count($obj_usuario->Permissoes) == 0)) {
					self::$_usuario_atual = null;
					return self::$_usuario_atual;
				}
				self::$_usuario_atual = $obj_usuario;
				return self::$_usuario_atual;
			} else {
				return self::$_usuario_atual;
			}
		} else {
			self::$_usuario_atual = null;
			return self::$_usuario_atual;
		}
	}
	
	public function getAgendas()
	{
		$obj_agendas = Doctrine_Query::create()
							->from('Agenda a')
							->innerJoin('a.Permissoes p ON p.agenda_id = a.id AND p.usuario_id = ' . $this->id)
							->execute();
							
		return $obj_agendas;
	}
	
	public function getConfiguracao($nome)
	{
		$obj_configuracoes = Doctrine_Query::create()
								->from('Configuracao c')
								->where('c.usuario_id = ' . $this->id)
								->andWhere('c.nome = \'' . $nome . '\'')
								->execute();
		
		$obj_configuracao = null;
		
		foreach ($obj_configuracoes as $obj_configuracao) break;
		
		if (!$obj_configuracao) {
			return ''; 
		}
		return $obj_configuracao->valor;
	}
	
	public function assertConfiguracao($nome)
	{
		$obj_configuracao = Usuario::getConfiguracao($nome);
		
		if ($obj_configuracao == '') {
			$obj_configuracao = new Configuracao();
			$obj_configuracao->usuario_id = Usuario::atual()->id;
			$obj_configuracao->nome = 'fichaspp';
		}
		
		return $obj_configuracao;
	}
	
	public function setTableDefinition()
	{
		$this->hasColumn('username', 'string', 255);
		$this->hasColumn('nome', 'string', 255);
		$this->hasColumn('password', 'string', 255);
		$this->hasColumn('pode_administrar', 'boolean');
		$this->hasColumn('ativo', 'boolean');
		$this->hasColumn('bloqueado', 'boolean');
		$this->hasColumn('hpe', 'integer');
		$this->hasColumn('hue', 'integer');
		$this->hasColumn('ec', 'integer', 4);
	}

	public function setUp()
	{
		$this->unique(array('username'));
		
		$this->hasMany('Permissao as Permissoes', array(
			'local' => 'id',
			'foreign' => 'usuario_id'
		));
		
		$this->hasMutator('password', '_encrypt_password');
	}

	protected function _encrypt_password($value)
	{
		$salt = "P@ssw0rd.";
		$this->_set('password', md5($salt . $value));
	}
}

?>
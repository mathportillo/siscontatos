<?
/*
 * Created on 20/09/2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
class Configuracoes extends Controller 
{
	public function Configuracoes()
	{
		parent::Controller();
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		$obj_configuracoes = Doctrine_Query::create()
								->from('Configuracao')
								->where('usuario_id = ' . Usuario::atual()->id)
								->andWhere('nome = \'fichaspp\'')
								->execute();
		if (count($obj_configuracoes) == 0) {
			$data['fichaspp'] = 20;
		} else {
			foreach ($obj_configuracoes as $obj_configuracao) break;
			$data['fichaspp'] = $obj_configuracao->valor;
		}
		$this->load->view('configuracoes_view',$data);
	}
 
	public function salvar_preferencias2()
	{
		// Salva as Fichas PP
		$obj_configuracoes = Doctrine_Query::create()
								->from('Configuracao')
								->where('usuario_id = ' . Usuario::atual()->id)
								->andWhere('nome = \'fichaspp\'')
								->execute();
		
		foreach ($obj_configuracoes as $obj_configuracao) break;
		$obj_configuracao->usuario_id = Usuario::atual()->id;
		$obj_configuracao->nome = 'fichaspp';
		$obj_configuracao->valor = $this->input->post('fichaspp');
		$obj_configuracao->save();
		
		// Salva Agenda Inicial
		$obj_configuracoes = Doctrine_Query::create()
								->from('Configuracao')
								->where('usuario_id = ' . Usuario::atual()->id)
								->andWhere('nome = \'agendainicial\'')
								->execute();
		
		foreach ($obj_configuracoes as $obj_configuracao) break;
		$obj_configuracao->usuario_id = Usuario::atual()->id;
		$obj_configuracao->nome = 'agendainicial';
		$obj_configuracao->valor = $this->input->post('agendainicial');
		$obj_configuracao->save();
		
		// TODO: Salva Tema
		
		redirect('configuracoes'); 
	}
	
	public function salvar_configuracoes() {
		if (!$this->_alterarsenha_submit_validate()) {
			$this->load->view('alterarsenha_view');
		} else {
			$u1 = Doctrine::getTable('Usuario')->findOneByUsername(Usuario::atual()->username);
			$u1->password = $this->input->post('newpassword');
			$u1->save();
			$data['aviso'] = 'Senha alterada com sucesso!';
			$this->load->view('principal_view', $data);
		}
	}
	
	public function _alterarsenha_submit_validate() {
			$this->form_validation->set_rules('password', 'Senha Atual',
						'required|callback_authenticate');
			$this->form_validation->set_rules('newpassword', 'Nova Senha',
						'required');
			$this->form_validation->set_rules('newpassword_confirm', 'Confirmar Nova Senha',
						'required|matches[newpassword]');
			$this->form_validation->set_message('authenticate', 'Senha atual inv&aacute;lida');
			return $this->form_validation->run();
	}
	
	public function authenticate() {
			$u1 = Doctrine::getTable('Usuario')->findOneByUsername(Usuario::atual()->username);
			$u2 = new Usuario();
			$u2->password = $this->input->post('password');
			if ($u1->password != $u2->password) {
				return false;
			}
			return true;
		}
}		
?>
		
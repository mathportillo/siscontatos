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
		$this->_lista_configuracoes();
	}
	
	public function _lista_configuracoes($data = array())
	{
		$data['fichaspp'] = Usuario::atual()->getConfiguracao('fichaspp');
		$this->load->view('configuracoes_view',$data);
	}
 
	public function salvar_preferencias()
	{
		// Salva as Fichas PP
		$obj_configuracao = Usuario::assertConfiguracao('fichaspp');
		$obj_configuracao->valor = $this->input->post('fichaspp');
		$obj_configuracao->save();
		
		// Salva Agenda Inicial
		$obj_configuracao = Usuario::assertConfiguracao('agendainicial');
		$obj_configuracao->valor = $this->input->post('agendainicial');
		$obj_configuracao->save();
		
		//  Salva Tema
		$obj_configuracao = Usuario::assertConfiguracao('tema');
		$obj_configuracao->valor = $this->input->post('tema');
		$obj_configuracao->save();		
		
		redirect('configuracoes');  
	}
	
	public function salvar_configuracoes() {
		if (!$this->_alterarsenha_submit_validate()) {
			$this->load_view('configuracoes_view');
		} else {
			$u1 = Doctrine::getTable('Usuario')->findOneByUsername(Usuario::atual()->username);
			$u1->password = $this->input->post('newpassword');
			$u1->save();
			$data['aviso'] = 'Senha alterada com sucesso!';
			$this->_lista_configuracoes($data);
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
		
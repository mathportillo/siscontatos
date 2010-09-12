<?
	/*****************************
	 * principal.php
	 * Controller Principal
	 *****************************/
	 
	class Principal extends Controller {

		// Construtor
		public function Principal() {
			parent::Controller();
			if (!Usuario::atual()) {
				redirect('login');
			}
			$this->load->library('form_validation');
		}

		// Função index - Mostra a tela principal
		public function index() {
			$this->load->view('principal_view');
		}

		// Função alterarsenha - Carrega o form de alteração de senha
		public function alterarsenha() {
			$this->load->view('alterarsenha_view');
		}

		// Função alterarsenha_submit - Processa a alteração de senha
		public function alterarsenha_submit() {
			if (!$this->_alterarsenha_submit_validate()) {
				$this->load->view('alterarsenha_view');
			} else {
				$u1 = Doctrine::getTable('Usuario')->findOneByUsername(Usuario::atual()->username);
				$u1->password = $this->input->post('newpassword');
				$u1->save();
				redirect('principal');
			}
		}

		// Função auxiliar _alterarsenha_submit_validate - valida o form de alteração de senha
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

		// Função auxiliar authenticate - Callback de form_validation para alteração de senha
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
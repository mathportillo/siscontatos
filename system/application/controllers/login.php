<?
	/*****************************
	 * login.php
	 * Controller Login
	 *****************************/
	 
	class Login extends Controller {

		// Construtor
		function Login()
		{
			parent::Controller();
		}

		// Função index - Carrega o form de login
		function index()
		{
			if (Usuario::atual()) {
				redirect('principal');
			}
			$data['error'] = "";
			$this->load->view('login_view',$data);
		}

		// Função auxiliar _entrou - Quando o usuário consegue logar, essa função é chamada
		function _entrou($u1)
		{
			$this->session->set_userdata('id', $u1->id);
			$obj_agendas = $u1->getAgendas();
			if (count($obj_agendas) == 0) {
				redirect('login/sair');	
				die();	
			}
			foreach ($obj_agendas as $obj_agenda) break;
	
			$this->session->set_userdata('agenda', $obj_agenda->id);
			redirect('principal');
		}

		// Função entrar - Processa os dados do form de login
		function entrar()
		{
			if (Usuario::atual()) {
				redirect('principal');
			}
			$hora_atual = date('U');
			$tempoA = 1800;
			$tempoB = 3600;
			$u1 = Doctrine::getTable('Usuario')->findOneByUsername($this->input->post('username'));
			if ($u1) {
				$u2 = new Usuario();
				$u2->password = $this->input->post('password');
	 			if ($u1->password == $u2->password) { // Acertou a senha ? SIM
					if ($u1->ativo) {
						if($u1->bloqueado){ // Bloqueado ? SIM
							if($hora_atual - $u1->hue > $tempoB) { // Passou tempoB ? SIM
								// Desbloqueia
								$u1->bloqueado = false;
								// Zera erros
								$u1->hpe = null;
								$u1->hue = null;
								$u1->ec = 0;
								$u1->save();
								// Entrou
								$this->_entrou($u1);
							} else { // Passou tempoB ? NAO
								$data['error'] = "Conta bloqueada temporariamente";
								$this->load->view('login_view',$data);
							}
						} else { // Bloqueado ? NAO
							// Zera erros
							$u1->hpe = null;
							$u1->hue = null;
							$u1->ec = 0;
							$u1->save();
							// Entrou
							$this->_entrou($u1);
						}
					} else {
					$data['error'] = "Conta Desativada";
					$this->load->view('login_view',$data);
					}
				} else { // Acertou a senha ? NAO
					if($u1->bloqueado) { // Bloqueado ? SIM
						if($hora_atual - $u1->hue > $tempoB) { // Passou tempoB ? SIM
							// Desbloqueia
							$u1->bloqueado = false;
							
							$u1->hpe = $hora_atual;
							$u1->hue = $hora_atual;
							$u1->ec = 1;
							$u1->save();
							
							$data['error'] = "Login Inv&aacute;lido";
							$this->load->view('login_view',$data);
						} else { // Passou tempoB ? NAO
							$data['error'] = "Conta bloqueada temporariamente";
							$this->load->view('login_view',$data);
						}
					} else { // Bloqueado ? NAO
						if($u1->ec == 0) { // Error count == 0 ? SIM
							$u1->hpe = $hora_atual;
							$u1->hue = $hora_atual;
							$u1->ec = 1;
							$u1->save();
							
							$data['error'] = "Login Inv&aacute;lido";
							$this->load->view('login_view',$data);
						} else { // Error count == 0 ? NAO
							if($hora_atual - $u1->hpe > $tempoA) { // Passou tempoA ? SIM
								$u1->hpe = $hora_atual;
								$u1->hue = $hora_atual;
								$u1->ec = 1;
								$u1->save();
							
								$data['error'] = "Login Inv&aacute;lido";
								$this->load->view('login_view',$data);
							} else { // Passou tempoA ? NAO
								if($u1->ec == 2) {
									// Bloqueia
									$u1->bloqueado = true;
									$u1->hue = $hora_atual;
									$u1->ec = 3;
									$u1->save();

									$data['error'] = "Login Inv&aacute;lido";
									$this->load->view('login_view',$data);
								} else {
									$u1->ec = 2;
									$u1->hue = $hora_atual;
									$u1->save();
									
									$data['error'] = "Login Inv&aacute;lido";
									$this->load->view('login_view',$data);
								}								
							}
						}
					}
				}
			} else {
				$data['error'] = "Login Inv&aacute;lido";
				$this->load->view('login_view',$data);
			}
		}
		
		// Função sair - Logout do Sistema
		function sair()
		{
			$this->session->sess_destroy();
			redirect('login');
		}	
	}
?>
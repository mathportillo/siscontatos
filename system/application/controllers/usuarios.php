<?
	/*****************************
	 * usuarios.php
	 * Controller Usuarios
	 *****************************/
	 
	class Usuarios extends Controller
	{
		// Construtor
		public function Usuarios()
		{
			parent::Controller();
			if (!Usuario::atual()) {
				redirect('login');
			}
			if (!Usuario::atual()->Permissoes[0]->pode_gerenciar) {
				redirect('login/sair');
			}
			$this->load->library('form_validation');
		}

		// Função Principal do Controller - Lista os Usuários 
		public function index()
		{
			$this->_lista_usuarios();
		}
		
		public function _lista_usuarios($data = array())
		{
			$result = Doctrine_Query::create()
						->from('Usuario u')
						->innerJoin('u.Permissoes p ON p.usuario_id = u.id AND p.agenda_id =' . $this->session->userdata('agenda'))
						->orderby('username')
						->execute();
			$data['usuarios'] = $result;
			
			$this->load->view('usuarios_view',$data);
		}
		
		// Chama a View de Criação de novo usuário
		public function novo($username = '', $pode_visualizar = true, $pode_editar = false, $pode_gerenciar = false)
		{
			$data['username'] = $username;
			$data['pode_visualizar'] = $pode_visualizar;
			$data['pode_editar'] = $pode_editar;
			$data['pode_gerenciar'] = $pode_gerenciar;
			$data['obj_usuario'] = null;
			$this->load->view('usuarios_editar_view', $data);
		}

		// Chama a View de Adicionar novo Usuário/Permissão
		public function adicionar()
		{
			$value['username'] = '';
			$value['pode_visualizar'] = true;
			$value['pode_editar'] = false;
			$value['pode_gerenciar'] = false;
			
			$data['value'] = $value;
			$this->load->view('usuarios_adicionar_view', $data);
		}

		// Chama a View de Propriedades de Usuário para Edição
		public function editar($usuario_id, $mensagem = '')
		{
			$obj_usuarios = Doctrine_Query::create()
										->from('Usuario u')
										->leftJoin('u.Permissoes p ON u.id = p.usuario_id AND p.agenda_id = ' . $this->session->userdata('agenda'))
										->where('u.id = ' . $usuario_id)
										->execute();
			foreach ($obj_usuarios as $obj_usuario)
				$data['obj_usuario'] = $obj_usuario;
			
			$data['mensagem'] = $mensagem;
			$this->load->view('usuarios_editar_view', $data);
		}

		// Exclui uma Permissão / Usuário
		public function excluir()
		{
			$data = array();
			if ($this->uri->segment(3) != '' && Usuario::atual()->id != $this->uri->segment(3)) {
				$obj_usuario = Doctrine::getTable('Usuario')->find($this->uri->segment(3));
				$data['aviso'] = 'Usuário ' . $obj_usuario->username . ' removido da agenda ' . Agenda::atual()->nome;
				$nperms = count($obj_usuario->Permissoes);

				foreach ($obj_usuario->Permissoes as $obj_permissao) {
					if ($obj_permissao->Agenda->id == $this->session->userdata('agenda')) {
						$obj_permissao->delete();
						$nperms--;
					}
				}
				if ($nperms == 0) {
					$data['aviso'] .= ' e excluido do sistema';
					
					$obj_usuario = Doctrine::getTable('usuario')->find($this->uri->segment(3));
					
					foreach ($obj_usuario->Configuracoes as $obj_configuracao) {
						
							$obj_configuracao->delete();

					}
					
					$obj_usuario->delete();
				}
				$data['aviso'] .= ' com sucesso';
			}
			$this->_lista_usuarios($data);
		}

		// Cria a Permissão / Usuário, e vai para a função de Edição
		public function salvar_permissao()
		{
			if ($this->input->post('criar_usuario')) {
				$obj_usuario = new Usuario();
				$obj_usuario->username = $this->input->post('username');
				$obj_usuario->nome = $this->input->post('username');
				$obj_usuario->password = $this->input->post('username');
				$obj_usuario->pode_administrar = false;
				$obj_usuario->ativo = true;
				$obj_usuario->save();
				
				$obj_configuracao = new Configuracao();
				$obj_configuracao->usuario_id = $obj_usuario->id;
				$obj_configuracao->nome = 'agendainicial';
				$obj_configuracao->valor = Agenda::atual()->id;
				$obj_configuracao->save();
				
				$obj_configuracao = new Configuracao();
				$obj_configuracao->usuario_id = $obj_usuario->id;
				$obj_configuracao->nome = 'fichaspp';
				$obj_configuracao->valor = '20';
				$obj_configuracao->save();
				
				$obj_permissao = new Permissao();
				$obj_permissao->usuario_id = $obj_usuario->id;
				$obj_permissao->agenda_id = $this->session->userdata('agenda');
				$obj_permissao->pode_visualizar = ($this->input->post('pode_visualizar') != '');
				$obj_permissao->pode_editar = ($this->input->post('pode_editar') != '');
				$obj_permissao->pode_gerenciar = ($this->input->post('pode_gerenciar') != '');
				$obj_permissao->save();

				$u1 = Doctrine::getTable('Usuario')->findOneByUsername($obj_usuario->username);
				$this->editar($u1->id, 'Usu&aacute;rio criado e adicionado &agrave; agenda ' . Agenda::atual()->nome . ' com sucesso');
			} else {
				$u1 = Doctrine::getTable('Usuario')->findOneByUsername($this->input->post('username'));
				if ($u1) {
					$obj_permissao = new Permissao();
					$obj_permissao->usuario_id = $u1->id;
					$obj_permissao->agenda_id = $this->session->userdata('agenda');
					$obj_permissao->pode_visualizar = ($this->input->post('pode_visualizar') != '');
					$obj_permissao->pode_editar = ($this->input->post('pode_editar') != '');
					$obj_permissao->pode_gerenciar = ($this->input->post('pode_gerenciar') != '');
					$obj_permissao->save();

					$data['aviso'] = 'Usu&aacute;rio ' . $u1->username . ' adicionado &agrave; agenda ' . Agenda::atual()->nome . ' com sucesso';
					$this->_lista_usuarios($data);
				} else {
					$value['username'] = $this->input->post('username');
					$value['pode_visualizar'] = ($this->input->post('pode_visualizar') != '');
					$value['pode_editar'] = ($this->input->post('pode_editar') != '');
					$value['pode_gerenciar'] = ($this->input->post('pode_gerenciar') != '');
					
					$data['value'] = $value;
					$data['prompt'] = true;
					$this->load->view('usuarios_adicionar_view', $data);
					//$username = $this->input->post('username');
					//$pode_visualizar = ($this->input->post('pode_visualizar') != '');
					//$pode_editar = ($this->input->post('pode_editar') != '');
					//$pode_gerenciar = ($this->input->post('pode_gerenciar') != '');
					//$this->novo($username, $pode_visualizar, $pode_editar, $pode_gerenciar);
				}
			}
		}

		// Salva as alterações feitas
		public function salvar()
		{
			if (!$this->_submit_validate()) {
				if ($this->input->post('id') == '') {
					$this->novo();
				} else {
					$data['obj_usuario'] = Doctrine::getTable('Usuario')->find($this->input->post('id'));
					$this->load->view('usuarios_editar_view', $data);
				}
				return;
			}
			if ($this->input->post('id') == '') {
				$obj_usuario = new Usuario();
			} else {
				//Doctrine::getTable('Usuario')->find($this->input->post('id'));
				$obj_usuarios = Doctrine_Query::create()
								->from('Usuario u')
								->leftJoin('u.Permissoes p ON p.usuario_id = u.id AND p.agenda_id = ' . $this->session->userdata('agenda'))
								->where('u.id = ' . $this->input->post('id'))
								->execute();
				foreach ($obj_usuarios as $obj_usuario);
			}
			$obj_usuario->username = $this->input->post('username');
			$obj_usuario->nome = $this->input->post('nome');
			if ($this->input->post('id') == '') {
				$obj_usuario->password = $this->input->post('username');
			}
			$obj_usuario->pode_administrar = ($this->input->post('pode_administrar') != '');
			$obj_usuario->ativo = ($this->input->post('ativo') != '');
			$obj_usuario->save();

			//$p1 = Doctrine::getTable('Permissao')->findOneByUsuario_id($this->input->post('username'));
			if (count($obj_usuario->Permissoes) > 0) {
				$obj_permissao = $obj_usuario->Permissoes[0];
			} else {
				$obj_permissao = new Permissao();
				$obj_permissao->usuario_id = $obj_usuario->id;
				$obj_permissao->agenda_id = $this->session->userdata('agenda');
			}
			$obj_permissao->pode_visualizar = ($this->input->post('pode_visualizar') != '');
			$obj_permissao->pode_editar = ($this->input->post('pode_editar') != '');
			$obj_permissao->pode_gerenciar = ($this->input->post('pode_gerenciar') != '');
			$obj_permissao->save();
			
			$data['aviso'] = 'Usuário ' . $obj_usuario->username . ' alterado com sucesso';
			$this->_lista_usuarios($data);
		}		
		
		// Função de Validação de campos de Edição de Usuário
		private function _submit_validate()
		{
			$this->form_validation->set_rules('username', 'Username',
				'required|alpha_numeric|min_length[3]|max_length[255]|callback_unique');

			$this->form_validation->set_rules('nome', 'Nome',
				'required|max_length[255]');

			$this->form_validation->set_message('unique', 'Login Existente');

			return $this->form_validation->run();
		 }
		
		// Callback unique para o form_validation
		public function unique()
		{
			$u1 = Doctrine::getTable('Usuario')->findOneByUsername($this->input->post('username'));
			if ($u1) {
				if ($this->input->post('id') != '') {
					if ($u1->id != $this->input->post('id')) {
						return false;
					}
				} else {
					return false;
				}
			}
			return true;
		}
	
	}

?>
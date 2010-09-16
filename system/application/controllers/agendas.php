<?
	/*****************************
	 * agendas.php
	 * Controller Agendas
	 *****************************/
	 
	class Agendas extends Controller
	{
		// Construtor
		public function Agendas() 
		{
			parent::Controller();
			if(!Usuario::atual()) {
				redirect('login');
			}
			if(!Usuario::atual()->pode_administrar) {
				redirect('login/sair');
			}
		}

		// Função Principal - Lista as Agendas
		public function index()
		{
			$this->_lista_agendas();
		}
		
		public function _lista_agendas($data = array())
		{
			$result = Doctrine_Query::create()
						->from('Agenda')
						->orderby('nome')
						->execute();
			$data['agendas'] = $result;
			$this->load->view('agendas_view', $data);
		}

		// Função novo - Carrega o form de edição de agenda para uma nova agenda
		public function novo()
		{
			$data['obj_agenda'] = null;
			$this->load->view('agendas_editar_view', $data);
		}

		// Função editar - Carrega o form de edição de agenda para uma agenda existente
		public function editar()
		{
			$data['obj_agenda'] = Doctrine::getTable('Agenda')->find($this->uri->segment(3));
			$this->load->view('agendas_editar_view', $data);
		}

		// Função excluir - Exclui uma agenda
		public function excluir()
		{
			$obj_agenda = Doctrine::getTable('Agenda')->find($this->uri->segment(3));
			
			$data['aviso'] = 'Agenda ' . $obj_agenda->nome;
			
			$obj_deletar_usuarios = array();
			$i = 0;
			$obj_usuarios = Doctrine::getTable('Usuario')->findAll();
			foreach ($obj_usuarios as $obj_usuario) {
				if (count($obj_usuario->Permissoes) == 1 && $obj_usuario->Permissoes[0]->agenda_id == $obj_agenda->id) {
					$obj_deletar_usuarios[$i++] = $obj_usuario;
				}
			}		
			$query = Doctrine_Query::create()
						->delete('Permissao')
						->where('agenda_id = ' . $obj_agenda->id);
			$query->execute();
			
			foreach ($obj_deletar_usuarios as $obj_usuario) {
				$obj_usuario->delete();
			}
			if ($i > 0) {
				$data['aviso'] .= ' e seu(s) usu&aacute;rio(s) exclusivos eliminados';
			} else {
				$data['aviso'] .= ' eliminada';
			}

			$query = Doctrine_Query::create()
						->delete('Contato')
						->where('agenda_id = ' . $this->uri->segment(3));
			$query->execute();

			$data['aviso'] .= ' com sucesso';
			
			$obj_agenda->delete();
			$this->_lista_agendas($data);
		}

		// Função salvar - Salva o que foi entrado no form de Agenda
		public function salvar()
		{
			$obj_permissao = null;
			if (!$this->input->post('id')) {
				$obj_agenda = new Agenda();

				$obj_permissao = new Permissao();
				$obj_permissao->Agenda = $obj_agenda;
				$obj_permissao->Usuario = Usuario::atual();
				$obj_permissao->pode_visualizar = true;
				$obj_permissao->pode_editar = true;
				$obj_permissao->pode_gerenciar = true;
			} else {
				$obj_agenda = Doctrine::getTable('Agenda')->find($this->input->post('id'));
			}
			$obj_agenda->nome = $this->input->post('nome');
			$obj_agenda->save();
			if ($obj_permissao) {
				//$obj_agenda = Doctrine::getTable('Agenda')->findOneByNome($this->input->post('nome'));
				$obj_permissao->save();
			}
			$data['aviso'] = 'Agenda ' . $obj_agenda->nome . (!$this->input->post('id') ? ' criada' : ' alterada') . ' com sucesso';
			$this->_lista_agendas($data);
		}
	}
?>

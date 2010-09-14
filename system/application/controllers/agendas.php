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
			$query = Doctrine_Query::create()
						->delete('Permissao')
						->where('agenda_id = ' . $this->uri->segment(3));
			$query->execute();

			$obj_usuarios = Doctrine::getTable('Usuario');
			foreach ($obj_usuarios as $obj_usuario) {
				if ($obj_usuario->Permissoes == 0) {
					$obj_usuario->delete();
				}
			}

			$query = Doctrine_Query::create()
						->delete('Contato')
						->where('agenda_id = ' . $this->uri->segment(3));
			$query->execute();

			$obj_agenda = Doctrine::getTable('Agenda')->find($this->uri->segment(3));
			$obj_agenda->delete();
			redirect('agendas');
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
			redirect('agendas');
		}
	}
?>

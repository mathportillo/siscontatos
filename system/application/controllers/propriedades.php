<?
	class Propriedades extends Controller
	{
		function index()
		{
			$this->load->view('propriedades_view');
		}
		
		public function novo()
		{
			$data['obj_propriedade'] = null;
			$this->load->view('propriedades_editar_view', $data);
		}
		
		public function salvar()
		{
			$obj_propriedade = null;
			if (!$this->input->post('id')) {
				$obj_propriedade = new Propriedade();
				$obj_propriedade->agenda_id = Agenda::atual()->id;
			} else {
				$obj_propriedade = Doctrine::getTable('Propriedade')->find($this->input->post('id'));
			}
			
			$obj_propriedade->nome = $this->input->post('nome');
			$obj_propriedade->tipo = $this->input->post('tipo');
			$obj_propriedade->tamanho = $this->input->post('tamanho');
			$obj_propriedade->save();
			redirect('propriedades');
		
		}
	}
?>

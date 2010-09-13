<?
	/*****************************
	 * contatos.php
	 * Controller Contatos
	 *****************************/
	
	class Contatos extends Controller
	{
		
		// Construtor
		public function Contatos()
		{
			parent::Controller();
			if (!Usuario::atual()) {
				redirect('login');
			}
			if (!Usuario::atual()->Permissoes[0]->pode_visualizar) {
				redirect('login/sair');
			}
			$this->load->library('form_validation');
		}
		
		// Função index - lista os contatos (com paginação e busca)
		// TODO: Remover falha de SQL injection
		public function index()
		{	
			$itens_por_pagina = 20;
			if ($this->input->post('busca')) {
				$busca = $this->input->post('busca');
			} else {
				$busca = '';
			}
			
			if ($this->input->post('letra_inicial')) {
				$letra_inicial = $this->input->post('letra_inicial');
			} else {
				$letra_inicial = '';
			}
			
			if ($this->input->post('pagina_atual')) {
				$pagina_atual = $this->input->post('pagina_atual');
			} else {
				$pagina_atual = 1;
			}
		
			$result = Doctrine_Query::create()
						->from('Contato')
						->where('(nome LIKE \'%' . $busca . '%\') OR (entidade LIKE \'%' . $busca . '%\')')
						->andWhere("nome LIKE '$letra_inicial%'")
						->andWhere("agenda_id = " . $this->session->userdata('agenda'))
						->orderby('nome')
						->execute();
		
			$total_rows = count($result);
			
			$result = Doctrine_Query::create()
						->from('Contato')
						->where('(nome LIKE \'%' . $busca . '%\') OR (entidade LIKE \'%' . $busca . '%\')')
						->andWhere("nome LIKE '$letra_inicial%'")
						->andWhere("agenda_id = " . $this->session->userdata('agenda'))
						->orderby('nome')
						->limit("$itens_por_pagina")
						->offset(($pagina_atual - 1) * $itens_por_pagina)
						->execute();
			
			$total_de_paginas = ceil($total_rows / $itens_por_pagina);
			
			$data['total_rows'] = $total_rows;
			$data['letra_inicial'] = $letra_inicial;
			$data['itens_por_pagina'] = $itens_por_pagina;
			$data['pagina_atual'] = $pagina_atual;
			$data['total_de_paginas'] = $total_de_paginas;
			$data['contatos'] = $result;
			$data['busca'] = $busca;
			$this->load->view('contatos_view',$data);
		}
		
		// Função novo - Carrega o form de Contato para um novo contato
		public function novo()
		{
			if (!Usuario::atual()->Permissoes[0]->pode_editar) {
				die();
			}
			$data['obj_contato'] = null;
			$this->_carrega_editar($data);
		}
		
		// Função editar - Carrega o form de Contato para um contato existente
		public function editar()
		{
			if (!Usuario::atual()->Permissoes[0]->pode_editar) {
				die();
			}
			$data['obj_contato'] = Doctrine::getTable('Contato')->find($this->uri->segment(3));
			$this->_carrega_editar($data);
		}
		
		// Função excluir - Exclui um contato	
		public function excluir()
		{
			if (!Usuario::atual()->Permissoes[0]->pode_editar) {
				die();
			}
			if ($this->uri->segment(3) != '') {
				$novo_contato = Doctrine::getTable('Contato')->find($this->uri->segment(3));
				$novo_contato->delete();
			}
			redirect('contatos');
		}
		
		// Função auxiliar _carrega_editar - configura as variáveis de entrada da View
		// para diferenciar os casos em que é um novo contato, um contato existente ou um formulário já preenchido
		public function _carrega_editar($data)
		{
			$obj_contato = $data['obj_contato'];
			if($this->input->post('editando')) {
				$value['nome'] = $this->input->post('nome');
				$value['entidade'] = $this->input->post('entidade');
				$value['cargo'] = $this->input->post('cargo');
				$value['telefone1_pais'] = $this->input->post('telefone1_pais');
				$value['telefone1_area'] = $this->input->post('telefone1_area');
				$value['telefone1_numero'] = $this->input->post('telefone1_numero');
				$value['telefone2_pais'] = $this->input->post('telefone2_pais');
				$value['telefone2_area'] = $this->input->post('telefone2_area');
				$value['telefone2_numero'] = $this->input->post('telefone2_numero');
				$value['telefone3_pais'] = $this->input->post('telefone3_pais');
				$value['telefone3_area'] = $this->input->post('telefone3_area');
				$value['telefone3_numero'] = $this->input->post('telefone3_numero');
				$value['celular1_pais'] = $this->input->post('celular1_pais');
				$value['celular1_area'] = $this->input->post('celular1_area');
				$value['celular1_numero'] = $this->input->post('celular1_numero');
				$value['celular2_pais'] = $this->input->post('celular2_pais');
				$value['celular2_area'] = $this->input->post('celular2_area');
				$value['celular2_numero'] = $this->input->post('celular2_numero');
				$value['fax_pais'] = $this->input->post('fax_pais');
				$value['fax_area'] = $this->input->post('fax_area');
				$value['fax_numero'] = $this->input->post('fax_numero');
				$value['email1'] = $this->input->post('email1');
				$value['email2'] = $this->input->post('email2');
				$value['logradouro'] = $this->input->post('logradouro');
				$value['numero'] = $this->input->post('numero');
				$value['complemento'] = $this->input->post('complemento');
				$value['bairro'] = $this->input->post('bairro');
				$value['cep'] = $this->input->post('cep');
				$value['cidade'] = $this->input->post('cidade');
				$value['estado'] = $this->input->post('estado');
				$value['pais'] = $this->input->post('pais');
				$value['observacao'] = $this->input->post('observacao');
			} else {
				$value['nome'] = ($obj_contato ? $obj_contato->nome : '');
				$value['entidade'] = ($obj_contato ? $obj_contato->entidade : '');
				$value['cargo'] = ($obj_contato ? $obj_contato->cargo : '');
				$value['telefone1'] = ($obj_contato ? $obj_contato->telefone1 : '');
				if ($value['telefone1'] != '') {
					$array_telefone1 = explode('-', $value['telefone1']);
					$value['telefone1_pais'] = $array_telefone1[0];
					$value['telefone1_area'] = $array_telefone1[1];
					$value['telefone1_numero'] = $array_telefone1[2];
				} else {
					$value['telefone1_pais'] = '55';
					$value['telefone1_area'] = '85';
					$value['telefone1_numero'] = '';
				}
				$value['telefone2'] = ($obj_contato ? $obj_contato->telefone2 : '');
				if ($value['telefone2'] != '') {
					$array_telefone2 = explode('-', $value['telefone2']);
					$value['telefone2_pais'] = $array_telefone2[0];
					$value['telefone2_area'] = $array_telefone2[1];
					$value['telefone2_numero'] = $array_telefone2[2];
				} else {
					$value['telefone2_pais'] = '55';
					$value['telefone2_area'] = '85';
					$value['telefone2_numero'] = '';
				}
				$value['telefone3'] = ($obj_contato ? $obj_contato->telefone3 : '');
				if ($value['telefone3'] != '') {
					$array_telefone3 = explode('-', $value['telefone3']);
					$value['telefone3_pais'] = $array_telefone3[0];
					$value['telefone3_area'] = $array_telefone3[1];
					$value['telefone3_numero'] = $array_telefone3[2];
				} else {
					$value['telefone3_pais'] = '55';
					$value['telefone3_area'] = '85';
					$value['telefone3_numero'] = '';
				}
				$value['celular1'] = ($obj_contato ? $obj_contato->celular1 : '');
				if ($value['celular1'] != '') {
					$array_celular1 = explode('-', $value['celular1']);
					$value['celular1_pais'] = $array_celular1[0];
					$value['celular1_area'] = $array_celular1[1];
					$value['celular1_numero'] = $array_celular1[2];
				} else {
					$value['celular1_pais'] = '55';
					$value['celular1_area'] = '85';
					$value['celular1_numero'] = '';
				}
				$value['celular2'] = ($obj_contato ? $obj_contato->celular2 : '');
				if ($value['celular2'] != '') {
					$array_celular2 = explode('-', $value['celular2']);
					$value['celular2_pais'] = $array_celular2[0];
					$value['celular2_area'] = $array_celular2[1];
					$value['celular2_numero'] = $array_celular2[2];
				} else {
					$value['celular2_pais'] = '55';
					$value['celular2_area'] = '85';
					$value['celular2_numero'] = '';
				}
				$value['fax'] = ($obj_contato ? $obj_contato->fax : '');
				if ($value['fax'] != '') {
					$array_fax = explode('-', $value['fax']);
					$value['fax_pais'] = $array_fax[0];
					$value['fax_area'] = $array_fax[1];
					$value['fax_numero'] = $array_fax[2];
				} else {
					$value['fax_pais'] = '55';
					$value['fax_area'] = '85';
					$value['fax_numero'] = '';
				}
				$value['email1'] = ($obj_contato ? $obj_contato->email1 : '');
				$value['email2'] = ($obj_contato ? $obj_contato->email2 : '');
				$value['logradouro'] = ($obj_contato ? $obj_contato->logradouro : '');
				$value['numero'] = ($obj_contato ? $obj_contato->numero : '');
				$value['complemento'] = ($obj_contato ? $obj_contato->complemento : '');
				$value['bairro'] = ($obj_contato ? $obj_contato->bairro : '');
				$value['cep'] = ($obj_contato ? $obj_contato->cep : '');
				$value['cidade'] = ($obj_contato ? $obj_contato->cidade : 'Fortaleza');
				$value['estado'] = ($obj_contato ? $obj_contato->estado : 'CE');
				$value['pais'] = ($obj_contato ? $obj_contato->pais : 'Brasil');
				$value['observacao'] = ($obj_contato ? $obj_contato->observacao : '');
			}
			$data['value'] = $value;
			$this->load->view('contatos_editar_view',$data);
		}
		
		// Função salvar - Salva os dados que foram entrados no form de Contato
		public function salvar()
		{
		
			if (!$this->_submit_validate()) {
				if ($this->input->post('id') == '') {
					$this->novo();
				} else {
					if (!Usuario::atual()->Permissoes[0]->pode_editar) {
						die();
					}
					$data['obj_contato'] = Doctrine::getTable('Contato')->find($this->input->post('id'));
					$this->_carrega_editar($data);
		//				redirect('contatos/editar/' . $this->input->post('id'));
				}
				return;
			}
		
			if ($this->input->post('id') == '') {
				$novo_contato = new Contato();
			} else {
				$novo_contato = Doctrine::getTable('Contato')->find($this->input->post('id'));
			}
			$novo_contato->nome = $this->input->post('nome');
			$novo_contato->entidade = $this->input->post('entidade');
			$novo_contato->cargo = $this->input->post('cargo');
			if ($this->input->post('telefone1_numero') != '') {
				$novo_contato->telefone1 = ($this->input->post('telefone1_pais') != '' ? $this->input->post('telefone1_pais') : '55') . '-' . ($this->input->post('telefone1_area') != '' ? $this->input->post('telefone1_area') : '85') . '-' . $this->input->post('telefone1_numero');
			} else {
				$novo_contato->telefone1 = '';
			}
			if ($this->input->post('telefone2_numero') != '') {
				$novo_contato->telefone2 = ($this->input->post('telefone2_pais') != '' ? $this->input->post('telefone2_pais') : '55') . '-' . ($this->input->post('telefone2_area') != '' ? $this->input->post('telefone2_area') : '85') . '-' . $this->input->post('telefone2_numero');
			} else {
				$novo_contato->telefone2 = '';
			}
			if ($this->input->post('telefone3_numero') != '') {
				$novo_contato->telefone3 = ($this->input->post('telefone3_pais') != '' ? $this->input->post('telefone3_pais') : '55') . '-' . ($this->input->post('telefone3_area') != '' ? $this->input->post('telefone3_area') : '85') . '-' . $this->input->post('telefone3_numero');
			} else {
				$novo_contato->telefone3 = '';
			}
			if ($this->input->post('celular1_numero') != '') {
				$novo_contato->celular1 = ($this->input->post('celular1_pais') != '' ? $this->input->post('celular1_pais') : '55') . '-' . ($this->input->post('celular1_area') != '' ? $this->input->post('celular1_area') : '85') . '-' . $this->input->post('celular1_numero');
			} else {
				$novo_contato->celular1 = '';
			}
			if ($this->input->post('celular2_numero') != '') {
				$novo_contato->celular2 = ($this->input->post('celular2_pais') != '' ? $this->input->post('celular2_pais') : '55') . '-' . ($this->input->post('celular2_area') != '' ? $this->input->post('celular2_area') : '85') . '-' . $this->input->post('celular2_numero');
			} else {
				$novo_contato->celular2 = '';
			}
			if ($this->input->post('fax_numero') != '') {
				$novo_contato->fax = ($this->input->post('fax_pais') != '' ? $this->input->post('fax_pais') : '55') . '-' . ($this->input->post('fax_area') != '' ? $this->input->post('fax_area') : '85') . '-' . $this->input->post('fax_numero');
			} else {
				$novo_contato->fax = '';
			}
			$novo_contato->email1 = $this->input->post('email1');
			$novo_contato->email2 = $this->input->post('email2');
			$novo_contato->logradouro = $this->input->post('logradouro'); 
			$novo_contato->numero = $this->input->post('numero'); 
			$novo_contato->complemento = $this->input->post('complemento'); 
			$novo_contato->bairro = $this->input->post('bairro'); 
			$novo_contato->cep = $this->input->post('cep'); 
			$novo_contato->cidade = $this->input->post('cidade');
			$novo_contato->estado = $this->input->post('estado');
			$novo_contato->pais = $this->input->post('pais');
			$novo_contato->observacao = $this->input->post('observacao');
			$novo_contato->agenda_id = $this->session->userdata('agenda');
			$novo_contato->save();
		
			redirect('contatos');
		}
		
		// Função _submit_validate - valida o form de Contato
		// TODO: form_validation telefones
		private function _submit_validate()
		{
			$this->form_validation->set_rules('nome', 'Nome',
				'required|max_length[255]');
		
			$this->form_validation->set_rules('entidade', 'Entidade',
				'required|max_length[255]');
			
			//$this->form_validation->set_rules('telefone1', 'Telefone1',
			//	'numeric|max_length[12]');
		
			//$this->form_validation->set_rules('telefone2', 'Telefone2',
			//	'numeric|max_length[15]');
		
			//$this->form_validation->set_rules('telefone3', 'Telefone3',
			//	'numeric|max_length[15]');
		
			//$this->form_validation->set_rules('celular1', 'Celular1',
			//	'numeric|max_length[15]');
		
			//$this->form_validation->set_rules('celular2', 'Celular2',
			//	'numeric|max_length[15]');
		
			//$this->form_validation->set_rules('fax', 'Fax',
			//	'numeric|max_length[15]');
		
			return $this->form_validation->run();
		}
		
		// Função Importar - Carrega o form de importação
		function importar()
		{
			if (!Usuario::atual()->Permissoes[0]->pode_editar) {
				die();
			}
			$data['obj_upload'] = null;
			$this->load->view('importar_view',$data);
		}

		// Função enviar_arquivo - Processa a importação
		function enviar_arquivo()
		{
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'csv';
			$this->load->library('upload',$config);
			if (!$this->upload->do_upload('arquivo')) {
				$data['obj_upload'] = $this->upload;
				$this->load->view('importar_view',$data);
			} else {
				$this->_process_file();
				$data['obj_upload'] = $this->upload;
				redirect('contatos');
			}
		}
		
		// Função Auxiliar _process_file - processa o arquivo de entrada, criando contatos
		function  _process_file()
		{
			$upload_info = $this->upload->data();		
			$myFile = $upload_info['full_path'];
			$fh = fopen($myFile, 'r');
			$theData = fgets($fh);
			$theData = fgets($fh);

			while ($theData = fgets($fh)) {
				$arr_data = explode(';', $theData);
				$obj_contato = new Contato();
				
				$obj_contato->nome = $arr_data[0];
				$obj_contato->entidade = $arr_data[1];
				$obj_contato->cargo = $arr_data[2];
				$obj_contato->telefone1 = $arr_data[3];
				$obj_contato->telefone2 = $arr_data[4];
				$obj_contato->telefone3 = $arr_data[5];
				$obj_contato->celular1 = $arr_data[6];
				$obj_contato->celular2 = $arr_data[7];
				$obj_contato->fax = $arr_data[8];
				$obj_contato->email1 = $arr_data[9];
				$obj_contato->email2 = $arr_data[10];
				$obj_contato->logradouro = $arr_data[11];
				$obj_contato->numero = $arr_data[12];
				$obj_contato->complemento = $arr_data[13];
				$obj_contato->bairro = $arr_data[14];
				$obj_contato->cep = $arr_data[15];
				$obj_contato->cidade = $arr_data[16];
				$obj_contato->estado = $arr_data[17];
				$obj_contato->pais = $arr_data[18];
				$obj_contato->observacao = substr($arr_data[19], 0, strlen($arr_data[19]) - 1);
				$obj_contato->agenda_id = $this->session->userdata('agenda');
				
				$obj_contato->save();
			}
			fclose($fh);
			unlink($myFile);
		}
		
		// Função Exportar - Exporta os Contatos em CSV
		function exportar()
		{
			if (!Usuario::atual()->Permissoes[0]->pode_editar) {
				die();
			}
			header('Content-type: text/csv');
			header("Content-Disposition: attachment; filename=contatos.csv");
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			//header('Content-Length: ' . filesize('cert/' . $certificado.'.pdf'));
			echo "nome;entidade;cargo;telefone1;telefone2;telefone3;celular1;celular2;fax;email1;email2;logradouro;numero;complemento;bairro;cep;cidade;estado;pais;observacao\n\n";
			$contatos = Doctrine_Query::create()
									->from('Contato')
									->where("agenda_id = " . $this->session->userdata('agenda'))
									->orderby('nome')
									->execute();
			foreach ($contatos as $contato) {
				$this->_safe_echo($contato->nome); echo ';';
				$this->_safe_echo($contato->entidade); echo ';';
				$this->_safe_echo($contato->cargo); echo ';';
				$this->_safe_echo($contato->telefone1); echo ';';
				$this->_safe_echo($contato->telefone2); echo ';';
				$this->_safe_echo($contato->telefone3); echo ';';
				$this->_safe_echo($contato->celular1); echo ';';
				$this->_safe_echo($contato->celular2); echo ';';
				$this->_safe_echo($contato->fax); echo ';';
				$this->_safe_echo($contato->email1); echo ';';
				$this->_safe_echo($contato->email2); echo ';';
				$this->_safe_echo($contato->logradouro); echo ';';
				$this->_safe_echo($contato->numero); echo ';';
				$this->_safe_echo($contato->complemento); echo ';';
				$this->_safe_echo($contato->bairro); echo ';';
				$this->_safe_echo($contato->cep); echo ';';
				$this->_safe_echo($contato->cidade); echo ';';
				$this->_safe_echo($contato->estado); echo ';';
				$this->_safe_echo($contato->pais); echo ';';
				$this->_safe_echo($contato->observacao); echo "\n";
			}
		}
		
		// Função Auxiliar _safe_echo - não imprime ; nem \n
		function _safe_echo($str)
		{
			$str = str_replace(';', ',', $str);
			$str = str_replace("\n", ' ', $str);
			echo $str;
		}
	}
?>
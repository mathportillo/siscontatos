<?
	/*****************************
	 * importar.php
	 * Controller Importar
	 *****************************/
	 
	class Importar extends Controller {
		
		// Função Auxiliar _process_file - processa o arquivo de entrada, criando contatos
		function  _process_file() {
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
		}

		// Função index - Carrega o form de importação
		function index() {
			if (!Usuario::atual()->Permissoes[0]->pode_editar) {
				die();
			}
			$data['obj_upload'] = null;
			$this->load->view('importar_view',$data);
		}

		// Função enviar_arquivo - Processa a importação
		function enviar_arquivo() {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'csv';
			$this->load->library('upload',$config);
			if ( ! $this->upload->do_upload('arquivo')) {
				$data['obj_upload'] = $this->upload;
				$this->load->view('importar_view',$data);
			} else {
				$this->_process_file();
				$data['obj_upload'] = $this->upload;
				redirect('contatos');
			}
		}

	}
?>
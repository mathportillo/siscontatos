<?
	/*****************************
	 * exportar.php
	 * Controller Exportar
	 *****************************/

	class Exportar extends Controller
	{
		// Função index - Exporta os Contatos em CSV
		function index()
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
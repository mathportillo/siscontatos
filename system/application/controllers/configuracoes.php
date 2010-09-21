<?
/*
 * Created on 20/09/2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
class Configuracoes extends Controller 
{
	public function index()
	{
		$obj_configuracoes = Doctrine_Query::create()
								->from('Configuracao')
								->where('usuario_id = ' . Usuario::atual()->id)
								->andWhere('nome = \'fichaspp\'')
								->execute();
		if (count($obj_configuracoes) == 0) {
			$data['fichaspp'] = 20;
		} else {
			foreach ($obj_configuracoes as $obj_configuracao) break;
			$data['fichaspp'] = $obj_configuracao->valor;
		}
		$this->load->view('configuracoes_view',$data);
	}
 
	public function salvar()
	{
		
		// Salva o Fichas PP
		$obj_configuracoes = Doctrine_Query::create()
								->from('Configuracao')
								->where('usuario_id = ' . Usuario::atual()->id)
								->andWhere('nome = \'fichaspp\'')
								->execute();

		if (count($obj_configuracoes) == 0) {
			$obj_configuracao = new Configuracao();
			$obj_configuracao->usuario_id = Usuario::atual()->id;
			$obj_configuracao->agenda_id = 0; // TODO: Usar agenda_id na configuracao
			$obj_configuracao->nome = 'fichaspp';
		} else {
			foreach ($obj_configuracoes as $obj_configuracao) break;
		}
		
		$obj_configuracao->valor = $this->input->post('fichaspp');
		
		$obj_configuracao->save();
		
		// Salva Agenda Inicial
		// Salva Tema
		redirect('configuracoes'); 
	}
}		
?>
		
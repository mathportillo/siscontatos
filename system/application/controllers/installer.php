<?
	/*****************************
	 * installer.php
	 * Controller Installer
	 *****************************/

	class Installer extends Controller
	{
		// Função create_tables - Cria as tabelas baseado no modelo
		public function create_tables()
		{
			Doctrine::createTablesFromModels();
		}
	
		// Função insert_rows - Insere linhas de inicialização do sistema
		public function insert_rows()
		{
			$novo_usuario = new Usuario();
			$novo_usuario->username = "admin";
			$novo_usuario->nome = "Administrador";
			$novo_usuario->password = "admin";
			$novo_usuario->pode_administrar = true;
			$novo_usuario->ativo = true;
			$novo_usuario->bloqueado = false;
			$novo_usuario->hpe = null;
			$novo_usuario->hue = null;
			$novo_usuario->ec = 0;		
			$novo_usuario->save();
			
			$novo_agenda = new Agenda();
			$novo_agenda->nome = "Principal";	
			$novo_agenda->save();
						
			$obj_configuracao = new Configuracao();
			$obj_configuracao->usuario_id = $novo_usuario->id;
			$obj_configuracao->nome = 'agendainicial';
			$obj_configuracao->valor = $novo_agenda->id;
			$obj_configuracao->save();
			
			$obj_configuracao = new Configuracao();
			$obj_configuracao->usuario_id = $novo_usuario->id;
			$obj_configuracao->nome = 'fichaspp';
			$obj_configuracao->valor = '20';
			$obj_configuracao->save();
			
			$novo_permissao = new Permissao();
			$novo_permissao->Usuario = $novo_usuario;
			$novo_permissao->Agenda = $novo_agenda;	
			$novo_permissao->pode_visualizar = true;
			$novo_permissao->pode_editar = true;
			$novo_permissao->pode_gerenciar = true;
			$novo_permissao->save();
		}
		
		// Função index - Instala o banco de dados 
		public function index()
		{
	//		try {
	//			Doctrine::dropDatabases();
	//		}
			?>
				<html><head><title>Sistema de Contatos</title></head><body>
			<?
			echo "Criando Banco de Dados...<br /><br />";
			try {
				Doctrine::createDatabases();
				$obj_conn = Doctrine_Manager::getInstance()->getConnection("default");
				$obj_conn->setCharset("utf8");
				$obj_conn->setCollate("utf8_general_ci");
				try {
					echo "Criando Tabelas...<br /><br />";
					$this->create_tables();
					try {
						echo "Configurando o ambiente...<br /><br />";
						$this->insert_rows();
	
						echo "Completo!<br /><br />";
	
					} catch (Exception $e) {
						echo "Não foi poss&iacute;vel configurar o ambiente";
					}
				} catch (Exception $e) {
					echo "Não foi poss&iacute;vel criar as Tabelas no Banco de Dados";
				}
			} catch (Exception $e) {
				echo "Não foi poss&iacute;vel criar o Banco de Dados";
			}
			?>
				</body></html>
			<?
		}
	}

?>
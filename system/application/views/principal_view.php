<? $this->load->view('_template_open_view'); ?>
	<div style="margin: 50px 50px 50px 50px; text-align: left;">
		Bem Vindo <b><?= Usuario::atual()->nome ?></b>!<br /><br />
		<?= anchor('principal/alterarsenha', 'Alterar Senha', 'class="itembutton"') ?>
	</div>
<? $this->load->view('_template_close_view'); ?>

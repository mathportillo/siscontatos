<? $this->load->view('_template_open_view'); ?>
	<div style="margin: 30px 50px 50px 50px; text-align: left;">
		<p><?= (isset($aviso) ? $aviso : '') ?>&nbsp</p><br />
		<p>Bem Vindo <b><?= Usuario::atual()->nome ?></b>!</p><br />
		<?= anchor('principal/alterarsenha', 'Alterar Senha', 'class="itembutton"') ?>
	</div>
<? $this->load->view('_template_close_view'); ?>

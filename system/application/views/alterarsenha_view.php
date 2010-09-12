<? $this->load->view('_template_open_view'); ?>

<?= form_open('principal/alterarsenha_submit', 'id="form_salvar"') ?>

<div style="text-align: center;">
	<b><b>Alterar Senha</b><br /><br />
</div>
<table class="simplefont" align="center">
	<tbody>
		<tr>
			<td>Senha Atual:</td>
			<td><?= form_password('password', '', 'class="normal_input" onkeyup="javascript:submitenter(this,event);"') ?></td>
		</tr>
		<tr>
			<td>Nova Senha:</td>
			<td><?= form_password('newpassword', '', 'class="normal_input" onkeyup="javascript:submitenter(this,event);"') ?></td>
		</tr>
		<tr>
			<td>Confirmar Nova Senha:</td>
			<td><?= form_password('newpassword_confirm', '', 'class="normal_input" onkeyup="javascript:submitenter(this,event);"') ?></td>
		</tr>
	</tbody>
</table><br />
    <div align="center">
		<?= anchor('principal/alterarsenha','Desfazer', 'class="itembutton"') ?>
        <a class="itembutton" href="javascript:" onclick="form_salvar.submit();">Ok</a>
		<?= anchor('principal','Cancelar','class="itembutton"') ?>
    </div>

<?= form_close() ?>

<? $this->load->view('_template_close_view'); ?>
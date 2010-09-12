<? $this->load->view('_template_open_view'); ?>
<?= form_open('usuarios/salvar_permissao', 'id="form_salvar"') ?>

<?= form_hidden('criar_usuario', '') ?>

<div>
	<b>Adicionar Usu&aacute;rio</b><br /><br />
</div>

<table border="0" class="simplefont">
	<tbody>
		<tr>
			<td>Nome de Usu&aacute;rio:</td>
			<td><?= form_input('username', $value['username'], 'class="normal_input" id="input_username"') ?></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td align="right"><?= form_checkbox('pode_visualizar', 'pode_visualizar', $value['pode_visualizar'], 'class="checkbox_input"') ?></td>
			<td>Pode visualizar contatos</td>
		</tr>
		<tr>
			<td align="right"><?= form_checkbox('pode_editar', 'pode_editar', $value['pode_editar'], 'class="checkbox_input"') ?></td>
			<td>Pode editar contatos</td>
		</tr>
		<tr>
			<td align="right"><?= form_checkbox('pode_gerenciar', 'pode_gerenciar', $value['pode_gerenciar'], 'class="checkbox_input"') ?></td>
			<td>Pode gerenciar a agenda</td>
		</tr>
	</tbody>
</table><br />
<div>
	<?= anchor('usuarios/adicionar', 'Desfazer', 'class="itembutton"') ?>
	<a class="itembutton" href="javascript:" onclick="form_salvar.submit();">Salvar</a>
	<?= anchor('usuarios','Cancelar','class="itembutton"') ?>
</div>

<?= form_close() ?>

<script language="javascript">
	var input_username = document.getElementById('input_username');
	input_username.focus() ;
</script>

<? if (isset($prompt)) { ?>
	<script language="javascript">
		if(confirm("Este usuário não existe, deseja criá-lo e continuar?")) {
			form_salvar.criar_usuario.value="1";
			form_salvar.submit();
		} else {
			window.location = "<?= base_url() . index_page() . '/usuarios/adicionar' ?>";
		}
	</script>
<? } ?>

<? $this->load->view('_template_close_view'); ?>

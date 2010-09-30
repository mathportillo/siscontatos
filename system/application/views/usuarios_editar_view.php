<? $this->load->view('_template_open_view'); ?>

<? $error = validation_errors('<p class="error">','</p>'); ?>

<?= form_open('usuarios/salvar', 'id="form_salvar"') ?>

<?= form_hidden('id', ($obj_usuario ? $obj_usuario->id : '')) ?>

<div>
	<?= (isset($mensagem) ? '<b>' . $mensagem . '</b><br /><br />' : '') ?>
	<b><?= ($obj_usuario ? 'Editar Usu&aacute;rio' : 'Novo Usu&aacute;rio') ?></b><br /><br />
</div>

<table border="0" class="simplefont">
	<tbody>
		<? if ($error != '') { ?>
			<tr><td align="center" colspan="2">
				<?= $error ?>
			</td></tr>
			<tr><td align="center" colspan="2">
				&nbsp;
			</td></tr>
		<? } ?>
		<?
			if (!Usuario::atual()->pode_administrar) {
				$str_disabled = " disabled";
			} else {
				$str_disabled = "";
			}
		?>
		<tr>
			<td>Nome de Usu&aacute;rio:</td>
			<td><?= form_input('username', ($obj_usuario ? $obj_usuario->username : $username), 'class="normal_input" id="input_username"' . $str_disabled) ?></td>
		</tr>
		<tr>
			<td>Nome:</td>
			<td><?= form_input('nome', ($obj_usuario ? $obj_usuario->nome : ""), 'class="normal_input"') ?></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td align="right"><?= form_checkbox('pode_visualizar', 'pode_visualizar', ($obj_usuario ? $obj_usuario->Permissoes[0]->pode_visualizar : $pode_visualizar), 'class="checkbox_input"') ?></td>
			<td>Pode visualizar contatos</td>
		</tr>
		<tr>
			<td align="right"><?= form_checkbox('pode_editar', 'pode_editar', ($obj_usuario ? $obj_usuario->Permissoes[0]->pode_editar : $pode_editar), 'class="checkbox_input"') ?></td>
			<td>Pode editar contatos</td>
		</tr>
		<tr>
			<td align="right"><?= form_checkbox('pode_gerenciar', 'pode_gerenciar', ($obj_usuario ? $obj_usuario->Permissoes[0]->pode_gerenciar : $pode_gerenciar), 'class="checkbox_input"') ?></td>
			<td>Pode gerenciar a agenda</td>
		</tr>
		<? if (Usuario::atual()->Permissoes[0]->pode_gerenciar) { ?>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td align="right"><?= form_checkbox('pode_administrar', 'pode_administrar', ($obj_usuario ? $obj_usuario->pode_administrar : false), 'class="checkbox_input"') ?></td>
				<td>Pode administrar o sistema</td>
			</tr>
			<tr>
				<td align="right"><?= form_checkbox('ativo', 'ativo', ($obj_usuario ? $obj_usuario->ativo : true), 'class="checkbox_input"') ?></td>
				<td>Usu&aacute;rio ativo</td>
			</tr>
		<? } ?>
	</tbody>
</table><br />
<div>
	<?= anchor('usuarios/' . ($obj_usuario ? 'editar/' . $obj_usuario->id : 'novo'),'Desfazer', 'class="itembutton"') ?>
	<a class="itembutton" href="javascript:" onclick="form_salvar.submit();">Salvar</a>
	<?= anchor('usuarios','Cancelar','class="itembutton"') ?>
</div>

<?= form_close() ?>

<script language="javascript">
	var input_username = document.getElementById('input_username');
	input_username.focus() ;
</script>

<? $this->load->view('_template_close_view'); ?>

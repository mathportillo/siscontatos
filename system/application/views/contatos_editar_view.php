<? $this->load->view('_template_open_view'); ?>

<?= form_open('contatos/salvar','id="form_salvar"'); ?>

<? $error = validation_errors('<p class="error">','</p>'); ?>

<div style="text-align: center;">
	<b><?= ($obj_contato ? 'Editando contato' : 'Novo Contato') ?></b><br /><br />
</div>

<?= form_hidden('id',($obj_contato ? $obj_contato->id : '')) ?>

<?= form_hidden('editando', '1') ?>

<table class="simplefont" align="center" border="0" style="width: 300px;">
	<tbody>
		<? if ($error != '') { ?>
			<tr><td align="center" colspan="2">
				<?= $error ?>
			</td></tr>
			<tr><td align="center" colspan="2">
				&nbsp;
			</td></tr>
		<? } ?>
		<tr>
			<td>Nome:</td>
			<td><?= form_input('nome', $value['nome'], 'class="normal_input" id="input_nome" maxlength="255" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?></td>
		</tr>
		<tr>
			<td>Entidade:</td>
			<td><?= form_input('entidade', $value['entidade'], 'class="normal_input" maxlength="255" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?></td>
		</tr>
		<tr>
			<td>Cargo:</td>
			<td><?= form_input('cargo', $value['cargo'], 'class="normal_input" maxlength="255" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td>Telefone Comercial 1:</td>
			<td>
				<?= form_input('telefone1_pais', $value['telefone1_pais'], 'class="mini_input" maxlength="2" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
				<?= form_input('telefone1_area', $value['telefone1_area'], 'class="mini_input" maxlength="3" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
				<?= form_input('telefone1_numero', $value['telefone1_numero'], 'class="medium_input" maxlength="8" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
			</td>
		</tr>
		<tr>
			<td>Telefone Comercial 2:</td>
			<td>
				<?= form_input('telefone2_pais', $value['telefone2_pais'], 'class="mini_input" maxlength="2" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
				<?= form_input('telefone2_area', $value['telefone2_area'], 'class="mini_input" maxlength="3" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
				<?= form_input('telefone2_numero', $value['telefone2_numero'], 'class="medium_input" maxlength="8" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
			</td>
		</tr>
		<tr>
			<td>Telefone Residencial:</td>
			<td>
				<?= form_input('telefone3_pais', $value['telefone3_pais'], 'class="mini_input" maxlength="2" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
				<?= form_input('telefone3_area', $value['telefone3_area'], 'class="mini_input" maxlength="3" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
				<?= form_input('telefone3_numero', $value['telefone3_numero'], 'class="medium_input" maxlength="8" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
			</td>
		</tr>
		<tr>
			<td>Celular 1:</td>
			<td>
				<?= form_input('celular1_pais', $value['celular1_pais'], 'class="mini_input" maxlength="2" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
				<?= form_input('celular1_area', $value['celular1_area'], 'class="mini_input" maxlength="3" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
				<?= form_input('celular1_numero', $value['celular1_numero'], 'class="medium_input" maxlength="8" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
			</td>
		</tr>
		<tr>
			<td>Celular 2:</td>
			<td>
				<?= form_input('celular2_pais', $value['celular2_pais'], 'class="mini_input" maxlength="2" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
				<?= form_input('celular2_area', $value['celular2_area'], 'class="mini_input" maxlength="3" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
				<?= form_input('celular2_numero', $value['celular2_numero'], 'class="medium_input" maxlength="8" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
			</td>
		</tr>
		<tr>
			<td>Fax:</td>
			<td>
				<?= form_input('fax_pais', $value['fax_pais'], 'class="mini_input" maxlength="2" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
				<?= form_input('fax_area', $value['fax_area'], 'class="mini_input" maxlength="3" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
				<?= form_input('fax_numero', $value['fax_numero'], 'class="medium_input" maxlength="8" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?>
			</td>
		</tr>
		<tr>
			<td>E-mail 1:</td>
			<td><?= form_input('email1', $value['email1'], 'class="normal_input" maxlength="255" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?></td>
		</tr>
		<tr>
			<td>E-mail 2:</td>
			<td><?= form_input('email2', $value['email2'], 'class="normal_input" maxlength="255" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td>Logradouro:</td>
			<td><?= form_input('logradouro', $value['logradouro'], 'class="normal_input" maxlength="255" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?></td>
		</tr>
		<tr>
			<td>N&uacute;mero:</td>
			<td><?= form_input('numero', $value['numero'], 'class="normal_input" maxlength="255" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?></td>
		</tr>
		<tr>
			<td>Complemento:</td>
			<td><?= form_input('complemento', $value['complemento'], 'class="normal_input" maxlength="255" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?></td>
		</tr>
		<tr>
			<td>Bairro:</td>
			<td><?= form_input('bairro', $value['bairro'], 'class="normal_input" maxlength="255" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?></td>
		</tr>
		<tr>
			<td>CEP:</td>
			<td><?= form_input('cep', $value['cep'], 'class="normal_input" maxlength="255" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td>Cidade:</td>
			<td><?= form_input('cidade', $value['cidade'], 'class="normal_input" maxlength="60" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?></td>
		</tr>
		<tr>
			<td>Estado:</td>
			<td><?= form_input('estado', $value['estado'], 'class="normal_input" maxlength="60" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?></td>
		</tr>
		<tr>
			<td>Pa&iacute;s:</td>
			<td><?= form_input('pais', $value['pais'], 'class="normal_input" maxlength="60" onkeypress="javascript:submitenter(this,event,\'Você realmente deseja salvar as alterações?\');"') ?></td>
		</tr>
		<tr>
			<td>Observa&ccedil;&otilde;es:</td>
			<td><textarea class="normal_input" name="observacao" rows="3" cols="16" onkeypress="return imposeMaxLength(this, 3000);"><?= $value['observacao'] ?></textarea></td>
		</tr>
	</tbody>
</table><br />
<div align="center">
		<?= anchor('contatos/' . ($obj_contato ? 'editar/' . $obj_contato->id : 'novo'),'Desfazer', 'class="itembutton"') ?>
		<a class="itembutton" href="javascript:" onclick="javascript:if (confirm('Você realmente deseja salvar as alterações?')) { form_salvar.submit(); } else { return false; }"'">Salvar</a>
		<?= anchor('contatos','Cancelar','class="itembutton"') ?>
</div>

<?= form_close() ?>

<script language="javascript">
	var input_username = document.getElementById('input_nome');
	input_username.focus() ;
	
	function imposeMaxLength(Object, MaxLen)
	{
		return (Object.value.length <= MaxLen);
	}
</script>


<? $this->load->view('_template_close_view'); ?>

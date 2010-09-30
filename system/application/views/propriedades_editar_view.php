<? $this->load->view('_template_open_view') ?>

<?= form_open('propriedades/salvar', 'id="form_salvar"') ?>

<?= form_hidden('id', ($obj_propriedade ? $obj_propriedade->id : '')) ?>
<div>
	<b><?= ($obj_propriedade ? 'Editar Propriedade' : 'Nova Propriedade') ?></b><br /><br />
</div>
<table class="simplefont">
	<tr>
		<td>Nome:</td>
		<td><?= form_input('nome', ($obj_propriedade ? $obj_propriedade->nome : ''), 'class="normal_input"') ?></td>
	</tr>
	<tr>
		<td>Tipo:</td>
		<td>
			<select name="tipo" size="1" class="normal_select">
					<option value="inteiro">Num&eacute;rico</option>
					<option value="string">Texto</option>
					<option value="boolean">Boleano</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Tamanho:</td>
		<td><?= form_input('tamanho', ($obj_propriedade ? $obj_propriedade->nome : ''), 'class="normal_input"') ?></td>
	</tr>
</table><br />
<div>
	<?= anchor('propriedades/' . ($obj_propriedade ? 'editar/' . $obj_propriedade->id : 'novo'), 'Desfazer', 'class="itembutton"') ?>
	<a class="itembutton" href="javascript:" onclick="form_salvar.submit();">Salvar</a>
	<?= anchor('propriedades', 'Cancelar', 'class="itembutton"') ?>
</div>

<?= form_close() ?>

<? $this->load->view('_template_close_view') ?>

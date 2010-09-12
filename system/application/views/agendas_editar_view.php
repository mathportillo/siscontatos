<? $this->load->view('_template_open_view') ?>

<?= form_open('agendas/salvar', 'id="form_salvar"') ?>

<?= form_hidden('id', ($obj_agenda ? $obj_agenda->id : '')) ?>
<div>
	<b><?= ($obj_agenda ? 'Editar Agenda' : 'Nova Agenda') ?></b><br /><br />
</div>
<table class="simplefont">
	<tr>
		<td>Nome:</td>
		<td><?= form_input('nome', ($obj_agenda ? $obj_agenda->nome : '')) ?></td>
	</tr>
</table><br />
<div>
	<?= anchor('agendas/' . ($obj_agenda ? 'editar/' . $obj_agenda->id : 'novo'), 'Desfazer', 'class="itembutton"') ?>
	<a class="itembutton" href="javascript:" onclick="form_salvar.submit();">Salvar</a>
	<?= anchor('agendas', 'Cancelar', 'class="itembutton"') ?>
</div>
<?= form_close() ?>

<? $this->load->view('_template_close_view') ?>

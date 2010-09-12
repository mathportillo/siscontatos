<? $this->load->view('_template_open_view'); ?>

<?= form_open('importar/enviar_arquivo', 'id="form_importar" enctype="multipart/form-data"') ?>
<table align="center" border="0" class="simplefont">
	<tbody>
		<tr>
			<td align="center" colspan="2">
				<?= form_upload('arquivo') ?>
			</td>
		</tr>
	</tbody>
</table>
<div align="center">
	<a class="itembutton" href="javascript:" onclick="javascript:form_importar.submit();">Importar</a>
	<?= anchor('contatos','Cancelar','class="itembutton"') ?>
</div>

<? $this->load->view('_template_close_view'); ?>

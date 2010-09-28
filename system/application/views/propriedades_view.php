<?= $this->load->view('_template_open_view'); ?>

<div align="center" style="margin: 0px auto; width: 796px;">
	<div style="float: left; width: 696px; height: 22px; line-height: 22px;">
		<?= (isset($aviso) ? '<b>' . $aviso . '</b>' : '') ?>
	</div>
	<?= anchor('propriedades/novo', 'Adicionar', 'class="itembutton" style="float: right;"'); ?>
</div>
<table>
	
</table>

<?= $this->load->view('_template_close_view'); ?>

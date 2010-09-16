<? $this->load->view('_template_open_view'); ?>
<div align="center" style="margin: 0px auto; width: 796px;">
	<div style="float: left; width: 696px; height: 22px; line-height: 22px;">
		<?= (isset($aviso) ? '<b>' . $aviso . '</b>' : '') ?>
	</div>
	<?= anchor('agendas/novo', 'Nova Agenda', 'class="itembutton" style="float: right;"'); ?>
</div>
<table align="center" border="0" class="alternedcolortable simplefont w800" style="clear: both">
	<thead>
		<th class="redondocima">Nome</th>
		<th class="redondocima" width="50">&nbsp;</th>
	</thead>
	<tbody>
		<? $i = 0 ?>
		<? foreach($agendas as $agenda) { ?>
			<tr class="color<?= $i ?>">
				<td><?= $agenda->nome ?></td>
				<td align="center">
					<?= anchor('agendas/editar/' . $agenda->id, '<img src="' . base_url() . 'img/edit.gif" border="0" title="Editar"/>') ?>
					&nbsp;<?= anchor('agendas/excluir/' . $agenda->id, '<img src="' . base_url() . 'img/remove.gif" border="0" title="Excluir"/>', 'onclick="javascript:if (confirm(\'Você realmente deseja excluir esta agenda?\')) { return true; } else { return false; }"') ?>
				</td> 
			</tr>
			<? $i = 1-$i ?>
		<? } ?>
	</tbody>
	<thead>
		<th class="redondobaixo">&nbsp;</th>
		<th class="redondobaixo">&nbsp;</th>
	</thead>
</table>

<? $this->load->view('_template_close_view') ?>

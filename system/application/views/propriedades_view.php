<?= $this->load->view('_template_open_view'); ?>

<div align="center" style="margin: 0px auto; width: 796px;">
	<div style="float: left; width: 696px; height: 22px; line-height: 22px;">
		<?= (isset($aviso) ? '<b>' . $aviso . '</b>' : '') ?>
	</div>
	<?= anchor('propriedades/novo', 'Adicionar', 'class="itembutton" style="float: right;"'); ?>
</div>
<table align="center" border="0" class="alternedcolortable simplefont w800" style="clear: both;">
	<thead>
		<th class="redondoesquerdacima">Nome</th>
		<th>Tipo</th>
		<th>Tamanho</th>
		<th class="redondodireitacima" width="50">&nbsp;</th>
	</thead>
	<tbody>
		<? $i = 0; ?>
		<? if (count($propriedades) == 0) { ?>
			<tr class="color<?= $i ?>">
				<td colspan="4" align="center">N&atilde;o h&aacute; propriedades extras adicionadas na Agenda atual</td>
			</tr>
		<? } else { ?>
			<? foreach ($propriedades as $propriedade) { ?>
				<tr class="color<?= $i ?>">
					<td><?= $propriedade->nome ?></td>
					<td><?= $propriedade->tipo ?></td>
					<td><?= $propriedade->tamanho ?></td>
					<td align="center" valign="bottom">
						<?= anchor('usuarios/editar/' . $propriedade->id, '<img src="' . base_url() . 'img/edit.gif" border="0" title="Editar"/>') ?>
						&nbsp;<?= anchor('usuarios/excluir/' . $propriedade->id, '<img src="' . base_url() . 'img/remove.gif" border="0" title="Excluir"/>', 'onclick="javascript:if (confirm(\'Você realmente deseja excluir a propriedade ' . $propriedade->nome . '?\')) { return true; } else { return false; }"') ?>
					</td>
				</tr>
				<? $i = 1-$i; ?>
			<? } ?>
		<? } ?>
	</tbody>
	<thead>
		<th class="redondoesquerdabaixo">&nbsp;</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th class="redondodireitabaixo">&nbsp;</th>
	</thead>
</table>

<?= $this->load->view('_template_close_view'); ?>

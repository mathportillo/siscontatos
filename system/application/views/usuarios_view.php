<? $this->load->view('_template_open_view'); ?>
<div style="padding-bottom: 2px; float: left">
	<?= (isset($aviso) ? '<p><b>' . $aviso . '</b></p>' : '') ?>
</div>
<div align="right" style="padding-bottom: 2px; margin: 0px auto; width: 796px;">
	<?= anchor('usuarios/adicionar', 'Novo Usu&aacute;rio', 'class="itembutton"'); ?>
</div>
<table align="center" border="0" class="alternedcolortable simplefont w800">
	<thead>
		<th class="redondoesquerdacima">Nome do Usu&aacute;rio</th>
		<th class="redondodireitacima">Nome</th>
		<th class="redondoesquerdacima" width="70">Visualizar</th>
		<th width="70">Editar</th>
		<th width="70">Gerenciar</th>
		<th width="70">Administrar</th>
		<th class="redondodireitacima" width="70">Ativo</th>
		<th class="redondocima" width="50"></th>
	</thead>
	<tbody>
		<? $i = 0; ?>
		<? foreach ($usuarios as $usuario) { ?>
			<tr class="color<?= $i ?>">
				<td><?= $usuario->username ?></td>
				<td><?= $usuario->nome ?></td>
				<td align="center"><img src="<?= base_url() ?>img/<?= ($usuario->Permissoes[0]->pode_visualizar ? 'yes.gif' : 'no.gif' ) ?>" /></td>
				<td align="center"><img src="<?= base_url() ?>img/<?= ($usuario->Permissoes[0]->pode_editar ? 'yes.gif' : 'no.gif' ) ?>" /></td>
				<td align="center"><img src="<?= base_url() ?>img/<?= ($usuario->Permissoes[0]->pode_gerenciar ? 'yes.gif' : 'no.gif' ) ?>" /></td>
				<td align="center"><img src="<?= base_url() ?>img/<?= ($usuario->pode_administrar ? 'yes.gif' : 'no.gif' ) ?>" /></td>
				<td align="center"><img src="<?= base_url() ?>img/<?= ($usuario->ativo ? 'yes.gif' : 'no.gif' ) ?>" /></td>
				<td align="center" valign="bottom">
					<?= anchor('usuarios/editar/' . $usuario->id, '<img src="' . base_url() . 'img/edit.gif" border="0" title="Editar"/>') ?>
					&nbsp;<?= anchor('usuarios/excluir/' . $usuario->id, '<img src="' . base_url() . 'img/remove.gif" border="0" title="Excluir"/>', 'onclick="javascript:if (confirm(\'Você realmente deseja excluir o usuário ' . $usuario->nome . '?\')) { return true; } else { return false; }"') ?>
				</td>
			</tr>
			<? $i = 1-$i; ?>
		<? } ?>
	</tbody>
	<thead>
		<th class="redondoesquerdabaixo">&nbsp;</th>
		<th class="redondodireitabaixo">&nbsp;</th>
		<th class="redondoesquerdabaixo">&nbsp;</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th class="redondodireitabaixo">&nbsp;</th>
		<th class="redondobaixo">&nbsp;</th>
	</thead>
</table>

<? $this->load->view('_template_close_view'); ?>

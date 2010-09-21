<? $this->load->view('_template_open_view'); ?>

<div>
	<b>Alterar Configura&ccedil;&otilde;es</b><br /><br />
</div>
<table class="simplefont" border="1">
	<tbody>
		<tr>
			<td rowspan="3">Alterar Senha:</td>
			<td>Senha Atual:</td>
			<td><?= form_password('password', '', 'class="normal_input" onkeyup="javascript:submitenter(this,event);"') ?></td>
		</tr>
		<tr>
			<td>Nova Senha:</td>
			<td><?= form_password('newpassword', '', 'class="normal_input" onkeyup="javascript:submitenter(this,event);"') ?></td>
		</tr>
		<tr>
			<td>Confirmar Nova Senha:</td>
			<td><?= form_password('newpassword_confirm', '', 'class="normal_input" onkeyup="javascript:submitenter(this,event);"') ?></td>
		</tr>
		<tr>
			<td colspan="2">Nome:</td>
			<td><?= form_input('nome', Usuario::atual()->nome, 'class="normal_input"') ?></td>
		</tr>
		<?= form_open('configuracoes/salvar','id="form_configuracoes"') ?>
		
		<tr>
			<td colspan="2">Fichas por P&aacute;gina:</td>
			<td><?= form_input('fichaspp', $fichaspp, 'class="normal_input" maxlength="3"') ?></td>
		</tr>
		<tr>
			<td colspan="2">Agenda Inicial:</td>
			<td>
				<select name="agenda" size="1" class="normal_select">
					<? foreach (Usuario::atual()->getAgendas() as $obj_agenda) { ?>
						<option value="<?= $obj_agenda->id ?>" <?=($obj_agenda->id == $this->session->userdata('agenda') ? 'selected="true"' : '') ?>><?= $obj_agenda->nome ?></option>
					<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">Tema:</td>
			<td>
				<select name="agenda" size="1" class="normal_select">
					<option value="verde" <?=($obj_agenda->id == $this->session->userdata('agenda') ? 'selected="true"' : '') ?>>Verde</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<?= form_close() ?>
				 <div align="center">
		        <a class="itembutton" href="javascript:" onclick="form_configuracoes.submit();">Ok</a>
			</td>		
	</tbody>
</table>


<? $this->load->view('_template_close_view'); ?>
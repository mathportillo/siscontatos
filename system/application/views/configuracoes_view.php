<? $this->load->view('_template_open_view'); ?>
<div align="center" style="width: 700px; margin: auto; height: 183px;">
	<div style="float: left;">
		<?= form_open('configuracoes/salvar_configuracoes','id="form_configuracoes	"') ?>
		<div>
			<b>Configura&ccedil;&otilde;es do Usu&aacute;rio</b><br /><br />
		</div>
		<table class="simplefont">
			<tbody>
				<tr>
					<td>Nome:</td>
					<td><?= form_input('nome', Usuario::atual()->nome, 'class="normal_input"') ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
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
			</tbody>
		</table><br />
		<div align="center" style="clear: both">
			<a class="itembutton" href="javascript:" onclick="form_configuracoes.submit();">Salvar</a>
		</div>
		<?= form_close() ?>
	</div>
	
	<div style="float: right;">
		<?= form_open('configuracoes/salvar_preferencias','id="form_preferencias"') ?>
		
		<div>
			<b>Prefer&ecirc;rencias Pessoais</b><br /><br />
		</div>
		<table class="simplefont">
			<tbody>
				<tr>
					<td>Fichas por P&aacute;gina:</td>
					<td><?= form_input('fichaspp', $fichaspp, 'class="normal_input" maxlength="3"') ?></td>
				</tr>
				<tr>
					<td>Agenda Inicial:</td>
					<td>
						<select name="agendainicial" size="1" class="normal_select">
							<? foreach (Usuario::atual()->getAgendas() as $obj_agenda) { ?>
								<option value="<?= $obj_agenda->id ?>" <?=($obj_agenda->id == Usuario::atual()->getConfiguracao('agendainicial') ? 'selected="true"' : '') ?>><?= $obj_agenda->nome ?></option>
							<? } ?>
						</select>
					</td>
				</tr>
				<!--
				<tr>
					<td>Tema:</td>
					<td>
						<select name="agenda" size="1" class="normal_select">
							<option value="verde" <?=($obj_agenda->id == $this->session->userdata('agenda') ? 'selected="true"' : '') ?>>Verde</option>
						</select>
					</td>
				</tr>
				-->
			</tbody>
		</table><br />
		<div align="center" style="clear: both; margin-top: 41px">
			<a class="itembutton" href="javascript:" onclick="form_preferencias.submit();">Salvar</a>
		</div>
		<?= form_close() ?>
	</div>
</div>


<script language="javascript">
	var input_nome = document.getElementById('nome');
	input_nome.focus() ;
</script>

<? $this->load->view('_template_close_view'); ?>
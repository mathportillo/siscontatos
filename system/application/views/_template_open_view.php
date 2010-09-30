<html>
	<head>
		<title>Sistema de Contatos</title>
		<link href="<?= base_url() ?>css/style.css" rel="stylesheet" type="text/css"/>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<!-- <link href="http://gfx2.hotmail.com/mail/w4/m3/ltr/mfav.ico" type="image/x-icon" rel="icon"> -->
	</head>

	<body>
		<script type="text/javascript">
		<!--
			function submitenter(myfield,e,mensagem)
			{
				var keycode;
				if (window.event) keycode = window.event.keyCode;
				else if (e) keycode = e.which;
				else return true;

				if (keycode == 13) {
					if (mensagem != '') {
						if (confirm(mensagem)) {
							myfield.form.submit();
							return false;
						} else {
							return false;
						}
					} else {
						myfield.form.submit();
						return false;	
					}
				}
				return true;
			}
		//-->
		</script>
		<div id="div_page">
			<div id="div_header">
				<div id="div_logo">
					<?= anchor('principal', '<img src="' . base_url() . 'img/logo_seplag.gif" style="border: none;" />') ?>
					
				</div>
				<div id="div_info">
					<div style="float: right">
						<?= anchor('login/sair', 'Sair', 'class="itembutton"') ?>
						<?= anchor('configuracoes','Configura&ccedil;&otilde;es', 'class="itembutton"') ?>
					</div>
					<div style="float: right; margin: auto; line-height: 22px;">
						Usu&aacute;rio: <?= Usuario::atual()->username ?> (<?= Usuario::atual()->nome ?>)&nbsp;
					</div>
				</div>
			</div>
			<div id="div_menu">
				<div id="div_lista_agendas">
					<?= form_open('util/muda_agenda', 'id="form_muda_agenda"') ?>
						<?= form_hidden('redirect', substr($this->uri->uri_string(), 1, strlen($this->uri->uri_string()) - 1)) ?>
						<select name="agenda" size="1" onchange="javascript:form_muda_agenda.submit();">
							<? foreach (Usuario::atual()->getAgendas() as $obj_agenda) { ?>
								<option value="<?= $obj_agenda->id ?>" <?=($obj_agenda->id == $this->session->userdata('agenda') ? 'selected="true"' : '') ?>><?= $obj_agenda->nome ?></option>
							<? } ?>
						</select>
					<?= form_close() ?>
				</div>
				<div id="div_botoes">
					<? $this->load->view('menu_view'); ?>&nbsp;
				</div>
			</div>
			<div id="div_maincontent"> 


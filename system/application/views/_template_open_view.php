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
					<?= anchor('principal', '<img src="' . base_url() . 'img/logo.gif" style="border: none;" />') ?>
					
				</div>
				<div id="div_info">
					Usuario: <?= Usuario::atual()->username ?>
					(<?= Usuario::atual()->nome ?>)
					<?= anchor('login/sair', 'Sair', 'class="itembutton"') ?>
				</div>
			</div>
			<div id="div_menu">
				<? $this->load->view('menu_view'); ?>&nbsp;
			</div>
			<div id="div_maincontent"> 


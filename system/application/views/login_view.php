<html>
	<head>
		<title>Sistema de Contatos</title>
		<link href="<?= base_url() ?>css/style.css" rel="stylesheet" type="text/css"/>
	</head>

	<body>
		<script type="text/javascript">
		<!--
			function submitenter(myfield,e)
			{
				var keycode;
				if (window.event) keycode = window.event.keyCode;
				else if (e) keycode = e.which;
				else return true;

				if (keycode == 13) {
					myfield.form.submit();
					return false;
				}
				return true;
			}
		//-->
		</script>
		<div id="div_formlogin">
			<div align="center">
				<img src="<?= base_url() ?>img/logo.gif" />
			</div><br />
			<?= form_open('login/entrar', 'id="form_login"') ?>
			<div align="center">
				<? if ($error != "") { ?>
					<div align="center" class="error"><?= $error ?></div><br />
				<? } ?>
				<div align="center" style="width: 200px; margin: 2px auto; height: 22px;">
					<div align="center" style="float: left; line-height: 22px;">
						Login:
					</div>
					<div align="right" style="float: right;">
						<?= form_input('username', '', 'class="normal_input" onkeyup="javascript:submitenter(this,event);"') ?>
					</div>
				</div>
				<div align="center" style="clear: both; width: 200px; margin: auto; height: 25px;">
					<div align="center" style="float: left; line-height: 22px;">
						Senha:
					</div>
					<div align="right" style="float: right;">
						<?= form_password('password', '', 'class="normal_input" onkeyup="javascript:submitenter(this,event);"') ?>
					</div>
				</div><br />
				<div align="center" style="clear: both;">
						<a class="itembutton" href="javascript:" onClick="form_login.submit();">Entrar</a>
				</div>
			</div>
			<?= form_close() ?>
		</div>
	</body>
</html>

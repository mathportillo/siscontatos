<?
	function formatatel($str)
	{
		if($str == '') {
			return '';
		}
		$arr_result = explode('-', $str);
		return '+' . $arr_result[0] . ' ' . $arr_result[1] . ' ' . $arr_result[2];
	}

?>
<? if($total_rows > 0) { ?>
	<? $lin = 0; ?>
	<? foreach ($contatos as $contato) { ?>
		<? $lin++; ?>
		<div class="ficha<?= ($lin < $linmax ? ' marginbaixo' : '') ?>"><div class="ficha_margin">
			<div class="linhazona">
				<div class="ficha_esquerda">
					<?= htmlentities($contato->nome) ?>
				</div><div class="ficha_acoes">
					<? if (Usuario::atual()->Permissoes[0]->pode_editar) { ?>
						<?= anchor('contatos/editar/' . $contato->id,'<img src="' . base_url() . 'img/edit.gif" border="0" title="Editar" />') ?>
						<?= anchor('contatos/excluir/' . $contato->id,'<img src="' . base_url() . 'img/remove.gif" border="0" title="Excluir" />', 'onclick="javascript:if (confirm(\'Você realmente deseja excluir o contato ' . addslashes(htmlentities($contato->nome)) . '?\')) { return true; } else { return false; }"') ?>
					<? } ?>
				</div>
			</div>
			<div class="linha">
				<div class="ficha_esquerda">
					<b>Entidade:</b> <?= htmlentities($contato->entidade) ?>
				</div><div class="ficha_direita">
					<b>Cargo:</b> <?= $contato->cargo ?>
				</div>
			</div>
			<div class="linha">
				<div class="ficha_esquerda">
					<b>Tel(s) Comercial(is):</b> <?= formatatel($contato->telefone1) ?><?= ($contato->telefone1 && $contato->telefone2 ? '&nbsp;&nbsp;/&nbsp;&nbsp;' : '') ?><?= formatatel($contato->telefone2) ?>
				</div><div class="ficha_direita">
					<b>Tel Residencial:</b> <?= formatatel($contato->telefone3) ?>
				</div>
			</div>
			<div class="linha">
				<div class="ficha_esquerda">
					<b>Celular(es):</b> <?= formatatel($contato->celular1) ?><?= ($contato->celular1 && $contato->celular2 ? '&nbsp;&nbsp;/&nbsp;&nbsp;' : '') ?><?= formatatel($contato->celular2) ?>
				</div><div class="ficha_direita">
					<b>Fax:</b> <?= formatatel($contato->fax) ?>
				</div>
			</div>
			<div class="linha">
				<div class="ficha_esquerda">
					<b>E-mail(s):</b> <?= $contato->email1 ?><?= ($contato->email1 && $contato->email2 ? '&nbsp;&nbsp;/&nbsp;&nbsp;' : '') ?><?= $contato->email2 ?>
				</div>
			</div>
			<div class="linha">
				<div class="ficha_esquerda">
					<b>Endere&ccedil;o:</b> <?= $contato->logradouro ?><?= ($contato->logradouro && $contato->numero ? ',' : '') ?> <?= $contato->numero ?><?= ($contato->numero && $contato->complemento ? ',' : '') ?> <?= $contato->complemento ?><?= ($contato->complemento && $contato->bairro ? ',' : '') ?> <?= $contato->bairro ?>
				</div>
			</div>
			<div class="linha">
				<div class="ficha_esquerda">
					<b>Localiza&ccedil;&atilde;o:</b> <?= $contato->cidade ?><?= ($contato->cidade && $contato->estado ? ',' : '') ?> <?= $contato->estado ?><?= ($contato->estado && $contato->pais ? ',' : '') ?> <?= $contato->pais ?>
				</div><div class="ficha_acoes">
					<img src="<?= base_url() ?>img/add.gif" title="<?= $contato->observacao ?>"/>
				</div><div class="ficha_direita" style="width: 33%">
					<b>CEP:</b> <?= $contato->cep ?>
				</div>
			</div>
		</div></div>
	<? } ?>
<? } else { ?>
	N&atilde;o h&aacute; registros com esse crit&eacute;rio de pesquisa
<? } ?>
<?= form_close() ?>

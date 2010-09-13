<? $this->load->view('_template_open_view'); ?>
<div id="div_contatos">
	<?= form_open('contatos/index', 'id="form_busca"') ?>
	<?= form_hidden('pagina_atual', $pagina_atual) ?>
	<?= form_hidden('itens_por_pagina', $itens_por_pagina) ?>
	<?= form_hidden('letra_inicial', $letra_inicial) ?>
	<div id="div_cabecalho" class="redondocima"><div id="div_cabecalho_margin">
		<div class="faixa">
			<div id="div_catalogo">
				<?
					$arr_letras = array('A','B','C','D','E','F','G','H','I','J','L','M','N','O','P','Q','R','S','T','U','V','X','Z');
					foreach ($arr_letras as $letra) { ?>
						<? if ($letra == $letra_inicial) { ?>
							<span class="spanbox"><?= $letra ?></span>
						<? } else { ?> 
							<a href="javascript:" onclick="javascript: form_busca.letra_inicial.value = '<?= $letra ?>'; form_busca.pagina_atual.value = '1'; form_busca.submit();"><?= $letra ?></a>
						<? } ?>
					<? }
				?>
				<? if ('' == $letra_inicial) { ?>
					<span class="spanbox">Todos</span>
				<? } else { ?> 
					<a href="javascript:" onclick="javascript: form_busca.letra_inicial.value = ''; form_busca.pagina_atual.value = '1'; form_busca.submit();">Todos</a>
				<? } ?>
			</div>
			<div id="div_novo_contato">
				<? if (Usuario::atual()->Permissoes[0]->pode_editar) { ?>
					<?= anchor('contatos/novo', 'Novo Contato', 'class="itembutton"'); ?>
				<? } ?>
			</div>
		</div>
		<div class="faixa">
			<div id="div_paginacao">
				<div class="priult">
					<? if ($pagina_atual > 3) { ?>
						<a href="javascript:" onclick="javascript:form_busca.pagina_atual.value = 1; form_busca.submit();">Primeira</a>
					<? } ?>
				</div>
				<div class="proant">
					<? if ($pagina_atual > 1) { ?>
						<a href="javascript:" onclick="javascript:form_busca.pagina_atual.value = <?= ($pagina_atual - 1) ?>; form_busca.submit();">&nbsp;<&nbsp;</a>
					<? } ?>
				</div>
				<div class="pagnum">
					<? if ($pagina_atual == $total_de_paginas && $total_de_paginas > 4) { ?>
						<a href="javascript:" onclick="javascript:form_busca.pagina_atual.value = <?= ($pagina_atual - 4) ?>; form_busca.submit();"><?= $pagina_atual - 4 ?></a>
					<? } ?>
					<? if ($pagina_atual > $total_de_paginas - 2 && $total_de_paginas > 4) { ?>
						<a href="javascript:" onclick="javascript:form_busca.pagina_atual.value = <?= ($pagina_atual - 3) ?>; form_busca.submit();"><?= $pagina_atual - 3 ?></a>
					<? } ?>
					<? if ($pagina_atual > 2) { ?>
						<a href="javascript:" onclick="javascript:form_busca.pagina_atual.value = <?= ($pagina_atual - 2) ?>; form_busca.submit();"><?= $pagina_atual - 2 ?></a>
					<? } ?>
					<? if ($pagina_atual > 1) { ?>
						<a href="javascript:" onclick="javascript:form_busca.pagina_atual.value = <?= ($pagina_atual - 1) ?>; form_busca.submit();"><?= $pagina_atual - 1 ?></a>
					<? } ?>
					<? if ($total_de_paginas > 1) { ?>
						 <?= "<strong>$pagina_atual</strong>" ?>
					<? } ?>
					<? if ($pagina_atual < $total_de_paginas) { ?>
						<a href="javascript:" onclick="javascript:form_busca.pagina_atual.value = <?= ($pagina_atual + 1) ?>; form_busca.submit();"><?= $pagina_atual + 1 ?></a>
					<? } ?>
					<? if ($pagina_atual < $total_de_paginas - 1) { ?>
						<a href="javascript:" onclick="javascript:form_busca.pagina_atual.value = <?= ($pagina_atual + 2) ?>; form_busca.submit();"><?= $pagina_atual + 2 ?></a>
					<? } ?>
					<? if ($pagina_atual == 1 && $total_de_paginas > 3) { ?>
						<a href="javascript:" onclick="javascript:form_busca.pagina_atual.value = 4; form_busca.submit();">4</a>
					<? } ?>
					<? if ($pagina_atual < 3 && $total_de_paginas > 4) { ?>
						<a href="javascript:" onclick="javascript:form_busca.pagina_atual.value = 5; form_busca.submit();">5</a>
					<? } ?>
				</div>
				<div class="proant">
					<? if ($pagina_atual < $total_de_paginas) { ?>
						<a href="javascript:" onclick="javascript:form_busca.pagina_atual.value = <?= ($pagina_atual + 1) ?>; form_busca.submit();">&nbsp;>&nbsp;</a>
					<? } ?>
				</div>
				<div class="priult">
					<? if ($pagina_atual < $total_de_paginas - 2) { ?>
						<a href="javascript:" onclick="javascript:form_busca.pagina_atual.value = <?= ($total_de_paginas) ?>; form_busca.submit();">&Uacute;ltima</a>
					<? } ?>
				</div>
			</div>
			<div class="busca">
				<a class="itembutton" href="javascript:" onclick="form_busca.submit();">Buscar</a>
			</div>
			<div class="busca">
				<?= form_input('busca', $busca) ?>
			</div>
		</div>
		<div class="espaco_superior redondocima">&nbsp;</div>
	</div></div>
	<? $linmax = count($contatos); ?>
	<div id="div_miolo" style="height: <?= ($linmax > 0 ? $linmax*122+($linmax-1)*5 : 17) ?>px">
		<div class="barra_lateral"></div>
		<div id="div_fichas"><div id="div_fichas_margin">
			<? $data['contatos'] = $contatos; ?>
			<? $data['linmax'] = $linmax; ?>
			<? $this->load->view('fichas_view', $data); ?>
		</div></div>
		<div class="barra_lateral"></div>
	</div>
	<div id="div_rodape" class="redondobaixo"><div id="div_rodape_margin">
		<div class="espaco_inferior redondobaixo">&nbsp;</div>
		<div class="faixa">
			<div id="div_importar">
				<? if (Usuario::atual()->Permissoes[0]->pode_editar) { ?>
					<?= anchor('contatos/importar', 'Importar', 'class="itembutton"'); ?>
				<? } ?>
			</div>
			<div  id="div_exportar">
				<?= anchor('contatos/exportar', 'Exportar', 'class="itembutton"'); ?>
			</div>
		</div>
	</div></div>
</div>
<? $this->load->view('_template_close_view'); ?>

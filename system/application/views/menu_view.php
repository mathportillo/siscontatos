<?= anchor('principal', 'Principal') ?>


<? if (Usuario::atual()->Permissoes[0]->pode_visualizar) { ?>

	<?= anchor('contatos', 'Contatos') ?>

<? } ?>


<? if (Usuario::atual()->Permissoes[0]->pode_gerenciar) { ?>

	<?= anchor('usuarios', 'Usu&aacute;rios') ?>

<? } ?>

<? if (Usuario::atual()->pode_administrar) { ?>

	<?= anchor('agendas', 'Agendas') ?>

<? } ?>
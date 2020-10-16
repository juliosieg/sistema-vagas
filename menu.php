<?
$pages = array(
    [
        'item' => 'home',
        'active' => (isset($_GET['pg']) && verificaMenuAtivo('home')) || !isset($_GET['pg']) ? 'active' : '',
        'label' => 'Início',
        'icon' => 'fas fa-tachometer-alt',
        'visible' => true
    ],
    [
        'item' => 'meus-dados',
        'active' => verificaMenuAtivo('meus-dados') ? 'active' : '',
        'label' => 'Meus dados',
        'icon' => 'fas fa-user',
        'visible' => isset($_SESSION['tipo_perfil']) && $_SESSION['tipo_perfil'] != 1 ? true : false
    ],
    [
        'item' => 'vagas',
        'active' => verificaMenuAtivo('vagas') ? 'active' : '',
        'label' => 'Vagas',
        'icon' => 'fas fa-id-card',
        'visible' => isset($_SESSION['tipo_perfil']) && $_SESSION['tipo_perfil'] == 1 ? true : false
    ],
    [
        'item' => 'vagas-candidato',
        'active' => verificaMenuAtivo('vagas-candidato') ? 'active' : '',
        'label' => 'Vagas',
        'icon' => 'fas fa-id-card',
        'visible' => isset($_SESSION['tipo_perfil']) && $_SESSION['tipo_perfil'] != 1 ? true : false
    ],
    [
        'item' => 'candidatos',
        'active' => verificaMenuAtivo('candidatos') ? 'active' : '',
        'label' => 'Candidatos',
        'icon' => 'fas fa-folder-open',
        'visible' => isset($_SESSION['tipo_perfil']) && $_SESSION['tipo_perfil'] == 1 ? true : false
    ],
    [
        'item' => 'alterarSenha',
        'active' => verificaMenuAtivo('alterarSenha') ? 'active' : '',
        'label' => 'Alterar a senha',
        'icon' => 'fas fa-key',
        'visible' => true
    ],
    [
        'item' => 'logout',
        'active' => '',
        'label' => 'Sair',
        'icon' => 'fas fa-sign-out-alt',
        'visible' => true
    ]
);

function verificaMenuAtivo($item){
    return isset($_GET['pg']) && $_GET['pg'] == $item;
}
?>

<ul class="nav nav-pills nav-sidebar flex-column" rdion="false">
  
    <? foreach($pages as $page) { ?>

        <? if($page['visible']) { ?>

            <li class="nav-item">
                <a href="index.php?pg=<?=$page['item'] ?? ''?>" class="nav-link <?=$page['active'] ?? ''?>">
                    <i class="nav-icon <?=$page['icon'] ?? ''?>"></i>
                    <p><?=$page['label'] ?? ''?></p>
                </a>
            </li>

        <? } ?>

    <? } ?>

</ul>
<?

$page = 'pages/admin/index.php';

if(isset($_GET['pg'])){
    switch ($_GET['pg']) {
        case 'home':
            $page = 'pages/admin/index.php';
            break;
        case 'vagas':
            if($_SESSION['tipo_perfil'] == 1) {
                $page = 'pages/vagas/index.php';
            } else {
                $page = 'pages/admin/pg-nao-encontrada.php';
            }
            break;
        case 'candidatos':
            if($_SESSION['tipo_perfil'] == 1) {
                $page = 'pages/candidatos/index.php';
            } else {
                $page = 'pages/admin/pg-nao-encontrada.php';
            }
            break;
        case 'alterarSenha':
            $page = 'pages/admin/alterarSenha.php';
            break;
        case 'logout':
            $page = 'pages/functions/logout.php';
            break;
        case 'meus-dados':
            if($_SESSION['tipo_perfil'] == 2) {
                $page = 'pages/meus-dados/index.php';
            } else {
                $page = 'pages/admin/pg-nao-encontrada.php';
            }
            break;
        case 'vagas-candidato':
            if($_SESSION['tipo_perfil'] == 2) {
                $page = 'pages/vagas-candidato/index.php';
            } else {
                $page = 'pages/admin/pg-nao-encontrada.php';
            }
            break;
        
    }
}

require_once($page);
?>
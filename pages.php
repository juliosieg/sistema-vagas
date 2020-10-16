<?

$page = 'pages/admin/index.php';

if(isset($_GET['pg'])){
    switch ($_GET['pg']) {
        case 'home':
            $page = 'pages/admin/index.php';
            break;
        case 'vagas':
            $page = 'pages/vagas/index.php';
            break;
        case 'candidatos':
            $page = 'pages/candidatos/index.php';
            break;
        case 'alterarSenha':
            $page = 'pages/admin/alterarSenha.php';
            break;
        case 'logout':
            $page = 'pages/functions/logout.php';
            break;
        
    }
}

require_once($page);
?>
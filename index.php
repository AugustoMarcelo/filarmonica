<?php
    session_start();
    require_once("vendor/autoload.php");
    require_once("functions.php");

    use Slim\Slim;
    use Framework\database\Database;
    use Framework\Page;
    use Framework\model\User;
    use Framework\model\Componente;
    use Framework\model\Tocata;
    use Framework\model\Frequencia;
    use Framework\utils\DateUtils;
    use Framework\utils\Report;
    use Framework\utils\Message;
    use Framework\utils\Cookie;

    $app = new Slim();

    $app->config('debug', true);

    $app->get('/', function() {
        User::verifyLogin();
        $page = new Page([
            "data" => array(
                "homeClassActive" => "active",
                "componentesClassActive" => "",
                "userClassActive" => "",
                "tocatasClassActive" => "",
                "user" => User::getFromSession()->getData()
            )
        ]);
        $page->setTemplate("index");
    });

    $app->get('/login', function() {
        $cookie = array();
        if (Cookie::get("LOGIN_COOKIE")) {
            $cookie = [
                "user" => Cookie::get("LOGIN_COOKIE"),
                "password" => Cookie::get("PASSWORD_COOKIE"),
                "remember" => Cookie::get("REMEMBER_COOKIE")
            ];
        }
        $page = new Page([
            "header" => false,
            "footer" => false
        ]);
        $page->setTemplate("login", [
            "message" => Message::getMessage(),
            "cookie" => $cookie
        ]);
    });

    $app->post('/login', function() {
        User::login($_POST['user'], $_POST['password']);
        if (isset($_POST['remember'])) {
            Cookie::create("LOGIN_COOKIE", $_POST['user']);
            Cookie::create("PASSWORD_COOKIE", $_POST['password']);
            Cookie::create("REMEMBER_COOKIE", $_POST['remember']);
        }
        header("Location: /");
        exit;
    });

    $app->get('/logout', function() {
        User::logout();
        header("Location: /login");
        exit;
    });

    // Rota para listar usuários
    $app->get('/users', function() {
        User::verifyLogin();
        $users = User::listAll();
        $page = new Page(array(
            "data" => array(
                "homeClassActive" => "",
                "componentesClassActive" => "",
                "userClassActive" => "active",
                "tocatasClassActive" => "",
                "user" => User::getFromSession()->getData()
            )
        ));
        $page->setTemplate("users", array(
            "users" => $users,
            "message" => Message::getMessage()
        ));
    });

    // Rota para acessar o cadastro de usuários
    $app->get('/users/cadastrar', function() {
        User::verifyLogin();
        $post = $_SESSION[User::SESSION]['post_submit'] ?? ["user" => "", "email" => "", "password" => ""];
        $_SESSION[User::SESSION]['post_submit'] = NULL;
        $page = new Page([
            "data" => array(
                "homeClassActive" => "",
                "componentesClassActive" => "",
                "userClassActive" => "active",
                "tocatasClassActive" => "",
                "user" => User::getFromSession()->getData(),
                "post" => $post,
                "message" => Message::getMessage()
            ),
        ]);
        $page->setTemplate("users-create");
    });

    // Rota para cadastrar um usuário
    $app->post('/users/cadastrar', function() {
        User::verifyLogin();
        $user = new User();
        $_SESSION[User::SESSION]['post_submit'] = $_POST;
        $_POST['ativo'] = isset($_POST['ativo']) ? 1 : 0;
        $user->setData($_POST);
        $saved = $user->save();
        if ($saved) {
            $_SESSION[User::SESSION]['post_submit'] = NULL;
            header("Location: /users");
            exit;
        }
        header('Location: /users/cadastrar');
        exit;
    });

    $app->get('/users/editar/:id', function($id) {
        $page = new Page([
            "data" => [
                "user" => User::getFromSession()->getData()
            ]
        ]);
    });

    // Rota para listar componentes
    $app->get('/componentes', function() {
        User::verifyLogin();
        $componentes = Componente::listAll([
            "ORDER BY nome ASC"
        ]);
        $page = new Page(array(
            "data" => array(
                "homeClassActive" => "",
                "componentesClassActive" => "active",
                "userClassActive" => "",
                "tocatasClassActive" => "",
                "user" => User::getFromSession()->getData(),
                "message" => Message::getMessage()
            )
        ));
        $page->setTemplate("componentes", array(
            "componentes" => $componentes
        ));
    });

    // Rota de adicionar componentes
    $app->get('/componentes/cadastrar', function() {
        User::verifyLogin();
        $page = new Page(array(
            "data" => array(
                "homeClassActive" => "",
                "componentesClassActive" => "active",
                "userClassActive" => "",
                "tocatasClassActive" => "",
                "user" => User::getFromSession()->getData(),
                "message" => Message::getMessage()
            )
        ));
        $page->setTemplate("componentes-create");
    });

    // Rota para enviar os dados de cadastro do componente
    $app->post('/componentes/cadastrar', function() {
        User::verifyLogin();
        $componente = new Componente();
        $_POST['cadastrado_por'] = $_SESSION[User::SESSION] ? $_SESSION[User::SESSION]['id'] : 1;
        $_POST['data_cadastro'] = DateUtils::now("Y-m-d H:i:s");
        $_POST['data_admissao'] = !empty($_POST['data_admissao']) ? $_POST['data_admissao'] : null;
        $_POST['ativo'] = isset($_POST['ativo']) ? 1 : 0;
        $componente->setData($_POST);
        $componente->save();
        header("Location: /componentes");
        exit;
    });

    // Rota de atualizar componente
    $app->get('/componentes/editar/:id', function($id) {
        User::verifyLogin();
        $componente = new Componente();
        $componente->get((int) $id);
        $page = new Page(array(
            "data" => array(
                "homeClassActive" => "",
                "componentesClassActive" => "active",
                "userClassActive" => "",
                "tocatasClassActive" => "",
                "user" => User::getFromSession()->getData()
            )
        ));
        $page->setTemplate("componentes-update", array(
            "componente" => $componente->getData()
        ));
    });

    // Rota para atualizar um componente
    $app->post('/componentes/editar/:id', function($id) {
        User::verifyLogin();
        $componente = new Componente();
        $_POST['matricula'] = isset($_POST['matricula']) && !empty($_POST['matricula']) ? $_POST['matricula'] : '0';
        $_POST['ativo'] = isset($_POST['ativo']) ? 1 : 0;
        $_POST['data_admissao'] = !empty($_POST['data_admissao']) ? $_POST['data_admissao'] : null;
        $_POST['atualizado_por'] = $_SESSION[User::SESSION] ? $_SESSION[User::SESSION]['id'] : 1;
        $_POST['data_atualizacao'] = DateUtils::now("Y-m-d H:i:s");
        $componente->get((int) $id);
        $componente->setData($_POST);
        $componente->update();
        header("Location: /componentes");
        exit;
    });

    // Rota para remover um componente
    $app->get('/componentes/delete/:id', function($id) {
        User::verifyLogin();
        $componente = new Componente();
        $componente->get((int) $id);
        $componente->delete();
        header("Location: /componentes");
        exit;
    });

    $app->get('/componentes/relatorio/fardamento', function() {
        Report::uniforms(Componente::listAll(["ORDER BY nome ASC"]), "Fardamento.pdf", false);
    });

    // Rota para listar todas as tocatas
    $app->get('/tocatas', function() {
        User::verifyLogin();
        $tocatas = Tocata::listAll([
            "ORDER BY data_tocata DESC, horario DESC"
        ]);
        $page = new Page(array(
            "data" => array(
                "homeClassActive" => "",
                "componentesClassActive" => "",
                "userClassActive" => "",
                "tocatasClassActive" => "active",
                "user" => User::getFromSession()->getData()
            )
        ));
        $page->setTemplate("tocatas", array(
            "tocatas" => $tocatas,
            "message" => Message::getMessage()
        ));
    });

    $app->get('/tocatas/cadastrar', function() {
        User::verifyLogin();
        $componentes = Componente::listAll();
        $page = new Page(array(
            "data" => array(
                "homeClassActive" => "",
                "componentesClassActive" => "",
                "userClassActive" => "",
                "tocatasClassActive" => "active",
                "user" => User::getFromSession()->getData()
            )
        ));
        $page->setTemplate("tocatas-create", array(
            "componentes" => $componentes
        ));
    });

    // ROTA PARA CADASTRAR UMA TOCATA
    $app->post('/tocatas/cadastrar', function() {
        User::verifyLogin();
        $_POST['cadastrado_por'] = $_SESSION[User::SESSION] ? $_SESSION[User::SESSION]['id'] : 1;
        $_POST['data_cadastro'] = DateUtils::now("Y-m-d H:i:s");
        $tocata = new Tocata();
        $tocata->setData($_POST);
        $tocata->save();
        header("Location: /tocatas");
        exit;
    });

    // ROTA PARA ATUALIZAR UMA TOCATA
    $app->get('/tocatas/editar/:idtocata', function($idtocata) {
        User::verifyLogin();
        $tocata = new Tocata();
        $tocata->get((int) $idtocata);
        $page = new Page(array(
            "data" => array(
                "homeClassActive" => "",
                "componentesClassActive" => "",
                "userClassActive" => "",
                "tocatasClassActive" => "active",
                "user" => User::getFromSession()->getData()
            )
        ));
        $page->setTemplate("tocatas-update", array(
            "tocata" => $tocata->getData()
        ));
    });

    // ROTA PARA ATUALIZAR UMA TOCATA
    $app->post('/tocatas/editar/:idtocata', function($idtocata) {
        User::verifyLogin();
        $tocata = new Tocata();
        $_POST['atualizado_por'] = isset($_SESSION[User::SESSION]) ? $_SESSION[User::SESSION]['id'] : 1;
        $_POST['data_atualizacao'] = DateUtils::now('Y-m-d H:i:s');
        $tocata->get((int) $idtocata);
        $tocata->setData($_POST);
        $tocata->update();
        header("Location: /tocatas");
        exit;
    });

    // ROTA PARA REMOVER UMA TOCATA
    $app->get('/tocatas/delete/:idtocata', function($idtocata) {
        $tocata = new Tocata();
        $tocata->get((int) $idtocata);
        $tocata->delete();
        header("Location: /tocatas");
        exit;
    });

    // ROTA PARA LISTA DE CHAMADA
    $app->get('/tocatas/:idtocata/chamada', function($idtocata) {
        $frequencia = new Frequencia();
        $frequencia->get((int) $idtocata);
        foreach ($frequencia->getPresencas() as $componente) {
            if ((int)$componente['presenca'] == 1 || (int)$componente['presenca'] == 2) {
                $editRoute = true;
                break;
            }
        }
        if (isset($editRoute)) {
            header("Location: /tocatas/editar/$idtocata/chamada");
            exit;
        }
        $componentes = Componente::listAll([
            "WHERE ativo = 1",
            "ORDER BY nome ASC"
        ]);
        $tocata = new Tocata();
        $tocata->get((int) $idtocata);
        $page = new Page(array(
            "data" => array(
                "homeClassActive" => "",
                "componentesClassActive" => "",
                "userClassActive" => "",
                "tocatasClassActive" => "active",
                "user" => User::getFromSession()->getData()
            )
        ));
        $page->setTemplate('chamada', array(
            "componentes" => $componentes,
            "tocata" => $tocata->getData(),
            "presencas" => $frequencia->getPresencas()
        ));
    });

    $app->get('/tocatas/editar/:idtocata/chamada', function($idtocata) {
        $frequencia = new Frequencia();
        $frequencia->get((int) $idtocata);
        $tocata = new Tocata();
        $tocata->get((int) $idtocata);
        $page = new Page(array(
            "data" => array(
                "homeClassActive" => "",
                "componentesClassActive" => "",
                "userClassActive" => "",
                "tocatasClassActive" => "active",
                "user" => User::getFromSession()->getData()
            )
        ));
        $justificativas = "";
        foreach ($frequencia->getPresencas() as $componente) {
            if ($componente['presenca'] == 2) {
                $justificativas .= $componente['id'].",";
            }
        }
        $page->setTemplate('chamada-update', array(
            "tocata" => $tocata->getData(),
            "presencas" => $frequencia->getPresencas(),
            "justificativas" => $justificativas
        ));
    });

    // ROTA PARA CADASTRAR UMA CHAMADA
    $app->post('/tocatas/:idtocata/chamada', function($idtocata) {
        $frequencia = new Frequencia();
        $frequencia->setTocata_ID($idtocata);
        // REMOVE TODA A LISTA DE CHAMADA DA TOCATA ANTES
        $frequencia->delete();
        $frequencia->setPresenca(1);
        $frequencia->setCadastrado_Por(isset($_SESSION[User::SESSION]) ? $_SESSION[User::SESSION]['id'] : 1);
        $frequencia->setData_Cadastro(DateUtils::now('Y-m-d H:i:s'));
        foreach ($_POST as $key => $value) {
            $field = explode('_', $key);
            if ($field[0] == 'componente') {
                $frequencia->setComponente_ID($field[1]);
                $frequencia->save();
            }
        }
        $justificativas = explode(",", rtrim($_POST['justificativas'], ","));
        $frequencia->setPresenca(2);
        for ($j = 0; $j < count($justificativas); $j++) {
            $frequencia->setComponente_ID($justificativas[$j]);
            $frequencia->save();
        }
        $frequencia->setFaults();
        header("Location: /tocatas");
        exit;
    });

    $app->post('/tocatas/relatorio/folha', function() {
        Report::monthFaults(Tocata::getFaultsForMonth($_POST['month']), "folha-mensal-".$_POST['month'], false);
    });

    $app->get('/tocatas/:idtocata/chamada/folha', function($idtocata) {
        $frequencia = new Frequencia();
        $frequencia->get($idtocata);
        $tocata = new Tocata();
        $tocata->get($idtocata);
        Report::individualCallList($frequencia->getPresencas(), $tocata, "folha-individual", false);
    });

    // ROTA PARA RESETAR SENHA
    $app->get('/recuperar-senha', function() {
        $page = new Page(array(
            "header" => false,
            "footer" => false
        ));
        $page->setTemplate('forgot-password', [
            "message" => Message::getMessage()
        ]);
    });

    $app->post('/recuperar-senha', function() {
        $user = User::recoverPassword($_POST['email']);
        if (!is_null($user)) {
            header("Location: /recuperar-senha/enviado");
            exit;
        }
        header("Location: /recuperar-senha");
        exit;
    });

    $app->get('/recuperar-senha/enviado', function() {
        $page = new Page(array(
            "header" => false,
            "footer" => false
        ));
        $page->setTemplate('forgot-sent');
    });

    // ROTA ACESSADA PELO LINK ENVIADO NO E-MAIL
    $app->get('/resetar-senha', function() {

        $user = User::validateRecoverCode($_GET['code']);

        $page = new Page(array(
            "header" => false,
            "footer" => false
        ));
        $page->setTemplate('forgot-reset', array(
            "name" => $user['user'],
            "code" => $_GET['code']
        ));
    });

    // ROTA PARA LINKS JÁ EXPIRADOS OU UTILIZADOS
    $app->get('/resetar-senha/error', function() {
        $page = new Page([
            "header" => false,
            "footer" => false
        ]);
        $page->setTemplate('forgot-reset-error');
    });

    $app->post('/resetar-senha', function() {
        $forgotUser = User::validateRecoverCode($_POST['code']);
        User::setDataRecover($forgotUser['recovery_id']);
        $user = new User();
        $user->get((int) $forgotUser['id']);
        $user->setNewPassword($_POST['password']);
        $page = new Page([
            "header" => false,
            "footer" => false
        ]);
        $page->setTemplate('forgot-reset-success');
    });

    $app->notFound(function() use ($app) {
        if (!User::getFromSession()->getData()) {
            header('Location: /login');
            exit;
        }
        $page = new Page(array(
            "data" => array(
                "homeClassActive" => "",
                "componentesClassActive" => "",
                "userClassActive" => "",
                "tocatasClassActive" => "active",
                "user" => User::getFromSession()->getData()
            )
        ));
        $page->setTemplate('404');
    });

    $app->run();
?>
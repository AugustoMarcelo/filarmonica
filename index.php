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
    use Framework\utils\DateUtils;

    $app = new Slim();

    $app->config('debug', true);

    $app->get('/', function() {
        User::verifyLogin();
        $page = new Page([
            "data" => array(
                "componentesClassActive" => "",
                "userClassActive" => "",
                "frequenciasClassActive" => "",
                "tocatasClassActive" => ""
            )
        ]);
        $page->setTemplate("index");
    });

    $app->get('/login', function() {
        $page = new Page([
            "header" => false,
            "footer" => false
        ]);
        $page->setTemplate("login");
    });

    $app->post('/login', function() {
        User::login($_POST['user'], $_POST['password']);
        header("Location: /");
        exit;
    });

    $app->get('/logout', function() {
        User::logout();
        header("Location: /login");
        exit;
    });

    $app->get('/forgot-password', function() {
        $page = new Page(array(
            "header" => false,
            "footer" => false
        ));
        $page->setTemplate("forgot-password");
    });

    // Rota para listar usuários
    $app->get('/users', function() {
        User::verifyLogin();
        $users = User::listAll();
        $page = new Page(array(
            "data" => array(
                "componentesClassActive" => "",
                "userClassActive" => "active",
                "frequenciasClassActive" => "",
                "tocatasClassActive" => ""
            )
        ));
        $page->setTemplate("users", array(
            "users" => $users
        ));
    });

    $app->get('/users/editar/:id', function($id) {
        $page = new Page();
    });

    // Rota para listar componentes
    $app->get('/componentes', function() {
        User::verifyLogin();
        $componentes = Componente::listAll();
        $page = new Page(array(
            "data" => array(
                "componentesClassActive" => "active",
                "userClassActive" => "",
                "frequenciasClassActive" => "",
                "tocatasClassActive" => ""
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
                "componentesClassActive" => "active",
                "userClassActive" => "",
                "frequenciasClassActive" => "",
                "tocatasClassActive" => ""
            )
        ));
        $page->setTemplate("componentes-create");
    });

    // Rota para enviar os dados de cadastro do componente
    $app->post('/componentes/cadastrar', function() {
        User::verifyLogin();
        $componente = new Componente();
        $_POST['cadastrado_por'] = $_SESSION[User::SESSION] ?? 1;
        $_POST['data_cadastro'] = DateUtils::now("Y-m-d H:i:s");
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
                "componentesClassActive" => "active",
                "userClassActive" => "",
                "frequenciasClassActive" => "",
                "tocatasClassActive" => ""
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
        $_POST['ativo'] = isset($_POST['ativo']) ? 1 : 0;
        $_POST['atualizado_por'] = $_SESSION[User::SESSION] ?? 1;
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

    // Rota para listar todas as tocatas
    $app->get('/tocatas', function() {
        User::verifyLogin();
        $tocatas = Tocata::listAll();
        $page = new Page(array(
            "data" => array(
                "componentesClassActive" => "",
                "userClassActive" => "",
                "frequenciasClassActive" => "",
                "tocatasClassActive" => "active"
            )
        ));
        $page->setTemplate("tocatas", array(
            "tocatas" => $tocatas
        ));
    });

    $app->get('/tocatas/cadastrar', function() {
        User::verifyLogin();
        $componentes = Componente::listAll();
        $page = new Page(array(
            "data" => array(
                "componentesClassActive" => "",
                "userClassActive" => "",
                "frequenciasClassActive" => "",
                "tocatasClassActive" => "active"
            )
        ));
        $page->setTemplate("tocatas-create", array(
            "componentes" => $componentes
        ));
    });

    // ROTA PARA CADASTRAR UMA TOCATA
    $app->post('/tocatas/cadastrar', function() {
        User::verifyLogin();
        foreach ($_POST as $key => $value) {
            $id = explode('_', $key);
            if ($id[0] == 'componente') {
                var_dump($id[1]);
            }
        }
        exit;
    });

    $app->run();
?>
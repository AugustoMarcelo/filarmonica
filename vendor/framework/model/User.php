<?php
    namespace Framework\model;

    use Framework\database\Database;
    use Framework\Model;

    class User extends Model {

        const SESSION = "User";

        /**
         * Faz autenticação do usuário
         * @param user usuário
         * @param password senha do usuário
         */
        public static function login($user, $password) {
            $db = new Database();
            
            $results = $db->select("SELECT * FROM tb_users WHERE user = :user", array(
                ":user" => $user
            ));

            if (count($results) === 0) {
                throw new \Exception("Usuário e/ou Senha estão incorretos");
            }

            $data = $results[0];
            $password = md5($password);
            if ($password === $data['password']) {
                $user = new User();
                $user->setData($data);
                $_SESSION[User::SESSION] = $user->getData();
                return $user;
            } else {
                throw new \Exception("Usuário e/ou Senha estão incorretos");
            }
        }

        /**
         * Verifica se o usuário está logado
         */
        public static function verifyLogin() {
            if (!isset($_SESSION[User::SESSION]) || !$_SESSION[User::SESSION] || !(int)$_SESSION[User::SESSION]["id"] > 0) {
                header("Location: /login");
                exit;   
            }
        }

        /**
         * Finaliza a sessão do usuário
         */
        public static function logout() {
            $_SESSION[User::SESSION] = null;
        }

        /**
         * Retorna todos os usuários cadastrados
         * @return array
         */
        public static function listAll() {
            $db = new Database();
            return $db->select("SELECT * FROM tb_users ORDER BY user ASC");
        }
    }
?>
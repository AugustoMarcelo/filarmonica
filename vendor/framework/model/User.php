<?php
    namespace Framework\model;

    use Framework\database\Database;
    use Framework\Model;
    use Framework\utils\Mailer;

    class User extends Model {

        const SESSION = "User";
        const SECRET = "SUA_CHAVE_AQUI_!";

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

        /**
         * Busca por um usuário de acordo com o ID passado
         * @param id ID do usuário a ser buscado no banco de dados
         */
        public function get($id) {
            $db = new Database();
            $results = $db->select("SELECT * FROM tb_users WHERE id = :id", [":id" => $id]);
            $this->setData($results[0]);
        }

        public static function recoverPassword($email) {
            $db = new Database();
            $results = $db->select("SELECT * FROM tb_users WHERE email = :email", [":email" => $email]);
            if (count($results) === 0) {
                throw new \Exception("Não foi possível recuperar a senha no momento");
            } else {
                $user = $results[0];
                $results = $db->select("CALL sp_password_recovery (:user_id, :user_ip)", array(
                    ":user_id" => $user['id'],
                    ":user_ip" => $_SERVER['REMOTE_ADDR']
                ));

                if (count($results[0]) === 0) {
                    throw new \Exception("Não possível recuperar a senha no momento");
                } else {
                    $recovery = $results[0];
                    $code = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, Self::SECRET, $recovery['recovery_id'], MCRYPT_MODE_ECB));
                    $link = "recreiocaicoense.local/resetar-senha?code=$code";
                    $mailer = new Mailer($user['email'], $user['user'], "Redefinir senha do Filarmônica", "forgot", array(
                        "name" => $user['user'],
                        "link" => $link
                    ));
                    $mailer->send();
                    return $user;
                }
            }
        }

        public static function validateRecoverCode($code) {
            $recoveryID = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, Self::SECRET, base64_decode($code), MCRYPT_MODE_ECB);
            $db = new Database();
            $results = $db->select("SELECT * FROM tb_password_recovery p INNER JOIN tb_users u ON p.user_id = u.id WHERE recovery_id = :code AND recovery_data IS NULL AND DATE_ADD(data_cadastro, INTERVAL 1 HOUR) >= NOW();", array(
                ":code" => $recoveryID
            ));
            if (count($results) === 0) {
                header("Location: /resetar-senha/error");
                exit;
            } else {
                return $results[0];
            }
        }

        public static function setDataRecover($recoveryID) {
            $db = new Database();
            $db->query("UPDATE tb_password_recovery SET recovery_data = NOW() WHERE recovery_id = :recovery_id", array(
                ":recovery_id" => $recoveryID
            ));
        }

        public function setNewPassword($password) {
            $db = new Database();
            $db->query("UPDATE tb_users SET password = :password WHERE id = :id", array(
                ":password" => md5($password),
                ":id" => $this->getId()
            ));
        }
    }
?>
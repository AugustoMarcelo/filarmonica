<?php
    namespace Framework\model;

    use Framework\database\Database;
    use Framework\Model;

    class Tocata extends Model {

        /**
         * Retorna todos as tocatas cadastradas no banco
         * @return array
         */
        public static function listAll() {
            $db = new Database();
            return $db->select("SELECT * FROM tb_tocatas ORDER BY data DESC");
        }
    }
?>
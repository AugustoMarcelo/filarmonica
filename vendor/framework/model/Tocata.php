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
            return $db->select("SELECT * FROM tb_tocatas ORDER BY data_tocata DESC, horario DESC");
        }

        /**
         * Salva uma tocata no banco de dados
         */
        public function save() {
            $db = new Database();
            $results = $db->select("CALL sp_save_tocatas (:local, :data, :horario, :observacoes, :cadastrado_por, :data_cadastro)", array(
                ":local" => $this->getLocal(),
                ":data" => $this->getData_Tocata(),
                ":horario" => $this->getHorario(),
                ":observacoes" => $this->getObservacoes(),
                ":cadastrado_por" => $this->getCadastrado_Por(),
                ":data_cadastro" => $this->getData_Cadastro()
            ));
            $this->setData($results[0]);
        }
    }
?>
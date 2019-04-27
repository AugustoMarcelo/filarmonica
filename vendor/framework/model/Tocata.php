<?php
    namespace Framework\model;

    use Framework\database\Database;
    use Framework\Model;

    class Tocata extends Model {

        /**
         * Retorna todos as tocatas cadastradas no banco
         * @return array
         */
        public static function listAll(array $conditions = null) {
            $db = new Database();
            $where = '';
            if (isset($conditions) && !is_null($conditions) && !empty($conditions)) {
                foreach ($conditions as $condition) {
                    $where .= "$condition ";
                }
                $where = rtrim($where, ' ');
            }
            return $db->select("SELECT * FROM tb_tocatas $where");
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

        /**
         * Busca por uma tocata de acordo com o ID passado
         * @param id ID da tocata a ser buscada no banco de dados
         */
        public function get($id) {
            $db = new Database();
            $results = $db->select("SELECT * FROM tb_tocatas WHERE id = :id", [":id" => $id]);
            $this->setData($results[0]);
        }

        public function update() {
            $db = new Database();
            $results = $db->select("CALL sp_update_tocatas (:param_id, :param_local, :param_data_tocata, :param_horario, :param_observacoes, :param_atualizado_por, :param_data_atualizacao)", array(
                ":param_id" => $this->getId(),
                ":param_local" => $this->getLocal(),
                ":param_data_tocata" => $this->getData_Tocata(),
                ":param_horario" => $this->getHorario(),
                ":param_observacoes" => $this->getObservacoes(),
                ":param_atualizado_por" => $this->getAtualizado_Por(),
                ":param_data_atualizacao" => $this->getData_Atualizacao()
            ));
            $this->setData($results[0]);
        }

        public function delete() {
            $db = new Database();
            $db->query("CALL sp_delete_tocatas (:param_tocata_id)", [":param_tocata_id" => $this->getId()]);
        }
    }
?>
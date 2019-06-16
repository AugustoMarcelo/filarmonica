<?php
    namespace Framework\model;

    use Framework\database\Database;
    use Framework\Model;
    use Framework\utils\Message;

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
            Message::setMessage("Tocata cadastrada com sucesso", "success");
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
            Message::setMessage("Tocata editada com sucesso", Message::MESSAGE_SUCCESS);
        }

        public function delete() {
            $db = new Database();
            $db->query("CALL sp_delete_tocatas (:param_tocata_id)", [":param_tocata_id" => $this->getId()]);
        }

        public static function getFaultsForMonth($month) {
            $db = new Database();
            return $db->select("SELECT c.nome, :month AS month, COUNT(t.id) AS qtde_tocatas, SUM(IF(f.presenca = 0 OR f.presenca IS NULL, 1, 0)) AS faltas, SUM(IF(f.presenca = 3, 1, 0)) AS atrasos FROM tb_frequencias f RIGHT JOIN tb_tocatas t ON f.tocata_id = t.id OR f.tocata_id IS NULL INNER JOIN tb_componentes c ON f.componente_id = c.id OR f.componente_id IS NULL WHERE DATE_FORMAT(t.data_tocata,'%Y-%m') = :month AND c.ativo = 1 GROUP BY c.nome ORDER BY c.nome", [
                ":month" => $month
            ]);
        }
    }
?>
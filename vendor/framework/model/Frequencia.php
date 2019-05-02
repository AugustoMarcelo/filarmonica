<?php
    namespace Framework\model;

    use Framework\database\Database;
    use Framework\Model;

    class Frequencia extends Model {

        private $presencas = [];

        public function save() {
            $db = new Database();
            $db->query("CALL sp_save_frequencia (:param_tocata, :param_componente, :param_presenca, :param_cadastrado_por, :param_data_cadastro)", array(
                ":param_tocata" => $this->getTocata_ID(),
                ":param_componente" => $this->getComponente_ID(),
                ":param_presenca" => $this->getPresenca(),
                ":param_cadastrado_por" => $this->getCadastrado_Por(),
                ":param_data_cadastro" => $this->getData_Cadastro()
            ));
        }

        /**
         * Informa a falta dos componentes
         */
        public function setFaults() {
            $db = new Database();
            // Seleciona todos os componentes que faltaram
            $results = $db->select("SELECT id FROM tb_componentes WHERE ativo = 1 AND id NOT IN (SELECT componente_id FROM tb_frequencias WHERE tocata_id = :tocata)", [":tocata" => $this->getTocata_ID()]);
            // Insere a falta para os componentes que faltaram
            foreach ($results as $result) {
                $db->query("CALL sp_save_frequencia (:param_tocata, :param_componente, :param_presenca, :param_cadastrado_por, :param_data_cadastro)", array(
                    ":param_tocata" => $this->getTocata_ID(),
                    ":param_componente" => $result['id'],
                    ":param_presenca" => 0,
                    ":param_cadastrado_por" => $this->getCadastrado_Por(),
                    ":param_data_cadastro" => $this->getData_Cadastro()
                ));
            }
        }

        public function get($id) {
            $db = new Database();
            // $results = $db->select("SELECT c.nome, c.id, IF(f.presenca IS NULL, 0, 1) AS presenca FROM tb_frequencias f RIGHT JOIN tb_componentes c ON f.componente_id = c.id AND f.tocata_id = :id OR f.tocata_id IS NULL WHERE c.ativo = 1 ORDER BY c.nome", [":id" => $id]);
            $results = $db->select("SELECT c.nome, c.id, f.presenca FROM tb_frequencias f INNER JOIN tb_componentes c ON f.componente_id = c.id AND f.tocata_id = :id ORDER BY c.nome", [":id" => $id]);
            foreach ($results as $result) {
                $this->presencas[] = $result;
            }
        }

        public function delete() {
            $db = new Database();
            $db->query("DELETE FROM tb_frequencias WHERE tocata_id = :id", [":id" => $this->getTocata_ID()]);
        }

        public function getPresencas() {
            return $this->presencas;
        }
    }
?>
<?php 
    namespace Framework\Model;

    use Framework\database\Database;
    use Framework\Model;

    class Componente extends Model {

        /**
         * Retorna todos os componentes ativos cadastrados no banco
         * @param array [conditions] Restrições a serem verificadas na execução do SELECT
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
            return $db->select("SELECT * FROM tb_componentes $where");
        }

        public function save() {
            $db = new Database();
            $results = $db->select("CALL sp_save_componentes (:param_nome, :param_matricula, :param_telefone, :param_data_admissao, :param_camiseta, :param_mangas_curtas, :param_mangas_compridas, :param_calca, :param_sapato, :param_ativo, :param_cadastrado_por, :param_data_cadastro)", array(
                ":param_nome" => $this->getNome(),
                ":param_matricula" => $this->getMatricula(),
                ":param_telefone" => $this->getTelefone(),
                ":param_data_admissao" => $this->getData_Admissao(),
                ":param_camiseta" => $this->getTam_Camiseta(),
                ":param_mangas_curtas" => (int)$this->getTam_Mangas_Curtas(),
                ":param_mangas_compridas" => (int)$this->getTam_Mangas_Compridas(),
                ":param_calca" => (int)$this->getTam_Calca(),
                ":param_sapato" => (int)$this->getTam_Sapato(),
                ":param_ativo" => (int)$this->getAtivo(),
                ":param_cadastrado_por" => (int)$this->getCadastrado_Por(),
                ":param_data_cadastro" => $this->getData_Cadastro()
            ));
            $this->setData($results[0]);
        }

        /**
         * Busca por um componente de acordo com o ID passado
         * @param id ID do componente a ser buscado no banco de dados
         */
        public function get($id) {
            $db = new Database();
            $results = $db->select("SELECT * FROM tb_componentes WHERE id = :id", [":id" => $id]);
            $this->setData($results[0]);
        }

        public function update() {
            $db = new Database();
            $results = $db->select("CALL sp_update_componentes (:param_id, :param_nome, :param_matricula, :param_telefone, :param_data_admissao, :param_camiseta, :param_mangas_curtas, :param_mangas_compridas, :param_calca, :param_sapato, :param_ativo, :param_atualizado_por, :param_data_atualizacao)", array(
                ":param_id" => $this->getId(),
                ":param_nome" => $this->getNome(),
                ":param_matricula" => $this->getMatricula(),
                ":param_telefone" => $this->getTelefone(),
                ":param_data_admissao" => $this->getData_Admissao(),
                ":param_camiseta" => $this->getTam_Camiseta(),
                ":param_mangas_curtas" => (int)$this->getTam_Mangas_Curtas(),
                ":param_mangas_compridas" => (int)$this->getTam_Mangas_Compridas(),
                ":param_calca" => (int)$this->getTam_Calca(),
                ":param_sapato" => (int)$this->getTam_Sapato(),
                ":param_ativo" => (int) $this->getAtivo(),
                ":param_atualizado_por" => (int)$this->getAtualizado_Por(),
                ":param_data_atualizacao" => $this->getData_Atualizacao()
            ));
            $this->setData($results[0]);
        }

        public function delete() {
            $db = new Database();
            $db->query("DELETE FROM tb_componentes WHERE id = :id", [":id" => $this->getId()]);
        }

    }
?>
<?php 
    namespace Framework\Model;

    use Framework\database\Database;
    use Framework\Model;

    class Componente extends Model {

        /**
         * Retorna todos os componentes ativos cadastrados no banco
         * @return array
         */
        public static function listALl() {
            $db = new Database();
            return $db->select("SELECT * FROM tb_componentes WHERE ativo = 1 ORDER BY nome ASC");
        }

        public function save() {
            $db = new Database();
            $results = $db->select("CALL sp_save_componentes (:param_nome, :param_telefone, :param_camiseta, :param_mangas_curtas, :param_mangas_compridas, :param_sapato, :param_cadastrado_por, :param_data_cadastro)", array(
                ":param_nome" => $this->getNome(),
                ":param_telefone" => $this->getTelefone(),
                ":param_camiseta" => $this->getTam_Camiseta(),
                ":param_mangas_curtas" => (int)$this->getTam_Mangas_Curtas(),
                ":param_mangas_compridas" => (int)$this->getTam_Mangas_Compridas(),
                ":param_sapato" => (int)$this->getTam_Sapato(),
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
            $results = $db->select("CALL sp_update_componentes (:param_id, :param_nome, :param_telefone, :param_camiseta, :param_mangas_curtas, :param_mangas_compridas, :param_sapato, :param_cadastrado_por, :param_data_cadastro)", array(
                ":param_id" => $this->getId(),
                ":param_nome" => $this->getNome(),
                ":param_telefone" => $this->getTelefone(),
                ":param_camiseta" => $this->getTam_Camiseta(),
                ":param_mangas_curtas" => (int)$this->getTam_Mangas_Curtas(),
                ":param_mangas_compridas" => (int)$this->getTam_Mangas_Compridas(),
                ":param_sapato" => (int)$this->getTam_Sapato(),
                ":param_cadastrado_por" => (int)$this->getCadastrado_Por(),
                ":param_data_cadastro" => $this->getData_Cadastro()
            ));
            $this->setData($results[0]);
        }

        public function delete() {
            $db = new Database();
            $db->query("DELETE FROM tb_componentes WHERE id = :id", [":id" => $this->getId()]);
        }

    }
?>
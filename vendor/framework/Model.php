<?php
    namespace Framework;

    class Model {
        private $values = [];

        /**
         * Executa um método
         * @param name Nome do método a ser executado
         * @param args Argumentos para serem executados dentro do método
         */
        public function __call($name, $args) {
            $method = substr($name, 0, 3);
			$fieldName = strtolower(substr($name, 3, strlen($name)));
			switch ($method) {
				case "get":
					return $this->values[$fieldName] ?? null;
				break;
				case "set":
					$this->values[$fieldName] = $args[0];
				break;
			}
        }

        /**
         * Seta todos os dados no Model dinamicamente
         * @param data Array contendo os atributos e os valores no modo chave => valor
         */
        public function setData($data = array()) {
            foreach ($data as $key => $value) {
                $this->{"set".$key}($value);
            }
        }

        /**
         * Retorna todos os atributos e valores da classe
         */
        public function getData() {
            return $this->values;
        }
    }

?>
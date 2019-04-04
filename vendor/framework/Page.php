<?php
    namespace Framework;

    use Rain\Tpl;

    class Page {

        private $tpl;
        private $options = [];
        private $defaults = [
            "header" => true,
            "footer" => true,
            "data" => []
        ];

        public function __construct($options = array(), $tpl_dir = "/views/") {
            $this->options = array_merge($this->defaults, $options);
            $config = array(
                "tpl_dir" => $_SERVER['DOCUMENT_ROOT'].$tpl_dir,
                "cache_dir" => $_SERVER['DOCUMENT_ROOT']."/views-cache/",
                "debug" => false
            );
            Tpl::configure($config);
            $this->tpl = new Tpl();
            $this->setData($this->options['data']);
            if ($this->options["header"] === true) $this->tpl->draw("header");
        }

        private function setData($data = array()) {
            foreach ($data as $key => $value) {
                // Atribuição de variáveis que podem ser utilizadas no template
                $this->tpl->assign($key, $value);
            }
        }

        /**
         * Configura um template
         * @param name Nome do template a ser configurado
         * @param data Dados que podem ser utilizados dentro do template
         * @param returnHTML TRUE caso deseje retornar o template 
         */
        public function setTemplate($name, $data = array(), $returnHTML = false) {
            $this->setData($data);
            return $this->tpl->draw($name, $returnHTML);
        }

        public function __destruct() {
            if ($this->options["footer"] === true) $this->tpl->draw("footer");
        }
    }
?>
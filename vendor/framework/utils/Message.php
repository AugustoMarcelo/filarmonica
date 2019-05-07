<?php

    namespace Framework\utils;

    class Message {

        const SESSION_MESSAGE = "Messages";
        const MESSAGE_ERROR = "danger";
        const MESSAGE_SUCCESS = "success";
        const MESSAGE_WARNING = "warning";
        const MESSAGE_INFO = "info";

        /**
         * Salva mensagens de erro ou sucesso na sessão
         * @param message Mensagem
         * @param type Indica o tipo da mensagem: ERROR, SUCCESS, INFO, WARNING
         */
        public static function setMessage($message, $type) {
            $_SESSION[Self::SESSION_MESSAGE]['message'] = $message;
            $_SESSION[Self::SESSION_MESSAGE]['type'] = $type;
        }

        /**
         * Recupera mensagens de erro ou sucesso salvas na sessão
         * @return message Mensagem
         */
        public static function getMessage() {
            $message = $_SESSION[Self::SESSION_MESSAGE] ?? "";
            Self::clearMessage();
            return $message;
        }
        
        /**
         * Limpa a variável de mensagens da sessão
         */
        public static function clearMessage() {
            $_SESSION[Self::SESSION_MESSAGE] = NULL;
        }
    }
?>
<?php

	namespace Framework\utils;

	class Cookie {

		/**
		 * Cria um cookie
		 * @param $name = Nome do cookie
		 * @param $valor = Valor do Cookie
		 * @param $duracao = Duração do Cookie
		 * @param $acesso = Páginas que podem ter acesso ao cookie
		 */
		public static function create($nome, $valor, $duracao = null, $acesso = null) {
			$duracao != null ? $duracao : $duracao = time() + (86400 * 30 * 12);
			$acesso != null ? $acesso : $acesso = "/";
			setcookie($nome, $valor, $duracao, $acesso);
		}

		/**
		 * Destroi um cookie
		 * @param $nome = Nome do cookie
		 */
		public static function destroy($nome) {
			static::create($nome, "", time() -1);
		}

		public static function get($nome) {
			if (isset($_COOKIE[$nome])) {
				return $_COOKIE[$nome];
			}
			return null;
		}
	}
<?php
    namespace Framework\utils;

    use \DateTime;
    use \DateTimeZone;

	class DateUtils {
		
		static $diaHoraBr = "d/m/Y H:i:s";
		static $diaBr = "d/m/Y";

		// Retorna a zona de fuso horário
		private static function getTimeZone() {
			return new DateTimeZone('America/Fortaleza');
		}

		/**
         * Retorna o horário atual considerando o TimeZone de Fortaleza
		 * @param $formato = Formato da hora gerada. Se nada for informado, "d/m/Y" será utilizado
		 * @return $date = Data gerada no formato padrão ou passado por parâmetro
		 */
		public static function now($formato = null) {
			$date = new DateTime('now', Self::getTimeZone());
			return $date->format(!is_null($formato) ? $formato : Self::$diaBr);
		}

		public static function millisToDate($formato = null, $millis) {
			$seconds = $millis / 1000; // Transforma em segundos
			return date(!is_null($formato) ? $formato : Self::$diaHoraBr, $seconds);
		}

		/**
		 * Transforma uma data considerando um formato
		 * @param $formatoAtual = Formato atual da data a ser convertida
		 * @param $formatoFinal = Formato da data. Por padrão, será considerado "d/m/Y"
		 * @param $date = data a ser formatada
		 */
		public static function transform($formatoAtual, $formatoFinal = null, $date) {
	    	$data = DateTime::createFromFormat($formatoAtual, $date);
	    	return $data->format(!is_null($formatoFinal) ? $formatoFinal : Self::$diaBr);
	    }

	    /**
	     * Compara duas datas
	     * @param $date1 = Data a ser comparada
	     * @param $date2 = Data a ser comparada
	     * @param $type = Tipo de comparação. Os valores aceitos são: 'after', 'before' e 'equal' será utilizado por padrão
	     * @return true = de acordo com o tipo de comparação
	     */
	    public static function compareTwoDates($date1, $date2, $type) {
	    	$d2 = $date2;
	    	switch ($type) {
	    		case 'after':
	    			return $date1 > $d2;
	    			break;
	    		case 'before':
	    			return $date1 < $d2;
	    			break;
	    		default:
	    			return $date1 == $d2;
	    			break;
	    	}
	    }
	}
?>
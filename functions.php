<?php
    use Framework\utils\DateUtils;

    /**
     * Transforma uma data em um formato para outro formato desejado
     * @param actualFormat Formato atual da data
     * @param desiredFormat Formato desejado
     * @param date Data a ser formatada
     */
    function transform($actualFormat, $desiredFormat, $date) {
        return DateUtils::transform($actualFormat, $desiredFormat, $date);
    }

?>
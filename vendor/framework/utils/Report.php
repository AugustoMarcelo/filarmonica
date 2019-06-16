<?php

    namespace Framework\utils;

    use Dompdf\Dompdf;
    use Framework\Config;
    use Framework\utils\DateUtils;

    class Report {

        private static function getHeader() {
            $html = "<!DOCTYPE html>";
            $html .= "<html>";
            $html .= "  <head>";
            $html .= "    <title>Folha de faltas</title>";
            $html .= "    <style type='text/css'>";
            $html .= "      @page { margin: 50px 25px; }";
            $html .= "      body {";
            $html .= "        font-family: Calibri, DejaVu Sans, Arial;";
            $html .= "        margin: 0;";
            $html .= "        padding: 0;";
            $html .= "        border: none;";
            $html .= "        font-size: 18px;";
            $html .= "      }";
            $html .= "      th, td { text-align: center; }";
            $html .= "      table { padding: 10px; font-size: x-small;}";
            $html .= "      .title, .subtitle { margin: 0; }";
            $html .= "      .subtitle { margin-bottom: 10px; }";
            $html .= "      .bg-grey { background-color: #CECECE; }";
            $html .= "      .text-white { color: #FFF; }";
            $html .= "      td.text-white { color: #FFF; border-color: #000; font-weight: bold;}";
            $html .= "      thead { display: table-row-group; }";
            $html .= "    </style>";
            $html .= "  </head>";
            $html .= "  <body>";
            return $html;
        }

        private static function getFooter(DOMPDF $dompdf) {
            $canvas = $dompdf->get_canvas();
            $canvas->page_text(780, 570, "Pág. {PAGE_NUM}/{PAGE_COUNT}", '', 8, array(0,0,0));
            $canvas->page_text(26, 570, date("d/m/Y H:i:s"), '', 8, array(0,0,0));
            $canvas->page_text(320, 570, "Desenvolvido por: mrclgst10@gmail.com", '', 8, array(0,0,0));
        }

        /**
         * Gera um relatório com informações de fardamento dos componentes
         * @param data Valores a serem mostrados no relatório
         * @param fileName Nome do arquivo
         * @param download TRUE caso deva ser executado o download
         */
        public static function uniforms(array $data = array(), string $fileName, bool $download = false) {
            $html = Self::getHeader();
            $html .= "    <center><h6 class='title'>Filarmônica Recreio Caicoense - Lista de Fardamento</h6></center>";
            $html .= "    <center><h6 class='subtitle'>".count($data)." componentes</h6></center>";
            $html .= "    <table border='1' width='100%' style='border-collapse: collapse;'>";
            $html .= "      <thead>";
            $html .= "        <tr>";
            $html .= "          <th class='bg-grey'>Matrícula</th>";
            $html .= "          <th class='bg-grey'>Nome</th>";
            $html .= "          <th class='bg-grey'>Camiseta</th>";
            $html .= "          <th class='bg-grey'>Mangas curtas</th>";
            $html .= "          <th class='bg-grey'>Mangas longas</th>";
            $html .= "          <th class='bg-grey'>Calça</th>";
            $html .= "          <th class='bg-grey'>Sapato</th>";
            $html .= "        </tr>";
            $html .= "      </thead>";
            $html .= "      <tbody>";
            foreach ($data as $c) {
                $html .= "        <tr>";
                $html .= "          <td>".$c['matricula']."</td>";
                $html .= "          <td>".$c['nome']."</td>";
                $html .= "          <td>".$c['tam_camiseta']."</td>";
                $html .= "          <td>".$c['tam_mangas_curtas']."</td>";
                $html .= "          <td>".$c['tam_mangas_compridas']."</td>";
                $html .= "          <td>".$c['tam_calca']."</td>";
                $html .= "          <td>".$c['tam_sapato']."</td>";
                $html .= "        </tr>";
            }
            $html .= "      </tbody>";
            $html .= "    </table>";
            $html .= "  </body>";
            $html .= "</html>";
            $dompdf = new DOMPDF();
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->loadHtml($html);
            $dompdf->render();
            Self::getFooter($dompdf);
            return $dompdf->stream($fileName, [
                "Attachment" => $download
            ]);
        }

        public static function monthFaults(array $data = array(), string $fileName, bool $download = false) {
            $html = Self::getHeader();
            $html .= "    <center><h6 class='title'>Filarmônica Recreio Caicoense - Folha Mensal (".DateUtils::transform('Y-m', 'm/Y', $data[0]['month']).")</h6></center>";
            $html .= "    <center><h6 class='subtitle'>".$data[0]['qtde_tocatas']." tocata(s)</h6></center>";
            $html .= "    <table border='1' width='100%' style='border-collapse: collapse;'>";
            $html .= "      <thead>";
            $html .= "        <tr>";
            $html .= "          <th class='bg-grey'>Nome</th>";
            $html .= "          <th class='bg-grey'>Faltas</th>";
            $html .= "          <th class='bg-grey'>Total a pagar</th>";
            $html .= "          <th class='bg-grey'>Pago</th>";
            $html .= "        </tr>";
            $html .= "      </thead>";
            $html .= "      <tbody>";
            $totalFaltas = 0;
            $totalAtrasos = 0;
            foreach ($data as $c) {
                if ($c['faltas'] > 0 || $c['atrasos'] > 0) {
                    $totalApagar = $c['faltas']*Config::FAULT_VALUE + $c['atrasos']*(Config::FAULT_VALUE/2);
                    $html .= "        <tr>";
                    $html .= "          <td>".$c['nome']."</td>";
                    $html .= "          <td>".$c['faltas']."</td>";
                    $html .= "          <td>R$ ".number_format($totalApagar, 2, ',', '.')."</td>";
                    $html .= "          <td></td>";
                    $html .= "        </tr>";
                    $totalFaltas += $c['faltas'];
                    $totalAtrasos += $c['atrasos'];
                }
            }
            $totalAreceber = $totalFaltas*Config::FAULT_VALUE + $totalAtrasos*(Config::FAULT_VALUE/2);
            $html .= "        <tr>";
            $html .= "        <td></td>";
            $html .= "        <td class='bg-grey'>Total</td>";
            $html .= "        <td class='bg-grey'>R$ ".number_format($totalAreceber, 2, ',', '.')."</td>";
            $html .= "        <td></td>";
            $html .= "        </tr>";
            $html .= "      </tbody>";
            $html .= "    </table>";
            $html .= "  </body>";
            $html .= "</html>";
            $dompdf = new DOMPDF();
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->loadHtml($html);
            $dompdf->render();
            Self::getFooter($dompdf);
            return $dompdf->stream($fileName, [
                "Attachment" => $download
            ]);
        }

        public static function individualCallList(array $data = array(), $tocata, string $fileName, $download = false) {
            $html = Self::getHeader();
            $html .= "    <center><h6 class='title'>SECRETARIA MUNICIPAL DE EDUCAÇÃO, CULTURA E ESPORTES - SEMECE</h6></center>";
            $html .= "    <center><h6 class='title'>SECRETARIA DE DESENVOLVIMENTO ECONÔMICO E TURISMO - SEDETUR</h6></center>";
            $html .= "    <center><h6 class='title' style='margin-top: 10px;'>FOLHA DE FREQUÊNCIA DAS TOCATAS EXECUTADAS PELA BANDA DE MÚSICA RECREIO CAICOENSE</h6></center>";
            // $html .= "    <center><h6 class='title'>Filarmônica Recreio Caicoense</h6></center>";
            $html .= "    <center><h6 class='subtitle' style='margin-top: 10px;'>Local: ".$tocata->getLocal()."</h6></center>";
            $html .= "    <center><h6 class='subtitle'>Data: ".DateUtils::transform('Y-m-d', 'd/m/Y', $tocata->getData_Tocata())."</h6></center>";
            $html .= "    <center><h6 class='subtitle'>Horário: ".$tocata->getHorario()."</h6></center>";
            $html .= "    <table border='1' width='100%' style='border-collapse: collapse;'>";
            $html .= "      <thead>";
            $html .= "        <tr>";
            $html .= "          <th class='bg-grey' width='10%'>Matrícula</th>";
            $html .= "          <th class='bg-grey' width='25%'>Nome</th>";
            $html .= "          <th class='bg-grey' width='10%'>Frequência</th>";
            $html .= "          <th class='bg-grey' wdith='30%'>Justificativa</th>";
            $html .= "          <th class='bg-grey' width='25%'>Assinatura</th>";
            $html .= "        </tr>";
            $html .= "      </thead>";
            $html .= "      <tbody>";
            foreach ($data as $c) {
                $html .= "        <tr>";
                $html .= "          <td>".$c['matricula']."</td>";
                $html .= "          <td>".$c['nome']."</td>";
                $html .= "          <td>".($c['presenca'] == 1 ? 'PRESENTE' : ($c['presenca'] == 3 ? 'ATRASADO' : 'AUSENTE'))."</td>";
                $html .= "          <td></td>";
                $html .= "          <td></td>";
                $html .= "        </tr>";
            }
            $html .= "      </tbody>";
            $html .= "    </table>";
            $html .= "  </body>";
            $html .= "</html>";
            $dompdf = new DOMPDF();
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->loadHtml($html);
            $dompdf->render();
            Self::getFooter($dompdf);
            return $dompdf->stream($fileName, [
                "Attachment" => $download
            ]);
        }
    }
?>
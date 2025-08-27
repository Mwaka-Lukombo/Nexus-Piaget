<?php


ob_start();
include ('template_pdf.php');
$conteudo = ob_get_contents();
ob_end_clean();

require ('vendor/autoload.php');

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$dompdf->loadHtml($conteudo);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream();

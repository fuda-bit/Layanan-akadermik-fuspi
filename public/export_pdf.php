<?php


require 'vendor/autoload.php';

use Dompdf\Dompdf;


require "functions_surat.php";


$id = $_GET['id'];


$data = querySurat($id);



ob_start();


include "preview_template_pdf.php";


$html = ob_get_clean();



$pdf = new Dompdf();


$pdf->loadHtml($html);



$pdf->setPaper(
    'A4',
    'portrait'
);



$pdf->render();



$pdf->stream(
    "surat-" . $data['nomor_permohonan'] . ".pdf",
    [
        "Attachment" => false
    ]
);

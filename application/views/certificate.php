<?php
define ('GELASIO_FONT_PATH', 'assets/Gelasio-Regular.ttf');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetAuthor('Admin');
$pdf->SetTitle('Sertifikat');
$pdf->SetSubject('Sertifikat User');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->setJPEGQuality(75);
$pdf->AddPage();

$pdf->Image('./assets/img/certificate/'.$certificate->file, 11, 10, 0, 0, 'JPG', false, '', true, 150, '', false, false, 1, false, false, false);

$pdf->SetFont('helvetica', 'B', 9.5);
$pdf->SetXY(167.6, 44);
$pdf->Write(0, date('dmY', strtotime($published_date)) . $mmic, '', 0, 'L', true, 0, false, false, 0 );

$pdf->SetFont('helvetica', 'B', 15);
$pdf->SetXY(44.8, 85);
$pdf->Write(0, $user_detail->name, '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', 'B', 8.9);
$pdf->SetXY(44.8, 93);
$pdf->MultiCell(150, 5, $user_detail->address, 0, 'L', true);

$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetXY(84, 175.5);
$pdf->Write(0, $user_detail->field_name, '', 0, 'L', true, 0, false, false, 0);



$pdf->Image('./assets/img/qrcode_alamat/'.$detail_submission->qr_code_alamat, 148, 218, 13, 13, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

$pdf->SetFont('helvetica', '', 8);
$pdf->SetXY(49, 255.9);
$pdf->Write(0, date('d-m-Y', strtotime($published_date)), '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);
$pdf->SetXY(76, 256.2);
$pdf->Write(0, date('d-m-Y', strtotime($valid_until)), '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);
$pdf->SetXY(51, 259.5);
$pdf->Write(0, date('d-m-Y', strtotime($published_date)), '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);
$pdf->SetXY(73, 259.5);
$pdf->Write(0, date('d-m-Y', strtotime($valid_until)), '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);
$pdf->SetXY(67, 265.2);
$pdf->Write(0, date('d-m-Y', strtotime($published_date)), '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);
$pdf->SetXY(78, 268.9);
$pdf->Write(0, date('d-m-Y', strtotime($published_date)), '', 0, 'L', true, 0, false, false, 0);

$pdf->Output('sertifikat.pdf', 'I');
?>
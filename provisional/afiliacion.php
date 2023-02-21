<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';


require_once(getcwd().'/fpdf/tcpdf_cf7.php');
 define ('ENCRYP',rand());
 define ('PDF_FILE_PATH',getcwd()."/");

$input = json_decode(file_get_contents('php://input'), true);


$name = $input['nombre']." ".$input['apellido1']." ".$input['apellido2'];
$email = $input['email'];
$birthdate = $input['fecha_nac'];
$idType = $input['tipoId'];
$idNumber = $input['cedula'];
$genero = $input['genero'];
$provincia = $input['provincia'];
$canton = $input['canton'];
$distrito = $input['distrito'];
$oncosmart = $input['oncosmart'];
$frecPago = $input['frecPago'];
$beneficiario = str_replace('{', '(', json_encode($input['beneficiarios'])); 
$beneficiario = str_replace('}', ')', $beneficiario); 
$mascotas = str_replace('{', '(', json_encode($input['mascotas'])); 
$mascotas = str_replace('}', ')', $mascotas); 
$tdcNumber = $input['your_tdcNumero'];
$tdcName = $input['your_tdcNombre'];
$tdcDate = $input['your_tdcFecha'];
$tdcSecret = $input['your_tdcCodigo'];
$phone = $input['celular'];
$createpdf = new CREATE_FPDFCF7();

$fname = $createpdf->CREATE_FPDFCF7Fn($name,$phone,$email,$birthdate,$idType,$idNumber,$genero,$frecPago,$oncosmart,$beneficiario,$mascotas,$provincia,$canton,$distrito,$tdcNumber,$tdcName,$tdcDate,$tdcSecret,PDF_FILE_PATH);

$pdf_filename= PDF_FILE_PATH.$fname;
$pdf_encryp = PDF_FILE_PATH.'protect_'.$fname;
$password = ENCRYP;
pdfEncrypt($pdf_filename, $password, $pdf_encryp );


$to			=	'pedro@buzz.cr';
$subject = 'PHP Email with Attachment'; 
$headers 	=	'From: andres@buzz.cr' . "\r\n";
$headers   .=	'MIME-Version: 1.0' . "\r\n";
$headers   .=	'Content-Type: text/html; charset=utf-8' . "\r\n";
$file = $pdf_encryp;
$mail = new PHPMailer(true);

try {

    //Recipients
    $mail->setFrom('andres@buzz.cr', 'Andrés Martin');
    $mail->addAddress($to, 'Pedro Flores');     // Add a recipient
    // Attachments
    $mail->addAttachment($file);         // Add attachments

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Nueva Afiliacion';
    $mail->Body    = 'This is the HTML message body <b>'.ENCRYP.'</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo "Mensaje enviado";
    http_response_code(201);
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

function pdfEncrypt ($origFile, $password, $destFile){
//include the FPDI protection http://www.setasign.de/products/pdf-php-solutions/fpdi-protection-128/
require_once(getcwd().'/fpdi/FPDI_Protection.php');

$pdf = new FPDI_Protection('P', 'mm', 'A4');
// set the format of the destinaton file, in our case 6×9 inch

//calculate the number of pages from the original document
$pagecount = $pdf->setSourceFile($origFile);

// copy all pages from the old unprotected pdf in the new one
for ($loop = 1; $loop <= $pagecount; $loop++) {
    $tplidx = $pdf->importPage($loop);
    $pdf->addPage();
    error_log($pdf->importPage($loop));
    $pdf->useTemplate($tplidx);
}

// protect the new pdf file, and allow no printing, copy etc and leave only reading allowed
$pdf->SetProtection(array('print', 'copy'),$password);
$pdf->Output($destFile, 'F');

return $destFile;
}

print_r($input);

echo ENCRYP;

?>
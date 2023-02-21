<?php
class CREATE_FPDFCF7
{
    function CREATE_FPDFCF7Fn($name,$phone,$email,$birthdate,$idType,$idNumber,$genero,$frecPago,$oncosmart,$beneficiario,$mascotas,$provincia,$canton,$distrito,$tdcNumber,$tdcName,$tdcDate,$tdcSecret,$savepath)
    {
        // include the main TCPDF library
        require_once(getcwd().'/fpdf/fpdf.php');
        // create new pdf document
        $pdf = new FPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator('PDF_CREATOR');
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('Contact Form 7 Submission');
        $pdf->SetSubject('Contact Form 7 Submission');
        
        // set auto page breaks
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        // set default font subsetting mode
        // add a page
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        //content to print
        $pdf->Cell(0,10,'Nuevo Usuario',0,1);
        $pdf->Cell(0,10,'Nombre :   '.$name,0,1);
        $pdf->Cell(0,10,'Telefono :   '.$phone,0,1);
        $pdf->Cell(0,10,'Correo Electrónico :    '.$email,0,1);
        $pdf->Cell(0,10,'Fecha de Nacimiento :    '.$birthdate,0,1);
        $pdf->Cell(0,10,'Tipo de identificación :    '.$idType,0,1);
        $pdf->Cell(0,10,'Numero de identificación :    '.$idNumber,0,1);
        $pdf->Cell(0,10,'Genero :    '.$genero,0,1);
        $pdf->Cell(0,10,'Provincia :    '.$provincia,0,1);
        $pdf->Cell(0,10,'Canton :    '.$canton,0,1);
        $pdf->Cell(0,10,'Distrito :    '.$distrito,0,1);
        $pdf->Cell(0,10,'Fecuencia de Pago :    '.$frecPago,0,1);
        $pdf->Cell(0,10,'     ',0,1);
        $pdf->write(5,'Beneficiario: '.$beneficiario ,'');
        $pdf->Cell(0,10,'     ',0,1);
        $pdf->write(5,'Mascotas: '.$mascotas ,'');
        $pdf->Cell(0,10,'     ',0,1);
        $pdf->Cell(0,10,'Numero de TDC :    '.$tdcNumber,0,1);
        $pdf->Cell(0,10,'Nombre del titular TDC :    '.$tdcName,0,1);
        $pdf->Cell(0,10,'Fecha de vencimiento de TDC :    '.$tdcDate,0,1);
        $pdf->Cell(0,10,'Codigo de Seguridad TDC :    '.$tdcSecret,0,1);
    
        // print text
        //$pdf->write(5,$html,'');
        $filename =rand().'_'.time().'.pdf';
        $pdf->Output('F',$savepath.''.$filename,true);
        error_log($savepath.$filename);
        return $filename;
    }
}
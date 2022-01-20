<?php
// Load autoloader (using Composer)
require_once "vendor/autoload.php";
 require_once 'db_conn.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = 'images.png';
        $this->Image($image_file, 10, 5, 40, '', 'PNG', '', 'T', false, 350, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 10);
        $data = 'Bo Göran Roos
                Masterpar AB
                Mats Knutsväg 190 borlänge,
                78454
                Sverige';
        // Title
        $this->MultiCell(144, 0, $data, 5, 'R', 0,1, '', '', true);
    }

    public function CreateTextBox($textval, $x = 0, $y, $width = 0, $height = 10, $fontsize = 10, $fontstyle = '', $align = 'L') {
		$this->SetXY($x, $y); 
		$this->SetFont(PDF_FONT_NAME_MAIN, $fontstyle, $fontsize);
		$this->Cell($width, $height, $textval, 0, false, $align);
	}

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_TOP);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


$pdf->SetFont('times', 'I', 12);
$pdf->AddPage();

$top_column = 'Packing Slip # 1000015375<br>Order # 1000019214<br>Order Date: 12 okt 2021';

$top_column1 = '';
$top_column2 = '';

$top_column3 = '<p>Bo Göran Roos<br>Masterpar AB<br>Mats Knutsväg 190 borlänge,<br>78454<br>Sverige</p>';


$bottom_column1 = '';
$bottom_column2 = '';

$bottom_column3 = '<p>Få först. Betala sen.<br>Order ID:<br>57aaf2cc-6849-14a3-bcbb-62ed9ad991ec<br>Merchant Portal:<br>https://orders.eu.portal.klarna.com/merchants<br>/K1009874/orders/57aaf2cc-6849-14a3-bcbb-62ed9ad991ec<br>Invoice ID (#1000001909): 4QC7FFNH-1</p>';

$bottom_column4 = 'Budbil <br>
                    <br>(Total Shipping Charges 0,00 kr)';


// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
$pdf->SetFillColor(255, 255, 200);
$pdf->SetTextColor(0, 63, 127);

$pdf->writeHTMLCell(85, 13, '', 55, $top_column1, 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(95, 13, 100, 55, $top_column2, 1, 0, 1, true, 'L', true);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(127, 31, 0);


$pdf->writeHTMLCell(180, 30,'', 67, $top_column3, 1, 1, 1, true, 'L', true);
$pdf->writeHTMLCell(0, 30,100, 67, $top_column3, 'TRB', 1, 1, true, 'L', true);


$pdf->SetFillColor(215, 235, 255);
$pdf->SetTextColor(127, 31, 0);

$pdf->writeHTMLCell(180, 20,'', 35, $top_column, 1, 1, 1, true, 'L', true);

////////////////////////////////////////////////////////////////////////////

$pdf->SetFillColor(255, 255, 200);

$pdf->SetTextColor(0, 63, 127);

$pdf->writeHTMLCell(85, 10, '', 100, $bottom_column1, 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(95, 10, 100, 100, $bottom_column2, 1, 0, 1, true, 'L', true);

$pdf->SetFillColor(255, 255, 255);

$pdf->SetTextColor(127, 31, 0);

$pdf->writeHTMLCell(85, 45,15, 110, $bottom_column3, 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(95, 45,100, 110, $bottom_column4, 'TRB', 0, 1, true, 'L', true);

$pdf->CreateTextBox('Sold to:', 15, 52, 120, 20, 16);
$pdf->CreateTextBox('Ship to:', 110, 52, 120, 20, 16);

$pdf->CreateTextBox('Payment Method', 15, 95, 120, 20, 16);
$pdf->CreateTextBox('Shipping Method:', 110, 95, 120, 20, 16);


$sql = "SELECT * FROM students ORDER BY id ";  
       $result = mysqli_query($conn, $sql);  

$content = '';  
       $content .= '  
       <table border="1" cellspacing="1" cellpadding="5">  
                         <thead>
                         <tr color = "#7F1F00" bgcolor = "#D7EBFF" >  
                                <th width="10%">ID</th>  
                                <th width="30%">First Name</th>  
                                <th width="20%">Last Name</th>  
                               <th width="40%">Email</th>  
                         </tr></thead>  
      ';  
        while($row = mysqli_fetch_array($result))  
       {       
       $content .= '<tr>  
                     <td width="10%">'.$row["id"].'</td>  
                     <td width="30%">'.$row["fname"].'</td>
                     <td width="20%">'.$row["lname"].'</td>    
                     <td width="40%">'.$row["email"].'</td>
                      </tr>  
                           ';  
       }   
      $content .= '</table>';  

$pdf->SetFillColor(255, 255, 255);

$pdf->SetTextColor(0, 63, 127);

$pdf->writeHTMLCell(180, 45,'', 167, $content, 1, 2, 1, true, 'J', true);
$pdf->Output('example_003.pdf', 'I');
?>
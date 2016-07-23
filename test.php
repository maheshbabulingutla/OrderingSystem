<?php
function do(){
$ip_add = $ip;
$company = "Ordering System";
$address = $add1;
$email = "team11@niu.edu";
//$telephone = $_POST["telephone"];
$number = $invoice;
$item = $p_id;
$price = $gtotal;
$vat = $tax;
$bank = "Credit Card";
//$iban = $_POST["iban"];
//$paypal = $_POST["paypal"];
//$com = $_POST["com"];
$pay = 'Payment information';
$price = str_replace(",",".",$price);
$vat = str_replace(",",".",$vat);
$p = explode(" ",$price);
$v = explode(" ",$vat);
$re = $p[0] + $v[0];
function r($r)
{
$r = str_replace("$","",$r);
$r = str_replace(" ","",$r);
$r = $r." $";
return $r;
}
$price = r($price);
$vat = r($vat);
require('u/fpdf.php');

class PDF extends FPDF
{
function Header()
{
if(!empty($_FILES["file"]))
  {
$uploaddir = "logo/";
$nm = $_FILES["file"]["name"];
$random = rand(1,99);
move_uploaded_file($_FILES["file"]["tmp_name"], $uploaddir.$random.$nm);
$this->Image($uploaddir.$random.$nm,10,10,20);
unlink($uploaddir.$random.$nm);
}
$this->SetFont('Arial','B',12);
$this->Ln(1);
}
function Footer()
{
$this->SetY(-15);
$this->SetFont('Arial','I',8);
$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function ChapterTitle($num, $label)
{
$this->SetFont('Arial','',12);
$this->SetFillColor(200,220,255);
$this->Cell(0,6,"$num $label",0,1,'L',true);
$this->Ln(0);
}
function ChapterTitle2($num, $label)
{
$this->SetFont('Arial','',12);
$this->SetFillColor(249,249,249);
$this->Cell(0,6,"$num $label",0,1,'L',true);
$this->Ln(0);
}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetTextColor(32);
$pdf->Cell(0,5,$company,0,1,'R');
$pdf->Cell(0,5,$address,0,1,'R');
$pdf->Cell(0,5,$email,0,1,'R');
//$pdf->Cell(0,5,'Tel: '.$telephone,0,1,'R');
$pdf->Cell(0,30,'',0,1,'R');
$pdf->SetFillColor(200,220,255);
$pdf->ChapterTitle('Invoice Number ',$number);
$pdf->ChapterTitle('Invoice Date ',date('d-m-Y'));
$pdf->Cell(0,20,'',0,1,'R');
$pdf->SetFillColor(224,235,255);
$pdf->SetDrawColor(192,192,192);
$pdf->Cell(170,7,'Item',1,0,'L');
$pdf->Cell(20,7,'Price',1,1,'C');
$pdf->Cell(170,7,$item,1,0,'L',0);
$pdf->Cell(20,7,$price,1,1,'C',0);
$pdf->Cell(0,0,'',0,1,'R');
$pdf->Cell(170,7,'VAT',1,0,'R',0);
$pdf->Cell(20,7,$vat,1,1,'C',0);
$pdf->Cell(170,7,'Total',1,0,'R',0);
$pdf->Cell(20,7,$re." $",1,0,'C',0);
$pdf->Cell(0,20,'',0,1,'R');
$pdf->Cell(0,5,$pay,0,1,'L');
$pdf->Cell(0,5,$bank,0,1,'L');
//$pdf->Cell(0,5,$iban,0,1,'L');
$pdf->Cell(0,20,'',0,1,'R');
//$pdf->Cell(0,5,'PayPal:',0,1,'L');
//$pdf->Cell(0,5,$paypal,0,1,'L');
//$pdf->Cell(190,40,$com,0,0,'C');
$filename= "invoice.pdf";
$pdf->Output($filename,'F');


echo'<a href="invoice.pdf">Invoice</a>';
}

?>
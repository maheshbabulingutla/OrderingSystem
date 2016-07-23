<?php
include_once "login_check.php";
include_once "functions/functions.php";
$ip = getIP();
$userid = $_SESSION['login_ID'];

?>

<html>
<head>
<title>Admin Interface</title>
<link rel="stylesheet" href="styles/bootstrap.min.css" media="all"/>
</head>
<body>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend style="
    margin-left: 10px;
">Get Invoice</legend>
    <div class="form-group" style="
    margin-left: 300px;
    margin-right: 10px;
    margin-top: 100px;
">
<br>
Invoice #<input type="text" name="invoice_id">
<br>
<br>
<input type="submit" name="insert_post" value="Generate" class="btn btn-primary">
</div>
</fieldset>
</form>
</body>
</html>


<?php
include_once "/includes/db.php";

if(isset($_POST['insert_post'])){

include_once("includes/legacydb.php");
include_once("includes/db.php");
$inv = $_POST['invoice_id'];

$data = "SELECT * FROM invoice where invoice_id='$inv'";
$data_run = mysqli_query($con1,$data);


while($row_prod=mysqli_fetch_array($data_run)){
	$invoice = $row_prod['invoice_id'];
	$name = $row_prod['name'];
	$add1 = $row_prod['add1'];
	$add2 = $row_prod['add2'];
	$city = $row_prod['city'];
	$state = $row_prod['state'];
	$postal = $row_prod['postal'];
	$time = $row_prod['time'];
	$gtotal = $row_prod['gtotal'];
	$subtotal = $row_prod['subtotal'];
	$tax = $row_prod['tax'];
	$ship_hand = $row_prod['ship_hand'];
	$status = $row_prod['status'];
	$user_id = $row_prod['user_id'];
						
				$get_prov = "select * from cart where user_id='$userid' or ip_add='$ip'";
				$run_prov = mysqli_query($con1,$get_prov);
				while($row_prov=mysqli_fetch_array($run_prov)){
					$p_id = $row_prov['p_id'];
					$qty = $row_prov['qty'];

				}		



			
	} 

	
	$invoice = $_POST['invoice_id'];


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


echo'<a href="invoice.pdf" style="
    margin-left: 400px;
">Invoice</a>';
}



?>

<?php 

session_start();

include_once("../fpdf/fpdf.php");

if ($_GET["order_date"] AND $_GET["invoice_no"]) {
	$pdf = new FPDF();
	$pdf->Addpage();

	$myImage = "../images/header.jpg";  // this is where you get your Image

	$pdf-> Image($myImage,0,0,210,0); //Image(imagestoring_variable,left side spacing,top side spacing,)
	$pdf->Cell(50,10,"",0,1);
	$pdf->Cell(50,10,"",0,1);
		
	$pdf->SetFont("Arial","B",18);
	$pdf->SetTextColor(194,8,8);
	//$pdf->Cell(190,12,"Softech Business Services Pvt Ltd.",1,1,"C");  //Cell(Width,Height,String,1 for Border 0 For No border,1 NextLine or 0 Same Line, C for Center)
	$pdf->Cell(50,10,"",0,1);
	$pdf->Cell(50,10,"",0,1);
	$pdf->Cell(50,10,"",0,1);
	$pdf->Cell(50,10,"",0,1);
	$pdf->SetFont("Arial",NULL,12);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(40,10,"Date",0,0);
	$pdf->Cell(40,10,": ".$_GET["order_date"],0,1);
	$pdf->Cell(40,10,"Customer Name",0,0);
	$pdf->Cell(40,10,": ".$_GET["cust_name"],0,1);

	$pdf->Cell(50,10,"",0,1);

	$pdf->Cell(10,10,"#",1,0,"C");
	$pdf->Cell(70,10,"Product Name",1,0,"C");
	$pdf->Cell(30,10,"Quantity",1,0,"C");
	$pdf->Cell(40,10,"Price",1,0,"C");
	$pdf->Cell(40,10,"Total (Rs)",1,1,"C");

	for ($i=0; $i < count($_GET["pid"]); $i++) { 
		$pdf->Cell(10,10,($i+1),1,0,"C");
		$pdf->Cell(70,10,$_GET["pro_name"][$i],1,0,"C");
		$pdf->Cell(30,10,$_GET["qty"][$i],1,0,"C");
		$pdf->Cell(40,10,$_GET["price"][$i],1,0,"C");
		$pdf->Cell(40,10,($_GET["qty"][$i] * $_GET["price"][$i]),1,1,"C");
	}

	$pdf->Cell(50,10,"",0,1);

	$pdf->Cell(50,10,"Sub Total",0,0);
	$pdf->Cell(50,10,": ".$_GET["sub_total"],0,1);
	$pdf->Cell(50,10,"Tax Charges",0,0);
	$pdf->Cell(50,10,": ".$_GET["gst"],0,1);
	$pdf->Cell(50,10,"Discount",0,0);
	$pdf->Cell(50,10,": ".$_GET["discount"],0,1);
	$pdf->Cell(50,10,"Net Total",0,0);
	$pdf->Cell(50,10,": ".$_GET["net_total"],0,1);
	$pdf->Cell(50,10,"Paid",0,0);
	$pdf->Cell(50,10,": ".$_GET["paid"],0,1);
	$pdf->Cell(50,10,"Due Amount",0,0);
	$pdf->Cell(50,10,": ".$_GET["due"],0,1);
	$pdf->Cell(50,10,"Payment Type",0,0);
	$pdf->Cell(50,10,": ".$_GET["payment_type"],0,1);

	$pdf->Cell(180,10,"Signature",0,0,"R");

	$myImage = "../images/footer.jpg";  // this is where you get your Image

	$pdf-> Image($myImage,0,245,210,0);
	
	
	$pdf->Output("../PDF_INVOICE/PDF_INVOICE_".$_GET["invoice_no"].".pdf","F");
	$pdf->Output(); 

}



?>
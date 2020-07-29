<?php
require_once('fpdf.php');
class PDF extends FPDF
{
	// private $level;
	// private $semester;
	public function __construct()
	{
		parent::__construct();
	}
	// public function setVal($l, $s){
	// 	$this->level = $l;
	// 	$this->semester = $s;
	// }

	function Header()
	{
		// Arial bold 15
		$this->SetFont('Arial','B',15);
		//$this->Image('iot.png',10,6,30);
		// Move to the right
		$this->Cell(130);
		// Logo
		 $url = base_url() . 'public/assets/images/pdf_logo.jpeg';
		 $this->Image($url,90,2,55,-750);
		// Title
		$this->SetTextColor(238, 61, 0);
		$this->Cell(30,2,'IOT Shop',0,0,'C', false, 'https://www.iotshop.lk/');
		//$this->SetTextColor(218, 165, 32);
		$this->Ln(5);

		$this->SetTextColor(102, 51, 0);

		$dte = date("Y-m-d");
		$year = explode('-', $dte);
		$this->SetFont('Arial','B',10);
		$this->Cell(122.5);
		$this->Cell(40,2,'Mobile and Computer Shop' . '','');
		//$year[0],0,0,'C', false,
		$this->Ln(4);
		$this->SetFont('Arial','B',9);
		$this->Cell(126);
		$this->Cell(40,2,'Walasmulla, Matara',0,0,'C', false);
		$this->Ln(1.5);
		$this->SetFont('Arial','B',10);
		$this->Cell(85);
		//$this->Cell(40,10,'Bachelor of Information Technology Level ' . $this->level . ' (Semester ' . $this->semester . ') Examination', 0, 0, '', false);
		$this->Ln(8);
		$this->SetDrawColor(255,0,0);
		$this->Cell(40);
		$this->Cell(200,0.2,'',1,0,'C',true);
		$this->Ln(7);

		

	}

	function Footer()
	{
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		$this->Cell(0,10,'POS System (#IOT Shop)',0,0,'R');
	}

	function BillTable($grnValue, $qty, $extra)
	{

		$this->Cell(130);
		$this->SetFont('Arial','B',18);
		$this->SetTextColor(0, 0, 0);
		$this->Cell(20,2,'GOODS RECEIVE NOTE',0,0,'C', false, '');
		//$this->SetTextColor(218, 165, 32);
		$this->Ln(5);
		// Colors, line width and bold font
		$this->SetFillColor(255,255,0);
		$this->SetTextColor(0);
		$this->SetDrawColor(124,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('Arial','B',12);


		// //$table_columns = array('student_id', 'student_name', 'ICT1214', 'ICT1211');
		// $table_columns = array();
		// $c = new course_model;
		// $table_columns = $c->get_final_format($level, $semester);
		// // Header
		// $header = $table_columns;
		 $header1 = array('Product Code', 'Name', 'Description', 'Whole Sale Price', 'Retail Price', 'Quentity');
		 $header = array('item_code', 'item_name', 'item_description', 'whole_sale_price', 'retail_price', 'quantity');
		 $w = array(30, 50, 60, 35, 30, 20);
		// $tc = 0;
		// foreach ($table_columns as $column) {
		// 	if ($tc >= 2) {
		// 		array_push($header1, $column);
		// 		array_push($w, 15);
		// 	}
		// 	$tc++;
		// }
		// $tbl_w = 70.0;
		// $cen = 0.0;
		// foreach ($header1 as $n) {
		// 	if (!($n == 'Student ID' || $n == 'Student Name')) {
		// 		$tbl_w += 15;
		// 	}
		// }
		 $cen = (270 - 225) / 2;
		// foreach ($header1 as $item) {
		// 	if (!($item == 'Student ID' || $item == 'Student Name' || $item == 'SGPA' || $item == 'CGPA')) {
		// 		$course_name = $c->get_single_course($item);
		// 		$gp = "";
		// 		if ($course_name[0]->gpa_stat == "No") {
		// 			$gp = " (NGPA)";
		// 		}
		// 		$this->Cell($cen);
		// 		$this->Cell(100,10,$item . ' - ' . $course_name[0]->course_name . $gp, 0, 0, '', false);
		// 		$this->Ln(5);
		// 	}
		// }
		$this->Ln(8);
		$this->Cell($cen - 13);
		$this->Cell(50,7,"GRN No: " . $extra['grn_no'],0,0,'C',false);
		$this->Ln();
		$this->Cell($cen - 8);
		$this->Cell(50,7,"Invoice No: " . $extra['bill_no'],0,0,'C',false);
	
		$this->Ln();
		$this->Cell($cen - 8);
		$dte = date("Y-m-d");
		//$year = explode('-', $dte);
		$this->Cell(50,7,"Date: " . $dte,0,0,'C',false);
		$this->Ln(8);
		$this->Cell($cen, 0, '', 0, 0);
		for($i=0;$i<count($header1);$i++)
			$this->Cell($w[$i],7,$header1[$i],1,0,'C',false);
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(148,255,162);
		$this->SetTextColor(0);
		$this->SetFont('');
		// // Data
		// $query = $c->get_final_details($level, $semester);


		foreach ($grnValue as $item) {
			$i = 0;
			$this->Cell($cen, 0, '', 0, 0);
			foreach ($header as $column) {
				if ($column == 'quantity') {
					$this->Cell($w[$i],6,$qty[$item->item_code],0,0,'C',false);
					$i++;
				} else {
					$this->Cell($w[$i],6,$item->$column,0,0,'C',false);
					$i++;
				}
				
			}
			$i = 0;

			$this->Ln();

		}
		$this->Ln(20);
		$this->Cell(200, 0, '', 0, 0);
		$this->Cell(50,6,"..............................",0,0,'C',false);
		$this->Ln();
		$this->Cell(200, 0, '', 0, 0);
		$this->Cell(50,6,"Cashier Signature",0,0,'C',false);
		// Closing line
		//$this->Cell(array_sum($w),0,'','T');
	}

	function InvoiceTable($billData, $billValue)
	{
		$this->Cell(130);
		$this->SetFont('Arial','B',18);
		$this->SetTextColor(0, 0, 0);
		$this->Cell(20,2,'SALES INVOICE',0,0,'C', false, '');
		//$this->SetTextColor(218, 165, 32);
		$this->Ln(15);

		$this->SetFont('Arial','B',12);
		$this->Cell(20);
		$this->Cell(50,2,'Invoice No: ' . $billData['bill_no'],0,0,'C', false, '');
		$this->Ln(7);
		$this->Cell(20.5);
		$this->Cell(50,2,'Bill Type: ' . $billData['bill_type'],0,0,'C', false, '');
		$this->Ln(7);
		$this->Cell(30.5);
		$this->Cell(50,2,'Customer ID: ' . $billData['customer'],0,0,'C', false, '');
		$this->Ln(7);
		$this->Cell(21.5);
		$this->Cell(50,2,'Branch: ' . $billData['branch'],0,0,'C', false, '');
		$this->Ln(7);
		$this->Cell(21);
		$this->Cell(50,2,'Date: ' . date('Y/m/d'),0,0,'C', false, '');
		$this->Ln(8);
		$header1 = array('Item Code', 'Name', 'Description', 'Price', 'Quentity', 'Total');
		$header = array('item_code', 'name', 'description', 'price', 'qty', 'total');
		$w = array(30, 50, 60, 35, 30, 30);
		$this->Cell(28, 0, '', 0, 0);
		for($i=0;$i<count($header1);$i++)
			$this->Cell($w[$i],7,$header1[$i],1,0,'C',false);
		$this->Ln(10);
	
		foreach ($billValue as $item) {
			$i = 0;
			$this->Cell(28, 0, '', 0, 0);
			foreach ($header as $column) {
				$this->Cell($w[$i],6,$item->$column,0,0,'C',false);
				$i++;
				
			}
			$i = 0;

			$this->Ln();
		}
		$this->Ln();
		$this->Ln();
		$this->Ln();
		$this->Cell(215);
		$this->Cell(28, 0, 'Total Amount: ' . $billData['totalAmount'], 0, 0);

		$this->Ln(19);
		
		$this->Cell(25, 0, '', 0, 0);
		$this->Cell(50,6,".....................................",0,0,'C',false);
		$this->Ln();
		$this->Cell(25, 0, '', 0, 0);
		$this->Cell(50,6,"Customer Signature",0,0,'C',false);

		$this->Cell(140, 0, '', 0, 0);
		$this->Cell(50,6,".....................................",0,0,'C',false);
		$this->Ln();
		$this->Cell(215, 0, '', 0, 0);
		$this->Cell(50,6,"Cashier Signature",0,0,'C',false);
	}
}

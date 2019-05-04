<?php 
require "fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=db23','root','');

class myPDF extends FPDF{
    function header(){
        $this->image('logo.png',10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'USERS DOCUMENTS',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'All Registered Users',0,0,'C');
        $this->Ln(20);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    function headerTable(){
        $this->SetFont('Times','B',12);
        $this->Cell(20,10,'userID',1,0,'C');
        $this->Cell(40,10,'Name',1,0,'C');
        $this->Cell(40,10,'Email',1,0,'C');
        $this->Cell(40,10,'Comments',1,0,'C');
        $this->Cell(60,10,'Rating',1,0,'C');
        $this->Cell(60,10,'FoodID',1,0,'C');
        $this->Ln();
    }
    function viewTable($db){
        $this->SetFont('Times','',12);
        $stmt = $db->query('SELECT * FROM reviews');
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            $this->Cell(20,10,$data->userID,1,0,'C');
            $this->Cell(40,10,$data->Name,1,0,'C');
            $this->Cell(40,10,$data->Email,1,0,'L');
            $this->Cell(40,10,$data->Comments,1,0,'L');
            $this->Cell(60,10,$data->Rating,1,0,'L');
            $this->Cell(60,10,$data->FoodID,1,0,'L');
            $this->Ln();
        }
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();
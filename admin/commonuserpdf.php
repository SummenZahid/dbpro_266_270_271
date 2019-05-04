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
        $this->Cell(20,10,'ID',1,0,'C');
        $this->Cell(40,10,'FirstName',1,0,'C');
        $this->Cell(40,10,'LastName',1,0,'C');
        $this->Cell(40,10,'Email',1,0,'C');
        $this->Cell(60,10,'Contact',1,0,'C');
        $this->Ln();
    }
    function viewTable($db){
        $this->SetFont('Times','',12);
        $stmt = $db->query('SELECT * FROM user WHERE RoleID = 2');
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            $this->Cell(20,10,$data->userID,1,0,'C');
            $this->Cell(40,10,$data->Fname,1,0,'L');
            $this->Cell(40,10,$data->Lname,1,0,'L');
            $this->Cell(40,10,$data->Email,1,0,'L');
            $this->Cell(60,10,$data->PhoneNo,1,0,'L');
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
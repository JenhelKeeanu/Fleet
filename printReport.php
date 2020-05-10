<?php
include "data.php";
require('fpdf182/fpdf.php');
session_start();
$dateToday = date("Y-m-d");
$timeToday = date("h:i:sa");

$reportType = $_SESSION['print_reportType'];
$Months = $_SESSION['print_Months'] ;
$Year = $_SESSION['print_Year'];
$vehicle = $_SESSION['print_vehicle'];
$pdf = new FPDF();
$pdf->AddPage('L','A4');
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,10,'Vehicle Report',0,'C');
$pdf->MultiCell(0,10,$dateToday,0,'R');
$pdf->SetFont('Arial','B',11);


if($reportType=="vehicleVrr"){
    if($vehicle=="all"){
        $vehicle=" ";
    }else{
        $vehicle=" and Plate_No ='".$vehicle."'";
    }
    $vehicles_rep=mysqli_query($con,"select *,MONTH(VRR_Date) from vrr_database join vrrnotes_database on vrr_database.VRR_ID=vrrnotes_database.VRR_ID WHERE MONTH(VRR_Date)={$Months} AND YEAR(VRR_Date)={$Year} {$vehicle} order by Plate_No,Note_Date,Note_Time");
}
$toBeAppend="";
// $rows=mysql_num_rows($vehicles_rep);
$loopCount=0;
$lastPlate="";
while($veh = mysqli_fetch_array($vehicles_rep)){
    if($loopCount==0||$lastPlate!=$veh['Plate_No']){
        if($lastPlate!=$veh['Plate_No']&&$loopCount!=0){
            $pdf->AddPage('L','A4');
            // $toBeAppend=$toBeAppend."</tbody></table><br><hr><br>";
        }
        $pdf->Ln(15);
        $pdf->Cell(30,10,'VRR NO: ');
        $pdf->Cell(110,10,$veh['VRR_ID']);
        $pdf->Cell(40,10,'DATE CREATED:');
        $pdf->Cell(100,10,$veh['VRR_Date']);
        $pdf->Ln(7);
        $pdf->Cell(30,10,'VRR TYPE: ');
        $pdf->Cell(110,10,$veh['VRR_Type']);
        $pdf->Cell(40,10,'STATUS: ');
        $pdf->Cell(100,10,$veh['Status']);
        $pdf->Ln(11);
        $pdf->Cell(30,10,'PLATE NO: ');
        $pdf->Cell(110,10,$veh['Plate_No']);
        $pdf->Ln(7);
        $pdf->Cell(30,10,'CAR MODEL: ');
        $pdf->Cell(110,10,$veh['Car_Type']);
        $pdf->Ln(7);
        $pdf->Cell(30,10,'CAR BRAND: ');
        $pdf->Cell(110,10,$veh['Car_Brand']);
        $pdf->Ln(11);
        $pdf->Cell(30,10,'AFFILIATES: ');
        $pdf->Cell(110,10,$veh['Affiliates']);
        $pdf->Cell(40,10,'BRANCH: ');
        $pdf->Cell(140,10,$veh['Branch']);
        $pdf->Ln(7);
        $pdf->Cell(30,10,'CONCERN: ');
        $pdf->Cell(90,10,$veh['VRR_Concern']);
        $pdf->Ln(15);
        $pdf->Cell(46.66,10,'Note Type');
        $pdf->Cell(63.22,10,'Notes');
        $pdf->Cell(46.66,10,'Assigned Affiliate');
        $pdf->Cell(30,10,'Date');
        $pdf->Cell(30,10,'Time');
        $pdf->Cell(46.66,10,'User');
    }
    $pdf->Ln(7);
    $pdf->Cell(46.66,10,$veh['Note_Type']);
    $pdf->Cell(63.22,10,$veh['Notes']);
    $pdf->Cell(46.66,10,$veh['Assigned_Affil']);
    $pdf->Cell(30,10,$veh['Note_Date']);
    $pdf->Cell(30,10,$veh['Note_Time']);
    $pdf->Cell(46.66,10,$veh['User_Note']);
//     $toBeAppend=$toBeAppend."
//     <tr>
//         <td>
//             ".$veh['Note_Type']."
//         </td>
//         <td>
//             ".$veh['Notes']."
//         </td>
//         <td>
//             ".$veh['User_Note']."
//         </td>
//         <td>
//             ".$veh['Assigned_Affil']."
//         </td>
//         <td>
//             ".$veh['Note_Date']."
//         </td>
//         <td>
//             ".$veh['Note_Time']."
//         </td>
//     </tr>";
    $lastPlate=$veh['Plate_No'];
    $loopCount++;
}
if($loopCount==0){
    $toBeAppend="No Record Found";
}
// $toBeAppend=$toBeAppend."</tbody></table>";
// print_r("{$toBeAppend}");
    $pdf->Output();
?>
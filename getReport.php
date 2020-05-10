<?php
include "data.php";
session_start();
$reportType = $_REQUEST["reportType"];
$type = $_REQUEST["type"];
$Months = $_REQUEST["Months"];
$Year = $_REQUEST["Year"];
$vehicle = $_REQUEST["vehicle"];
if($type=="print"){
    $_SESSION['print_reportType'] = $reportType;
    $_SESSION['print_Months'] = $Months;
    $_SESSION['print_Year'] = $Year;
    $_SESSION['print_vehicle'] = $vehicle;
}else{
    if($reportType=="vehicleVrr"){
        if($vehicle=="all"){
            $vehicle=" ";
        }else if($vehicle==0){

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
                $toBeAppend=$toBeAppend."</tbody></table><br><hr style='background:#c4c4c4'><br>";
            }
            $toBeAppend=$toBeAppend."
            <div class='form-row'>
                <div class='col-6'>
                    <strong>VRR NO: </strong>".$veh['VRR_ID']."
                </div>
                <div class='col-6'>
                    <strong>DATE CREATED: </strong>".$veh['VRR_Date']."
                </div>
            </div>
            <div class='form-row'>
                <div class='col-6'>
                    <strong>VRR TYPE: </strong>".$veh['VRR_Type']."
                </div>
                <div class='col-6'>
                    <strong>STATUS: </strong>".$veh['Status']."
                </div>
            </div><br><br>
            <div class='form-row mt-2'>
                <div class='col-6'>
                    <strong>PLATE NO: </strong>".$veh['Plate_No']."
                </div>
            </div>
            <div class='form-row'>
                <div class='col-6'>
                    <strong>CAR MODEL: </strong>".$veh['Car_Type']."
                </div>
            </div>
            <div class='form-row'>
                <div class='col-6'>
                    <strong>CAR BRAND: </strong>".$veh['Car_Brand']."
                </div>
            </div>
            <div class='form-row'>
                <div class='col-6'>
                    <strong>ODO: </strong>".$veh['ODO']."
                </div>
            </div>
            <br>
            <br>
            <div class='form-row'>
                <div class='col-8'>
                    <strong>CONCERN: </strong>".$veh['VRR_Concern']."
                </div>
                <div class='col-2'>
                    <strong>AFFILIATES: </strong>".$veh['Affiliates']."
                </div>
                <div class='col-2'>
                    <strong>BRANCH: </strong>".$veh['Branch']."
                </div>
            </div><br><br>
            <table style='width:100%;'>
            <thead>
                <tr>
                    <th>Note Type
                    </th>
                    <th>Notes
                    </th>
                    <th>Assigned Affiliate
                    </th>
                    <th>Date
                    </th>
                    <th>Time
                    </th>
                    <th>User
                    </th>
                </tr>
            </thead>
            <tbody>
            ";
        }
        $toBeAppend=$toBeAppend."
        <tr>
            <td>
                ".$veh['Note_Type']."
            </td>
            <td>
                ".$veh['Notes']."
            </td>
            <td>
                ".$veh['Assigned_Affil']."
            </td>
            <td>
                ".$veh['Note_Date']."
            </td>
            <td>
                ".$veh['Note_Time']."
            </td>
            <td>
                ".$veh['User_Note']."
            </td>
        </tr>";
        $lastPlate=$veh['Plate_No'];
        $loopCount++;
    }
    if($loopCount==0){
        $toBeAppend="No Record Found";
    }
    $toBeAppend=$toBeAppend."</tbody></table>";
    print_r("{$toBeAppend}");
        
}
?>
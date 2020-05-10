<div id="test" >
    <center>
        <div class="form-row m-5 col-8 m-5 p-5" style="border:1px solid #c4c4c4">
            <div class="col-2">
                <select class="form-control"  id="reportSelectReport">
                    <option value="0">Select Report</option>
                    <option value="vehicleVrr">Vehicles VRR report</option>
                </select>
            </div>
            <div class="col-2">
                <select class="form-control"  id="reportSelectMonths">
                    <option value="0">Select Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div class="col-2">
                <select class="form-control"  id="reportSelectYear">
                    <option value="0">Select Year</option>
                    <?php
                        $Years=mysqli_query($con,"SELECT YEAR(VRR_Date) as YEAR FROM vrr_database group by YEAR(VRR_Date)");
                        // echo $Years;
                        while($year = mysqli_fetch_array($Years)){
                            print_r("<option value='{$year['YEAR']}'>{$year['YEAR']}</option>");
                        }
                    ?>
                </select>
            </div>
            <div class="col-3">
                <select class="form-control"  id="reportSelectVehicle" style="display:none">
                    <option value="0">Select Vehicle</option>
                    <option value="all">All Vehicles</option>
                    <?php
                        $vehicles_rep=mysqli_query($con,"SELECT * FROM vehicle_database");
                        // echo $Years;
                        while($veh = mysqli_fetch_array($vehicles_rep)){
                            print_r("<option value='{$veh['Vehicle_Plate']}'>{$veh['Vehicle_Plate']}-{$veh['Vehicle_Brand']} {$veh['Vehicle_Model']}</option>");
                        }
                    ?>
                </select>
            </div>
            <div class="col-1"><button id="print_report" class="btn bg-transparent"><i class=" fa fa-print"></i></button></div>
            <div class="col-2">
                <button class="btn btn-secondary" id="generate_report">Generate Report</button>
            </div>
        </div>
    </center>
    <div id="txtHint" class="m-5 col-8 m-5 p-5">
    </div>
</div>
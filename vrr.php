<div id="test" >
    <center>
        <div class="m-5 col-8 m-5 p-5">
            <div style="font-weight:bold;font-size:22px">
                VRR Received
            </div>
            <table width="100%" class="table table-bordered" id="QuotationTable">
                <thead>
                    <tr>
                        <th>VRR No.
                        </th>
                        <th>Type
                        </th>
                        <th>Concern
                        </th>
                        <th>Car Brand
                        </th>
                        <th>Car Model
                        </th>
                        <th>Plate Number
                        </th>
                        <th>ODO
                        </th>
                        <th>Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // echo 'SELECT *,(select quot_id from quotation_database where quote_vrr=qd.VRR_ID) as QUOT FROM vrr_database qd join vehicle_database vd on qd.Plate_No=vd.Vehicle_Plate where qd.Status="Affiliate Repair" and qd.Affiliates=(SELECT Affiliates_Name from affiliates_database where affiliate_user='.$_SESSION['UserID'].') and Branch=(SELECT Branch from affiliates_database where affiliate_user='.$_SESSION['UserID'].') ';
                        $vrrRep=mysqli_query($con,'SELECT *,(select quot_id from quotation_database where quote_vrr=qd.VRR_ID) as QUOT
                        ,(select quot_status from quotation_database where quote_vrr=qd.VRR_ID) as quot_status
                         FROM vrr_database qd join vehicle_database vd on qd.Plate_No=vd.Vehicle_Plate where qd.Status="Affiliate Repair" and qd.Affiliates=(SELECT Affiliates_Name from affiliates_database where affiliate_user='.$_SESSION['UserID'].') and Branch=(SELECT Branch from affiliates_database where affiliate_user='.$_SESSION['UserID'].') ');
                        
                        while($vrr = mysqli_fetch_array($vrrRep))
                        {
                            echo "<tr>
                            <td>{$vrr['VRR_ID']}
                            </td>
                            <td>{$vrr['VRR_Type']}
                            </td>
                            <td>{$vrr['VRR_Concern']}
                            </td>
                            <td>{$vrr['Car_Brand']}
                            </td>
                            <td>{$vrr['Car_Type']}
                            </td>
                            <td>{$vrr['Plate_No']}
                            </td>
                            <td>{$vrr['ODO']}
                            </td>
                            <td style='vertical-align: middle;'>";
                            if($vrr['QUOT']==null)
                            echo "<button class='btn btn-secondary btn_addQuotation' value='{$vrr['VRR_ID']}' data-ct='{$vrr['Car_Type']}' data-cb='{$vrr['Car_Brand']}' data-pt='{$vrr['Vehicle_ID']}'>ADD QUOTATION
                            </button>";
                            else{
                                if($vrr['quot_status']=="approved-paid"){
                                    
                                    echo "<form method='post'><input type='hidden' name='vrr_id' value='{$vrr['VRR_ID']}'> <button name='fixed_vrr' class='btn btn-outline-success ' value='{$vrr['VRR_ID']}' data-ct='{$vrr['Car_Type']}' data-cb='{$vrr['Car_Brand']}' data-pt='{$vrr['Vehicle_ID']}'>FIXED
                                    </button></form>";
                                }else
                                echo "<p style='color:green'>Quotation Sent</p>";
                            }
                            echo "</td>
                            </tr>";
                        }
                    ?>
                </tbody>
            </table>
            <div style="font-weight:bold;font-size:22px" id="returnVRRH">
                Returned VRR
            </div>
            <table width="100%" class="table table-bordered" id="returnVRR">
                <thead>
                    <tr>
                        <th>VRR No.
                        </th>
                        <th>Type
                        </th>
                        <th>Concern
                        </th>
                        <th>Return Reason
                        </th>
                        <th>Car Brand
                        </th>
                        <th>Car Model
                        </th>
                        <th>Plate Number
                        </th>
                        <th>ODO
                        </th>
                        <th>Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // echo 'SELECT *,(select quot_id from quotation_database where quote_vrr=qd.VRR_ID) as QUOT FROM vrr_database qd join vehicle_database vd on qd.Plate_No=vd.Vehicle_Plate where qd.Status="Affiliate Repair" and qd.Affiliates=(SELECT Affiliates_Name from affiliates_database where affiliate_user='.$_SESSION['UserID'].') and Branch=(SELECT Branch from affiliates_database where affiliate_user='.$_SESSION['UserID'].') ';
                        $vrrRep=mysqli_query($con,'SELECT *,
                        (select quot_id from quotation_database where quote_vrr=qd.VRR_ID) as QUOT,
                        (select quot_status from quotation_database where quote_vrr=qd.VRR_ID) as quot_status,
                        (select Notes from vrrnotes_database where VRR_ID=qd.VRR_ID order by Note_ID DESC Limit 1) as Notes
                         FROM vrr_database qd 
                         join vehicle_database vd on qd.Plate_No=vd.Vehicle_Plate 
                         where qd.Status="Repair Return" and qd.Affiliates=(SELECT Affiliates_Name from affiliates_database where affiliate_user='.$_SESSION['UserID'].') and Branch=(SELECT Branch from affiliates_database where affiliate_user='.$_SESSION['UserID'].') ');
                        
                        while($vrr = mysqli_fetch_array($vrrRep))
                        {
                            echo "<tr>
                            <td>{$vrr['VRR_ID']}
                            </td>
                            <td>{$vrr['VRR_Type']}
                            </td>
                            <td>{$vrr['VRR_Concern']}
                            </td>
                            <td>{$vrr['Notes']}
                            </td>
                            <td>{$vrr['Car_Brand']}
                            </td>
                            <td>{$vrr['Car_Type']}
                            </td>
                            <td>{$vrr['Plate_No']}
                            </td>
                            <td>{$vrr['ODO']}
                            </td>
                            <td style='vertical-align: middle;'>";
                            if($vrr['QUOT']==null)
                            echo "<button class='btn btn-secondary btn_addQuotation' value='{$vrr['VRR_ID']}' data-ct='{$vrr['Car_Type']}' data-cb='{$vrr['Car_Brand']}' data-pt='{$vrr['Vehicle_ID']}'>ADD QUOTATION
                            </button>";
                            else{
                                if($vrr['quot_status']=="approved-paid"){
                                    
                                    echo "<form method='post'><input type='hidden' name='vrr_id' value='{$vrr['VRR_ID']}'> <button name='fixed_vrr' class='btn btn-outline-success ' value='{$vrr['VRR_ID']}' data-ct='{$vrr['Car_Type']}' data-cb='{$vrr['Car_Brand']}' data-pt='{$vrr['Vehicle_ID']}'>FIXED
                                    </button></form>";
                                }else
                                echo "<p style='color:green'>Quotation Sent</p>";
                            }
                            echo "</td>
                            </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
            <?php
                $vrrquery=mysqli_query($con,'SELECT * FROM vrr_database where Status="Repair Return" and Affiliates=(SELECT Affiliates_Name from affiliates_database where affiliate_user='.$_SESSION['UserID'].') and Branch=(SELECT Branch from affiliates_database where affiliate_user='.$_SESSION['UserID'].') ');
                $vrrReturn=mysqli_num_rows($vrrquery);
                if($vrrReturn==0){
                    echo "<script>
                    $('#returnVRRH').css('display','none');
                    $('#returnVRR').css('display','none');
                    </script>";
                }
            ?>
    </center>
    <div id="txtHint" class="m-5 col-8 m-5 p-5">
    </div>
</div>
<script>
    $(document).ready( function () {
        var table=$('#QuotationTable').DataTable();
        table.search("<?php echo $_GET['viewVRR'] ?>").draw();
    } );
</script>
<div class="modal-backDrop">
</div>
<div class="modal_add_quotation">
    <button class="btn btn-transparent float-right" id="modal_close_quotation">&#10006;</button>
    <form action='#' method='POST' id="ADDQUOTATIONFORM">
        <div class="modal_content">
            <div class="header">
            ADD QUOTATION
            </div>
            <div class="body mt-4">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Plate Number:</label>
                    <div class="col-sm-8">
                        <select class="form-control" required readonly id="addQuotPlate" name="addQuotPlate">
                            <option value="" disabled selected>Select Vehicle</option>
                            <?php
                                $vehicles_rep=mysqli_query($con,"SELECT * FROM vehicle_database");
                                // echo $Years;
                                while($showPlate = mysqli_fetch_array($vehicles_rep))
                                {
                                    // $_SESSION['vBrand'] = $showPlate['Vehicle_Brand'];
                                    // $_SESSION['vModel'] = $showPlate['Vehicle_Model'];
                                    echo "<option value='{$showPlate['Vehicle_ID']}' data-brand='{$showPlate['Vehicle_Brand']}' data-model='{$showPlate['Vehicle_Model']}'";
                                    if(isset($_POST['newPlate']))
                                    {
                                        if($_POST['newPlate']==$showPlate['Vehicle_Plate']) echo "selected";
                                    }
                                    echo "
                                    >{$showPlate['Vehicle_Plate']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" class="form-control" required id="addQuotVRR" name="addQuotVRR" readonly>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Car Brand:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" required id="addQuotBrand" name="addQuotBrand" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Car Model:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" required id="addQuotModel" name="addQuotModel" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-12 col-form-label">Description:</label>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <textarea class="form-control" required id="exampleFormControlTextarea1" name="addQuotDesc" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Amount:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" required id="addQuotAmount" name="addQuotAmount">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-8 col-form-label"></label>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-success" id="submit_addQuotation" name="submit_addQuotation">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
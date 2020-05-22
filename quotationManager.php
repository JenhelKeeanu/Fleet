<div id="test" >
    <center>
        <div class="m-5 col-8 m-5 p-5">
            <!-- <div class=" float-right">
            <button class="btn btn-secondary mb-3" id="btn_addQuotation">ADD QUOTATION
            </button></div> -->
            <table width="100%" class="table table-bordered" id="QuotationTable">
                <thead>
                    <tr>
                        <th>VRR No.
                        </th>
                        <th>Plate No.
                        </th>
                        <th>Model
                        </th>
                        <th>Description
                        </th>
                        <th>Amount
                        </th>
                        <th>Cheque
                        </th>
                        <th>Status
                        </th>
                        <th>Affiliate
                        </th>
                        <th>Date Created
                        </th>
                        <th>Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($_SESSION['Accounttype']=='Manager')
                            $vehicles_rep=mysqli_query($con,"SELECT * FROM quotation_database qd join vrr_database vrd on qd.quote_vrr=vrd.VRR_ID join vehicle_database vd on qd.vehicle_id=vd.Vehicle_ID join affiliates_database ad on qd.affiliate_id=ad.Affiliates_ID");
                        else
                            $vehicles_rep=mysqli_query($con,"SELECT * FROM quotation_database qd join vrr_database vrd on qd.quote_vrr=vrd.VRR_ID join vehicle_database vd on qd.vehicle_id=vd.Vehicle_ID join affiliates_database ad on qd.affiliate_id=ad.Affiliates_ID where quot_status not in ('pending','decline')");
                        // $vehicles_rep=mysqli_query($con,"SELECT * FROM quotation_database qd join vehicle_database vd on qd.vehicle_id=vd.Vehicle_ID join affiliates_database ad on qd.affiliate_id=ad.Affiliates_ID where affiliate_user={$_SESSION['UserID']}");
                        // echo $Years;
                        while($showPlate = mysqli_fetch_array($vehicles_rep))
                        {
                            $status=$showPlate['quot_status'];
                            if($status=='approved-manager')
                                $status='Approved - Unpaid';
                            elseif($status=='approved-manager')
                                $status='Approved - Paid';
                            echo "<tr id='row{$showPlate['quot_id']}' value='false'>
                            <td onclick=showVRR('{$showPlate['quot_id']}','{$showPlate['VRR_Type']}','{$showPlate['VRR_Date']}','{$showPlate['VRR_Concern']}','{$showPlate['ODO']}')>
                            {$showPlate['VRR_ID']}
                            <input type='hidden' id='row_order{$showPlate['quot_id']}' value='false'>
                            </td>
                            <td onclick=showVRR('{$showPlate['quot_id']}','{$showPlate['VRR_Type']}','{$showPlate['VRR_Date']}','{$showPlate['VRR_Concern']}','{$showPlate['ODO']}')>{$showPlate['Vehicle_Plate']}
                            </td>
                            <td onclick=showVRR('{$showPlate['quot_id']}','{$showPlate['VRR_Type']}','{$showPlate['VRR_Date']}','{$showPlate['VRR_Concern']}','{$showPlate['ODO']}')>{$showPlate['Vehicle_Brand']} {$showPlate['Vehicle_Model']}
                            </td>
                            <td onclick=showVRR('{$showPlate['quot_id']}','{$showPlate['VRR_Type']}','{$showPlate['VRR_Date']}','{$showPlate['VRR_Concern']}','{$showPlate['ODO']}')>{$showPlate['quot_description']}
                            </td>
                            <td onclick=showVRR('{$showPlate['quot_id']}','{$showPlate['VRR_Type']}','{$showPlate['VRR_Date']}','{$showPlate['VRR_Concern']}','{$showPlate['ODO']}')>{$showPlate['quot_amount']}
                            </td>
                            <td onclick=showVRR('{$showPlate['quot_id']}','{$showPlate['VRR_Type']}','{$showPlate['VRR_Date']}','{$showPlate['VRR_Concern']}','{$showPlate['ODO']}')>{$showPlate['quot_cheque']}
                            </td>
                            <td onclick=showVRR('{$showPlate['quot_id']}','{$showPlate['VRR_Type']}','{$showPlate['VRR_Date']}','{$showPlate['VRR_Concern']}','{$showPlate['ODO']}')>{$status}
                            </td>
                            <td onclick=showVRR('{$showPlate['quot_id']}','{$showPlate['VRR_Type']}','{$showPlate['VRR_Date']}','{$showPlate['VRR_Concern']}','{$showPlate['ODO']}')>{$showPlate['Affiliates']} {$showPlate['Branch']}
                            </td>
                            <td onclick=showVRR('{$showPlate['quot_id']}','{$showPlate['VRR_Type']}','{$showPlate['VRR_Date']}','{$showPlate['VRR_Concern']}','{$showPlate['ODO']}')>{$showPlate['quot_createDate']}
                            </td>
                            <td>";
                            if($status=='pending')
                                echo "<form action='#' method='POST' class='btn-group-vertical' style='margin:0'>
                                        <input type='hidden' value='{$showPlate['quot_id']}' name='ids'>
                                        <button name='quotationStat' class='btn btn-success approve' value='approve'>Approve</button>
                                        <button name='quotationStat' class='btn btn-danger' value='decline'>Decline</button>
                                    </form>";
                            if($status=='Approved - Unpaid')
                                echo "<button id='cheque' class='btn btn-info approve' value='{$showPlate['quot_id']}'>Send Cheque Number</button>";
                            echo "</td>
                                </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </center>
    <div id="txtHint" class="m-5 col-8 m-5 p-5">
    </div>
</div>
<div class="modal-backDrop">
</div>
<div class="modal_add_cheque">
    <button class="btn btn-transparent float-right" id="modal_close_quotation">&#10006;</button>
    <form action='#' method='POST' id="ADDQUOTATIONFORM">
        <div class="modal_content">
            <div class="header">
            SEND CHEQUE
            </div>
            <div class="body mt-4">
                <div class="input-group mb-3">
                    <input type="hidden" id="ids" name="ids">
                    <input type="text" class="form-control" name="chequeNum" required placeholder="Cheque Number" aria-label="Cheque Number" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit" name="save_cheque" id="button-addon2">Button</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready( function () {
        var table=$('#QuotationTable').DataTable();
        table.search("<?php echo $_GET['viewQuotation'] ?>").draw();
    } );
    function showVRR(id,type,date,concern,odo){
        // alert("VRR")
        if($("#row_order"+id).val()=="false"){
            $("#row_order"+id).val("true")
                $('#row'+id).after(`<tr id="row_order_det${id}" style="background:#f3f3f3">
                <td colspan="5">VRR TYPE: ${type}<br>VRR CONCERN: ${concern}</td>
                <td colspan="5">Date Created: ${date}<br>Vehicle ODO: ${odo}</td>
                </tr>`);
                     
        }else{
            $("#row_order"+id).val("false")
            $("#row_order_det"+id).remove()
        }
    }
    $("#cheque").on("click",function(){
        $("#ids").val($(this).val());
        $('.modal-backDrop').css('display','block')
        $('.modal_add_cheque').css('display','block')
    })
</script>
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
                        $vehicles_rep=mysqli_query($con,"SELECT * FROM quotation_database qd join vrr_database vrd on qd.quote_vrr=vrd.VRR_ID join vehicle_database vd on qd.vehicle_id=vd.Vehicle_ID join affiliates_database ad on qd.affiliate_id=ad.Affiliates_ID");
                        // $vehicles_rep=mysqli_query($con,"SELECT * FROM quotation_database qd join vehicle_database vd on qd.vehicle_id=vd.Vehicle_ID join affiliates_database ad on qd.affiliate_id=ad.Affiliates_ID where affiliate_user={$_SESSION['UserID']}");
                        // echo $Years;
                        while($showPlate = mysqli_fetch_array($vehicles_rep))
                        {
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
                            <td onclick=showVRR('{$showPlate['quot_id']}','{$showPlate['VRR_Type']}','{$showPlate['VRR_Date']}','{$showPlate['VRR_Concern']}','{$showPlate['ODO']}')>{$showPlate['quot_status']}
                            </td>
                            <td onclick=showVRR('{$showPlate['quot_id']}','{$showPlate['VRR_Type']}','{$showPlate['VRR_Date']}','{$showPlate['VRR_Concern']}','{$showPlate['ODO']}')>{$showPlate['Affiliates']} {$showPlate['Branch']}
                            </td>
                            <td onclick=showVRR('{$showPlate['quot_id']}','{$showPlate['VRR_Type']}','{$showPlate['VRR_Date']}','{$showPlate['VRR_Concern']}','{$showPlate['ODO']}')>{$showPlate['quot_createDate']}
                            </td>
                            <td>";
                            if($showPlate['quot_status']=='Pending')
                                echo "<form action='#' method='POST' class='btn-group-vertical' style='margin:0'>
                                        <input type='hidden' value='{$showPlate['quot_id']}' name='ids'>
                                        <button name='quotationStat' class='btn btn-success approve' value='approve'>Approve</button>
                                        <button name='quotationStat' class='btn btn-danger' value='decline'>Decline</button>
                                    </form>";
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
                <td colspan="5">DAte Created: ${date}<br>Vehicle ODO: ${odo}</td>
                </tr>`);
                     
        }else{
            $("#row_order"+id).val("false")
            $("#row_order_det"+id).remove()
        }
    }
</script>
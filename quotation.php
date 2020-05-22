<div id="test" >
    <center>
        <div class="m-5 col-8 m-5 p-5">
            <!-- <div class=" float-right"> -->
            <!-- <button class="btn btn-secondary mb-3" id="btn_addQuotation">ADD QUOTATION -->
            <!-- </button></div> -->
            <center><strong style="font-size:23px">QUOTATION</strong></center>
            <table width="100%" class="table table-bordered" id="QuotationTable">
                <thead>
                    <tr>
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
                        <th>Date Created
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $vehicles_rep=mysqli_query($con,"SELECT * FROM quotation_database qd join vehicle_database vd on qd.vehicle_id=vd.Vehicle_ID join affiliates_database ad on qd.affiliate_id=ad.Affiliates_ID where affiliate_user={$_SESSION['UserID']}");
                        // echo $Years;
                        while($showPlate = mysqli_fetch_array($vehicles_rep))
                        {
                            $status=$showPlate['quot_status'];
                            if($status=='approved-manager'){
                                $status="Approved(Unpaid)";
                            }elseif($status=='approved-paid'){
                                $status="Approved(Paid)";
                            }elseif($status=='declined'){
                                $status="declined <button class='btn btn-outline-danger btn_resendQuotation' data-id='{$showPlate['quot_id']}' data-plate='{$showPlate['vehicle_id']}' data-desc='{$showPlate['quot_description']}' data-amount='{$showPlate['quot_amount']}' data-brand='{$showPlate['Vehicle_Brand']}' data-model='{$showPlate['Vehicle_Model']}'>Resend Quotation</button>";
                            }
                            echo "<tr>
                            <td>{$showPlate['Vehicle_Plate']}
                            </td>
                            <td>{$showPlate['Vehicle_Brand']} {$showPlate['Vehicle_Model']}
                            </td>
                            <td>{$showPlate['quot_description']}
                            </td>
                            <td>{$showPlate['quot_amount']}
                            </td>
                            <td>{$showPlate['quot_cheque']}
                            </td>
                            <td>{$status}
                            </td>
                            <td>{$showPlate['quot_createDate']}
                            </td>
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
</script>
<div class="modal-backDrop">
</div>
<div class="modal_resend_quotation">
    <button class="btn btn-transparent float-right" id="modal_close_quotation">&#10006;</button>
    <form action='#' method='POST' id="resendQUOTATIONFORM">
        <div class="modal_content">
            <div class="header">
            RESEND QUOTATION
            </div>
            <div class="body mt-4">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Plate Number:</label>
                    <div class="col-sm-8">
                        <select class="form-control" readonly required id="addQuotPlate" name="addQuotPlate">
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
                <input type="hidden" class="form-control" required id="addQuotID" name="addQuotID" readonly>
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
                        <textarea class="form-control" required id="addQuotDesc" name="addQuotDesc" rows="3"></textarea>
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
                        <button type="submit" class="btn btn-success" id="submit_addQuotation" name="submit_resendQuotation">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- <div class="modal_add_quotation">
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
                        <select class="form-control" required id="addQuotPlate" name="addQuotPlate">
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
</div> -->
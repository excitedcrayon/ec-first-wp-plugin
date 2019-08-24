<div class="cnw-contracts-modal edit-contract-container">
    <a href="javascript:void(0)" id="view-close-contract">x</a>
    <form id="editContract" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
        <h2>Contract Information for
            <?php echo $id; ?>
        </h2>
        <?php foreach ( $result as $data ):  ?>
        <div class="c-row">
            <input type="hidden" id="updateID" name="updateID" value="<?php echo $data->id; ?>">
        </div>
        <div class="c-row">
            <label for="updateID">Contract ID</label>
            <input type="text" id="updateContractID" name="updateContractID" value="<?php echo $data->contract_id; ?>" readonly>
        </div>
        <div class="c-row">
            <label for="updateCustomer">Customer</label>
            <input type="text" id="updateCustomer" name="updateCustomer" value="<?php echo $data->customer; ?>" readonly>
        </div>
        <div class="c-row">
            <label for="updateContractName">Contract Name</label>
            <input type="text" id="updateContractName" name="updateContractName" value="<?php echo $data->contract_name; ?>" readonly>
        </div>
        <div class="c-row">
            <label for="updateContractNumber">Contract Number</label>
            <input type="text" id="updateContractNumber" name="updateContractNumber" value="<?php echo $data->contract_number; ?>" readonly>
        </div>
        <div class="c-row">
            <label for="updateTypeContract">Type of Contract</label>
            <input type="text" id="updateTypeContract" name="updateTypeContract" placeholder="Tender" value="<?php echo $data->type_of_contract; ?>">
        </div>
        <div class="c-row">
            <label for="updateLocation">Location</label>
            <input type="text" id="updateLocation" name="updateLocation" placeholder="Queensland, NSW..." value="<?php echo $data->location; ?>">
        </div>
        <div class="c-row">
            <label for="updateDateReceived">Date Received</label>
            <input type="text" id="updateDateReceived" name="updateDateReceived" placeholder="07/08/2019" value="<?php echo $data->date_received; ?>">
        </div>
        <div class="c-row">
            <label for="updateClosingDate">Closing Date</label>
            <input type="text" id="updateClosingDate" name="updateClosingDate" placeholder="07/08/2019" value="<?php echo $data->closing_date; ?>">
        </div>
        <div class="c-row">
            <label for="updateCurrentContractHolder">Current Contract Holder</label>
            <input type="text" id="updateCurrentContractHolder" name="updateCurrentContractHolder" placeholder="Vendor Panel" value="<?php echo $data->current_contract_holder; ?>">
        </div>
        <div class="c-row">
            <label for="updateSuppliers">Supplying Branches</label>
            <input type="text" id="updateSuppliers" name="updateSuppliers" placeholder="TAS, NT & QLD" value="<?php echo $data->supplying_branches; ?>">
        </div>
        <div class="c-row">
            <label for="updateCustomerContact">Customer Contact Details</label>
            <input type="text" id="updateCustomerContact" name="updateCustomerContact" placeholder="Ken Hobl, Mobile: xxxx, Email: ...." value="<?php echo $data->customer_contact_details; ?>">
        </div>
        <div class="c-row">
            <label for="updateResults">Win/Lost/No Result</label>
            <select name="updateResults" id="updateResults">
                <option value="">--Select--</option>
                <option <?php if ($data->won_lost_noresult == 'won') { echo 'selected'; } ?> value="won">Won</option>
                <option <?php if ($data->won_lost_noresult == 'lost') { echo 'selected'; } ?> value="lost">Lost</option>
                <option <?php if ($data->won_lost_noresult == 'no-result') { echo 'selected'; } ?> value="no-result">No Result</option>
            </select>
        </div>
        <div class="c-row">
            <label for="updateComments">Comments</label>
            <textarea name="updateComments" id="updateComments" cols="30" rows="10">
            <?php echo $data->comments; ?>
            </textarea>
        </div>
        <div class="c-row col-50">
            <label for="updateAssign">Assign Contract ID</label>
            <select name="updateAssign" id="updateAssign">
                <option value=""></option>
                <option <?php if($data->assign_contract_id == 'Open') { echo 'selected'; } ?> value="Open">Open</option>
                <option <?php if($data->assign_contract_id == 'Completed') { echo 'selected'; } ?> value="Completed">Completed</option>
            </select>
        </div>
        <div class="c-row col-50">
            <label for="updateExpiry">Expiry Date</label>
            <input type="text" id="updateExpiry" name="updateExpiry" placeholder="27/08/2019" value="<?php echo $data->expiry_date; ?>">
        </div>
        <div class="c-row">
            <label for="updatePrice">Price Schedule</label>
            <input type="text" id="updatePrice" name="updatePrice" placeholder="" value="<?php echo $data->price_schedule; ?>">
        </div>
        <div class="c-row">
            <span>
                <strong>Date Created: </strong>
                <?php echo $data->date_created; ?>
            </span>
            <span>
                <strong>Last Modified: </strong>
                <?php echo $data->date_edited; ?>
            </span>
            <span>
                <strong>Last Edited By: </strong>
                <?php echo $data->last_edited_by; ?>
            </span>
        </div>
        <div class="c-row">
            <input type="hidden" id="updateDateCreated" name="updateDateCreated" value="<?php echo $data->date_created; ?>">
        </div>
        <input type="submit" id="updateContract" name="updateContract" value="Update Contract">
        <?php endforeach;?>
    </form>
</div>

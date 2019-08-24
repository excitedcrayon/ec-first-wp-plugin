<?php
function trackInput($parameter){
    if(empty($_GET[$parameter])){
        echo '';
    }else{
        echo $_GET[$parameter];
    }
}
?>
<div class="cnw-contracts-modal new-contract-container">
    <span></span>
    <a href="javascript:void(0)" id="view-close-contract">x</a>
    <form id="insertContracts" action="<?php esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post">
        <h2>Create new Contract</h2>
        <div class="c-row">
            <label for="contractID">Contract ID<sup>*</sup></label>
            <input type="text" id="contractID" name="contractID" placeholder="FPA-100" value="<?php trackInput('contractID'); ?>" required>
        </div>
        <div class="c-row">
            <label for="contractCustomer">Customer<sup>*</sup></label>
            <input type="text" id="contractCustomer" name="contractCustomer" placeholder="Ken Hobl" value="<?php trackInput('contractCustomer'); ?>" required>
        </div>
        <div class="c-row">
            <label for="contractName">Contract Name<sup>*</sup></label>
            <input type="text" id="contractName" name="contractName" placeholder="Solar Energy" value="<?php trackInput('contractName'); ?>" required>
        </div>
        <div class="c-row">
            <label for="contractNumber">Contract Number<sup>*</sup></label>
            <input type="text" id="contractNumber" name="contractNumber" placeholder="BUS268" value="<?php trackInput('contractNumber'); ?>" required>
        </div>
        <div class="c-row">
            <label for="contractType">Type of Contract</label>
            <input type="text" id="contractType" name="contractType" placeholder="Tender" value="<?php trackInput('contractType'); ?>">
        </div>
        <div class="c-row">
            <label for="contractLocation">Location</label>
            <input type="text" id="contractLocation" name="contractLocation" placeholder="Queensland" value="<?php trackInput('contractLocation'); ?>">
        </div>
        <div class="c-row col-50">
            <label for="contractDateReceived">Date Received</label>
            <input type="text" id="contractDateReceived" name="contractDateReceived" placeholder="07/08/2019" value="<?php trackInput('contractDateReceived'); ?>">
        </div>
        <div class="c-row col-50">
            <label for="contractClosingDate">Closing Date</label>
            <input type="text" id="contractClosingDate" name="contractClosingDate" placeholder="17/08/2019" value="<?php trackInput('contractClosingDate'); ?>">
        </div>
        <div class="c-row">
            <label for="contractHolder">Current Contract Holder</label>
            <input type="text" id="contractHolder" name="contractHolder" placeholder="Vendor Panel" value="<?php trackInput('contractHolder'); ?>">
        </div>
        <div class="c-row">
            <label for="contractSuppliers">Supplying Branches</label>
            <input type="text" id="contractSuppliers" name="contractSuppliers" placeholder="TAS, NT & QLD" value="<?php trackInput('contractSuppliers'); ?>">
        </div>
        <div class="c-row">
            <label for="contractContact">Customer Contact Details</label>
            <input type="text" id="contractContact" name="contractContact" placeholder="Ken Hobl, Mobile: xxxx, Email: ....">
        </div>
        <div class="c-row">
            <label for="contractResults">Win/Lost/No Result</label>
            <select name="contractResults" id="contractResults">
                <option value="">--Select--</option>
                <option value="won">Won</option>
                <option value="lost">Lost</option>
                <option value="no-result">No Result</option>
            </select>
        </div>
        <div class="c-row">
            <label for="contractComments">Comments</label>
            <textarea name="contractComments" id="contractComments" cols="30" rows="10"></textarea>
        </div>
        <div class="c-row col-50">
            <label for="contractAssign">Assign Contract ID</label>
            <select name="contractAssign" id="contractAssign">
                <option value=""></option>
                <option value="Open">Open</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
        <div class="c-row col-50">
            <label for="contractExpiry">Expiry Date</label>
            <input type="text" id="contractExpiry" name="contractExpiry" placeholder="27/08/2019" value="<?php trackInput('contractExpiry'); ?>">
        </div>
        <div class="c-row">
            <label for="contractPrice">Price Schedule</label>
            <input type="text" id="contractPrice" name="contractPrice" placeholder="$2000" value="<?php trackInput('contractPrice'); ?>">
        </div>
        <input type="submit" id="contractSubmit" name="submitContract" value="Create Contract">
    </form>
</div>

<?php
function display_short_string($string){
    if(strlen($string) >= 30){
        // truncate string
        $stringTrimmed = substr($string, 0, 30);
        return $stringTrimmed . '...';
    }
}
?>

<?php include_once plugin_dir_path(__FILE__) . 'export-to-csv.php'; ?>
<div class="new-contract-container">
    <a href="?newContract=true" id="new-contract">New Contract</a>
</div>
<div class='cnw-contracts-table-container' style='overflow-x:scroll;'>
    <table id='cnw-contracts-table'>
        <thead>
            <tr>
                <th>ContractID</th>
                <th>Customer</th>
                <th>Contract Name</th>
                <th>Contract Number</th>
                <th>Type of Contract</th>
                <th>Location</th>
                <th>Date Received</th>
                <th>Closing Date</th>
                <th>Current Contract Holder</th>
                <th>Supplying Branches</th>
                <th>Customer Contact Details</th>
                <th>Won/Lost/No Result</th>
                <th>Comments</th>
                <th>Assign Contract</th>
                <th>Expiry Date</th>
                <th>Price Schedule</th>
                <th>Last Edited By</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ( $contracts as $row ): ?>
            <tr>
                <td>
                    <?php echo $row->contract_id; ?>
                </td>
                <td>
                    <?php echo $row->customer; ?>
                </td>
                <td>
                    <a href="?contractID=<?php echo $row->contract_id; ?>">
                        <?php echo $row->contract_name; ?>
                    </a>
                </td>
                <td>
                    <?php echo $row->contract_number; ?>
                </td>
                <td>
                    <?php echo $row->type_of_contract; ?>
                </td>
                <td>
                    <?php echo $row->location; ?>
                </td>
                <td>
                    <?php echo $row->date_received; ?>
                </td>
                <td>
                    <?php echo $row->closing_date; ?>
                </td>
                <td>
                    <?php echo $row->current_contract_holder; ?>
                </td>
                <td>
                    <?php echo $row->supplying_branches; ?>
                </td>
                <td>
                    <?php echo $row->customer_contact_details; ?>
                </td>
                <td>
                    <?php echo $row->won_lost_noresult; ?>
                </td>
                <td>
                    <?php echo display_short_string($row->comments); ?>
                </td>
                <td>
                    <?php echo $row->assign_contract_id; ?>
                </td>
                <td>
                    <?php echo $row->expiry_date; ?>
                </td>
                <td>
                    <?php echo $row->price_schedule; ?>
                </td>
                <td>
                    <?php echo $row->last_edited_by; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

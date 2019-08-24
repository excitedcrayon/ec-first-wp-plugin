"use strict";

jQuery(document).ready(function ($) {
    //=========== add datepickers to the create form date fields ===========
    $('#contractDateReceived').datepicker({
        dateFormat: 'dd/mm/yy'
    });

    $('#contractClosingDate').datepicker({
        dateFormat: 'dd/mm/yy'
    });

    $('#contractExpiry').datepicker({
        dateFormat: 'dd/mm/yy'
    });

    //=========== add datepickers to the update form date fields ===========
    $('#updateDateReceived').datepicker({
        dateFormat: 'dd/mm/yy'
    });

    $('#updateClosingDate').datepicker({
        dateFormat: 'dd/mm/yy'
    });

    $('#updateExpiry').datepicker({
        dateFormat: 'dd/mm/yy'
    });

    // display contracts table in a sortable javascript table
    $('#cnw-contracts-table').DataTable({
        "pageLength": 25,
        "order": [[0, "desc"]]
    });

    //=========== button to close edit form ===========
    $('#view-close-contract').on('click', function () {

        clearURLParams();

        // close new contract modal
        $('.new-contract-container').css('display', 'none');
        // close edit contract modal
        $('.edit-contract-container').css('display', 'none');
    });

    function clearURLParams() {
        // remove get parameter from URL
        location.href = location.href.split("?")[0]; // default to previous URL without parameters
    }
});

<?php
if(!class_exists('Functions')){
    class Functions{

        const CNW_CONTRACTS_TABLE = 'cnw_contracts';

        public static function init_menu(){
            add_menu_page(
                'CNW Contracts Menu', // page title
                'CNW Contracts', // menu title
                'manage_options', // admin level
                'cnw-contracts-documentation1', // page slug
                'Functions::view_documentation', // callback function
                'dashicons-portfolio', // icon
                8 // position
            );
        }

        public static function load_assets(){
            wp_enqueue_style(
                'cnw-contracts-style',
                plugins_url().'/cnw-contracts/assets/css/style.css'
            );
            wp_enqueue_style(
                'cnw-contracts-datatables-style',
                plugins_url().'/cnw-contracts/assets/css/jquery.dataTables.min.css'
            );

            wp_enqueue_script(
                'cnw-contracts-script',
                plugins_url().'/cnw-contracts/assets/js/main.js',
                array ( 'jquery' )
            );
            wp_enqueue_script(
                'cnw-contracts-datatables-script',
                plugins_url().'/cnw-contracts/assets/js/jquery.dataTables.min.js'
            );

            wp_enqueue_script('jquery-ui-datepicker');
        }

        public static function create_db_table(){
            global $wpdb;
            global $charset_collate;

            $cnwTable = $wpdb->prefix.Functions::CNW_CONTRACTS_TABLE;
            if( $wpdb->get_var("SHOW TABLES LIKE $cnwTable") != $cnwTable ){
                $createTable = "CREATE TABLE $cnwTable (
                id INT(11) NOT NULL AUTO_INCREMENT,
                contract_id VARCHAR(255) NOT NULL,
                customer VARCHAR(255) NOT NULL,
                contract_name VARCHAR(255) NOT NULL,
                contract_number VARCHAR(100) NULL,
                type_of_contract VARCHAR(255) NULL,
                location VARCHAR(255) NULL,
                date_received VARCHAR(50) NULL,
                closing_date VARCHAR(50) NULL,
                current_contract_holder VARCHAR(255) NULL,
                supplying_branches VARCHAR(255) NULL,
                customer_contact_details VARCHAR(255) NULL,
                won_lost_noresult VARCHAR(15) NULL,
                comments TEXT,
                assign_contract_id VARCHAR(100) NULL,
                expiry_date VARCHAR(50) NULL,
                price_schedule VARCHAR(50) NULL,
                last_edited_by VARCHAR(255) NOT NULL,
                date_created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                date_edited DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id))$charset_collate;";

                require_once(ABSPATH.'wp-admin/includes/upgrade.php');
                dbDelta($createTable);
            }
        }

        public static function drop_db_table(){
            global $wpdb;
            $cnwTable = $wpdb->prefix.Functions::CNW_CONTRACTS_TABLE;

            $dropTable = "DROP TABLE IF EXISTS $cnwTable";

            $wpdb->query($dropTable);

        }

        public static function check_user_role(){
            global $current_user;

            if( is_user_logged_in() ){
                return $current_user->roles[0];
            }
        }

        public static function check_username(){
            global $current_user;

            if( is_user_logged_in() ){
                return $current_user->user_login;
            }
        }

        public static function view_documentation(){

            global $wpdb;
            $cnwTable = $wpdb->prefix.Functions::CNW_CONTRACTS_TABLE;
            $query = $wpdb->get_results("SELECT * FROM $cnwTable");
            $rows = $wpdb->num_rows;

            include_once plugin_dir_path(__FILE__) . '../views/documentation.php';
        }

        public static function view_contracts_table(){
            // method creates new contract
            Functions::view_insert_form();
            // method edits requested contract
            Functions::view_edit_contract();

            global $wpdb;
            $cnwTable = $wpdb->prefix.Functions::CNW_CONTRACTS_TABLE;
            $contracts = $wpdb->get_results("SELECT * FROM $cnwTable ORDER BY id ASC");
            include_once plugin_dir_path(__FILE__) . '../views/contracts.php';
        }

        public static function view_edit_contract(){
            if(!empty($_GET['contractID'])){
                $id = $_GET['contractID'];

                global $wpdb;
                $cnwTable = $wpdb->prefix.Functions::CNW_CONTRACTS_TABLE;
                $result = $wpdb->get_results("SELECT * FROM $cnwTable WHERE contract_id='$id'");

                if(empty($_POST['updateContract'])){
                    include_once plugin_dir_path(__FILE__) . '../views/edit-form.php';
                }else if($_POST['updateContract']){
                    Functions::process_edit_form();
                }else{
                    echo '';
                }
            }
        }

        public static function view_insert_form(){
            if(!empty($_GET['newContract'])){
                $newContract = $_GET['newContract'];
                $currentURL = explode('?', $_SERVER['REQUEST_URI']);

                if($newContract == 'true'){
                    include_once plugin_dir_path(__FILE__) . '../views/insert-form.php';
                }

                if(empty($_POST['submitContract'])){
                    include_once plugin_dir_path(__FILE__) . '../views/insert-form.php';
                }else if($_POST['submitContract']){
                    Functions::process_insert_form();
                }else{
                    echo '';
                    Functions::display_success_message('Contract has been created');
                }
            }
        }

        public static function process_insert_form(){
            global $wpdb;
            global $current_user;

            $cnwTable = $wpdb->prefix.Functions::CNW_CONTRACTS_TABLE;

            // form data
            $contract_id = $_POST['contractID'];
            $customer = $_POST['contractCustomer'];
            $contract_name = $_POST['contractName'];
            $contract_number = $_POST['contractNumber'];
            $type_of_contract = $_POST['contractType'];
            $location = $_POST['contractLocation'];
            $date_received = $_POST['contractDateReceived'];
            $closing_date = $_POST['contractClosingDate'];
            $contract_holder = $_POST['contractHolder'];
            $contract_supplier = $_POST['contractSuppliers'];
            $customer_contact = $_POST['contractContact'];
            $results = $_POST['contractResults'];
            $comments = $_POST['contractComments'];
            $assign = $_POST['contractAssign'];
            $expiry_date = $_POST['contractExpiry'];
            $contract_price = $_POST['contractPrice'];

            // check if contract already exists
            $existing_result = $wpdb->get_results("SELECT * FROM $cnwTable WHERE contract_id='$contract_id'");

            if($existing_result){
                Functions::display_error_message('<strong>'.$contract_id.'</strong> contract already exists');
            }else{
                $insert_result = $wpdb->insert($cnwTable,
                    array(
                        'id' => NULL,
                        'contract_id' => strtoupper($contract_id),
                        'customer' => $customer,
                        'contract_name' => $contract_name,
                        'contract_number' => strtoupper($contract_number),
                        'type_of_contract' => $type_of_contract,
                        'location' => $location,
                        'date_received' => $date_received,
                        'closing_date' => $closing_date,
                        'current_contract_holder' => $contract_holder,
                        'supplying_branches' => $contract_supplier,
                        'customer_contact_details' => $customer_contact,
                        'won_lost_noresult' => $results,
                        'comments' => trim($comments),
                        'assign_contract_id' => $assign,
                        'expiry_date' => $expiry_date,
                        'price_schedule' => $contract_price,
                        'last_edited_by' => $current_user->display_name,
                        'date_created' => current_time( 'mysql' ),
                        'date_edited' => current_time( 'mysql' )
                    ), array('%d','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s', '%s', '%s'));
                if($insert_result){
                    Functions::display_success_message('Contract <strong>'.$contract_id.'</strong> has been created');
                    echo '<script type="text/javascript">
                            setInterval(function(){
                            window.location = location.href.split("?")[0];
                        }, 1500);
                    </script>';
                }
            }
        }

        public static function process_edit_form(){
            global $wpdb;
            global $current_user;

            $cnwTable = $wpdb->prefix.Functions::CNW_CONTRACTS_TABLE;

            // form data
            $index = $_POST['updateID'];
            $contract_id = $_POST['updateContractID'];
            $customer = $_POST['updateCustomer'];
            $contract_name = $_POST['updateContractName'];
            $contract_number = $_POST['updateContractNumber'];
            $type_of_contract = $_POST['updateTypeContract'];
            $location = $_POST['updateLocation'];
            $date_received = $_POST['updateDateReceived'];
            $closing_date = $_POST['updateClosingDate'];
            $contract_holder = $_POST['updateCurrentContractHolder'];
            $contract_supplier = $_POST['updateSuppliers'];
            $customer_contact = $_POST['updateCustomerContact'];
            $results = $_POST['updateResults'];
            $comments = $_POST['updateComments'];
            $assign = $_POST['updateAssign'];
            $expiry_date = $_POST['updateExpiry'];
            $contract_price = $_POST['updatePrice'];
            $date_created = $_POST['updateDateCreated'];

            // update values in cnw contracts table
            $update_result = $wpdb->update(
                $cnwTable,
                array(
                    'contract_id' => $contract_id,
                    'customer' => $customer,
                    'contract_name' => $contract_name,
                    'contract_number' => $contract_number,
                    'type_of_contract' => $type_of_contract,
                    'location' => $location,
                    'date_received' => $date_received,
                    'closing_date' => $closing_date,
                    'current_contract_holder' => $contract_holder,
                    'supplying_branches' => $contract_supplier,
                    'customer_contact_details' => $customer_contact,
                    'won_lost_noresult' => $results,
                    'comments' => trim($comments),
                    'assign_contract_id' => $assign,
                    'expiry_date' => $expiry_date,
                    'price_schedule' => $contract_price,
                    'last_edited_by' => $current_user->display_name,
                    'date_created' => $date_created,
                    'date_edited' => current_time ( 'mysql' )
                ),
                array(
                    'id' => $index
                ),
                array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'),
                array( '%d' )
            );

            if($update_result){
                Functions::display_success_message('Contract <strong>'.$contract_id.'</strong> has been updated');
                echo '<script type="text/javascript">
                    setInterval(function(){
                        window.location = location.href.split("?")[0];
                    }, 1500);
                </script>';
            }
        }

        public static function export_to_csv(){
            if(isset($_POST['exportContracts'])){

                // query from database
                global $wpdb;
                $cnwTable = $wpdb->prefix.Functions::CNW_CONTRACTS_TABLE;
                $data = $wpdb->get_results("SELECT * FROM $cnwTable", ARRAY_A);

                $column_names = array('ID','Contract ID','Customer','Contract Name','Contract Number','Type of Contract',
                                     'Location','Date Received','Closing Date','Current Contract Holder','Supplying Branches','Customer Contact Details','Won Lost No-Result','Comments','Assign Contract ID','Expiry Date','Price Schedule','Last Edited By','Date Created','Date Edited');

                $output = fopen('php://output', 'w');

                fputcsv($output, $column_names);

                // loop through db search results
                foreach( $data as $key => $value ){
                    $column_data = array(
                        $value['id'],
                        $value['contract_id'],
                        $value['customer'],
                        $value['contract_name'],
                        $value['contract_number'],
                        $value['type_of_contract'],
                        $value['location'],
                        $value['date_received'],
                        $value['closing_date'],
                        $value['current_contract_holder'],
                        $value['supplying_branches'],
                        $value['customer_contact_details'],
                        $value['won_lost_noresult'],
                        $value['comments'],
                        $value['assign_contract_id'],
                        $value['expiry_date'],
                        $value['price_schedule'],
                        $value['last_edited_by'],
                        $value['date_created'],
                        $value['date_edited']
                    );
                    fputcsv( $output, $column_data );
                }

                $filename = date("Ymd").time().'_cnw_contracts';

                header('Content-Encoding: UTF-8');
                header('Content-Type: text/csv; charset=utf-8');
                header('Content-Disposition: attachment; filename='.$filename.'.csv');

                fclose($output);
                exit;
            }
        }

        public static function import_csv_to_db(){
            global $wpdb;
            $cnwTable = $wpdb->prefix.Functions::CNW_CONTRACTS_TABLE;

            if(isset($_POST['importCSVContracts'])){
                $uploadFile = $_FILES['contractCSVFile']['tmp_name'];
                if(empty($uploadFile)){
                    echo '<script>alert("Please select a file");</script>';
                }else{
                    // check if file has .csv extension
                    $file_ext = pathinfo($uploadFile, PATHINFO_EXTENSION);
                    $allowed_ext = array('php','txt','jpg','pdf','ini','png');
                    if( in_array( $file_ext, $allowed_ext ) ){
                        echo '<script>alert("File type is not allowed.");</script>';
                    }else{
                        $handle = fopen($uploadFile, "r");
                        while( ($file_open = fgetcsv($handle, ",")) !== false ){

                            $upload_data = array(
                                'id' => $file_open[0],
                                'contract_id' => $file_open[1],
                                'customer' => $file_open[2],
                                'contract_name' => $file_open[3],
                                'contract_number' => $file_open[4],
                                'type_of_contract' => $file_open[5],
                                'location' => $file_open[6],
                                'date_received' => $file_open[7],
                                'closing_date' => $file_open[8],
                                'current_contract_holder' => $file_open[9],
                                'supplying_branches' => $file_open[10],
                                'customer_contact_details' => $file_open[11],
                                'won_lost_noresult' => $file_open[12],
                                'comments' => $file_open[13],
                                'assign_contract_id' => $file_open[14],
                                'expiry_date' => $file_open[15],
                                'price_schedule' => $file_open[16],
                                'last_edited_by' => $file_open[17],
                                'date_created' => $file_open[18],
                                'date_edited' => $file_open[19]
                            );

                            $upload_results = $wpdb->insert(
                                $cnwTable,
                                $upload_data, array('%d','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s', '%s', '%s'));
                        }
                        if($upload_results){
                            echo '<script>alert("CNW Contracts Successfully Imported.");</script>';
                        }
                    }
                }
            }
        }

        public static function display_error_message($message){
            echo '<span class="cnw-contracts-error-msg">'.$message.'</span>';
        }

        public static function display_success_message($message){
            echo '<span class="cnw-contracts-success-msg">'.$message.'</span>';
        }
    }
}
?>

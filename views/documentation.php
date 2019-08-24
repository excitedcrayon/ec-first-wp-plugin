<?php # displays the documentation page in the admin section ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
</head>

<body>
    <div class="doc-container">
        <h1>CNW Contracts</h1>
        <div class="doc-container-logo">
            <img src="<?php echo plugins_url() . '/cnw-contracts/assets/images/cnw-logo.png' ?>" alt="CNW Logo">
        </div>

        <section>
            <h1>Welcome! Thank you for using the CNW Contracts plugin.</h1>
        </section>
        <hr>
        <section>
            <h2>Disclaimer</h2>
            <p class="doc-disclaimer">All data is lost when the plugin is deactivated/deleted. Make sure to create a backup by exporting all database entries to a CSV file!</p>
        </section>
        <hr>
        <section>
            <h2>Shortcode </h2>
            <p>
                Once the plugin has been activated, you can display the contracts form in table format using the following shortcode:
                <span class="code-snippet">[insert_contract]</span>
            </p>
            <p>
                This will not work immediately as the table is restricted using two parameters, <strong>user_role</strong> and/or <strong>user_access</strong>.
            </p>
            <p>
                List of parameters and attributes to use
            </p>
            <table id="doc-table">
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Attribute(s)</th>
                        <th>Effect/Example</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>user_role</td>
                        <td>administrator,editor,author,contributor,subscriber</td>
                        <td>
                            Checks for the logged in user's account and uses their permissions. You can restrict the table display to one role <strong>i.e [insert_contract user_role="administrator"]</strong>, or you can restrict the table display to multiple roles using <strong>[insert_contract user_role="administrator,editor,subscriber"].</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>user_access</td>
                        <td>user login id (i.e bmkonto, rabylkassov, sryan, mastil, myip, khill, dcruz etc)</td>
                        <td>
                            Pass one or more user login ids to restrict the table display to those specific users. For example <strong>[insert_contract user_access="sryan, khobl, jhay"]</strong>.
                        </td>
                    </tr>
                </tbody>
            </table>
            <p>You can also combine both parameters and attributes for further restrictions.</p>
        </section>
        <hr>
        <section>
            <h2>Database Information</h2>
            <p>Table name: <strong>[<?php echo $cnwTable; ?>]</strong></p>
            <?php if ( $rows == 0 ): ?>
            <?php include_once plugin_dir_path(__FILE__) . 'import-csv.php'; ?>
            <?php else: ?>
            <p>Number of contracts: <strong>(<?php echo $rows; ?>)</strong></p>
            <?php include_once plugin_dir_path(__FILE__) . 'export-to-csv.php'; ?>
            <?php endif; ?>
        </section>
    </div>
</body>

</html>

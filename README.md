# ec-first-wp-plugin
This is a custom Wordpress plugin I built to extend the functionality of the Intranet at work.

## Functionality
The plugin was designed with simplicity to perform the following actions
- Create a custom table in the Wordpress database.
- Display all entries in a sort and search table using DataTables (JQuery).
- Allow the end user to create an entry.
- View/Edit an entry.
- Export all available entries to a CSV file.

## Admin Panel 
- Upload data to the table using a CSV file.
- Export and backup entries from table into a CSV file.

## Permissions and User Access
- Use the custom shortcode [insert_contracts] with parameters and attributes to control which user level access (admin, editor, subscriber) and/or user login can view and access the entries table.

## Screenshots
- Shortcode
![shortcode](https://user-images.githubusercontent.com/33831343/63638921-649d3680-c6d1-11e9-9a82-d7762ad1bec4.PNG)

- Table displayed
![contracts_table](https://user-images.githubusercontent.com/33831343/63638928-741c7f80-c6d1-11e9-9596-ded4affab50b.PNG)

- Custom Wordpress table 
![db_table](https://user-images.githubusercontent.com/33831343/63638938-8f878a80-c6d1-11e9-9cfd-3fd498deb4be.PNG)

- New Contract
![new_contract](https://user-images.githubusercontent.com/33831343/63638958-b34ad080-c6d1-11e9-9b60-5e1a343e403e.PNG)

- View Contract
![view_contract](https://user-images.githubusercontent.com/33831343/63638966-c2ca1980-c6d1-11e9-948b-bfebd7ebbcb1.PNG)

- Upload CSV as admin in the backend dashboard
![upload_csv_data](https://user-images.githubusercontent.com/33831343/63638975-d4132600-c6d1-11e9-8ea6-ee10b3476d11.PNG)

- Export/Backup data from the admin backend dashboard
![admin_page](https://user-images.githubusercontent.com/33831343/63638977-e8efb980-c6d1-11e9-81b5-40bb30efb735.PNG)

- Access Denied (When user does not have permission)
![access_denied](https://user-images.githubusercontent.com/33831343/63639016-4a178d00-c6d2-11e9-8127-6a2c4ceb3826.PNG)

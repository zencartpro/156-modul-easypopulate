<?php
/**
 * @package Easy Populate 4 for Zen Cart German (www.zen-cart-pro.at)
 * @copyright Copyright 2016-2018  mc12345678 and chadderuski
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0 
 * @version $Id: easypopulate_4.php 2018-03-28 08:19:14 webchills $
*/
// $display_output defines
// file uploads display - output via $display_output
define('EASYPOPULATE_4_DISPLAY_SPLIT_LOCATION','You can also download your split files from your %s directory<br />');
define('EASYPOPULATE_4_DISPLAY_HEADING','<br /><h3><u>Import Results</u></h3><br />');
define('EASYPOPULATE_4_DISPLAY_UPLOADED_FILE_SPEC','<p class=smallText>File uploaded.<br />Temporary filename: %s<br /><b>User filename: %s</b><br />Size: %s<br />'); // open paragraph
define('EASYPOPULATE_4_DISPLAY_LOCAL_FILE_SPEC','<p class=smallText><b>Filename: %s</b><br />'); // open paragraph
// upload results display - output via $display_output
define('EASYPOPULATE_4_DISPLAY_RESULT_DELETED','<br /><font color="fuchsia"><b>DELETED! - Model:</b> %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_DELETE_NOT_FOUND','<br /><font color="darkviolet"><b>NOT FOUND! - Model:</b> %s - cant delete...</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_CATEGORY_NOT_FOUND', '<br /><font color="red"><b>SKIPPED! - Model:</b> %s - No category provided for this%s product</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_CATEGORY_NAME_LONG','<br /><font color="red"><b>SKIPPED! - Model:</b> %s - Category name: "%s" exceeds max. length: %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_PRODUCTS_URL_LONG','<br /><font color="red"><b>WARNING! - Model:</b> %s - URL: "%s" exceeds max. length: %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_MANUFACTURER_NAME_LONG','<br /><font color="red"><b>MANUFACTURER SKIPPED! - Manufacturer:</b> %s - Manufacturer name exceeds max. length: %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_PRODUCTS_MODEL_LONG','<br /><font color="red"><b>SKIPPED! - Model: </b>%s - Products model exceeds max. length: %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_PRODUCTS_NAME_LONG','<br /><font color="red"><b>WARNING! - Model: </b>%s - Products name: "%s" exceeds max. length: %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_NEW_PRODUCT', '<br /><font color="green"><b>NEW PRODUCT! - Model:</b> %s</font> | ');
define('EASYPOPULATE_4_DISPLAY_RESULT_NEW_PRODUCT_FAIL', '<br /><font color="red"><b>ADD NEW PRODUCT FAILED! - Model:</b> %s - SQL error. Check Easy Populate error log in uploads directory</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_UPDATE_PRODUCT', '<br /><font color="mediumblue"><b>UPDATED! - %2$s:</b> %1$s</font> | ');
define('EASYPOPULATE_4_DISPLAY_RESULT_UPDATE_PRODUCT_FAIL', '<br /><font color="red"><b>UPDATE PRODUCT FAILED! - %2$s:</b> %s - SQL error. Check Easy Populate error log in uploads directory</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_NO_MODEL', '<br /><font color="red"><b>No %1$s field data in record. This line was not imported</b></font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_UPLOAD_IMPORT', ' file to database or see below for more.');
define('EASYPOPULATE_4_DISPLAY_RESULT_UPLOAD_COMPLETE','<br /><b>File uploaded Successfully</b>: %1$s %2$s');
define('EASYPOPULATE_4_DISPLAY_RESULT_UPLOAD_EMPTY','<br /><b>Upload button was pressed, but no file had been selected.  Click Browse... to select a file to upload.</b>');
define('EASYPOPULATE_4_DISPLAY_RESULT_UPLOAD_NO_CSV', ' file is not a CSV file. See below for options.');
define('EASYPOPULATE_4_DISPLAY_RESULT_ARTISTS_NAME_LONG','<br /><font color="red"><b>SKIPPED! - Artist Name:</b> %s - exceeds max. length: %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_RECORD_COMPANY_NAME_LONG','<br /><font color="red"><b>SKIPPED! - Record Company Name:</b> %s - exceeds max. length: %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_MUSIC_GENRE_NAME_LONG','<br /><font color="red"><b>SKIPPED! - Music Genre Name:</b> %s - exceeds max. length: %s</font>');
// $messageStack defines
// checks - msg stack alerts - output via $messageStack
define('EASYPOPULATE_4_MSGSTACK_TEMP_FOLDER_MISSING','<b>Easy Populate "Uploads Folder" missing!</b><br />Your uploads folder is missing. Your configuration indicates that your uploads folder is named <b>%s</b>, and is located in <b>%s</b>.<br>');
define('EASYPOPULATE_4_MSGSTACK_TEMP_FOLDER_NOT_WRITABLE','<b>Easy Populate "Uploads Folder" is not writable!</b><br />Your uploads folder is not writable. Folder permissions for <b>%s</b> must be "777" or "755" depending on your server setup.<br>You must correct folder permissions before contining.<br>');
define('EASYPOPULATE_4_MSGSTACK_TEMP_FOLDER_PERMISSIONS_SUCCESS','Easy Populate successfully adjusted the permissions on your uploads folder! You can now upload files using Easy Populate...');
define('EASYPOPULATE_4_MSGSTACK_TEMP_FOLDER_PERMISSIONS_SUCCESS_777','Easy Populate successfully adjusted the permissions on your uploads folder, but the folder is now publically viewable. Please ensure that you added the index.html file to this directory to prevent public browsing/downloading of your Easy Populate files.');
define('EASYPOPULATE_4_MSGSTACK_MODELSIZE_DETECT_FAIL','Easy Populate cannot determine the maximum size permissible for the products_model field in your products table. Please ensure that the length of your model data field does not exceed the Zen Cart default value of 32 characters for any given product. Failure to heed this warning may have unintended consequences for your data.');
define('EASYPOPULATE_4_MSGSTACK_ERROR_SQL', 'An SQL error has occured. Please check your input data for tabs within fields and delete these. If this error continues, please forward your error log to the Easy Populate maintainer');
define('EASYPOPULATE_4_MSGSTACK_DROSS_DELETE_FAIL', '<b>Deleting of product data debris failed!</b> Please see the debug log in your uploads directory for further information.');
define('EASYPOPULATE_4_MSGSTACK_DROSS_DELETE_SUCCESS', 'Deleting of product data debris succeeded!');
define('EASYPOPULATE_4_MSGSTACK_DROSS_DETECTED', '<b>%s partially deleted product(s) found!</b> Delete this dross to prevent unwanted zencart behaviour by clicking <a href="%s">here.</a><br />You are seeing this because there are references in tables to a product that no longer exists, which is usually caused by an incomplete product deletion. This can cause Zen Cart to misbehave in certain circumstances.');
define('EASYPOPULATE_4_MSGSTACK_DATE_FORMAT_FAIL', '%s is not a valid date format. If you upload any date other than raw format (such as from Excel) you will mangle your dates. Please fix this by correcting your date format in the Easy Populate config.');
define('EASYPOPULATE_4_ORDERS_DROPDOWN_FIRST', 'Order Type');
define('EASYPOPULATE_4_ORDERS_FULL', 'Orders Full');
define('EASYPOPULATE_4_ORDERS_NEWFULL', 'Orders New Full');
define('EASYPOPULATE_4_ORDERS_NO_ATTRIBS', 'Orders No Attributes');
define('EASYPOPULATE_4_ORDERS_ATTRIBS', 'Orders Attributes Only');
define('EASYPOPULATE_4_ORDERS_DROPDOWN_TITLE', '<b>Filterable Orders Exports:</b><br/>');
// install - msg stack alerts - output via $messageStack
define('EASYPOPULATE_4_MSGSTACK_INSTALL_DELETE_SUCCESS','Redundant file <b>%s</b> was deleted from <b>YOUR_ADMIN%s</b> directory.');
define('EASYPOPULATE_4_MSGSTACK_INSTALL_DELETE_FAIL','Easy Populate was unable to delete redundant file <b>%s</b> from <b>YOUR_ADMIN%s</b> directory. Please delete this file manually.');
define('EASYPOPULATE_4_MSGSTACK_INSTALL_CHMOD_FAIL','<b>Please run the Easy Populate install again after fixing your uploads directory problem.</b>');
define('EASYPOPULATE_4_MSGSTACK_INSTALL_CHMOD_SUCCESS','<b>Configuration Variables Installation Successfull!</b>');
define('EASYPOPULATE_4_MSGSTACK_INSTALL_KEYS_FAIL','<b>Easy Populate Configuration Missing.</b>  Please install your configuration by clicking %sInstall EP4%s');
// file handling - msg stack alerts - output via $messageStack
define('EASYPOPULATE_4_MSGSTACK_FILE_EXPORT_SUCCESS', 'File <b>%s.csv</b> successfully exported! The file is ready for download in your /%s directory.');
// $specials_print defines
// results of specials in $specials_print
define('EASYPOPULATE_4_SPECIALS_HEADING', '<b><u>Specials Summary</u></b><p class=smallText>'); // open paragraph
define('EASYPOPULATE_4_SPECIALS_PRICE_FAIL', '<font color="red"><b>SKIPPED! - Model:</b> %s - specials price higher than normal price...</font><br />');
define('EASYPOPULATE_4_SPECIALS_NEW', '<font color="green"><b>NEW! - Model:</b> %s</font> | %s | %s | <font color="green"><b>%s</b></font> |<br />');
define('EASYPOPULATE_4_SPECIALS_UPDATE', '<font color="mediumblue"><b>UPDATED! - Model:</b> %s</font> | %s | %s | <font color="green"><b>%s</b></font> |<br />');
define('EASYPOPULATE_4_SPECIALS_DELETE', '<font color="fuchsia"><b>DELETED! - Model:</b> %s</font> | %s |<br />');
define('EASYPOPULATE_4_SPECIALS_DELETE_FAIL', '<font color="darkviolet"><b>NOT FOUND! - Model:</b> %s - cannot delete special...</font><br />');
define('EASYPOPULATE_4_SPECIALS_FOOTER', '</p>'); // close paragraph
define('EP_DESC_PLURAL', 'They');
define('EP_DESC_SING', 'It');
define('FEATURED_EP_DESC','Prefix: %1$s. %2$s will be processed through the featured filters.');
define('PRICEQTY_EP_DESC','Prefix: %1$s. %2$s will be processed through the Price Quantity filters.');
define('PRICEBREAKS_EP_DESC','Prefix: %1$s. %2$s will be processed through the Price Breaks filters.');
define('CATEGORY_EP_DESC','Prefix: %1$s. %2$s will be processed through the Category filters.');
define('CATEGORYMETA_EP_DESC','Prefix: %1$s. %2$s will be processed through the Category Meta filters.');
define('ATTRIB_BASIC_EP','Prefix: %1$s. %2$s will be processed through the Basic Attribute filters.');
define('ATTRIB_DETAILED_EP_DESC','Prefix: %1$s. %2$s will be processed through the Detailed Attributes filters.');
define('SBA_DETAILED_EP_DESC','Prefix: %1$s. %2$s will be processed through the Detailed Stock by Attributes filters.');
define('SBA_STOCK_EP_DESC','Prefix: %1$s. %2$s will be processed through the Stock by Attributes Stock Modification filters.');
define('ORDERS_EP_DESC', 'Prefix: %1$s. %2$s will not be processed for import.');
define('CATCHALL_EP_DESC', 'This contains any other file. %2$s will be processed like a full data file.');
define('ORDERSEXPORT_LINK_SAVE1', 'ORDERSEXPORT_LINK_SAVE1');
define('ORDERSEXPORT_LINK_SAVE1B', 'ORDERSEXPORT_LINK_SAVE1B');
define('ORDERSEXPORT_LINK_SAVE2', 'ORDERSEXPORT_LINK_SAVE2');
define('ORDERSEXPORT_LINK_SAVE3', 'ORDERSEXPORT_LINK_SAVE3');
// error log defines - for ep_debug_log.txt
define('EASYPOPULATE_4_ERRORLOG_SQL_ERROR', 'MySQL error %s: %s\nWhen executing:\n%sn');
define('EASYPOPULATE_4_REMOVE_SETTINGS', 'Un-Install EP4');
define('EASYPOPULATE_4_CONFIG_SETTINGS', 'Configuration Settings');
define('EASYPOPULATE_4_CONFIG_UPLOAD', 'Upload Directory: ');
define('EASYPOPULATE_4_UPDATE_SETTINGS', 'Update EP4 Database');
define('EASYPOPULATE_4_DISPLAY_SPLIT_SHORT', 'Split Records: ');
define('EASYPOPULATE_4_DISPLAY_EXEC_TIME', 'Execution Time: ');
define('EASYPOPULATE_4_DISPLAY_ENABLE_META', 'Enable Products Metatags: ');
define('EASYPOPULATE_4_DISPLAY_ENABLE_MUSIC', 'Enable Products Music: ');
define('EASYPOPULATE_4_DISPLAY_CUSTOM_PRODUCT_FIELDS', 'Custom Products Fields');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_SHORT_DESC', 'Product Short Descriptions: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_UNIT_MEAS', 'Product Unit of Measure: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_UPC', 'Product UPC Code: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_GOOGLE_CAT', 'Google Product Category: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_MSRP', 'Manufacturer\'s Suggested Retail Price: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_MAP', 'Manufacturer\'s Advertised Price: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_GP', 'Group Pricing Per Item: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_EXCLUSIVE', 'Exclusive Products Mod: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_SBA', 'Stock By Attributes Mod: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_CEON', 'CEON URI Rewriter Mod: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_DPM', 'Dual Pricing Mod: ');
define('EASYPOPULATE_4_DISPLAY_USER_DEF_FIELDS', 'User Defined Products Fields: ');
define('EASYPOPULATE_4_DISPLAY_INSTALLED_LANG', 'Installed Languages');
define('EASYPOPULATE_4_DISPLAY_INSTALLED_LANG_DEF', 'Default Language: ');
define('EASYPOPULATE_4_DISPLAY_INT_CHAR_ENC', 'Internal Character Encoding: ');
define('EASYPOPULATE_4_DISPLAY_DB_COLL', 'DB Collation: ');
define('EASYPOPULATE_4_DISPLAY_DB_FLD_LGTH', 'Database Field Lengths');
define('EASYPOPULATE_4_DISPLAY_TITLE_UPLOAD', 'Upload EP File');
define('EASYPOPULATE_4_DISPLAY_MAX_UP_SIZE', 'Http Max Upload File Size: %1$d bytes (%2$d Mbytes)');
define('EASYPOPULATE_4_DISPLAY_UPLOAD_BUTTON_TEXT', 'Upload File');
define('EASYPOPULATE_4_DD_STATUS_DEFAULT', 'Status (active)');
define('EASYPOPULATE_4_DD_STATUS_ACTIVE', 'active');
define('EASYPOPULATE_4_DD_STATUS_INACTIVE', 'inactive');
define('EASYPOPULATE_4_DD_STATUS_ALL', 'all');
define('EASYPOPULATE_4_DD_DOWNLOAD_DEFAULT', 'Download Type');
define('EASYPOPULATE_4_DD_DOWNLOAD_COMPLETE', 'Complete Products');
define('EASYPOPULATE_4_DD_DOWNLOAD_QUANTITY', 'Model/Price/Qty');
define('EASYPOPULATE_4_DD_DOWNLOAD_BREAKS', 'Model/Price/Breaks');
define('EASYPOPULATE_4_DD_DOWNLOAD_COMPLETE_SINGLE', 'Complete Prod No Linked');
define('EASYPOPULATE_4_DD_FILTER_CATEGORIES', 'Categories');
define('EASYPOPULATE_4_DD_FILTER_EXPORT', 'Export');
define('EASYPOPULATE_4_ORDERS_DROPDOWN_EXPORT', 'Export');
define('EASYPOPULATE_4_DELIMITER_UNKNOWN', 'Unknown Delimiter');
define('EASYPOPULATE_4_DISPLAY_IMPORT_CSV_DELIMITER_ISSUES', 'Issues with the CSV file delimiter(s)');

define('EASYPOPULATE_4_DISPLAY_EXPORT_FILE_SPLIT', 'Split');
define('EASYPOPULATE_4_DISPLAY_EXPORT_FILE_IMPORT_SYNC', 'Import w/Sync');
define('EASYPOPULATE_4_DISPLAY_EXPORT_FILE_IMPORT', 'Import');
define('EASYPOPULATE_4_DISPLAY_EXPORT_FILE_DELETE', 'Delete file');
define('EASYPOPULATE_4_DISPLAY_EXPORT_FILE_DOWNLOAD', 'Download');
define('EASYPOPULATE_4_DISPLAY_EXPORT_FILE_NONE_SUPPORTED', '<b>No Supported Data Files</b>');
define('EASYPOPULATE_4_DISPLAY_EXPORT_FILE_ERROR_FOLDER_OPEN', '<b>Error Opening Upload Directory:</b>');

define('EASYPOPULATE_4_DISPLAY_EXPORT_TYPE_ERROR','error: no export type set - press backspace to return.');

define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_FILENAME', 'File Name');
define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_SIZE', 'Size');
define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_DATE_TIME', 'Date &amp; Time');
define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_TYPE', 'Type');
define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_SPLIT', 'Split');
define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_IMPORT', 'Import');
define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_DELETE', 'Delete');
define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_DOWNLOAD', 'Download');

define('EASYPOPULATE_4_DISPLAY_EXPORT_RESULTS_TITLE','<br><u><h3>Export Results</h3></u><br>');
define('EASYPOPULATE_4_DISPLAY_EXPORT_RESULTS_NUM_RECORDS','<br>Records Exported: %d<br>');
define('EASYPOPULATE_4_DISPLAY_EXPORT_RESULTS_MEM_USE','<br>Memory Usage: %d');
define('EASYPOPULATE_4_DISPLAY_EXPORT_RESULTS_MEM_PEAK','<br>Memory Peak: %d');
define('EASYPOPULATE_4_DISPLAY_EXPORT_RESULTS_EXEC_TIME','<br>Execution Time: %d seconds.');

define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_TITLE','<h3>Finished Processing Import File</h3>');
define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_NUM_RECORDS_UPDATE','<br/>Updated records: %d');
define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_NUM_RECORDS_IMPORT','<br/>New Imported records: %d');
define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_NUM_ERRORS','<br/>Errors Detected: %d');
define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_NUM_WARNINGS','<br/>Warnings Detected: %d');
define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_MEM_USE','<br/>Memory Usage: %d');
define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_MEM_PEAK','<br/>Memory Peak: %d');
define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_EXEC_TIME','<br/>Execution Time: %d seconds.');
define('EASYPOPULATE_4_DISPLAY_IMPORT_COMPLETE_ISSUES','File Import Completed with issues.');
define('EASYPOPULATE_4_DISPLAY_IMPORT_COMPLETE','File Import Completed.');

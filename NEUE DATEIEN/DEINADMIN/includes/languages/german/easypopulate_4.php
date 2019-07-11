<?php
/**
 * @package Easy Populate 4 for Zen Cart German (www.zen-cart-pro.at)
 * @copyright Copyright 2016-2018  mc12345678 and chadderuski
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0 
 * @version $Id: easypopulate_4.php 2018-03-28 16:19:14 webchills $
*/

// $display_output defines
// file uploads display - output via $display_output
define('EASYPOPULATE_4_DISPLAY_SPLIT_LOCATION','Sie können Ihre gesplitteten Dateien auch von Ihrem %s Verzeichnis hochladen<br />');
define('EASYPOPULATE_4_DISPLAY_HEADING','<br /><h3><u>Ergebnisse des Imports</u></h3><br />');
define('EASYPOPULATE_4_DISPLAY_UPLOADED_FILE_SPEC','<p class=smallText>Datei hochgeladen.<br />Temporärer Dateiname: %s<br /><b>User Dateiname: %s</b><br />Größe: %s<br />'); // open paragraph
define('EASYPOPULATE_4_DISPLAY_LOCAL_FILE_SPEC','<p class=smallText><b>Dateiname: %s</b><br />'); // open paragraph
// upload results display - output via $display_output
define('EASYPOPULATE_4_DISPLAY_RESULT_DELETED','<br /><font color="fuchsia"><b>GELÖSCHT! - Artikelnummer:</b> %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_DELETE_NOT_FOUND','<br /><font color="darkviolet"><b>NICHT GEFUNDEN! - Artikelnummer:</b> %s - kann nicht gelöscht werden...</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_CATEGORY_NOT_FOUND', '<br /><font color="red"><b>ÜBERSPRUNGEN! - Artikelnummer:</b> %s - Keine Kategorie zu diesem %s Artikel angegeben.</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_CATEGORY_NAME_LONG','<br /><font color="red"><b>ÜBERSPRUNGEN! - Artikelnummer:</b> %s - Kategoriename: "%s" überschreitet maximale Länge: %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_PRODUCTS_URL_LONG','<br /><font color="red"><b>WARNUNG! - Artikelnummer:</b> %s - URL: "%s" überschreitet maximale Länge: %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_MANUFACTURER_NAME_LONG','<br /><font color="red"><b>HERSTELLER ÜBERSPRUNGEN! - Hersteller:</b> %s - Herstellername überschreitet maximale Länge: %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_PRODUCTS_MODEL_LONG','<br /><font color="red"><b>ÜBERSPRUNGEN! - Artikelnummer: </b>%s - Artikelnummer überschreitet maximale Länge: %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_PRODUCTS_NAME_LONG','<br /><font color="red"><b>WARNUNG! - Artikelnummer: </b>%s - Artikelname: "%s" überschreitet maximale Länge: %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_NEW_PRODUCT', '<br /><font color="green"><b>NEUER ARTIKEL! - Artikelnummer:</b> %s</font> | ');
define('EASYPOPULATE_4_DISPLAY_RESULT_NEW_PRODUCT_FAIL', '<br /><font color="red"><b>NEUEN ARTIKEL HINZUFÜGEN FEHLGESCHLAGEN! - Artikelnummer:</b> %s - SQL error. Überprüfen Sie das Easy Populate Error Log im uploads Verzeichnis</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_UPDATE_PRODUCT', '<br /><font color="mediumblue"><b>AKTUALISIERT! - Artikelnummer:</b> %s</font> | ');
define('EASYPOPULATE_4_DISPLAY_RESULT_UPDATE_PRODUCT_FAIL', '<br /><font color="red"><b>AKTUALISIERUNG DES ARTIKELS FEHLGESCHLAGEN! - Artikelnummer:</b> %s - SQL error. Überprüfen Sie das Easy Populate Error Log im uploads Verzeichnis</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_NO_MODEL', '<br /><font color="red"><b>Keine Artikelnummer angegeben. Diese Zeile wurde nicht importiert</b></font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_UPLOAD_IMPORT', ' der Datei in die Datenbank oder schauen Sie unten auf dieser Seite für weitere Optionen.');
define('EASYPOPULATE_4_DISPLAY_RESULT_UPLOAD_COMPLETE','<br /><b>Datei erfolgreich hochgeladen</b>: %1$s %2$s');
define('EASYPOPULATE_4_DISPLAY_RESULT_UPLOAD_EMPTY','<br /><b>Der Upload Button wurde zwar gedrückt, aber es wurde keine Datei ausgewählt.  Clicken Sie erst auf Durchsuchen und wählen Sie eine Datei zum Hochladen aus.</b>');
define('EASYPOPULATE_4_DISPLAY_RESULT_UPLOAD_NO_CSV', ' file is not a CSV file. See below for options.');
define('EASYPOPULATE_4_DISPLAY_RESULT_ARTISTS_NAME_LONG','<br /><font color="red"><b>ÜBERSPRUNGEN! - Name des Künstlers:</b> %s - überschreitet maximale Länge: %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_RECORD_COMPANY_NAME_LONG','<br /><font color="red"><b>ÜBERSPRUNGEN! - Plattenfirma Name:</b> %s - überschreitet maximale Länge: %s</font>');
define('EASYPOPULATE_4_DISPLAY_RESULT_MUSIC_GENRE_NAME_LONG','<br /><font color="red"><b>ÜBERSPRUNGEN! - Music Genre Name:</b> %s - überschreitet maximale Länge: %s</font>');
// $messageStack defines
// checks - msg stack alerts - output via $messageStack
define('EASYPOPULATE_4_MSGSTACK_TEMP_FOLDER_MISSING','<b>Easy Populate "Uploads Ordner" fehlt!</b><br />Ihr uploads Ordner ist nicht vorhanden. In Ihrer Konfiguration haben Sie angegeben, dass Ihr upload Ordner <b>%s</b> heisst und sich in <b>%s</b> befindet.<br>');
define('EASYPOPULATE_4_MSGSTACK_TEMP_FOLDER_NOT_WRITABLE','<b>Easy Populate "Uploads Ordners" ist nicht beschreibbar!</b><br />In Ihren uploads Ordner kann nichts geschrieben werden. Die Schreibberechtigungen für <b>%s</b> müssen "777" oder "755" sein je nach Konfiguration Ihres Servers.<br>Korrigieren Sie die Schreibrechte für den Ordner bevor Sie fortfahren.<br>');
define('EASYPOPULATE_4_MSGSTACK_TEMP_FOLDER_PERMISSIONS_SUCCESS','Easy Populate hat die Schreibrechte für Ihren uploads Ordner erfolgreich aktualisiert! Sie können nun mit Easy Populate Dateien hochladen...');
define('EASYPOPULATE_4_MSGSTACK_TEMP_FOLDER_PERMISSIONS_SUCCESS_777','Easy Populate hat die Schreibrechte für Ihren uploads Ordenr erfolgreich aktualisiert, aber dieser Ordner ist nun öffentlich zugänglich. Bitte stellen Sie sicher, dass Sie in diesen Ordner eine index.html gelegt haben, um zu verhindern, dass man via Browser in diesem Ordner stöbern und Dateien herunterladen kann.');
define('EASYPOPULATE_4_MSGSTACK_MODELSIZE_DETECT_FAIL','Easy Populate kann die maximal zulässige Länge für das Feld Artikelnummer in der Tabelle products Ihrer Datenbank nicht ermitteln. Bitte stellen Sie sicher, dass die maximale Länge dieses Feldes den Zen-Cart Defaultwert von 32 Zeichen nicht überschreitet. Keiner Ihrer Artikel darf eine Artikelnummer haben, die mehr als 32 Zeichen hat!!!! Ignorieren dieser Warnung kann schwerwiegenede Konsequenzen für Ihre Daten haben.');
define('EASYPOPULATE_4_MSGSTACK_ERROR_SQL', 'Ein SQL Fehler ist aufgetreten. Bitte überprüfen Sie Ihre Datei auf Tabulatordaten innerhalb eines Feldes und entfernen Sie diese.');
define('EASYPOPULATE_4_MSGSTACK_DROSS_DELETE_FAIL', '<b>Löschen von Datenmüll fehlgeschlagen!</b> Bitte sehen Sie sich das Debug Logfile in Ihrem uploads Verzeichnis für weitere Informationen an.');
define('EASYPOPULATE_4_MSGSTACK_DROSS_DELETE_SUCCESS', 'Löschen von Datenmüll war erfolgreich!');
define('EASYPOPULATE_4_MSGSTACK_DROSS_DETECTED', '<b>%s teilweise gelöschte Artikel gefunden!</b> Delete this dross to prevent unwanted zencart behaviour by clicking <a href="%s">here.</a><br />You are seeing this because there are references in tables to a product that no longer exists, which is usually caused by an incomplete product deletion. This can cause Zen Cart to misbehave in certain circumstances.');
define('EASYPOPULATE_4_MSGSTACK_DATE_FORMAT_FAIL', '%s ist kein gültiges Datumsformat. Falls Sie irgendein Datum in einem anderen Format als raw hochladen (z.B. von Excel), dann stimmen Ihre Datumsangaben nicht. Bitte beheben Sie dies durch Ändern des Datumsformats in der Easy Populate Konfiguration.');
define('EASYPOPULATE_4_ORDERS_DROPDOWN_FIRST', 'Typ der Bestellung');
define('EASYPOPULATE_4_ORDERS_FULL', 'Alle Bestellungen komplett');
define('EASYPOPULATE_4_ORDERS_NEWFULL', 'Neue Bestellungen komplett');
define('EASYPOPULATE_4_ORDERS_NO_ATTRIBS', 'Bestellungen ohne Attribute');
define('EASYPOPULATE_4_ORDERS_ATTRIBS', 'Nur Attribute der Bestellungen');
define('EASYPOPULATE_4_ORDERS_DROPDOWN_TITLE', '<b>Filterbare Bestellexporte:</b><br/>');
// install - msg stack alerts - output via $messageStack
define('EASYPOPULATE_4_MSGSTACK_INSTALL_DELETE_SUCCESS','Überflüssige Datei <b>%s</b> wurde aus dem Verzeichnis <b>DEINADMIN%s</b> gelöscht.');
define('EASYPOPULATE_4_MSGSTACK_INSTALL_DELETE_FAIL','Easy Populate könnte die überflüssige Datei <b>%s</b> nicht aus Ihrem <b>DEINADMIN%s</b> Verzeichnis löschen. Bitte löschen Sie diese Datei manuell.');
define('EASYPOPULATE_4_MSGSTACK_INSTALL_CHMOD_FAIL','<b>Bitte führen Sie die Easy Populate Installation erneut aus, nachdem Sie das Problem mit Ihrem uploads Ordner behoben haben.</b>');
define('EASYPOPULATE_4_MSGSTACK_INSTALL_CHMOD_SUCCESS','<b>Installation der Konfigurationeinstellungen war erfolgreich!</b>');
define('EASYPOPULATE_4_MSGSTACK_INSTALL_KEYS_FAIL','<b>Easy Populate Konfigurationeinstellungen fehlen</b>  Bitte installieren Sie die Easy Populate Einstellungen, indem Sie auf %sInstall EP4%s klicken.');
// file handling - msg stack alerts - output via $messageStack
define('EASYPOPULATE_4_MSGSTACK_FILE_EXPORT_SUCCESS', 'Datei <b>%s.csv</b> erfolgreich exportiert! Die Datei steht in Ihrem /%s Verzeichnis zum Download zur Verfügung.');
// $specials_print defines
// results of specials in $specials_print
define('EASYPOPULATE_4_SPECIALS_HEADING', '<b><u>Sonderangebote Zusammenfassung</u></b><p class=smallText>'); // open paragraph
define('EASYPOPULATE_4_SPECIALS_PRICE_FAIL', '<font color="red"><b>ÜBERSPRUNGEN! - Artikelnummer:</b> %s - Sonderangebotspreis höher als der Normalpreis...</font><br />');
define('EASYPOPULATE_4_SPECIALS_NEW', '<font color="green"><b>NEU! - Artikelnummer:</b> %s</font> | %s | %s | <font color="green"><b>%s</b></font> |<br />');
define('EASYPOPULATE_4_SPECIALS_UPDATE', '<font color="mediumblue"><b>AKTUALISIERT! - Artikelnummer:</b> %s</font> | %s | %s | <font color="green"><b>%s</b></font> |<br />');
define('EASYPOPULATE_4_SPECIALS_DELETE', '<font color="fuchsia"><b>GELÖSCHT! - Artikelnummer:</b> %s</font> | %s |<br />');
define('EASYPOPULATE_4_SPECIALS_DELETE_FAIL', '<font color="darkviolet"><b>NICHT GEFUNDEN! - Artikelnummer:</b> %s - kann Sonderangebot nicht löschen...</font><br />');
define('EASYPOPULATE_4_SPECIALS_FOOTER', '</p>'); // close paragraph
define('EP_DESC_PLURAL', 'Sie');
define('EP_DESC_SING', 'Es');
define('FEATURED_EP_DESC','Prefix: %1$s. %2$s wird verarbeitet durch den Empfohlene Artikel Filter.');
define('PRICEQTY_EP_DESC','Prefix: %1$s. %2$s wird verarbeitet durch den Preis Menge Filter.');
define('PRICEBREAKS_EP_DESC','Prefix: %1$s. %2$s wird verarbeitet durch den Staffelpreis Filter.');
define('CATEGORY_EP_DESC','Prefix: %1$s. %2$s wird verarbeitet durch den Kategorie Filter.');
define('CATEGORYMETA_EP_DESC','Prefix: %1$s. %2$s wird verarbeitet durch den Kategorie Metatags Filter.');
define('ATTRIB_BASIC_EP','Prefix: %1$s. %2$s wird verarbeitet durch den Basic Attribut Filter.');
define('ATTRIB_DETAILED_EP_DESC','Prefix: %1$s. %2$s wird verarbeitet durch den Detaillierten Attribut Filter');
define('SBA_DETAILED_EP_DESC','Prefix: %1$s. %2$s wird verarbeitet durch den Detaillierten Stock by Attributes Filter.');
define('SBA_STOCK_EP_DESC','Prefix: %1$s. %2$s wird verarbeitet durch den Stock by Attributes Stock Modification Filter.');
define('ORDERS_EP_DESC', 'Prefix: %1$s. %2$s wird nicht für den Import verarbeitet.');
define('CATCHALL_EP_DESC', 'Dies enthält irgendeine andere Datei. %2$s wird verarbeitet wie ein Komplettfile.');
define('ORDERSEXPORT_LINK_SAVE1', 'ORDERSEXPORT_LINK_SAVE1');
define('ORDERSEXPORT_LINK_SAVE1B', 'ORDERSEXPORT_LINK_SAVE1B');
define('ORDERSEXPORT_LINK_SAVE2', 'ORDERSEXPORT_LINK_SAVE2');
define('ORDERSEXPORT_LINK_SAVE3', 'ORDERSEXPORT_LINK_SAVE3');
// error log defines - for ep_debug_log.txt
define('EASYPOPULATE_4_ERRORLOG_SQL_ERROR', 'MySQL FEHLER %s: %s\nBei der Ausführung von:\n%sn');
define('EASYPOPULATE_4_REMOVE_SETTINGS', 'Easy Populate deinstallieren');
define('EASYPOPULATE_4_CONFIG_SETTINGS', 'Konfigurationseinstellungen');
define('EASYPOPULATE_4_CONFIG_UPLOAD', 'Upload Verzeichnis: ');
define('EASYPOPULATE_4_UPDATE_SETTINGS', 'EP4 Datenbank aktualisieren');
define('EASYPOPULATE_4_DISPLAY_SPLIT_SHORT', 'Einträge splitten: ');
define('EASYPOPULATE_4_DISPLAY_EXEC_TIME', 'Ausführungszeit: ');
define('EASYPOPULATE_4_DISPLAY_ENABLE_META', 'Artikel Metatags aktivieren: ');
define('EASYPOPULATE_4_DISPLAY_ENABLE_MUSIC', 'Artikeltyp Musik aktivieren: ');
define('EASYPOPULATE_4_DISPLAY_CUSTOM_PRODUCT_FIELDS', 'Benutzerdefinierte Artikelfelder');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_SHORT_DESC', 'Artikel Kurzbeschreibung: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_UNIT_MEAS', 'Product Unit of Measure: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_UPC', 'UPC Code: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_GOOGLE_CAT', 'Google Produktkategorie: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_MSRP', 'Manufacturer\'s Suggested Retail Price: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_MAP', 'Manufacturer\'s Advertised Price: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_GP', 'Gruppenpreise pro Artikel Modul: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_EXCLUSIVE', 'Exclusive Products Modul: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_SBA', 'Stock By Attributes Modul: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_CEON', 'CEON URI Rewriter Modul: ');
define('EASYPOPULATE_4_DISPLAY_STATUS_PRODUCT_DPM', 'Dual Pricing Modul: ');
define('EASYPOPULATE_4_DISPLAY_USER_DEF_FIELDS', 'Benutzerdefinierte Felder: ');
define('EASYPOPULATE_4_DISPLAY_INSTALLED_LANG', 'Installierte Sprachen');
define('EASYPOPULATE_4_DISPLAY_INSTALLED_LANG_DEF', 'Default Sprache: ');
define('EASYPOPULATE_4_DISPLAY_INT_CHAR_ENC', 'Internal Character Encoding: ');
define('EASYPOPULATE_4_DISPLAY_DB_COLL', 'DB Collation: ');
define('EASYPOPULATE_4_DISPLAY_DB_FLD_LGTH', 'Datenbank Feldlängen');
define('EASYPOPULATE_4_DISPLAY_TITLE_UPLOAD', 'Upload EP Datei');
define('EASYPOPULATE_4_DISPLAY_MAX_UP_SIZE', 'Http Max Upload File Size: %1$d bytes (%2$d Mbytes)');
define('EASYPOPULATE_4_DISPLAY_UPLOAD_BUTTON_TEXT', 'Datei hochladen');
define('EASYPOPULATE_4_DD_STATUS_DEFAULT', 'Status');
define('EASYPOPULATE_4_DD_STATUS_ACTIVE', 'aktiv');
define('EASYPOPULATE_4_DD_STATUS_INACTIVE', 'inaktiv');
define('EASYPOPULATE_4_DD_STATUS_ALL', 'all');
define('EASYPOPULATE_4_DD_DOWNLOAD_DEFAULT', 'Download Typ');
define('EASYPOPULATE_4_DD_DOWNLOAD_COMPLETE', 'Alle Artikel');
define('EASYPOPULATE_4_DD_DOWNLOAD_QUANTITY', 'Artikelnummer/Preis/Menge');
define('EASYPOPULATE_4_DD_DOWNLOAD_BREAKS', 'Artikelnummer/Preis/Staffelpreise');
define('EASYPOPULATE_4_DD_DOWNLOAD_COMPLETE_SINGLE', 'Alle Artikel ohne verlinkte');
define('EASYPOPULATE_4_DD_FILTER_CATEGORIES', 'Kategorien');
define('EASYPOPULATE_4_DD_FILTER_EXPORT', 'Export');

define('EASYPOPULATE_4_ORDERS_DROPDOWN_EXPORT', 'Export');

define('EASYPOPULATE_4_DELIMITER_UNKNOWN', 'Unbekanntes Trennzeichen');
define('EASYPOPULATE_4_DISPLAY_IMPORT_CSV_DELIMITER_ISSUES', 'Probleme mit den Trennzeichen in der CSV Datei');
define('EASYPOPULATE_4_DISPLAY_EXPORT_FILE_SPLIT', 'Splitten');
define('EASYPOPULATE_4_DISPLAY_EXPORT_FILE_IMPORT_SYNC', 'Import w/Sync');
define('EASYPOPULATE_4_DISPLAY_EXPORT_FILE_IMPORT', 'Import');
define('EASYPOPULATE_4_DISPLAY_EXPORT_FILE_DELETE', 'Datei löschen');
define('EASYPOPULATE_4_DISPLAY_EXPORT_FILE_DOWNLOAD', 'Download');
define('EASYPOPULATE_4_DISPLAY_EXPORT_FILE_NONE_SUPPORTED', '<b>keine unterstützten Dateien vorhanden</b>');
define('EASYPOPULATE_4_DISPLAY_EXPORT_FILE_ERROR_FOLDER_OPEN', '<b>Fehler beim Öffnen des Upload Verzeichnisses:</b>');

define('EASYPOPULATE_4_DISPLAY_EXPORT_TYPE_ERROR','Fehler: Exporttyp nicht festgelegt - drücken Sie die Backspace Taste um zurückzukehren');

define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_FILENAME', 'Dateiname');
define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_SIZE', 'Größe');
define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_DATE_TIME', 'Datum &amp; Uhrzeit');
define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_TYPE', 'Typ');
define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_SPLIT', 'Splitten');
define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_IMPORT', 'Import');
define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_DELETE', 'Löschen');
define('EASYPOPULATE_4_DISPLAY_EXPORT_TABLE_TITLE_DOWNLOAD', 'Download');

define('EASYPOPULATE_4_DISPLAY_EXPORT_RESULTS_TITLE','<br><u><h3>Export Ergebnisse</h3></u><br>');
define('EASYPOPULATE_4_DISPLAY_EXPORT_RESULTS_NUM_RECORDS','<br>Exportierte Einträge: %d<br>');
define('EASYPOPULATE_4_DISPLAY_EXPORT_RESULTS_MEM_USE','<br>Memory Usage: %d');
define('EASYPOPULATE_4_DISPLAY_EXPORT_RESULTS_MEM_PEAK','<br>Memory Peak: %d');
define('EASYPOPULATE_4_DISPLAY_EXPORT_RESULTS_EXEC_TIME','<br>Execution Time: %d Sekunden.');

define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_TITLE','<h3>Importdatei verarbeitet</h3>');
define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_NUM_RECORDS_UPDATE','<br/>Aktualisierte Einträge: %d');
define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_NUM_RECORDS_IMPORT','<br/>Neue importierte Einträge: %d');
define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_NUM_ERRORS','<br/>Festgestellte Fehler: %d');
define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_NUM_WARNINGS','<br/>Festgestellte Warnungen: %d');
define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_MEM_USE','<br/>Memory Usage: %d');
define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_MEM_PEAK','<br/>Memory Peak: %d');
define('EASYPOPULATE_4_DISPLAY_IMPORT_RESULTS_EXEC_TIME','<br/>Execution Time: %d seconds.');
define('EASYPOPULATE_4_DISPLAY_IMPORT_COMPLETE_ISSUES','Datei Import mit Problemen abgeschlossen.');
define('EASYPOPULATE_4_DISPLAY_IMPORT_COMPLETE','Datei Import abgeschlossen.');

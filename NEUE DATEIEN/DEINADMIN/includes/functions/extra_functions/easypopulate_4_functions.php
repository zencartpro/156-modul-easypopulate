<?php
/**
 * @package Easy Populate 4 for Zen Cart German (www.zen-cart-pro.at)
 * @copyright Copyright 2016-2019  mc12345678 and chadderuski
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0 
 * @version $Id: easypopulate_4_functions.php for Zen Cart German 2019-07-12 17:15:14 webchills $
*/
  if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
  }

function ep_4_curly_quotes($curly_text) {
  $ep_curly_quotes = (int)EASYPOPULATE_4_CONFIG_CURLY_QUOTES;
  $ep_char_92 = (int)EASYPOPULATE_4_CONFIG_CHAR_92;
  if ($ep_curly_quotes == 1) { // standard characters
    $clean_text = str_replace(array("\xe2\x80\x98", "\xe2\x80\x99", "\xe2\x80\x9c", "\xe2\x80\x9d", "\xe2\x80\x93", "\xe2\x80\x94", "\xe2\x80\xa6"),
            array("'", "'", '"', '"', '-', '--', '...'), $curly_text);
  } elseif ($ep_curly_quotes == 2) { // html
    $clean_text = str_replace(array("\xe2\x80\x98", "\xe2\x80\x99", "\xe2\x80\x9c", "\xe2\x80\x9d", "\xe2\x80\x93", "\xe2\x80\x94", "\xe2\x80\xa6"),
      array("&lsquo;", "&rsquo;", '&ldquo;', '&rdquo;', '&ndash;', '&mdash;', '&hellip;'), $curly_text);
  } else { // do nothing
    $clean_text = $curly_text;
  }
  // deal with 0x92 ... a funky right-single-quote
  if ($ep_char_92 == 1) { // standard single quote
    $clean_text = str_replace("\x92", "'", $clean_text);
  } elseif ($ep_char_92 == 2) { // html right-single quote
    $clean_text = str_replace("\x92", "&rsquo;", $clean_text);
    //echo '<br>option 2 - html <br>';
  }

  unset($ep_curly_quotes);
  unset($ep_char_92);

  return $clean_text;
}

// function to return field length
// uses $tbl = table name, $fld = field name
function ep4_zen_field_length($tbl, $fld) {
    global $db;
  $project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
  $ep_uses_mysqli = ((PROJECT_VERSION_MAJOR > '1' || PROJECT_VERSION_MINOR >= '5.3') ? true : false);

  $meta = array();
  $result = ($ep_uses_mysqli ? mysqli_query($db->link, "SELECT $fld FROM $tbl") : mysql_query("SELECT $fld FROM $tbl"));
  if (!$result) {
      echo 'Could not run query: ' . ($ep_uses_mysqli ? mysqli_error($db->link) : mysql_error());
      unset($project);
      unset($ep_uses_mysqli);
      unset($meta);
      unset($result);

      exit;
  }
  $length = ($ep_uses_mysqli ? mysqli_fetch_field_direct($result, 0)->length : mysql_field_len($result, 0));
  unset($project);
  unset($ep_uses_mysqli);
  unset($meta);
  unset($result);

  return $length;
}

function ep_4_get_languages() {
    $ep_languages_array = array();
    $project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
  $ep_uses_mysqli = ((PROJECT_VERSION_MAJOR > '1' || PROJECT_VERSION_MINOR >= '5.3') ? true : false);
  $langcode = array();
  $languages_query = ep_4_query("SELECT languages_id, name, code FROM ".TABLE_LANGUAGES." ORDER BY sort_order");
  $i = 1;

  while ($ep_languages = ($ep_uses_mysqli ? mysqli_fetch_array($languages_query): mysql_fetch_array($languages_query))) {
    $ep_languages_array[$i++] = array(
      'id' => $ep_languages['languages_id'],
      'name' => $ep_languages['name'],
      'code' => $ep_languages['code']
      );
  }
  unset($project);
  unset($ep_uses_mysqli);
  unset($langcode);
  unset($languages_query);
  unset($i);
  unset($ep_languages);

  return $ep_languages_array;
}

function ep_4_SBA1Exists () {
  $project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
  $ep_uses_mysqli = ((PROJECT_VERSION_MAJOR > '1' || PROJECT_VERSION_MINOR >= '5.3') ? true : false);
  // The current thought is to have one of these Exists files for each version of SBA to consider; however, they also all could fall under one SBA_Exists check provided some return is made and a comparison done on the other end about what was returned.
  //Check to see if any version of Stock with attributes is installed (If so, and properly programmed, there should be a define for the table associated with the stock.  There may be more than one, and if so, they should all be verified for the particular SBA.
  if (defined('TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK')) {
    $tablePresent = ep_4_query('SELECT *
          FROM information_schema.tables
          WHERE table_schema = \'' . DB_DATABASE . '\'
          AND table_name = \'' . TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK . '\'
          LIMIT 1;');
    // Check if database table is present in the database before attempting to access it.  If not present, then no need to
    //  continue processing.
    if ($tablePresent == false) {
      unset($project);
      unset($ep_uses_mysqli);
      unset($tablePresent);
      return false;
    }
    //Now that have identified that the table (applicable to mc12345678's store, has been identified as in existence, now need to look at the setup of the table (Number of columns and if each column identified below is in the table, or conversely if the table's column matches the list below.
    //Columns in table: stock_id, products_id, stock_attributes, quantity, and sort.
    $colsarray = ep_4_query('SHOW COLUMNS FROM ' . TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK);
//    echo 'After execute<br />';
    $numCols = ($ep_uses_mysqli ? mysqli_num_rows($colsarray) : mysql_num_rows($colsarray));
    if ($numCols == 5) {
      while ($row = ($ep_uses_mysqli ? mysqli_fetch_array($colsarray) : mysql_fetch_array($colsarray))){
        switch ($row['Field']) {
          case 'stock_id':
            break;
          case 'products_id':
            break;
          case 'stock_attributes':
            break;
          case 'quantity':
            break;
          case 'sort':
            break;
          default:
            unset($project);
            unset($ep_uses_mysqli);
            unset($tablePresent);
            unset($colsarray);
            unset($numCols);
            unset($row);
            return false;
            break;

        }
      }
      unset($project);
      unset($ep_uses_mysqli);
      unset($tablePresent);
      unset($colsarray);
      unset($numCols);
      unset($row);
      return '1';
    } elseif ($numCols >= 6) {
      $desired = 0;
//      $addToList = array();
      while ($row = ($ep_uses_mysqli ? mysqli_fetch_array($colsarray) : mysql_fetch_array($colsarray))){
        switch ($row['Field']) {
          case 'stock_id':
            $desired++;
            break;
          case 'products_id':
            $desired++;
            break;
          case 'stock_attributes':
            $desired++;
            break;
          case 'quantity':
            $desired++;
            break;
          case 'sort':
            $desired++;
            break;
          case 'customid';
            $desired++;
            break;
          default:
//            $addToList = $row['Field'];
            break;
        }
      }
      unset($project);
      unset($ep_uses_mysqli);
      unset($tablePresent);
      unset($colsarray);
      unset($numCols);
      unset($row);
      if ($desired >= 6) {
        unset($desired);
        return '2';
      } else {
        unset($desired);
        return false;
      }
    } else {
      unset($project);
      unset($ep_uses_mysqli);
      unset($tablePresent);
      unset($colsarray);
      unset($numCols);
      unset($row);
      return false;
    }
  } else {
    unset($project);
    unset($ep_uses_mysqli);

    return false;
  }
}

function ep_4_CEONURIExists () {
  $project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
  $ep_uses_mysqli = ((PROJECT_VERSION_MAJOR > '1' || PROJECT_VERSION_MINOR >= '5.3') ? true : false);
  // The current thought is to have one of these Exists files for each version of SBA to consider; however, they also all could fall under one SBA_Exists check provided some return is made and a comparison done on the other end about what was returned.
  //Check to see if any version of Stock with attributes is installed (If so, and properly programmed, there should be a define for the table associated with the stock.  There may be more than one, and if so, they should all be verified for the particular SBA.
  if (defined('TABLE_CEON_URI_MAPPINGS')) {
    //Now that have identified that the table (applicable to mc12345678's store, has been identified as in existence, now need to look at the setup of the table (Number of columns and if each column identified below is in the table, or conversely if the table's column matches the list below.
    //Columns in table: stock_id, products_id, stock_attributes, quantity, and sort.
    $colsarray = ep_4_query('SHOW COLUMNS FROM ' . TABLE_CEON_URI_MAPPINGS);
//    echo 'After execute<br />';
    $numCols = ($ep_uses_mysqli ? ($colsarray === false ? 0 : mysqli_num_rows($colsarray)) : mysql_num_rows($colsarray));
    if ($numCols == 9) {
      while ($row = ($ep_uses_mysqli ? mysqli_fetch_array($colsarray) : mysql_fetch_array($colsarray))){
        switch ($row['Field']) {
          case 'uri':
            break;
          case 'language_id':
            break;
          case 'current_uri':
            break;
          case 'main_page':
            break;
          case 'query_string_parameters':
            break;
          case 'associated_db_id':
            break;
          case 'alternate_uri':
            break;
          case 'redirection_type_code':
            break;
          case 'date_added':
            break;
          default:
            unset($project);
            unset($ep_uses_mysqli);
            unset($colsarray);
            unset($numCols);
            unset($row);
            return false;
            break;

        }
      }

      unset($project);
      unset($ep_uses_mysqli);
      unset($colsarray);
      unset($numCols);
      unset($row);
      if (file_exists(DIR_FS_CATALOG . DIR_WS_CLASSES . 'class.CeonURIMappingAdmin.php') ) {
        return true;
      } else {
        return false;
      }
    } else {
      unset($project);
      unset($ep_uses_mysqli);
      unset($colsarray);
      unset($numCols);
      return false;
    }
  } else {
    unset($project);
    unset($ep_uses_mysqli);
    return false;
  }
}

if (!function_exists('zen_get_sub_categories')) {
  function zen_get_sub_categories(&$categories, $categories_id) {
    global $db;
    $project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
    $ep_uses_mysqli = ((PROJECT_VERSION_MAJOR > '1' || PROJECT_VERSION_MINOR >= '5.3') ? true : false);
    $sub_categories_query = ($ep_uses_mysqli ? mysqli_query($db->link, "SELECT categories_id FROM ".TABLE_CATEGORIES.
      " WHERE parent_id = '".(int)$categories_id."'") : mysql_query("SELECT categories_id FROM ".TABLE_CATEGORIES.
      " WHERE parent_id = '".(int)$categories_id."'"));
    while ($sub_categories = ($ep_uses_mysqli ? mysqli_fetch_array($sub_categories_query) : mysql_fetch_array($sub_categories_query))) {
      if ($sub_categories['categories_id'] == 0) return true;
      $categories[count($categories)] = $sub_categories['categories_id'];
      if ($sub_categories['categories_id'] != $categories_id) {
        zen_get_sub_categories($categories, $sub_categories['categories_id']);
      }
    }
    unset($project);
    unset($ep_uses_mysqli);
    unset($sub_categories_query);
    unset($sub_categories);
  }
}

if (!function_exists('plugin_version_check_for_updates')) {
/**
 * plugin_support.php
 *
 * @package functions
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Modified in v1.5.5 $
 */
/**
 * Functions to support plugin usage
 */
    /**
     * Check for updated version of a plugin
     * Arguments:
     *   $plugin_file_id = the fileid number for the plugin as hosted on the zen-cart.com plugins library
     *   $version_string_to_compare = the version that I have now on my own server (will be checked against the one on the ZC server)
     * If the "version string" passed to this function evaluates (see strcmp) to a value less-then-or-equal-to the one on the ZC server, FALSE will be returned.
     * If the "version string" on the ZC server is greater than the version string passed to this function, this function will return an array with up-to-date information. The [link] value is the plugin page at zen-cart.com
     * If no plugin_file_id is passed, or if no result is found, then FALSE will be returned.
     *
     * USAGE:
     *   if (IS_ADMIN_FLAG) {
     *     $new_version_details = plugin_version_check_for_updates(999999999, 'some_string');
     *     if ($new_version_details !== FALSE) {
     *       $message = '<span class="alert">' . ' - NOTE: A NEW VERSION OF THIS PLUGIN IS AVAILABLE. <a href="' . $new_version_details['link'] . '" target="_blank">[Details]</a>' . '</span>';
     *     }
     *   }
     *
     * @param int    $plugin_file_id
     * @param string $version_string_to_compare
     *
     * @return bool|mixed
     */
  function plugin_version_check_for_updates($plugin_file_id = 0, $version_string_to_compare = '')
  {
    if ($plugin_file_id == 0) return FALSE;
    $new_version_available = FALSE;
    $lookup_index = 0;
    $url = 'https://www.zen-cart.com/downloads.php?do=versioncheck' . '&id='.(int)$plugin_file_id;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Plugin Version Check [' . (int)$plugin_file_id . '] ' . HTTP_SERVER);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $error = curl_error($ch);
    if ($error > 0) {
      curl_setopt($ch, CURLOPT_URL, str_replace('tps:', 'tp:', $url));
      $response = curl_exec($ch);
      $error = curl_error($ch);
    }
    curl_close($ch);
    if ($error > 0 || $response == '') {
      $response = file_get_contents($url);
    }
    if ($response === false) {
      $response = file_get_contents(str_replace('tps:', 'tp:', $url));
    }
    if ($response === false) return false;
    $data = json_decode($response, true);
    if (!$data || !is_array($data)) return false;
    // compare versions
    if (strcmp($data[$lookup_index]['latest_plugin_version'], $version_string_to_compare) > 0) $new_version_available = TRUE;
    // check whether present ZC version is compatible with the latest available plugin version
    if (!in_array('v'. PROJECT_VERSION_MAJOR . '.' . PROJECT_VERSION_MINOR, $data[$lookup_index]['zcversions'])) $new_version_available = FALSE;
    return ($new_version_available) ? $data[$lookup_index] : FALSE;
  }

}

function ep_4_get_uploaded_file($filename) {
  if (isset($_FILES[$filename])) {
    //global $_FILES;
    $uploaded_file = array('name' => $_FILES[$filename]['name'],
    'type' => $_FILES[$filename]['type'],
    'size' => $_FILES[$filename]['size'],
    'tmp_name' => $_FILES[$filename]['tmp_name']);
  } elseif (isset($_POST[$filename])) {
    $uploaded_file = array('name' => $_POST[$filename],
    );
  } elseif (isset($GLOBALS['HTTP_POST_FILES'][$filename])) {
    global $HTTP_POST_FILES;
    $uploaded_file = array('name' => $HTTP_POST_FILES[$filename]['name'],
    'type' => $HTTP_POST_FILES[$filename]['type'],
    'size' => $HTTP_POST_FILES[$filename]['size'],
    'tmp_name' => $HTTP_POST_FILES[$filename]['tmp_name']);
  } elseif (isset($GLOBALS['HTTP_POST_VARS'][$filename])) {
    global $HTTP_POST_VARS;
    $uploaded_file = array('name' => $HTTP_POST_VARS[$filename],
    );
  } else {
    $uploaded_file = array('name' => $GLOBALS[$filename . '_name'],
    'type' => $GLOBALS[$filename . '_type'],
    'size' => $GLOBALS[$filename . '_size'],
    'tmp_name' => $GLOBALS[$filename]);
  }
return $uploaded_file;
}

// the $filename parameter is an array with the following elements: name, type, size, tmp_name
function ep_4_copy_uploaded_file($filename, $target) {
  if (substr($target, -1) != '/') $target .= '/';
  $target .= $filename['name'];
  move_uploaded_file($filename['tmp_name'], $target);
}

function ep_4_get_tax_class_rate($tax_class_id) {
  global $db;
  $tax_multiplier = 0;
  $project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
  $ep_uses_mysqli = ((PROJECT_VERSION_MAJOR > '1' || PROJECT_VERSION_MINOR >= '5.3') ? true : false);

  $tax_query = ($ep_uses_mysqli ? mysqli_query($db->link, "SELECT SUM(tax_rate) AS tax_rate FROM ".TABLE_TAX_RATES.
    " WHERE tax_class_id = '".zen_db_input($tax_class_id)."' GROUP BY tax_priority") : mysql_query("SELECT SUM(tax_rate) AS tax_rate FROM ".TABLE_TAX_RATES.
    " WHERE tax_class_id = '".zen_db_input($tax_class_id)."' GROUP BY tax_priority"));
  if (($ep_uses_mysqli ? mysqli_num_rows($tax_query): mysql_num_rows($tax_query))) {
    while ($tax = ($ep_uses_mysqli ? mysqli_fetch_array($tax_query) : mysql_fetch_array($tax_query))) {
      $tax_multiplier += $tax['tax_rate'];
    }
  }
  unset($project);
  unset($ep_uses_mysqli);
  unset($tax_query);
  unset($tax);

  return $tax_multiplier;
}

function ep_4_get_tax_title_class_id($tax_class_title) {
  global $db;
  $project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
  $ep_uses_mysqli = ((PROJECT_VERSION_MAJOR > '1' || PROJECT_VERSION_MINOR >= '5.3') ? true : false);
  $classes_query = ($ep_uses_mysqli ? mysqli_query($db->link, "SELECT tax_class_id FROM ".TABLE_TAX_CLASS.
    " WHERE tax_class_title = '".zen_db_input($tax_class_title)."'") : mysql_query("SELECT tax_class_id FROM ".TABLE_TAX_CLASS.
    " WHERE tax_class_title = '".zen_db_input($tax_class_title)."'"));
  $tax_class_array = ($ep_uses_mysqli ? mysqli_fetch_array($classes_query) : mysql_fetch_array($classes_query));
  $tax_class_id = $tax_class_array['tax_class_id'];

  unset($project);
  unset($ep_uses_mysqli);
  unset($classes_query);
  unset($tax_class_array);

  return $tax_class_id;
}

function print_el_4($item2) {
  $output_display = substr(strip_tags($item2), 0, 10)." | ";
  return $output_display;
}

function print_el1_4($item2) {
  $output_display = sprintf("| %'.4s ", substr(strip_tags($item2), 0, 80));
  return $output_display;
}

// this function needs further review
function smart_tags_4($string,$tags,$crsub,$doit) {
  if ($doit == true) {
    foreach ($tags as $tag => $new) {
      $tag = '/('.$tag.')/';
      $string = preg_replace($tag,$new,$string);
    }
    unset($tag);
    unset($new);
  }
  // we remove problem characters here anyway as they are not wanted..
  $string = preg_replace("/(\r\n|\n|\r)/", "", $string);
  // $crsub is redundant - may add it again later though..
  return $string;
}

function ep_4_check_table_column($table_name,$column_name) {
  $project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
  $ep_uses_mysqli = ((PROJECT_VERSION_MAJOR > '1' || PROJECT_VERSION_MINOR >= '5.3') ? true : false);
  $sql = "SHOW COLUMNS FROM ".$table_name;
  $result = ep_4_query($sql);
  while ($row = ($ep_uses_mysqli ? mysqli_fetch_array($result) : mysql_fetch_array($result))) {
    $column = $row['Field'];
    if ($column == $column_name) {
      unset($project);
      unset($ep_uses_mysqli);
      unset($sql);
      unset($result);
      unset($column);
      unset($row);

      return true;
    }
  }

  unset($project);
  unset($ep_uses_mysqli);
  unset($sql);
  unset($result);
  unset($column);
  unset($row);

  return false;
}

function ep_4_remove_product($product_model) {
  global $db, $ep_debug_logging, $ep_debug_logging_all, $ep_stack_sql_error;
  $project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
  $ep_uses_mysqli = ((PROJECT_VERSION_MAJOR > '1' || PROJECT_VERSION_MINOR >= '5.3') ? true : false);
  $sql = "SELECT products_id FROM ".TABLE_PRODUCTS;
  switch (EP4_DB_FILTER_KEY) {
    case 'products_model':
      $sql .= " WHERE products_model = :products_model:";
      $sql = $db->bindVars($sql, ':products_model:', $product_model, 'string');
      break;
    case 'blank_new':
    case 'products_id':
      $sql .= " WHERE products_id = :products_id:";
      $sql = $db->bindVars($sql, ':products_id:', $product_model, 'string');
      break;
    default:
      $sql .= " WHERE products_model = :products_model:";
      $sql = $db->bindVars($sql, ':products_model:', $product_model, 'string');
      break;
  }
  $products = $db->Execute($sql);
  if (($ep_uses_mysqli ? mysqli_errno($db->link) : mysql_errno())) {
    $ep_stack_sql_error = true;
    if ($ep_debug_logging == true) {
      $string = "MySQL error ".($ep_uses_mysqli ? mysqli_errno($db->link) : mysql_errno()).": ".($ep_uses_mysqli ? mysqli_error($db->link) : mysql_error())."\nWhen executing:\n$sql\n";
      write_debug_log_4($string);
    }
  } elseif ($ep_debug_logging_all == true) {
    $string = "MySQL PASSED\nWhen executing:\n$sql\n";
    write_debug_log_4($string);
  }
  while (!$products->EOF) {
    zen_remove_product($products->fields['products_id']);
    $products->MoveNext();
  }
  unset($project);
  unset($ep_uses_mysqli);
  unset($sql);
  unset($products);
  unset($string);
  return;
}

function ep_4_rmv_chars($filelayout, $active_row, $csv_delimiter = "^") {
//  $datarow = ep_4_rmv_chars($filelayout, $active_row, $csv_delimiter);
  $dataRow = '';

  $problem_chars = array("\r", "\n", "\t"); // carriage return, newline, tab
  foreach ($filelayout as $key => $value) {
//    $thetext = $active_row[$key];
    // remove carriage returns, newlines, and tabs - needs review
    $thetext = '';
    if (isset($active_row[$key]) || array_key_exists($key, $active_row)) {
      $thetext = str_replace($problem_chars, ' ', $active_row[$key]);
    }
    // encapsulate data in quotes, and escape embedded quotes in data
    $dataRow .= '"' . str_replace('"', '""', $thetext) . '"' . $csv_delimiter;
  }
  // Remove trailing tab, then append the end-of-line
  $dataRow = rtrim($dataRow, $csv_delimiter) . "\n";

  unset($problem_chars);
  unset($thetext);

  return $dataRow;
}


// DEPRECATED: no calls to this function!
// reset products master categories ID - I do not believe this works correctly - chadd
/*
function ep_4_update_cat_ids() {
  global $db;
  $sql = "SELECT products_id FROM ".TABLE_PRODUCTS;
  $check_products = $db->Execute($sql);
  while (!$check_products->EOF) {
    $sql = "SELECT products_id, categories_id FROM ".TABLE_PRODUCTS_TO_CATEGORIES.
      " WHERE products_id='".$check_products->fields['products_id']."'";
    $check_category = $db->Execute($sql);
    $sql = "UPDATE ".TABLE_PRODUCTS." SET master_categories_id='".$check_category->fields['categories_id'].
      "' WHERE products_id='".$check_products->fields['products_id']."'";
    $update_viewed = $db->Execute($sql);
    $check_products->MoveNext();
  }
}
*/

// DEPRECATED: no calls to this function!
// Better to run: zen_update_products_price_sorter($v_products_id);
// after each new or updated product
/*
function ep_4_update_prices() {
  global $db;
  $sql = "SELECT products_id FROM ".TABLE_PRODUCTS;
  $update_prices = $db->Execute($sql);
  while (!$update_prices->EOF) {
    zen_update_products_price_sorter($update_prices->fields['products_id']);
    $update_prices->MoveNext();
  }
}
*/

// DEPRECATED: no calls to this function
// I am writing all my own attribute processing code
/*function ep_4_update_attributes_sort_order() {
  global $db;
  $all_products_attributes = $db->Execute("select p.products_id, pa.products_attributes_id from ".
    TABLE_PRODUCTS." p, ".
    TABLE_PRODUCTS_ATTRIBUTES." pa "."
    where p.products_id = pa.products_id");
  while (!$all_products_attributes->EOF) {
    $count++;
    //$product_id_updated .= ' - ' . $all_products_attributes->fields['products_id'] . ':' . $all_products_attributes->fields['products_attributes_id'];
    zen_update_attributes_products_option_values_sort_order($all_products_attributes->fields['products_id']);
    $all_products_attributes->MoveNext();
  }
}*/

function write_debug_log_4($string) {
  global $ep_debug_log_path;
  $logFile = $ep_debug_log_path.'ep_debug_log.txt';
  $fp = fopen($logFile,'ab');
  fwrite($fp, $string);
  fclose($fp);
  unset($logFile);
  unset($fp);

  return;
}

function ep_4_query($query) {
  global $ep_debug_logging, $ep_debug_logging_all, $ep_stack_sql_error, $db;
  $project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
  $ep_uses_mysqli = ((PROJECT_VERSION_MAJOR > '1' || PROJECT_VERSION_MINOR >= '5.3') ? true : false);
  $result = ($ep_uses_mysqli ? mysqli_query($db->link, $query) : mysql_query($query));
  if (($ep_uses_mysqli ? mysqli_errno($db->link) : mysql_errno())) {
    $ep_stack_sql_error = true;
    if ($ep_debug_logging == true) {
      $string = ($ep_uses_mysqli ? "MySQLi" : "MySQL") . " error ".($ep_uses_mysqli ? mysqli_errno($db->link) : mysql_errno() ) . ": ".($ep_uses_mysqli ? mysqli_error($db->link) : mysql_error())."\nWhen executing:\n$query\n";
      write_debug_log_4($string);
    }
  } elseif ($ep_debug_logging_all == true) {
    $string = ($ep_uses_mysqli ? "MySQLi" : "MySQL") . " PASSED\nWhen executing:\n$query\n";
    write_debug_log_4($string);
  }
//  unset($project);
//  unset($ep_uses_mysqli);
  unset($string);

  return $result;
}

function install_easypopulate_4() {
  global $db, $zco_notifier, $curver_detail;
  $project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
  if (PROJECT_VERSION_MAJOR > '1' || PROJECT_VERSION_MINOR >= '5.0') {

        $group_check = $db->Execute("SELECT configuration_group_id FROM " . TABLE_CONFIGURATION_GROUP . " WHERE configuration_group_title = 'Easy Populate 4'");

        if (!$group_check->EOF && $group_check->RecordCount() > 0 && $group_check->fields['configuration_group_id'] > 0) {
            $group_id = $group_check->fields['configuration_group_id'];

        } else {
            $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_GROUP . " (configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('Easy Populate 4', 'Configuration Options for Easy Populate 4', '1', '1')");
            if (PROJECT_VERSION_MAJOR > '1' || PROJECT_VERSION_MINOR >= '5.3') {
                $group_id = mysqli_insert_id($db->link);
            } else {
                $group_id = mysql_insert_id();
            }
        $db->Execute("UPDATE ".TABLE_CONFIGURATION_GROUP." SET sort_order = ".$group_id." WHERE configuration_group_id = ".$group_id);

            zen_register_admin_page('easypopulate_4_config', 'BOX_TOOLS_EASYPOPULATE_4','FILENAME_CONFIGURATION', 'gID='.$group_id, 'configuration', 'Y', 97);
        }
   
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Uploads Directory',                  'EASYPOPULATE_4_CONFIG_TEMP_DIR', 'temp/', 'Name of directory for your uploads as compared to the setting of Uploads Directory Admin/Catalog.<br /><br />Default is to use YOUR_ADMIN/temp/ by entering temp/ below.<br /><b>Caution:</b> the admin directory folder name should not be entered here as it will be stored in the database.  If the admin directory is to be used please set/verify Uploads Directory Admin/Catalog is set to true.<br /><br />(default is to use the YOUR_ADMIN directory and the below value of: temp/).', ".$group_id.", '10', NULL, now(), 'ep4_directory_check', NULL)
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Uploads Directory Admin/Catalog',                  'EP4_ADMIN_TEMP_DIRECTORY', 'true', 'Should the admin directory be used to store the export and import files for EP4?<br /><br />This switch affects how Uploads Directory is used.<br /><br />true (default) or<br />false. ', ".$group_id.", '20', NULL, now(), 'ep4_directory_choice_check', 'zen_cfg_select_option(array(\"true\", \"false\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Import/Export Primary Key', 'EP4_DB_FILTER_KEY', 'products_model', 'Select the primary key that is to be used for import of the data.<br /><br />The default for Easy Populate v4 is products_model.<br /><br /> The field products_model is independent of the store, while products_id will require/generate the product information associated with that products_id and could lead to duplication of product. Choosing blank_new will import by products_id and create new products when the products_id is not entered/blank.<br /><br />products_model (default)<br />products_id<br />blank_new', ".$group_id.", '30', NULL, now(), NULL, 'zen_cfg_select_option(array(\'products_model\', \'products_id\', \'blank_new\'),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
        ('Import Language Override',       'EASYPOPULATE_4_CONFIG_IMPORT_OVERRIDE', 'language_code', 'On import, if all possible language identifiers for a field are given, which should be used for the final data? (E.g. products_name_en (language_code), products_name_1 (language_id) are given in the file, which should be used?)<br />Default: language_code', ".$group_id.", '32', NULL, now(), NULL, 'zen_cfg_select_option(array(\"language_id\", \"language_code\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
        ('Import/Export CSV Delimiter', 'EASYPOPULATE_4_CONFIG_CSV_DELIMITER', '0', 'When exporting and importing files, each field of a record is separated by some \"unique\" character.  This character is called the CSV delimiter and allows the program reading the file to understand where one field ends and another begins.  CSV stands for Comma Separated Value and therefore a comma is the default; however, there are conditions and times when an alternate delimiter is needed or desired.  Choose the delimiter used for the file(s) to be imported/exported.  (default: \",\")<br/><br/>1. \",\" - comma,<br/>2. \";\" - semicolon,<br/>3. \"\t\" - tab,<br/>4. \" \" - space', ".$group_id.", '35', NULL, now(), 'ep4_delimiter_display', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\',\'), array(\'id\'=>\'1\', \'text\'=>\';\'), array(\'id\'=>\'2\', \'text\'=>\'\t\'), array(\'id\'=>\'3\', \'text\'=>\' \')),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
        ('Export Language Identifier', 'EASYPOPULATE_4_CONFIG_LANGUAGE_EXPORT', 'id', 'Select the export suffix to fields that are language dependent.<br /><br />id: represents the numeric language_id assigned to the language.<br />code: represents the abbreviated language identifier such as en for English.<br />all: exports each language based field with all of the programmed suffixes to be included.<br />(default: id)<br />', ".$group_id.", '35', NULL, now(), NULL, 'zen_cfg_select_option(array(\'id\', \'code\', \'all\'),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Upload File Date Format',            'EASYPOPULATE_4_CONFIG_FILE_DATE_FORMAT', 'm-d-y', 'Choose order of date values that corresponds to your uploads file, usually generated by MS Excel. Raw dates in your uploads file (Eg 2005-09-26 09:00:00) are not affected, and will upload as they are.', ".$group_id.", '40', NULL, now(), NULL, 'zen_cfg_select_option(array(\"m-d-y\", \"d-m-y\", \"y-m-d\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Default Raw Time',                   'EASYPOPULATE_4_CONFIG_DEFAULT_RAW_TIME', '09:00:00', 'If no time value stipulated in upload file, use this value. Useful for ensuring specials begin after a specific time of the day (default: 09:00:00)', ".$group_id.", '50', NULL, now(), NULL, NULL)
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
        ('Export Filename Date', 'EASYPOPULATE_4_CONFIG_DATE_SORT', 'Y-m-d', 'When exporting files, a unique date identifier is added.  The default was year as four numbers, text abbreviated month, and two number day all together (Ybd).  To improve on sorting within a file group, an option is now available to export the four number year, two digit month, and two digit day so that files within a group will be in export date order.<br/><br/>The default is now Y-m-d.', ".$group_id.", '55', NULL, now(), NULL, 'zen_cfg_select_option(array(\"Y-m-d\", \"Ymd\", \"Ybd\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Upload/Download Prices Include Tax', 'EASYPOPULATE_4_CONFIG_PRICE_INC_TAX', 'false', 'Choose to include or exclude tax, depending on how you manage prices outside of Zen Cart.', ".$group_id.", '60', NULL, now(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Verbose Feedback',                   'EASYPOPULATE_4_CONFIG_VERBOSE', 'true', 'When importing, report all messages. Set to false for only warnings and errors. (default: true).', ".$group_id.", '70', NULL, now(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Show all EP4 Filetypes with Files',       'EP4_SHOW_ALL_FILETYPES', 'true', 'When looking at the EP4 Tools screen, should the filename prefix for all specific file types be displayed for all possible file types (true [default]), should only the method(s) that will be used to process the files present be displayed (false), or should there be no assistance be provided on filenaming on the main page (Hidden) like it was until this feature was added? (true, false, or Hidden)', ".$group_id.", '80', NULL, now(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\", \"Hidden\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
            ('Replace Blank Image', 'EP4_REPLACE_BLANK_IMAGE', 'false', 'On import, if the image information is blank, then update the image path to the path of the blank image (true)? Otherwise the image path will remain blank (false <Default>).<br /><br />false (Default)<br />true.', ".$group_id.", '90', NULL, now(), NULL, 'zen_cfg_select_option(array(\'false\', \'true\'),')
    ");
    $db->Execute("UPDATE IGNORE " . TABLE_CONFIGURATION . " SET set_function = 'zen_cfg_select_option(array(\'false\', \'true\'),' WHERE configuration_key = 'EP4_ACTIVATE_BLANK_FEATURED' 
    ");
    $db->Execute("INSERT IGNORE INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
            ('Activate Blank Featured', 'EP4_ACTIVATE_BLANK_FEATURED', 'true', 'On import, if the available date and expiry date are both blank, 0, 0001-01-01, or not imported, should the featured product be made automatically active?<br/> (yes=true or no=false)<br/>(Default: yes)', ".$group_id.", '95', NULL, now(), NULL, 'zen_cfg_select_option(array(\'false\', \'true\'),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
            ('Remove Blank Specials', 'EASYPOPULATE_4_CONFIG_SPECIALS_REMOVE_AT', 'negative', 'On import, what price level should be used to clear the special from the database.<br /><br /><b>New Default</b>: negative - a negative price entered for the special will delete the special on import.<br />zero: a negative or zero price entered for the special will delete the special on import.<br />', ".$group_id.", '97', NULL, now(), NULL, 'zen_cfg_select_option(array(\'negative\', \'zero\'),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Make Zero Qty Products Inactive',    'EASYPOPULATE_4_CONFIG_ZERO_QTY_INACTIVE', 'false', 'When uploading, make the status Inactive for products with zero qty (default: false).', ".$group_id.", '100', NULL, now(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Smart Tags Replacement of Newlines', 'EASYPOPULATE_4_CONFIG_SMART_TAGS', 'true', 'Allows your description fields in your uploads file to have carriage returns and/or new-lines converted to HTML line-breaks on uploading, thus preserving some rudimentary formatting - Note: this legacy code is disabled until further review. (default: true).', ".$group_id.", '110', NULL, now(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Advanced Smart Tags',                'EASYPOPULATE_4_CONFIG_ADV_SMART_TAGS', 'false', 'Allow the use of complex regular expressions to format descriptions, making headings bold, add bullets, etc. Note: legacy code is disabled until further review. (default: false).', ".$group_id.", '120', NULL, now(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Debug Logging',                      'EASYPOPULATE_4_CONFIG_DEBUG_LOGGING', 'true', 'Allow Easy Populate to generate an error log on errors only (default: true)', ".$group_id.", '130', NULL, now(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Maximum Quantity Discounts',         'EASYPOPULATE_4_CONFIG_MAX_QTY_DISCOUNTS', '3', 'Maximum number of quantity discounts (price breaks). Is the number of discount columns in downloaded file (default: 3).', ".$group_id.", '140', NULL, now(), NULL, NULL)
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Split On Number of Records',         'EASYPOPULATE_4_CONFIG_SPLIT_RECORDS', '2000', 'Number of records to split csv files. Used to break large import files into smaller files. Useful on servers with limited resourses. (default: 2000).', ".$group_id.", '150', NULL, now(), NULL, NULL)
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Script Execution Time',              'EASYPOPULATE_4_CONFIG_EXECUTION_TIME', '60', 'Number of seconds for script to run before timeout. May not work on some servers. (default: 60).', ".$group_id.", '160', NULL, now(), NULL, NULL)
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Convert Curly Quotes, etc.',         'EASYPOPULATE_4_CONFIG_CURLY_QUOTES', '0', 'Convert Curly Quotes, Em-Dash, En-Dash and Ellipsis characters in fields displayed to customer (default 0).<br><br>0=No Change<br>1=Replace with Basic Characters<br>2=Replace with HTML equivalents', ".$group_id.", '170', NULL, now(), NULL, 'zen_cfg_select_option(array(\"0\", \"1\", \"2\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Convert Character 0x92',             'EASYPOPULATE_4_CONFIG_CHAR_92', '1', 'Convert Character 0x92 characters in Product Names &amp; Descriptions (default 1).<br><br>0=No Change<br>1=Replace with Standard Single Quote<br>2=Replace with HMTL equivalant', ".$group_id.", '180', NULL, now(), NULL, 'zen_cfg_select_option(array(\"0\", \"1\", \"2\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Enable Products Meta Data',          'EASYPOPULATE_4_CONFIG_META_DATA', '1', 'Enable Products Meta Data Columns (default 1).<br><br>0=Disable<br>1=Enable', ".$group_id.", '190', NULL, now(), NULL, 'zen_cfg_select_option(array(\"0\", \"1\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Enable Products Music Data',         'EASYPOPULATE_4_CONFIG_MUSIC_DATA', '0', 'Enable Products Music Data Columns (default 0).<br><br>0=Disable<br>1=Enable', ".$group_id.", '200', NULL, now(), NULL, 'zen_cfg_select_option(array(\"0\", \"1\"),')
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('User Defined Products Fields',       'EASYPOPULATE_4_CONFIG_CUSTOM_FIELDS', '', 'User Defined Products Table Fields (comma delimited, no spaces)', ".$group_id.", '210', NULL, now(), NULL, NULL)
    ");
    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('Export URI with Prod and or Cat',       'EASYPOPULATE_4_CONFIG_EXPORT_URI', '0', 'Export the current products or categories URI when exporting data? (Yes - 1 or no - 0)', ".$group_id.", '220', NULL, now(), NULL, 'zen_cfg_select_option(array(\"0\", \"1\"),')
    ");


    $db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
      ('EP4-version', 'TOOLS_EASYPOPULATE_4_VERSION', '" . $curver_detail . "', 'This is the version of EP4 installed.', 6, '70', NULL, now(), NULL, 'zen_cfg_select_option(array(\'" . $curver_detail . "\'),')
      ON DUPLICATE KEY
       UPDATE configuration_value = '" . $curver_detail . "', set_function = 'zen_cfg_select_option(array(\'" . $curver_detail . "\'),'
    ");

// create/update German configuration_values
$db->Execute("REPLACE INTO ".TABLE_CONFIGURATION_LANGUAGE." (configuration_title, configuration_key, configuration_language_id, configuration_description) VALUES
		('Uploads Ordner', 'EASYPOPULATE_4_CONFIG_TEMP_DIR', '43', 'Name Ihrer Verzeichnisses für die Uploads<br/>(Voreinstellung: temp/).<br/>Dieser Ordner muss sich im Shopverzeichnis befinden und beschreibbar sein!'),
			('Uploads Ordner Admin oder Frontend', 'EP4_ADMIN_TEMP_DIRECTORY', '43', 'Soll der Upload Ordner im Admin Verzeichnis oder im Frontend genutzt werden?<br/>(Voreinstellung: true)<br/>Es wird empfohlen dass auf true zu lassen und das Verzeichnis DEINADMIN/temp zu verwenden.'),
			('Hauptschlüssel für Import/Export', 'EP4_DB_FILTER_KEY', '43', 'Welcher Primärschlüssel soll für Import und Exporte verwendet werden?<br/>(Voreinstellung: products_model).<br/>Empfohlen wird, die Artikelnummer zu verwenden, also products_model eingestellt lassen. Die Artikelnummer ist vom Shop unabhängig, die products_id nicht. Daher würde die Auswahl von products_id zu doppelten Einträgen führen und wäre nur sinnvoll, wenn Sie dazu gute Gründe haben. Wird hier auf blank_new gestellt, dann wird nach products_id importiert und falls keine products_id hinterlegt ist, wird ein neuer Artikel angelegt.'),
			('Trennzeichen in der csv Datei','EASYPOPULATE_4_CONFIG_CSV_DELIMITER', '43', 'Beim Export oder Import von csv Dateien sind Datensätze immer mit einem eindeutigen Trennzeichen getrennt.  Dieses CSV Trennzeichen kennzeichnet wo ein Feld aufhört und ein anderes beginnt.  CSV steht für Comma Separated Value, daher ist ein Komma das übliche Default-Zeichen. Es sind aber auch andere Trennzeichen möglich.  Stellen Sie hier ein, welches Trennzeichen in Ihren Export/Import Dateien verwendet wird.  (Voreinstellung: \",\")<br/><br/>1. \",\" - Komma,<br/>2. \";\" - Semikolon,<br/>3. \"\t\" - Tab,<br/>4. \" \" - Leerzeichen'),
			('Suffix für Sprachkennung', 'EASYPOPULATE_4_CONFIG_LANGUAGE_EXPORT', '43', 'Wählen Sie das Export Suffix für Felder, die sprachabhängig sind.<br /><br />id: bedeutet die numerische language_id, die dieser Sprache zugeordnet ist. z.B. deutsch = 43, englisch = 1<br />code: bedeutet das Sprachkürzel, z.B. en für Englisch, de für Deutsch<br />all: bedeutet dass alle sprachbasierten Felder mit allen eingestellten Suffixen exportiert werden.<br />(Voreinstellung: id)<br />'),
			('Datumsformat für die Upload Datei','EASYPOPULATE_4_CONFIG_FILE_DATE_FORMAT', '43', 'Wählen Sie das Datumsformat, das Ihrer Upload Datei entspricht. Es wird normalerweise von Excel erzeugt. Rohdaten in Ihrer Upload Datei, z.B. 2012-07-23 09:00:00 sind hiervon nicht betroffen und werden genauso hochgeladen wie sie sind'),
			('Default Rohwert für Zeit', 'EASYPOPULATE_4_CONFIG_DEFAULT_RAW_TIME', '43', 'Falls in der Upload Datei keine Zeit angegeben ist, wird die hier hinterlegte Zeit verwendet. Das ist nützlich, wenn z.B. sichergestellt werden soll, dass Sonderangebote nach einer bestimmten Uhrzeit beginnen sollen.<br/>(Voreinstellung: 09:00:00)'),
			('Upload/Download Preise inklusive Steuer?', 'EASYPOPULATE_4_CONFIG_PRICE_INC_TAX', '43', 'Stellen Sie heir ein, ob die Preise inclusive oder exclusive Steuer angegeben sind, je nachdem wie Sie die Preise außerhalb von Zen-Cart hinterlegt haben.'),
			('Datumsformat im Dateinamen der Exportdatei','EASYPOPULATE_4_CONFIG_DATE_SORT', '43', 'Beim Export wird der Exportdatei ein eindeutiges Datum an den Dateinamen angehängt. In bisherigen Versionen war das lediglich das Jahr in vier Stellen, der abgekürzte Monat und der zweistellige Tag (Ybd).  Um die Sortiermöglichkeit zu verbessern ist das Format nun auch  als vierstelliges Jahr, zweistelliger Monat, und zweistelliger Tag (Y-m-d) möglich.<br/><br/>Voreinstellung Y-m-d.'),
			('Ausführliche Rückmeldungen beim Import','EASYPOPULATE_4_CONFIG_VERBOSE', '43', 'Sollen beim Import alle Rückmeldungen ausgegeben werden? Nützlich zur Kontrolle. Um nur Warnungen und Fehler auszugeben auf false stellen.<br/>(Voreinstellung: true)'),
			('Easy Populate Dateitypen anzeigen?', 'EP4_SHOW_ALL_FILETYPES', '43', 'Sollen im Easy Populate Tools Bildschirm die Präfixe für alle möglichen Dateitypen angezeigt werden?<br/>(Voreinstellung: true).<br/>'),
			('Platzhalter für leeres Bild setzen?', 'EP4_REPLACE_BLANK_IMAGE', '43', 'Wenn beim Artikel in der Importdatei kein Artikelbild angegeben ist, soll dann als Artikelbild der Platzhalter für Bild nicht verfügbar gesetzt werden (true) oder soll der Eintrag in der Datenbank für das Bild leer bleiben (false)<br/>(Voreinstellung: false).<br/>'),
			('Empfohlene Artikel anhand von Leerdatum aktivieren?', 'EP4_ACTIVATE_BLANK_FEATURED', '43', 'Wenn beim Import sowohl das Erstellungsdatum als auch das Ablaufdatum leer, 0, 0001-01-01 oder gar nicht erst importiert sind. Soll dann der empfohlene Artikel automatisch aktiv sein?<br/>(Voreinstellung: true).<br/>'),
			('Kennung, um Sonderangebote zu entfernen', 'EASYPOPULATE_4_CONFIG_SPECIALS_REMOVE_AT', '43', 'Welche Kennung soll bei einem Import verwendet werden um das Sonderangebot aus der Datenbank zu entfernen?<br /><br /><b>Neuer Default Wert</b>:<br/>negative - ein negativer Preis für ein Sonderangebot entfernt beim Import das Sonderangebot.<br /><br/>zero: ein negativer oder Preis 0 für das Sonderangebot wird es beim Import entfernen.<br />'),
			('Artikel mit Menge Null auf inaktiv stellen?','EASYPOPULATE_4_CONFIG_ZERO_QTY_INACTIVE', '43', 'Sollen Artikel, die mit Menge Null hochgeladen werden den Status inaktiv bekommen?<br/>(Voreinstellung: false)'),
			('Smart Tags Ersetzung von Zeilenumbrüchen', 'EASYPOPULATE_4_CONFIG_SMART_TAGS', '43', 'Zeilenumbrüche und/oder Leerzeilen in Artikelbeschreibungen werden beim Upload in HTML Zeilenumbrüche konvertiert wodurch eine gewisse Formatierung möglich wird - Note: this legacy code is disabled until further review.<br/>(Voreinstellung: true).'),
			('Advanced Smart Tags', 'EASYPOPULATE_4_CONFIG_ADV_SMART_TAGS', '43', 'Allow the use of complex regular expressions to format descriptions, making headings bold, add bullets, etc. Note: legacy code is disabled until further review.<br/>(Voreinstellung: false).'),
			('Debug Logging','EASYPOPULATE_4_CONFIG_DEBUG_LOGGING', '43', 'Easy Populate soll bei Fehlern ein Error Logfile schreiben.<br/>(Voreinstellung: true)'),
			('Maximale Mengenrabatte', 'EASYPOPULATE_4_CONFIG_MAX_QTY_DISCOUNTS', '43', 'Die hier eingestellte maximale Anzahl von Mengenrabatten ist die Anzahl von Spalten für die Mengenrabatte in der Exportdatei.<br/> (Voreinstellung: 3).'),
			('CSV Dateien aufsplitten','EASYPOPULATE_4_CONFIG_SPLIT_RECORDS', '43', 'Nach wievielen Einträgen sollen die csv Dateien aufgesplittet werden? Dadurch werden sehr große Importdateien vermieden, weil sie auf mehrere kleinere aufgeteilt werden. nützlich auf Servern mit schwachen Ressourcen.<br/>(Voreinstellung: 2000).'),
			('Maximale Ausführungszeit','EASYPOPULATE_4_CONFIG_EXECUTION_TIME', '43', 'Wieviele Sekunden hat das Easy Populate Script Zeit, bevor es zu einem Timeout kommt? Diese Einstellung funktioniert nicht auf allen Servern.<br/>(Voreinstellung: 60)'),
			('Konvertiere Curly Quotes, usw','EASYPOPULATE_4_CONFIG_CURLY_QUOTES',  '43', 'Konvertiere Curly Quotes, Em-Dash, En-Dash und Ellipsis Zeichen in Artikelnamen und Beschreibungen? (Voreinstellung: 0).<br><br>0=keine Änderung<br>1=mit einfachen Zeichen ersetzen<br>2=mit dem entsprechenden HTML Zeichen ersetzen'),
			('Konvertiere Zeichen 0x92','EASYPOPULATE_4_CONFIG_CHAR_92', '43', 'Sollen 0x92 Zeichen in Artikelnamen und Artikelbeschreibungen konvertiert werden? (Voreinstellung: 1).<br><br>0=keine Änderung<br>1=durch einfache Anführungszeichen ersetzen<br>2=mit dem entsprechenden HTML Zeichen ersetzen'),
			('Metatag Spalten für Artikel aktivieren?', 'EASYPOPULATE_4_CONFIG_META_DATA',  '43', 'Sollen die Spalten für die Metatag Angaben zu den Artikel aktiviert werden?<br/>(Voreinstellung: 1).<br><br>0=Deaktivieren<br>1=Aktivieren'), 
			('Spalten für Artikeltyp Musik aktivieren?', 'EASYPOPULATE_4_CONFIG_MUSIC_DATA', '43', 'Sollen die Spalten für Angaben zum Artikeltyp Musik aktiviert werden?<br/>(Voreinstellung: 0).<br><br>0=Deaktivieren<br>1=Aktivieren'),
			('Benutzerdefinierte Zusatzfelder in der Tabelle products','EASYPOPULATE_4_CONFIG_CUSTOM_FIELDS', '43', 'Easy Populate erkennt viele zusätzliche Datenbankfelder, die häufig verwendete Module in der Tabelle products angelegt haben. Unter Tools > Easy Populate sehen Sie welche Zusatzfelder etwaiger Module erkannt wurder.<br/>Wenn Sie die Tabelle products mit weiteren individuellen Feldern erweitert haben, dann tragen Sie hier die Namen Ihrer benutzerdefinierte Zusatzfelder ein (mit Komma getrennt, keine Leerzeichen)'),
			('URI von CEON Modul mitexportieren','EASYPOPULATE_4_CONFIG_EXPORT_URI', '43', 'Wenn CEON Uri Mapping genutzt wird, sollen die URI für Artikel oder Kategorien mitexportiert werden?'),
			('Import Sprache Kennung Override','EASYPOPULATE_4_CONFIG_IMPORT_OVERRIDE', '43', 'Beim Import, wenn in der Datei mehrere mögliche Sprachbezeichnungen für ein Feld angegeben sind, welche sollen für die endgültigen Daten verwendet werden?<br/>(z.B. product_name_de (language_code) und product_name_43 (language_id) sind in der Datei angegeben, welche soll dann verwendet werden?)<br/>Voreinstellung: language_code')			
		");

  } else { // unsupported version
    // i should do something here!
  }
    $zco_notifier->notify('EP4_EXTRA_FUNCTIONS_INSTALL_END', array('group_id' => $group_id));
    unset($project);
    unset($group_id);
}

function remove_easypopulate_4() {
	global $db;
	$project = PROJECT_VERSION_MAJOR.'.'.PROJECT_VERSION_MINOR;
	$ep_uses_mysqli = ((PROJECT_VERSION_MAJOR > '1' || PROJECT_VERSION_MINOR >= '5.3') ? true : false);
	if (substr($project,0,3) == "1.5") {
    $sql = "SELECT configuration_group_id FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_title = 'Easy Populate 4' LIMIT 1";
    $result = ep_4_query($sql);
    if (($ep_uses_mysqli ? mysqli_num_rows($result) : mysql_num_rows($result))) {
      $ep_group_id =  ($ep_uses_mysqli ? mysqli_fetch_array($result) : mysql_fetch_array($result));
      $db->Execute("DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_group_id = ".$ep_group_id[0]);
      $db->Execute("DELETE FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_id = ".$ep_group_id[0]);
	  $db->Execute("DELETE FROM ".TABLE_CONFIGURATION_LANGUAGE." WHERE configuration_key LIKE '%EASYPOPULATE_4%'");		
      $db->Execute("DELETE FROM ".TABLE_ADMIN_PAGES." WHERE page_key = 'easypopulate_4'");
      $db->Execute("DELETE FROM ".TABLE_ADMIN_PAGES." WHERE page_key = 'easypopulate_4_config'");
    }
  } else { // unsupported version
  }
  unset($project);
  unset($ep_uses_mysqli);
  unset($sql);
  unset($result);

}

function ep_4_chmod_check($tempdir) {
  global $messageStack;
  if (!@file_exists((EP4_ADMIN_TEMP_DIRECTORY !== 'true' ? /* Storeside */ DIR_FS_CATALOG : /* Admin side */ DIR_FS_ADMIN) . $tempdir . ".")) { // directory does not exist
    $messageStack->add(sprintf(EASYPOPULATE_4_MSGSTACK_TEMP_FOLDER_MISSING, $tempdir, (EP4_ADMIN_TEMP_DIRECTORY !== 'true' ? /* Storeside */ DIR_FS_CATALOG : /* Admin side */ DIR_FS_ADMIN)), 'warning');
    $chmod_check = false;
  } else { // directory exists, test is writeable
    if (!@is_writable((EP4_ADMIN_TEMP_DIRECTORY !== 'true' ? /* Storeside */ DIR_FS_CATALOG : /* Admin side */ DIR_FS_ADMIN) . $tempdir . ".")) { // directory does not exist
      $messageStack->add(sprintf(EASYPOPULATE_4_MSGSTACK_TEMP_FOLDER_NOT_WRITABLE, $tempdir, (EP4_ADMIN_TEMP_DIRECTORY !== 'true' ? /* Storeside */ DIR_FS_CATALOG : /* Admin side */ DIR_FS_ADMIN)), 'warning');
      $chmod_check = false;
    } else {
      $chmod_check = true;
    }
  }
  return $chmod_check;
}

function ep4_directory_check($ep_debug_log_path) {
  global $db;

  if (EP4_ADMIN_TEMP_DIRECTORY !== 'true') {

    if (strpos(DIR_FS_CATALOG . $ep_debug_log_path, DIR_FS_ADMIN) === 0) {

      $temp_rem = substr(DIR_FS_CATALOG . $ep_debug_log_path, strlen(DIR_FS_ADMIN));
      $db->Execute('UPDATE ' . TABLE_CONFIGURATION . ' SET configuration_value = \'true\' where configuration_key = \'EP4_ADMIN_TEMP_DIRECTORY\'', false, false, 0, true);

      $db->Execute('UPDATE ' . TABLE_CONFIGURATION . ' SET configuration_value = \'' . $temp_rem . '\' WHERE configuration_key = \'EASYPOPULATE_4_CONFIG_TEMP_DIR\'', false, false, 0, true);
      unset($temp_rem);
      // need a message to  be displayed...
//      zen_redirect(zen_href_link(FILENAME_CONFIGURATION /*, $parameters*/));
      // zen_redirect(zen_href_link(FILENAME_EASYPOPULATE_4));
    }
  }
  $ep_debug_log_path = $db->Execute('SELECT configuration_value FROM ' . TABLE_CONFIGURATION . ' where configuration_key = \'EASYPOPULATE_4_CONFIG_TEMP_DIR\'', false, false, 0, true);

  return $ep_debug_log_path->fields['configuration_value'];
}

function ep4_delimiter_display($config_value) {
  // global $db;

  // $ep_delim_value_return = '';

  switch ($config_value) {
    case '0':
      $ep_delim_value_return = ',';
      break;
    case '1':
      $ep_delim_value_return = ';';
      break;
    case '2':
      $ep_delim_value_return = 'tab';
      break;
    case '3':
      $ep_delim_value_return = 'space';
      break;
    default:
      $ep_delim_value_return = $ep_delim_value->fields['configuration_value'];
      break;
  }

  return $ep_delim_value_return;
}


function ep4_directory_choice_check($ep_debug_log_path) {
  global $db;

  //$temp_dir = $db->Execute('SELECT configuration_value FROM ' . TABLE_CONFIGURATION . ' where configuration_key = \'EP4_ADMIN_TEMP_DIRECTORY\'', false, false, 0, true);

  if (EP4_ADMIN_TEMP_DIRECTORY !== 'true') {

    if (strpos(DIR_FS_CATALOG . $ep_debug_log_path, DIR_FS_ADMIN) === 0) {

      $temp_rem = substr(DIR_FS_CATALOG . $ep_debug_log_path, strlen(DIR_FS_ADMIN));
      $db->Execute('UPDATE ' . TABLE_CONFIGURATION . ' SET configuration_value = \'true\' where configuration_key = \'EP4_ADMIN_TEMP_DIRECTORY\'', false, false, 0, true);

      $db->Execute('UPDATE ' . TABLE_CONFIGURATION . ' SET configuration_value = \'' . $temp_rem . '\' WHERE configuration_key = \'EASYPOPULATE_4_CONFIG_TEMP_DIR\'', false, false, 0, true);
      unset($temp_rem);
      // need a message to  be displayed...
//      zen_redirect(zen_href_link(FILENAME_CONFIGURATION /*, $parameters*/));
      // zen_redirect(zen_href_link(FILENAME_EASYPOPULATE_4));
    }
  }
  $ep_debug_log_path = $db->Execute('SELECT configuration_value FROM ' . TABLE_CONFIGURATION . ' where configuration_key = \'EP4_ADMIN_TEMP_DIRECTORY\'', false, false, 0, true);

  return ($ep_debug_log_path->fields['configuration_value'] == 'true' ? 'true' : 'false');
}
// The following functions are for testing purposes only
// available zen functions of use..
/*
function zen_get_category_name($category_id, $language_id)
function zen_get_category_description($category_id, $language_id)
function zen_get_products_name($product_id, $language_id = 0)
function zen_get_products_description($product_id, $language_id)
function zen_get_products_model($products_id)
*/

function register_globals_vars_check_4 () {
  echo phpversion();
  echo '<br>register_globals = ', ini_get('register_globals'), '<br>';
  print "_GET: "; print_r($_GET); echo '<br />';
  print "_POST: "; print_r($_POST); echo '<br />';
  print "_FILES: "; print_r($_FILES); echo '<br />';
  print "_COOKIE: "; print_r($_COOKIE); echo '<br />';
  print "GLOBALS: "; print_r($GLOBALS); echo '<br />';
  print "_REQUEST: "; print_r($_REQUEST); echo '<br /><br />';
  global $HTTP_POST_FILES;
  print "HTTP_POST_FILES: "; print_r($HTTP_POST_FILES); echo '<br />';
}

// Added function to evaluate the presence of a field in the $filelayout variable
//   where $filelayout is intended to identify the fields in the file.
function ep4_field_in_file($field_name) {
  if (is_null($field_name)) {
    return false;
  }
  
  if ( (isset($GLOBALS['filelayout'][$field_name])
         || array_key_exists($field_name, $GLOBALS['filelayout'])
       )
     &&
       (isset($GLOBALS['items'][$GLOBALS['filelayout'][$field_name]])
         || array_key_exists($GLOBALS['filelayout'][$field_name], $GLOBALS['items'])
       )
     ) {
      return true;
  }
  
  return false;
}
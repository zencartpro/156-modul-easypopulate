<?php
/**
 * @package Easy Populate 4 for Zen Cart German (www.zen-cart-pro.at)
 * @copyright Copyright 2016-2019  mc12345678 and chadderuski
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0 
 * @version $Id: easypopulate_4_attrib.php 2019-07-12 16:19:14 webchills $
*/
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}


// Database default values
$products_options_id  = 1; // this needs to auto increment for NEW products options
$language_id          = $epdlanguage_id; // default 1=english
$product_options_type = 0; // default 0=Dropdown, 1=Text, 2=Radio, 3=Checkbox, 4=File, 5=Read Only
$products_options_values_id = 1;
$new_options_name = 0;
$new_options_values_name = 0;
$products_sort_order_increment = 10;

$chosen_key_sub = $chosen_key;
if (strpos($chosen_key_sub, 'v_') === 0) {
  $chosen_key_sub = substr($chosen_key_sub, 2);
}
// attribute import loop - read 1 line of data from input file
while (($contents = fgetcsv($handle, 0, $csv_delimiter, $csv_enclosure)) !== false) { // while #1 - Main Loop
  ${$chosen_key} = $contents[$filelayout[$chosen_key]];

  // READ products_id and products_model from TABLE_PRODUCTS
  // Since products_model must be unique (for EP4 at least), this query can be LIMIT 1
  $query ="SELECT * FROM ".TABLE_PRODUCTS." WHERE (" . $chosen_key_sql . ")";
  $query = $db->bindVars($query, ':' . $chosen_key_sub . ':', ${$chosen_key}, 'string');
  $result = ep_4_query($query);

  if (($ep_uses_mysqli ? mysqli_num_rows($result) : mysql_num_rows($result)) == 0)  { // products_model is not in TABLE_PRODUCTS
    $display_output .= sprintf('<br /><font color="red"><b>SKIPPED! - Primary key: %s:</b>%s - Not Found! Unable to apply attributes.</font>', $chosen_key, ${$chosen_key});
    $ep_error_count++;
    continue; // skip current record (returns to while #1)
  }

  // Find the correct product_model to edit
  while(($row = ($ep_uses_mysqli ? mysqli_fetch_array($result) : mysql_fetch_array($result))) !== false) { // BEGIN while #2
    $v_products_id = $row['products_id'];

    // why am I again testing products_model? I used that to query the database in the first place!
    if ($contents[$filelayout[$chosen_key]] == $row[$chosen_key]) {
      // echo "model: ".$contents[$filelayout['v_products_model']]."<br>";
      // echo "options_name: ".$contents[$filelayout['v_products_options_name']]."<br>";
      // echo "options_type: ".$contents[$filelayout['v_products_options_type']]."<br>";
      // echo "values_names: ".$contents[$filelayout['v_products_options_values_name']]."<br>";

      $v_products_options_type = $contents[$filelayout['v_products_options_type']];
      foreach ($langcode as $key => $lang) { // get each language entry
        $l_id = $lang['id'];
        $l_id_code = $lang['code'];
        $v_products_options_name[$l_id] = $contents[$filelayout['v_products_options_name_'.$l_id]];
        // Override in place to use the language identifier code content over the language identifier content.
        if (isset($filelayout['v_products_options_name_'.$l_id_code]) && (EASYPOPULATE_4_CONFIG_LANGUAGE_EXPORT === 'code' || EASYPOPULATE_4_CONFIG_LANGUAGE_EXPORT === 'all')) {
          $v_products_options_name[$l_id] = $contents[$filelayout['v_products_options_name_'.$l_id_code]];
        }
        $values_names_array[$l_id] = explode(',',$contents[$filelayout['v_products_options_values_name_'.$l_id]]);
        if (isset($filelayout['v_products_options_values_name_'.$l_id_code]) && (EASYPOPULATE_4_CONFIG_LANGUAGE_EXPORT === 'code' || EASYPOPULATE_4_CONFIG_LANGUAGE_EXPORT === 'all')) {
          $values_names_array[$l_id] = explode(',',$contents[$filelayout['v_products_options_values_name_'.$l_id_code]]);
        }
      } // foreach

      // PRODUCTS OPTIONS NAMES
      // This will insert a new product_options_name, and product_options_type into TABLE_PRODUCTS_OPTIONS

      // READ products_options_id and products_options_name from TABLE_PRODUCTS_OPTIONS
      // Does products_options_name exist?

      // NOTE: DUPLICATE OPTIONS NAMES ARE HANDLED AS IF THEY ARE THE SAME OPTION NAME!!!
      // Zencart, however, will let you define multiple option names with the same products_options_name value.
      // This works in zencart because products_options_name is not the key, products_options_id is the key.
      // To auto populate the attributes it is easier to use just products_options_name uniquely, otherwise you will have to
      // also define the key which is not so easy.
      // This CAN be done, but it adds greatly to the complexity of the import logic.

      // For sanities sake, I am assuming that language id 1 is defined. This may not always be true.
      // Probably better to set to the default language id... will look into this for future update

// HERE ==> language 1 is main key, and assumbed
      $l_id = $language_id; // temporary check - should this be the default language id?
      $query  = "SELECT products_options_id, products_options_name FROM ".TABLE_PRODUCTS_OPTIONS."
        WHERE products_options_name = :v_products_options_name: AND language_id = :language_id:";
      $query = $db->bindVars($query, ':v_products_options_name:', $v_products_options_name[$l_id], 'string');
      $query = $db->bindVars($query, ':language_id:', $l_id, 'integer');
      $result = ep_4_query($query);

      // insert new products_options_name
      if ($row = ($ep_uses_mysqli ? mysqli_fetch_array($result) : mysql_fetch_array($result)))  {
        $v_products_options_id = $row['products_options_id']; // this is not getting used for anything!
      // get current products_options_id
      } else { // products_options_name is not in TABLE_PRODUCTS so ADD it
        $sql_max = "SELECT MAX(products_options_id) + 1 max FROM ".TABLE_PRODUCTS_OPTIONS;
        $result_max = ep_4_query($sql_max);
        $row_max = ($ep_uses_mysqli ? mysqli_fetch_array($result_max) : mysql_fetch_array($result_max));
        unset($result_max);
        $v_products_options_id = $row_max['max'];
        unset($row_max);
//        if (!is_numeric($products_options_id) ) { // i don't think this ever gets executed even when table is empty!!!
//          $v_products_options_id = 1;
//        }
// HERE ======> This resolves the missing entries for additionally defined languages beyond [1]
        foreach ($langcode as $key => $lang) {
          $l_id = $lang['id'];
          $sql = "INSERT INTO ".TABLE_PRODUCTS_OPTIONS."
            (products_options_id, language_id, products_options_name, products_options_type)
            VALUES
            (:v_products_options_id:, :language_id:, :v_products_options_name:, :v_products_options_type:)";
          $sql = $db->bindVars($sql, ':v_products_options_id:', $v_products_options_id, 'integer');
          $sql = $db->bindVars($sql, ':language_id:', $l_id, 'integer');
          $sql = $db->bindVars($sql, ':v_products_options_name:', $v_products_options_name[$l_id], 'string');
          $sql = $db->bindVars($sql, ':v_products_options_type:', $v_products_options_type, 'integer');
          $errorcheck = ep_4_query($sql);
        }
        $new_options_name++;
      }

      // BEGIN: PRODUCTS OPTIONS VALUES

// HERE ==> multi language products_options_values_name
      $number_of_elements = count($values_names_array[$language_id]); // all elements count must be the same
      $values_names_index = 0; // values_names index - array indexes start at zero
      $products_options_values_sort_order = 1;

      // Get max index id for TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS
      $sql_max2 = "SELECT MAX(products_options_values_to_products_options_id) +1 max FROM ".TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS;
      $result2 = ep_4_query($sql_max2);
      unset($sql_max2);
      $row2 = ($ep_uses_mysqli ? mysqli_fetch_array($result2) : mysql_fetch_array($result2));
      unset($result2);
      $products_options_values_to_products_options_id = $row2['max'];
      unset($row2);
/*      if ( !is_numeric($products_options_values_to_products_options_id) ) {
        $products_options_values_to_products_options_id = 1;
      }*/

      // Get max index id for TABLE_PRODUCTS_OPTIONS_VALUES
      $sql_max3 = "SELECT MAX(products_options_values_id) + 1 max FROM ".TABLE_PRODUCTS_OPTIONS_VALUES;
      $result3 = ep_4_query($sql_max3);
      unset($sql_max3);
      $row3 = ($ep_uses_mysqli ? mysqli_fetch_array($result3) : mysql_fetch_array($result3));
      unset($result3);
      $products_options_values_id = $row3['max'];
      unset($row3);
/*      if (!is_numeric($products_options_values_id) ) {
        $products_options_values_id = 1;
      }*/

      $exclude_array = array(1, 4); // exclude 1=TEXT, 4=FILE are special cases and are assigned products_options_values=0

      while ($values_names_index < $number_of_elements) { // BEGIN: while #3: process each element in $values_names_array[]
        // TABLE: products_options_values
        // This does not take into account that you can have a larger options_values set than on the current product
        // it is just auto incrementing
        if (in_array($v_products_options_type, $exclude_array)) {
          // do not process excluded types into TABLE_PRODUCTS_OPTIONS_VALUES
        } else {
          // look for existing products_options_name associated with products_options_id

          // for multi-language values names
          $l_id = $language_id; // first defined language is main key - mandatory
          $sql = "SELECT
            a.products_options_id,
            a.products_options_values_id,
            b.products_options_values_id,
            b.products_options_values_name
            FROM "
            .TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS." as a, "
            .TABLE_PRODUCTS_OPTIONS_VALUES." as b
            WHERE
            a.products_options_id = :v_products_options_id: AND
            a.products_options_values_id = b.products_options_values_id AND
            b.products_options_values_name = :values_name:";
          $sql = $db->bindVars($sql, ':v_products_options_id:', $v_products_options_id, 'integer');
          $sql = $db->bindVars($sql, ':values_name:', $values_names_array[$l_id][$values_names_index], 'string');
          $result4 = ep_4_query($sql);

          // if $result4 == 0, products_options_values_name not found
          if (($ep_uses_mysqli ? mysqli_num_rows($result4) : mysql_num_rows($result4)) == 0)  { // products_options_name is not in TABLE_PRODUCTS_OPTIONS_VALUES
            // insert New products_options_values_name
// HERE ==============> changed to add language entries for all defined languages
            foreach ($langcode as $key => $lang) {
              $l_id = $lang['id'];
              $sql = "INSERT INTO ".TABLE_PRODUCTS_OPTIONS_VALUES."
                (products_options_values_id,
                language_id,
                products_options_values_name,
                products_options_values_sort_order)
                VALUES (
                :products_options_values_id:,
                :language_id:,
                :values_name:,
                :products_options_values_sort_order:)";
              $sql = $db->bindVars($sql, ':products_options_values_id:', $products_options_values_id, 'integer');
              $sql = $db->bindVars($sql, ':language_id:', $l_id, 'integer');
              $sql = $db->bindVars($sql, ':values_name:', $values_names_array[$l_id][$values_names_index], 'string');
              $sql = $db->bindVars($sql, ':products_options_values_sort_order:', $products_options_values_sort_order, 'integer');
              $errorcheck = ep_4_query($sql);
            } // foreach
            $new_options_values_name++;
          } else { // this is an existing products_options_values_name assisgned to this products_options_name
// HERE ===============> add code for updating additional language entries
          }
        } // if (in_array($v...

        // TABLE: products_options_values_to_products_options
        // Now associate "product_options_values_id" with "product_options_id" so the names can be associated with a product_id
        if (in_array($v_products_options_type, $exclude_array)) { // excluded type get special TABLE_PRODUCTS_OPTIONS_VALUES id=0 (a TEXT type)
          $sql5 = "SELECT
            products_options_id,
            products_options_values_id
            FROM "
            .TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS."
            WHERE
            products_options_id =  :v_products_options_id: AND
            products_options_values_id = '0'";
          $sql5 = $db->bindVars($sql5, ':v_products_options_id:', $v_products_options_id, 'integer');
          $result5 = ep_4_query($sql5);
          // if $result5 == 0, combination not found
          if (($ep_uses_mysqli ? mysqli_num_rows($result5) : mysql_num_rows($result5)) == 0)  { // combination is not in TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS
            // insert new combination
            $errorcheck = ep_4_query("INSERT INTO ".TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS."
            (products_options_values_to_products_options_id, products_options_id, products_options_values_id)
            VALUES(" . (int)$products_options_values_to_products_options_id . ", " . (int)$v_products_options_id . ", 0)");
          } else { // duplicate entry, skip
          }
        } else { // add $products_options_values_id
          $l_id = $language_id; // default first language is main key
          $sql5 = "SELECT
            a.products_options_id,
            a.products_options_values_id,
            b.products_options_values_id,
            b.products_options_values_name
            FROM "
            .TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS. " as a, "
            .TABLE_PRODUCTS_OPTIONS_VALUES. " as b
            WHERE
            a.products_options_id = :v_products_options_id: AND
            a.products_options_values_id = b.products_options_values_id AND
            b.products_options_values_name = :values_name:";
          $sql5 = $db->bindVars($sql5, ':v_products_options_id:', $v_products_options_id, 'integer');
          $sql5 = $db->bindVars($sql5, ':values_name:', $values_names_array[$l_id][$values_names_index], 'string');
          $result5 = ep_4_query($sql5);

          // if $result5 == 0, combination not found
          if (($ep_uses_mysqli ? mysqli_fetch_array($result5) : mysql_num_rows($result5)) == 0)  { // combination is not in TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS
            $errorcheck = ep_4_query("INSERT INTO ".TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS."
              (products_options_values_to_products_options_id, products_options_id, products_options_values_id)
              VALUES(" . (int)$products_options_values_to_products_options_id . ", " . (int)$v_products_options_id . ", " . (int)$products_options_values_id . ")");
          } else { // duplicate entry, skip
          }
        }

        // TABLE_PRODUCTS_ATTRIBUTES
        // Finish up by associating the correct set of options with as an attribute_id
        if (in_array($v_products_options_type, $exclude_array)) { //
          $errorcheck = ep_4_query("INSERT INTO ".TABLE_PRODUCTS_ATTRIBUTES."
          (products_id, options_id, options_values_id)
          VALUES (".(int)$v_products_id.", ".(int)$v_products_options_id.",0)");
        } else {
          $l_id = $language_id; // default first language is main key
          $sql5 = "SELECT
            a.products_options_id,
            a.products_options_values_id,
            b.products_options_values_id,
            b.products_options_values_name
            FROM "
            .TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS. " as a, "
            .TABLE_PRODUCTS_OPTIONS_VALUES. " as b
            WHERE
            a.products_options_id = :v_products_options_id: AND
            a.products_options_values_id = b.products_options_values_id AND
            b.products_options_values_name = :values_name:";
          $sql5 = $db->bindVars($sql5, ':v_products_options_id:', $v_products_options_id, 'integer');
          $sql5 = $db->bindVars($sql5, ':values_name:', $values_names_array[$l_id][$values_names_index], 'string');
          $result5 = ep_4_query($sql5);

          $row5 = ($ep_uses_mysqli ? mysqli_fetch_array($result5) : mysql_fetch_array($result5));
          $a_products_options_values_id = $row5['products_options_values_id'];


// HERE ==========> // INSERT vs UPDATE!!!
          // need to query the v_products_id, v_products_options_id, and a_products_options_values_id
          // if found update, else insert new values
          $sql6 = "SELECT * FROM "
            .TABLE_PRODUCTS_ATTRIBUTES. "
            WHERE
            products_id = :v_products_id: AND
            options_id = :v_products_options_id: AND
            options_values_id = :a_products_options_values_id:";
          $sql6 = $db->bindVars($sql6, ':v_products_id:', $v_products_id, 'integer');
          $sql6 = $db->bindVars($sql6, ':v_products_options_id:', $v_products_options_id, 'integer');
          $sql6 = $db->bindVars($sql6, ':a_products_options_values_id:', $a_products_options_values_id, 'integer');
          $result6 = ep_4_query($sql6);
          $row6 = ($ep_uses_mysqli ? mysqli_fetch_array($result6) : mysql_fetch_array($result6));
          if (($ep_uses_mysqli ? mysqli_num_rows($result6) : mysql_num_rows($result6)) == 0)  {
            $errorcheck = ep_4_query("INSERT INTO ".TABLE_PRODUCTS_ATTRIBUTES."
              (products_id, options_id, options_values_id)
              VALUES (".(int)$v_products_id.", ".(int)$v_products_options_id.",".(int)$a_products_options_values_id.")");
            $table_products_attributes_update = 0;
          } else { // UPDATE
            $sql7 ="UPDATE ".TABLE_PRODUCTS_ATTRIBUTES." SET
              products_options_sort_order = :values_names_index:
              WHERE
              products_id = :v_products_id: AND
              options_id = :v_products_options_id: AND
              options_values_id = :a_products_options_values_id:";
            $sql7 = $db->bindVars($sql7, ':values_names_index:', $values_names_index, 'integer');
            $sql7 = $db->bindVars($sql7, ':v_products_id:', $v_products_id, 'integer');
            $sql7 = $db->bindVars($sql7, ':v_products_options_id:', $v_products_options_id, 'integer');
            $sql7 = $db->bindVars($sql7, ':a_products_options_values_id:', $a_products_options_values_id, 'integer');
            $errorcheck = ep_4_query($sql7);
            $table_products_attributes_update = 1;
          }
        }

        // Get max index id for TABLE_PRODUCTS_OPTIONS_VALUES
        $sql_max3 = "SELECT MAX(products_options_values_id) + 1 max FROM ".TABLE_PRODUCTS_OPTIONS_VALUES;
        $result3 = ep_4_query($sql_max3);
        unset($sql_max3);
        $row3 = ($ep_uses_mysqli ? mysqli_fetch_array($result3) : mysql_fetch_array($result3));
        unset($result3);
        $products_options_values_id = $row3['max'];
        unset($row3);

        // Get max index id for TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS
        $sql_max2 = "SELECT MAX(products_options_values_to_products_options_id) + 1 max FROM ".TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS;
        $result2 = ep_4_query($sql_max2);
        unset($sql_max2);
        $row2 = ($ep_uses_mysqli ? mysqli_fetch_array($result2) : mysql_fetch_array($result2));
        unset($resul2);
        $products_options_values_to_products_options_id = $row2['max'];
        unset($row2);
        $values_names_index++;
        // mc12345678: allows for more room in sort order of options names: New = round(old/10)*10 + increment
        // $products_options_values_sort_order = $products_options_values_sort_order + $products_sort_order_increment;
        $products_options_values_sort_order = (round(($products_options_values_sort_order/10))) * 10 + $products_sort_order_increment;
      } // END: while #3
      if (!$table_products_attributes_update) {
        // FEEDBACK ========> implode(",", $values_names_array[1])
        $display_output .= sprintf('<br /><font color="green"><b>NEW ATTRIBUTE! - Model:</b> %s, <b>Option:</b> %s, <b>Values:</b> %s</font>',
                     ${$chosen_key}, $v_products_options_name[$language_id], implode(",", $values_names_array[$language_id]));
        $ep_import_count++; // record inserted
      } else {
        // FEEDBACK =======>
        $display_output .= sprintf('<br /><font color="blue"><b>UPDATED ATTRIBUTE! - Model:</b> %s <b>Option:</b> %s, <b>Values:</b> %s</font>',
                    ${$chosen_key}, $v_products_options_name[$language_id], implode(",", $values_names_array[$language_id]));
        $ep_update_count++; // records updated
      }
      // END: PRODUCTS OPTIONS VALUES
    } // END: if
    unset($row);
  }  // END: while #2
  print(str_repeat(" ", 300));
  flush();
  unset($contents);
} // END: while #1


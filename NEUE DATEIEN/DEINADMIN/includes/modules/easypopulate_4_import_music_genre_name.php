<?php
/**
 * @package Easy Populate 4 for Zen Cart German (www.zen-cart-pro.at)
 * @copyright Copyright 2016-2018  mc12345678 and chadderuski
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0 
 * @version $Id: easypopulate_4_import_music_genre_name.php 2018-03-28 08:19:14 webchills $
*/

          if (isset($v_music_genre_name) && ($v_music_genre_name != '') && ((function_exists('mb_strlen') && mb_strlen($v_music_genre_name) <= $max_len['music_genre_name']) || (!function_exists('mb_strlen') && strlen($v_music_genre_name) <= $max_len['music_genre_name']))) {
            $sql = "SELECT music_genre_id AS music_genreID FROM " . TABLE_MUSIC_GENRE . " WHERE music_genre_name = :music_genre_name: LIMIT 1";
            $sql = $db->bindVars($sql, ':music_genre_name:', $v_music_genre_name, 'string');
            $result = ep_4_query($sql);
            if ($row = ($ep_uses_mysqli ? mysqli_fetch_array($result) : mysql_fetch_array($result) )) {
              $v_music_genre_id = $row['music_genreID']; // this id goes into the product_music_extra table
            } else { // It is set to autoincrement, do not need to fetch max id
              $sql = "INSERT INTO " . TABLE_MUSIC_GENRE . " (music_genre_name, date_added, last_modified)
                VALUES (:music_genre_name:, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
              $sql = $db->bindVars($sql, ':music_genre_name:', $v_music_genre_name, 'string');
              $result = ep_4_query($sql);

              $v_music_genre_id = ($ep_uses_mysqli ? mysqli_insert_id($db->link) : mysql_insert_id()); // id is auto_increment

              if ($result) {
                zen_record_admin_activity('Inserted music genre ' . zen_db_input($v_music_genre_name) . ' via EP4.', 'info');
              }
            }
          } else { // $v_music_genre_name == '' or name length violation
            if ((function_exists('mb_strlen') && mb_strlen($v_music_genre_name) > $max_len['music_genre_name']) || (!function_exists('mb_strlen') && strlen($v_music_genre_name) > $max_len['music_genre_name'])) {
              $display_output .= sprintf(EASYPOPULATE_4_DISPLAY_RESULT_MUSIC_GENRE_NAME_LONG, $v_music_genre_name, $max_len['music_genre_name']);
              $ep_error_count++;
              continue;
            }
            $v_music_genre_id = 0; // chadd - zencart uses genre_id = '0' for no assisgned artists
          }

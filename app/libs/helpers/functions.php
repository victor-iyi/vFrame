<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 03 06, 2017 @ 4:01 PM
 * Copyright victor © 2017. All rights reserved.
 */


/**
 * Preserves the text supplied in HTML inputs
 * @param $key
 * @return string
 */
function _preserveInputs($key)
{
  return isset($_REQUEST[$key]) ? htmlspecialchars($_REQUEST[$key]) : '';
}

/**
 * Preserve the state of a checkbox
 * @param $key
 * @return string
 */
function _preserveCheckBox($key)
{
  return isset($_POST[$key]) ? "checked" : "";
}

/**
 * Redirects to supplied uri
 * @param $uri
 */
function _redirect($uri)
{
  echo '<script>document.title = "Redirecting..."; window.location="' . PROJECT_PATH . $uri . '"</script>';
  die();
}


/**
 * Hash a password using PASSWORD_BCRYPT default algorithm
 * @param $password
 * @param int $algorithm
 * @return bool|string
 */
function _hash($password, $algorithm = PASSWORD_BCRYPT)
{
  return password_hash($password, $algorithm);
}


/**
 * Verifies hashed password
 * @param $password
 * @param $hash
 * @return bool
 */
function _verify_hash($password, $hash)
{
  return password_verify($password, $hash);
}

/**
 * Generates random mixed case string
 * @param $length
 * @return string
 */
function _generate_id($length = 8)
{
  $chars = array_merge(range('A', 'Z'), range(0, 9), range('a', 'z'));
  shuffle($chars);
  if ($length > count($chars)) $length = count($chars);
  return implode(array_slice($chars, 0, $length));
}

/**
 * Generates a random salt
 * @param $name
 * @param int $algorithm
 * @return bool|string
 */
function _generate_salt($name, $algorithm = PASSWORD_BCRYPT)
{
  return password_hash($name, $algorithm);
}

/**
 * Verifies a salt
 * @param $name
 * @param $salt
 * @return bool
 */
function _verify_salt($name, $salt)
{
  return password_verify($name, $salt);
}
<?php
/**
 * Merge user defined arguments into defaults array.
 *
 * This function is used throughout WordPress to allow for both string or array
 * to be merged into another array.
 *
 * @since 2.2.0
 *
 * @param string|array $args Value to merge with $defaults
 * @param array $defaults Array that serves as the defaults.
 * @return array Merged user defined values with defaults.
 */
function parse_args($args, $defaults = '') {
  if (is_object($args))
    $r = get_object_vars($args);
  elseif (is_array($args))
    $r =& $args;
  else
    parse_str($args, $r);

  if (is_array($defaults))
    return array_merge($defaults, $r);
  return $r;
}

/**
 * Return a friendly date (in french)
 */
function get_date($date, $mode = 'relative') {
  // Les paramètres locaux sont basés sur la France
  setlocale(LC_TIME,"fra");

  // On prend divers points de repère dans le temps
  $time            = strtotime($date);
  $after           = strtotime("+7 day 00:00");
  $afterTomorrow   = strtotime("+2 day 00:00");
  $tomorrow        = strtotime("+1 day 00:00");
  $today           = strtotime("today 00:00");
  $yesterday       = strtotime("-1 day 00:00");
  $beforeYesterday = strtotime("-2 day 00:00");
  $before          = strtotime("-7 day 00:00");

  // On compare les repères à la date actuelle
  // si elle est proche alors on retourne une date relative...
  if ($time < $after && $time > $before && $mode=='relative') {

    if ($time >= $after)
      $relative = strftime("%A", $date)." prochain";
    else if ($time >= $afterTomorrow)
      $relative = "après demain";
    else if ($time >= $tomorrow)
      $relative = "demain";
    else if ($time >= $today)
      $relative = "aujourd'hui";
    else if ($time >= $yesterday)
      $relative = "hier";
    else if ($time >= $beforeYesterday)
      $relative = "avant hier";
    else if ($time >= $before)
      $relative = strftime("%A", $time)." dernier";

  // sinon on retourne une date complète
  } else {
    $relative = strftime("%d/%m/%Y", $time);
  }

  // si l'heure est présente dans la date originale, on l'ajoute
  if (preg_match('/[0-9]{2}:[0-9]{2}/', $date)) {
    $relative .= ' à '.date('H:i', $time);
  }
  return $relative;
}

/**
 * Include only if the file exists
 *
 * @param files|array $args List of files to be included
 * @return array Merged user defined values with defaults.
 */
function _include($files=array()) {
  foreach ((array) $files as $file) {
    if(file_exists($file)) include $file;
  }
}
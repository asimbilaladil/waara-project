<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('test_method')) {
  function getMonthFromDate($date) {
    $d = date_parse_from_format("Y-m-d", $date);
    $monthNum = $d["month"];
    $dateObj = DateTime::createFromFormat('!m', $monthNum);
    return $dateObj->format('F'); 
  }
  function getIndexOf($array, $key, $value) {
    foreach($array as $index => $item) {
      if($item[$key] == $value) {
        return $index;
      }
    }
    return -1;
  }
}
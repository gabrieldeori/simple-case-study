<?php
  require_once('utils/charFilter.php');

  define ("ERROR", "erro");
  define ("EMPTY_FIELD", "Campo vazio!");
  define ("UNDEFINED_FIELD", "Campo indefinido!");

  function validateField(string $fieldName) {
    if (isset($_POST[$fieldName])) {
      $fieldValue = antiXSite($_POST[$fieldName]);
      
      if (!empty($fieldValue)) {
        return $fieldValue;
      }
      return [ERROR => EMPTY_FIELD];
    } else {
      return [ERROR => UNDEFINED_FIELD];
    }
  }

  function validateAllFields(array $fieldsArray) {
    $array_response = [];
    
    for ($count=0; $count < count($fieldsArray); $count++) { 
      $fieldName = $fieldsArray[$count];
      $response = validateField($fieldName);
      $array_response[$fieldName] = $response;
    }

    return $array_response;
  }
?>

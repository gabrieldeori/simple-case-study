<?php
  require_once('utils/charFilter.php');

  define ("ERROR", "erro");
  define ("EMPTY_FIELD", "Todos campos precisam ser preenchidos!");

  function validateEmptyField(string $fieldName) {
    if (isset($_POST[$fieldName])) {
      $fieldValue = antiXSite($_POST[$fieldName]);
      
      if (!empty($fieldValue)) {
        return $fieldValue;
      }
    }
    return false;
  }

  function validateEmptyFields(array $fieldsArray) {
    $array_response = [];
    
    for ($count=0; $count < count($fieldsArray); $count++) { 
      $fieldName = $fieldsArray[$count];
      $response = validateEmptyField($fieldName);
      if (!$response) {
        return [ERROR => EMPTY_FIELD];
      }
      $array_response[$fieldName] = $response;
    }

    return $array_response;
  }
?>

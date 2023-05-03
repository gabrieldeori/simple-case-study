<?php
  require_once('utils/charFilter.php');

  define ("ERROR_VAL", "error_validate");
  define ("EMPTY_FIELD", "Todos campos precisam ser preenchidos!");
  define ("ATLEAST_FIELD", '[nome, apelido, número, email] ao menos um desses deve ser preenchido.');

  function validateEachField(string $fieldName) {
    if (isset($_POST[$fieldName])) {
      $fieldValue = antiXSite($_POST[$fieldName]);

      if (!empty($fieldValue)) {
        return $fieldValue;
      }
    }
    return false;
  }

  function validateAllFields(array $fieldsArray) {
    $array_response = [];
    
    for ($count=0; $count < count($fieldsArray); $count++) { 
      $fieldName = $fieldsArray[$count];
      $response = validateEachField($fieldName);
      if (!$response) {
        return [ERROR_VAL => EMPTY_FIELD];
      }
      $array_response[$fieldName] = $response;
    }

    return $array_response;
  }

  function validateAtLeastOneField(array $fieldsArray) {
    $array_response = [];
    $valid = false;
    for ($count=0; $count < count($fieldsArray); $count++) { 
      $fieldName = $fieldsArray[$count];
      $response = validateEachField($fieldName);
      if ($response) {
        $array_response[$fieldName] = $response;
        $valid = true;
      }
    }

    if (!$valid) {
      return [ERROR_VAL => ATLEAST_FIELD];
    }
    return $array_response;
  }

  function validateAnyField(array $fieldsArray) {
    $array_response = [];
    $valid = false;
    for ($count=0; $count < count($fieldsArray); $count++) { 
      $fieldName = $fieldsArray[$count];
      $response = validateEachField($fieldName);
      if ($response) {
        $array_response[$fieldName] = $response;
        $valid = true;
      }
    }

    if (!$valid) {
      return false;
    }
    return $array_response;
  }

  function validateProfilepic($fieldName) {
    if (isset($_FILES[$fieldName])) {
      $fieldValue = $_FILES[$fieldName];

      if (!empty($fieldValue)) {
        return $fieldValue;
      }
    }
    return false;
  }
?>

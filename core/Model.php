<?php

namespace app\core;

abstract class Model 
{
  public array $errors = [];

  public function loadData($data)
  { 
    foreach($data as $key => $value)
    {
      if(property_exists($this, $key))
      {
        $this->{$key} = $value;
      }
    }
  }

  abstract public function rules();

  public function validate()
  {
    foreach($this->rules() as $attr => $rules)
    {
      $value = $this->{$attr};
      foreach($rules as $rule)
      {
        if($rule === 'required' && !$value)
        {
          $this->addErrorForRule($attr, 'required');
        }
        if($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL))
        {
          $this->addErrorForRule($attr, 'email');
        }
        if($rule === 'min' && strlen($value) < 6)
        {
          $this->addErrorForRule($attr, 'min');
        }
        if(is_array($rule) && $rule[0] === 'unique')
        {
          $class = $rule['class'];
          $uniqueAttr = $attr;
          $tableName = $class::tableName();
          $stmt = App::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :attr");
          $stmt->bindValue(':attr', $value);
          $stmt->execute();
          $result = $stmt->fetchObject();
          if($result)
          {
            $this->addErrorForRule($attr, 'unique');
          }

        }
      }
    }
    return empty($this->errors);
  }

  private function addErrorForRule($attr, $rule)
  {
    $message = $this->errorMessages()[$rule] ?? '';
    $this->errors[$attr][] = $message;
  }

  public function addError($attr, $message)
  {
    $this->errors[$attr][] = $message;
  }

  public function errorMessages()
  {
    return [
      'required' => 'This field is required',
      'email' => 'Invalid email address',
      'min' => 'Min length must be 6 characters',
      'unique' => 'Already exists'
    ];
  }

  public function hasError($attr)
  {
    return $this->errors[$attr] ?? false;
  }

  public function getFirstError($attr)
  {
    return $this->errors[$attr][0] ?? false;
  }
}
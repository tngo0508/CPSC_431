<?php
class Address
{
  //Instance attributes
  private $name = array('FIRST'=>"", 'LAST'=>null);
  private $street = array('ADDRESS'=>0, 'STREET'=>null);
  private $city = null;
  private $state = null;
  private $zipCode = 0;

  //Operations

  /*name() prototypes:
  string name()   returns name in "Last, First" format. If no first name assigned, then return in "Last" format.
  void name(string $value)  set object's $name attribute in "Last, First" or "Last" format.
  void name(array $value) set object's $name attribute in [first, last] format
  void name(string $first, string $last)  set object's $name attribute
  */

  function name()
  {
    //string name()
    if (func_num_args() == 0)
    {
      if (empty($this->name['FIRST']))
      {
        return $this->name['LAST'];
      }
      else
      {
        return $this->name['LAST'].', '.$this->name['FIRST'];
      }
    }
    //void name($value)
    else if (func_num_args() == 1)
    {
      $value = func_get_arg(0);

      if (is_string($value))
      {
        $value = explode(',', $value); //convert string to array

        if (count($value) >= 2)
          $this->name['FIRST'] = htmlspecialchars(trim($value[1]));
        else
          $this->name['FIRST'] = '';
        $this->name['LAST'] = htmlspecialchars(trim($value[0]));
      }
      else if (is_array($value))
      {
        if (count($value) >= 2)
          $this->name['LAST'] = htmlspecialchars(trim($value[1]));
        else
          $this->name['LAST'] = '';
        $this->name['FIRST'] = htmlspecialchars(trim($value[0]));
      }
    }
    //void name($first_name, $last_name)
    else if (func_num_args() == 2)
    {
      $this->name['FIRST'] = htmlspecialchars(trim(func_get_arg(0)));
      $this->name['LAST']  = htmlspecialchars(trim(func_get_arg(1)));
    }

    return $this;
  }

  /*
  street() prototypes:
  string street() returns street in "Address_number street_name" format.
  void street(string $value) set object's $street attribute in "Address_number street_name" format.
  void street(array $value) set object's $street attribute in [Address, street] format
  void street(int $address, string $street) set object's $street attribute
  */
  function street()
  {
    //string street()
    if (func_num_args() == 0)
    {
      return $this->street['ADDRESS'].' '.$this->street['STREET'];
    }
    //void street(string $value)
    else if (func_num_args() == 1)
    {
      $value = func_get_arg(0);

      if( is_string($value) )
        $value = explode(' ', $value); // convert string to array
      if( is_array ($value) )
      {
        if ( count($value) >= 2 )
        {
          $this->street['ADDRESS'] = (int)$value[0];
          $this->street['STREET'] = htmlspecialchars(trim($value[1]));
        }
      }
    }
      //void street(int $address, string $street)
      else if (func_num_args() == 2)
      {
        $this->street['ADDRESS'] = (int)func_get_arg(0);
        $this->street['STREET'] = htmlspecialchars(trim(func_get_arg(1)));
      }

    return $this;
  }

  /*
  city() prototypes
  string city() returns the city.
  void city(string $value) set object's $city attribute
  */
  function city()
  {
    //string city()
    if (func_num_args() == 0)
      return $this->city;

    //void city(string $value)
    else if (func_num_args() == 1)
      $this->city = htmlspecialchars(trim(func_get_arg(0)));

    return $this;
  }

  /*
  state() prototypes:
  string state() returns the state name.
  void state(string $value) set object's $state attribute
  */
  function state()
  {
    //string state()
    if (func_num_args() == 0)
      return $this->state;

    //void state(string $value)
    else if (func_num_args() == 1)
      $this->state = htmlspecialchars(trim(func_get_arg(0)));

    return $this;
  }

  /*
  zip() prototypes:
  int zip() returns the zipcode.
  void zip(int $value) set object's $zipCode attribute
  */
  function zip()
  {
    //int zip()
    if (func_num_args() == 0)
      return $this->zipCode;

    //void zip(int $value)
    else if (func_num_args() == 1)
      $this->zipCode = (int)func_get_arg(0);

    return $this;
  }

  //constructor
  function __construct($name="", $street="", $city=null, $state=null, $zipCode=0)
  {
    // if $name contains at least one tab character, assume all attributes //are provided in a tab separated list. Otherswise, $name is just the
    //player's name.

    if (strpos($name, "\t") !== false)
    {
      list($name, $street, $city, $state, $zipCode) = explode("\t", $name);
    }

    $this->name($name);
    $this->street($street);
    $this->city($city);
    $this->state($state);
    $this->zip($zipCode);
  }

  function __toString()
  {
    return (var_export($this, true));
  }

  //Returns a tab separated value (TSV) string containing the contents of all instance attributes
  function toTSV()
  {
    return implode("\t", [$this->name(), $this->street(), $this->city(), $this->state(), $this->zip()]);
  }

  // Sets instance attributes to the contents of a string containing ordered, tab separated values
  function fromTSV(string $tsvString)
  {
    // assign each argument a value from the tab delineated string respecting relative positions
    list($name, $street, $city, $state, $zipCode) = explode("\t", $tsvString);
    $this->name($name);
    $this->street($street);
    $this->city($city);
    $this->state($state);
    $this->zip($zipCode);
  }
}
 ?>

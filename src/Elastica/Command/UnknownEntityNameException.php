<?php

namespace App\Elastica\Command;

class UnknownEntityNameException extends \Exception {

  public function __construct($message, $code = 0, Exception $previous = null) {

    parent::__construct($message, $code, $previous);
  }

  // chaîne personnalisée représentant l'objet
  public function __toString() {
    return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
  }

}

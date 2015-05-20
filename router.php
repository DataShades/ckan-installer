<?php

class Router {
  public $steps = array(
    0 => 'FormStep0',
    1 => 'FormStep1',
    2 => 'FormStep2',
    3 => 'ThankYou',
  );
  private $current_step = 0;

  protected static $_instance;

  private function __construct(){
    session_start();

    if (!isset($_SESSION['current_step'])) {
      $_SESSION['current_step'] = 0;
    }
    $this->current_step = $_SESSION['current_step'];
  }

  private function __clone(){

  }

  public static function getInstance() {

    if (null === self::$_instance) {
      self::$_instance = new self();
    }

    return self::$_instance;
  }

  public function reload_page() {
    header('Location: /');
  }
  public function next_step() {
    if ($_SESSION['current_step'] + 1 < count($this->steps)) {
      $_SESSION['current_step']++;
    }
    header('Location: /');
  }
  public function prev_page() {
    if ($_SESSION['current_step'] > 0) {
      $_SESSION['current_step']--;
    }
    header('Location: /');
  }
  public function get_current_step() {
    return $this->current_step;
  }
  public function get_current_form_class() {
    return $this->steps[$this->get_current_step()];
  }

}


<?php

class Form {
  var $template_path = '';
  var $formItems = array();
  protected $valid = TRUE;

  /**
   * Print template
   */
  public function render() {
    $errs = $this->getErrors();
    include_once 'theme/html_template.php';
  }

  /**
   * Validate form
   */
  public function validate() {
    foreach ($this->formItems as $item) {
      if (isset($item['required']) && $item['required'] && empty($_POST[$item['name']])) {
        $this->setError($item['title'] . ' field is required');
      }
    }
  }

  /**
   * Build validate and render form
   */
  public function execute() {
    $this->formBuild();
    $router = $router = Router::getInstance();
    if (isset($_POST['next'])) {
      $this->validate();
      if ($this->valid) {
        $this->submit();
        $router->next_step();
      } else {
        $this->render();
      }
    }
    elseif (isset($_POST['prev'])) {
      $router->prev_page();
    }
    else {
      $this->render();
    }
  }

  /**
   * Execute if form valid
   */
  public function submit() {

  }

  /**
   * Set err message and make form invalid
   */
  public function setError($err) {
    $_SESSION['form_errors'][] = $err;
    $this->valid = FALSE;
  }

  /**
   * Get all form errors
   */
  public function getErrors() {
    $errs = $_SESSION['form_errors'];
    $_SESSION['form_errors'] = array();
    return $errs;
  }

  /**
   * Initialise routing
   */
  public function __construct() {
    if (!isset($_SESSION['form_errors'])) {
      $_SESSION['form_errors'] = array();
    }
  }

  /**
   * Update config ini file using array
   */
  public function updateIniFile($path, $configs = array()) {
    $content = file_get_contents($path);

    $lines = explode("\n", $content);

    foreach($lines as &$line) {
      foreach($configs as $name => $val) {
        if (strpos($line, $name) === 0) {
          $line = $name . ' = ' . $val;
          unset($configs[$name]);
          break;
        }
      }
    }
    if (!empty($configs)) {
      $lines[] = '[app:main]';
      foreach ($configs as $name => $val) {
        $lines[] = $name . ' = ' . $val;
      }
    }

    $content = implode("\n", $lines);

    file_put_contents($path, $content);
  }

  /**
   * Add for items
   */
  public function formBuild() {
    return $this->formItems = array();
  }
  /**
   * Return 'required' or ''
   */
  public function isRequired($name) {
    return isset($this->formItems[$name]['required']) && $this->formItems[$name]['required'] ? 'required' : '';
  }

  /**
   * Return default form value
   */
  public function getDefault($name) {
    $val = '';
    if (isset($_POST[$name])) {
      $val = $_POST[$name];
    }
    elseif (isset($this->formItems[$name]['default'])) {
      $val = $this->formItems[$name]['default'];
    }
    return $val;
  }
}


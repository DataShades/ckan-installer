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
    $warns = $this->getWarnings();
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
   * Set warning message and make form invalid
   */
  public function setWarning($err) {
    $_SESSION['form_warnings'][] = $err;
  }

  /**
   * Get all form warnings
   */
  public function getWarnings() {
    $errs = $_SESSION['form_warnings'];
    $_SESSION['form_warnings'] = array();
    return $errs;
  }

  /**
   * Initialise routing
   */
  public function __construct() {
    if (!isset($_SESSION['form_errors'])) {
      $_SESSION['form_errors'] = array();
    }
    if (!isset($_SESSION['form_warnings'])) {
      $_SESSION['form_warnings'] = array();
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

  public function isDbInitialised() {
    $cmds = array(
      sprintf('paster --plugin=ckan db version --config=%s', escapeshellarg($_SESSION['ckan_config_file_path'])),
    );

    return !$this->cliCommandsChain($cmds, TRUE);
  }

  /**
   * Run chain of commands, break process and set form err
   */
  public function cliCommandsChain($cmds = array(), $skip_form_errors = FALSE) {
    $fail = FALSE;
    foreach ($cmds as $cmd) {
      $err = 0;
      $output_arr = array();

      $command = sprintf('. %s && ', $_SESSION['ckan_env_activate_file_path']) . $cmd;
      $output = exec($command, $output_arr, $err);

      if ($err) {
        foreach ($output_arr as $out) {
          if (!$skip_form_errors) {
            $this->setError($out);
          }
        }
        $fail = TRUE;
        break;
      }
    }

    return $fail;
  }

}


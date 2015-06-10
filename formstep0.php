<?php

include_once 'form.php';

define('DEFAULT_CONF_CKAN_DIR', '/etc/ckan');
define('DEFAULT_ENV_CKAN_DIR', '/usr/lib/ckan');

class FormStep0 extends Form {
  var $template_path = 'theme/step0.php';

  public function formBuild() {

    parent::formBuild();

    $this->checkDependencies();

    $this->formItems['ckan_config_file_path'] = array(
      'name' => 'ckan_config_file_path',
      'required' => TRUE,
      'title' => 'Config file',
      'default' => isset($_SESSION['ckan_config_file_path']) ? $_SESSION['ckan_config_file_path'] : '',
    );
    if (!$this->formItems['ckan_config_file_path']['default'] && $conf_file = $this->find_config_file()) {
      $this->formItems['ckan_config_file_path']['default'] = $conf_file;
      if ($this->valid) {
        $this->setWarning('Installer find config file automatically');
      }
    }

    $this->formItems['ckan_env_activate_file_path'] = array(
      'name' => 'ckan_env_activate_file_path',
      'required' => TRUE,
      'title' => 'Python virtual environment activate path',
      'default' => isset($_SESSION['ckan_env_activate_file_path']) ? $_SESSION['ckan_env_activate_file_path'] : '',
    );
    if (!$this->formItems['ckan_env_activate_file_path']['default'] && $env_file = $this->find_env_file()) {
      $this->formItems['ckan_env_activate_file_path']['default'] = $env_file;
      if ($this->valid) {
        $this->setWarning('Installer find python virtual environment file automatically');
      }
    }
  }

  public function validate() {
    parent::validate();

    $this->check_config_file_access($_POST['ckan_config_file_path']);

    $this->check_env_file_access($_POST['ckan_env_activate_file_path']);

  }

  private function check_config_file_access($path) {
    if (!file_exists($path)) {
      $this->setError('Config file does not exist');
    }
    elseif (!is_writable($path)) {
      $this->setError('Config file is not writable');
    }
  }
  private function check_env_file_access($path) {
    if (!file_exists($path)) {
      $this->setError('Python virtual environment is incorrect');
    }
    elseif (!is_executable($path)) {
      $this->setError('Python virtual environment activate path is not executable');
    }
  }


  public function submit() {

    $_SESSION['ckan_config_file_path'] = $_POST['ckan_config_file_path'];
    $_SESSION['ckan_env_activate_file_path'] = $_POST['ckan_env_activate_file_path'];

  }

  public function checkDependencies() {
    $apps = array(
      'type python' => 'Python',
      'type psql' => 'PostgreSQL',
      'type pip' => 'pip',
      'type virtualenv' => 'virtualenv',
      'type git' => 'Git',
      'type java' => 'Java',
      'type javac' => 'Java',
    );
    foreach ($apps as $key => $app) {
      $err = 0;
      $output_arr = array();
      $command = sprintf('%s', $key);
      exec($command, $output_arr, $err);
      if ($err) {
        $this->setWarning($app . ' should be installed to run CKAN');
      }
    }
  }

  public function find_config_file() {
    $configs = array();
    foreach(glob(DEFAULT_CONF_CKAN_DIR . '/*/*.ini') as $f) {
      $confs = parse_ini_file($f, FALSE, INI_SCANNER_RAW);
      if (!empty($confs['sqlalchemy.url']) && !empty($confs['ckan.site_id'])) {
        $configs[] = $f;
      }
    }
    if (count($configs) == 1) {
      $file = reset($configs);
      if (!is_writable($file)) {
        $this->setError('Installer find config file but it is not writable');
      }

      return $file;
    }
    if (count($configs) > 1) {
      $this->setWarning('Installer find more than one config file, please define it manually');
    }
    if (count($configs) == 0) {
      $this->setWarning('Installer could not find config file automatically, please define it manually');
    }
    return FALSE;
  }

  public function find_env_file() {
    $configs = array();
    foreach(glob(DEFAULT_ENV_CKAN_DIR . '/*/bin/activate') as $f) {
        $configs[] = $f;
    }
    if (count($configs) == 1) {
      $file = reset($configs);
      if (!is_executable($file)) {
        $this->setError('Python virtual environment activate path is not executable');
      }

      return $file;
    }
    if (count($configs) > 1) {
      $this->setWarning('Installer find more than one python virtual environment file, please define it manually');
    }
    if (count($configs) == 0) {
      $this->setWarning('Installer could not find python virtual environment file automatically, please define it manually');
    }
    return FALSE;
  }
}

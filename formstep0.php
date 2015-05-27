<?php

include_once 'form.php';

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

    $this->formItems['ckan_env_activate_file_path'] = array(
      'name' => 'ckan_env_activate_file_path',
      'required' => TRUE,
      'title' => 'Python virtual environment activate path',
      'default' => isset($_SESSION['ckan_env_activate_file_path']) ? $_SESSION['ckan_env_activate_file_path'] : '',
    );
  }

  public function validate() {
    parent::validate();
    if (!file_exists($_POST['ckan_config_file_path'])) {
      $this->setError('Config file does not exist');
    }
    elseif (!is_writable($_POST['ckan_config_file_path'])) {
      $this->setError('Config file is not writable');
    }

    if (!file_exists($_POST['ckan_env_activate_file_path'])) {
      $this->setError('Python virtual environment is incorrect');
    }
    elseif (!is_executable($_POST['ckan_env_activate_file_path'])) {
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

}

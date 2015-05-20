<?php

include_once 'form.php';

class FormStep0 extends Form {
  var $template_path = 'theme/step0.php';

  public function formBuild() {

    parent::formBuild();
    $this->formItems['ckan_config_file_path'] = array(
      'name' => 'ckan_config_file_path',
      'required' => TRUE,
      'title' => 'Config file',
      'default' => isset($_SESSION['ckan_config_file_path']) ? $_SESSION['ckan_config_file_path'] : '',
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
  }

  public function submit() {

    $_SESSION['ckan_config_file_path'] = $_POST['ckan_config_file_path'];

  }

}

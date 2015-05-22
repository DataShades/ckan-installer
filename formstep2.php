<?php

include_once 'form.php';

class FormStep2 extends Form {
  var $template_path = 'theme/step2.php';

  public function submit() {
    $post = $_POST;

    unset($post['next'], $post['prev']);

    $_SESSION['step2'] = array();

    foreach ($post as $name => $value) {
      $_SESSION['step2'][$name] = $value;
    }

  }

  public function formBuild() {

    parent::formBuild();
    $this->formItems['ckan_cloud_storage_enable'] = array(
      'name' => 'ckan_cloud_storage_enable',
      'config' => 'ckan.cloud_storage_enable',
      'title' => 'Cloud',
    );
    $this->formItems['ckan_cloud_failover'] = array(
      'name' => 'ckan_cloud_failover',
      'config' => 'ckan.cloud_failover',
      'title' => 'Failover',
      'required' => TRUE,
    );
    $this->formItems['ckan_s3_aws_key'] = array(
      'name' => 'ckan_s3_aws_key',
      'config' => 'ckan.s3_aws_key',
      'title' => 'AWS Access Key',
    );
    $this->formItems['ckan_s3_secret_key'] = array(
      'name' => 'ckan_s3_secret_key',
      'config' => 'ckan.s3_secret_key',
      'title' => 'AWS Secret Key',
    );

    $config = parse_ini_file($_SESSION['ckan_config_file_path'], FALSE, INI_SCANNER_RAW);

    foreach ($this->formItems as $name => &$item) {
      $this->formItems[$name]['default'] = '';
      if (isset($_POST[$name])) {
        $this->formItems[$name]['default'] = $_POST[$name];
      } elseif (isset($_SESSION['step2'][$name])) {
        $this->formItems[$name]['default'] = $_SESSION['step2'][$name];
      } elseif (isset($config[$item['config']])) {
        $this->formItems[$name]['default'] = $config[$item['config']];
      }
    }

  }

}

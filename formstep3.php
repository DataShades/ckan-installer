<?php

include_once 'form.php';

class FormStep3 extends Form {
  var $template_path = 'theme/step3.php';

  public function validate() {
    if (!isset($_POST['ckan_sysadmin_skip']) || !$_POST['ckan_sysadmin_skip']) {

      parent::validate();

      if (strlen($_POST['ckan_sysadmin_pswd']) < 4) {
        $this->setError('Your password must be 4 characters or longer');
      }
      elseif ($_POST['ckan_sysadmin_pswd'] != $_POST['ckan_sysadmin_pswd_rpt']) {
        $this->setError('Passwords mismatch');
      }
      if (!filter_var($_POST['ckan_sysadmin_email'], FILTER_VALIDATE_EMAIL)) {
        $this->setError('Invalid email');
      }


      if ($this->valid) {
        $cmds = array(
          sprintf('paster --plugin=ckan user add %s email=%s password=%s -c %s', $_POST['ckan_sysadmin_name'], $_POST['ckan_sysadmin_email'], $_POST['ckan_sysadmin_pswd'], $_SESSION['ckan_config_file_path']),
          sprintf('paster --plugin=ckan sysadmin add %s -c %s', $_POST['ckan_sysadmin_name'], $_SESSION['ckan_config_file_path']),
        );

        $this->cliCommandsChain($cmds);
      }
    }
  }

  public function submit() {
    $post = $_POST;

    unset($post['next'], $post['prev']);

    $configs = array(
      // Step 1
      'ckan.site_title' => htmlspecialchars($_SESSION['step1']['ckan_site_title'], ENT_QUOTES, 'UTF-8'),
      'ckan.main_css' => htmlspecialchars($_SESSION['step1']['ckan_main_css'], ENT_QUOTES, 'UTF-8'),
      'ckan.site_description' => htmlspecialchars($_SESSION['step1']['ckan_site_description'], ENT_QUOTES, 'UTF-8'),
      'ckan.site_logo' => htmlspecialchars($_SESSION['step1']['ckan_site_logo'], ENT_QUOTES, 'UTF-8'),
      'ckan.site_about' => preg_replace('/\n/', PHP_EOL . ' ', $_SESSION['step1']['ckan_site_about']),
      'ckan.site_intro_text' => preg_replace('/\n/', PHP_EOL . ' ', $_SESSION['step1']['ckan_site_intro_text']),
      'ckan.site_custom_css' => preg_replace('/\n/', PHP_EOL . ' ', htmlspecialchars($_SESSION['step1']['ckan_site_custom_css'], ENT_QUOTES, 'UTF-8')),
      'ckan.homepage_style' => htmlspecialchars($_SESSION['step1']['ckan_homepage_style'], ENT_QUOTES, 'UTF-8'),
      // Step 2
      'ckan.cloud_storage_enable' => $_SESSION['step2']['ckan_cloud_storage_enable'],
      'ckan.cloud_failover' => $_SESSION['step2']['ckan_cloud_failover'],
      'ckan.s3_aws_key' => $_SESSION['step2']['ckan_s3_aws_key'],
      'ckan.s3_secret_key' => $_SESSION['step2']['ckan_s3_secret_key'],
    );

    $this->updateIniFile($_SESSION['ckan_config_file_path'], $configs);

  }

  public function formBuild() {

    if (!$this->isDbInitialised()) {
      $router = $router = Router::getInstance();
      $router->next_step();
    }

    parent::formBuild();
    $this->formItems['ckan_sysadmin_name'] = array(
      'name' => 'ckan_sysadmin_name',
      'title' => 'Login',
      'required' => TRUE,
    );
    $this->formItems['ckan_sysadmin_email'] = array(
      'name' => 'ckan_sysadmin_email',
      'title' => 'Email',
      'required' => TRUE,
    );
    $this->formItems['ckan_sysadmin_pswd'] = array(
      'name' => 'ckan_sysadmin_pswd',
      'title' => 'Password',
      'required' => TRUE,
    );
    $this->formItems['ckan_sysadmin_pswd_rpt'] = array(
      'name' => 'ckan_sysadmin_pswd_rpt',
      'title' => 'Confirm password',
      'required' => TRUE,
    );
    $this->formItems['ckan_sysadmin_skip'] = array(
      'name' => 'ckan_sysadmin_skip',
      'title' => 'Skip this step',
    );

    foreach ($this->formItems as $name => &$item) {
      $this->formItems[$name]['default'] = '';
      if (isset($_POST[$name])) {
        $this->formItems[$name]['default'] = $_POST[$name];
      }
    }

  }

}

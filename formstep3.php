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

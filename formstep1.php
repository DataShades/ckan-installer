<?php

include_once 'form.php';

class FormStep1 extends Form {
  var $template_path = 'theme/step1.php';

  public function submit() {
    $post = $_POST;

    unset($post['next'], $post['prev']);

    $_SESSION['step1'] = array();

    foreach ($post as $name => $value) {
      $_SESSION['step1'][$name] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    $configs = array(
      'ckan.site_title' => htmlspecialchars($_SESSION['step1']['ckan_site_title'], ENT_QUOTES, 'UTF-8'),
      'ckan.main_css' => htmlspecialchars($_SESSION['step1']['ckan_main_css'], ENT_QUOTES, 'UTF-8'),
      'ckan.site_description' => htmlspecialchars($_SESSION['step1']['ckan_site_description'], ENT_QUOTES, 'UTF-8'),
      'ckan.site_logo' => htmlspecialchars($_SESSION['step1']['ckan_site_logo'], ENT_QUOTES, 'UTF-8'),
      'ckan.site_about' => preg_replace('/\n/', PHP_EOL . ' ', $_SESSION['step1']['ckan_site_about']),
      'ckan.site_intro_text' => preg_replace('/\n/', PHP_EOL . ' ', $_SESSION['step1']['ckan_site_intro_text']),
      'ckan.site_custom_css' => preg_replace('/\n/', PHP_EOL . ' ', htmlspecialchars($_SESSION['step1']['ckan_site_custom_css'], ENT_QUOTES, 'UTF-8')),
      'ckan.homepage_style' => htmlspecialchars($_SESSION['step1']['ckan_homepage_style'], ENT_QUOTES, 'UTF-8'),
    );

    $this->updateIniFile($_SESSION['ckan_config_file_path'], $configs);

  }

  public function formBuild() {
    parent::formBuild();
    $this->formItems['ckan_site_title'] = array(
      'name' => 'ckan_site_title',
      'config' => 'ckan.site_title',
      'title' => 'Site title',
    );
    $this->formItems['ckan_main_css'] = array(
      'name' => 'ckan_main_css',
      'config' => 'ckan.main_css',
      'title' => 'Style',
    );
    $this->formItems['ckan_site_description'] = array(
      'name' => 'ckan_site_description',
      'config' => 'ckan.site_description',
      'title' => 'Site Tag Line',
    );
    $this->formItems['ckan_site_logo'] = array(
      'name' => 'ckan_site_logo',
      'config' => 'ckan.site_logo',
      'title' => 'Site Tag Logo',
    );
    $this->formItems['ckan_site_about'] = array(
      'name' => 'ckan_site_about',
      'config' => 'ckan.site_about',
      'title' => 'About',
    );
    $this->formItems['ckan_site_intro_text'] = array(
      'name' => 'ckan_site_intro_text',
      'config' => 'ckan.site_intro_text',
      'title' => 'Intro text',
    );
    $this->formItems['ckan_site_custom_css'] = array(
      'name' => 'ckan_site_custom_css',
      'config' => 'ckan.site_custom_css',
      'title' => 'Custom css',
    );
    $this->formItems['ckan_homepage_style'] = array(
      'name' => 'ckan_homepage_style',
      'config' => 'ckan.homepage_style',
      'title' => 'Homepage',
    );
    $config = parse_ini_file($_SESSION['ckan_config_file_path'], FALSE, INI_SCANNER_RAW);

    foreach ($this->formItems as $name => &$item) {
      $this->formItems[$name]['default'] = '';
      if (isset($_POST[$name])) {
        $this->formItems[$name]['default'] = $_POST[$name];
      } elseif (isset($_SESSION['step1'][$name])) {
        $this->formItems[$name]['default'] = $_SESSION['step1'][$name];
      } elseif (isset($config[$item['config']])) {
        $this->formItems[$name]['default'] = $config[$item['config']];
      }
    }

  }

}

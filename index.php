<?php

  define('CONFIG_FILE_PATH', 'development.ini');

  include_once 'router.php';
  include_once 'form.php';
  include_once 'formstep0.php';
  include_once 'formstep1.php';
  include_once 'formstep2.php';
  include_once 'thankyoustep.php';

  $router = Router::getInstance();
  $form_class = $router->get_current_form_class();

  $form = new $form_class;

  $form->execute();



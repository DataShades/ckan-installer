<?php

include_once 'form.php';

class ThankYou extends Form {
  var $template_path = 'theme/thankyou.php';

  public function render() {
    parent::render();
    unset($_SESSION['step1'], $_SESSION['current_step']);
  }
}

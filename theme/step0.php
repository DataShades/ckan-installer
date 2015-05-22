<div class="module-content">

  <span class="page-heading-grayed">CKAN Shades Configuration Wizard</span>

  <h1 class="page-heading">Basic Architecture</h1>

  <p>You can leave everything as default for now and can change it later throught this Configuration Wizard, in the CKAN
    administration interface or via command line over SSH.</p>

  <p>In fact you can escape this wizard right now and go straight to your brand new CKAN instance, although it's going
    to look a bit bland and not do much so if this is the first time you've installed and used CKAN then we recommend
    you to stay with us.</p>
  <?php if (!empty($errs)) : ?>
    <div class="message error alert alert-danger">
      <?php foreach ($errs as $err) : ?>
        <p><?php print $err; ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="post" name="form-name">
    <!--  Config file-->
    <div class="form-block margin-top-20px height70">
      <div class="form-label">
        <span <?php print $this->isRequired('ckan_config_file_path'); ?>><?php print $this->formItems['ckan_config_file_path']['title']; ?></span>
      </div>
      <div class="form-radio">
        <p><input name="ckan_config_file_path" type="text" value="<?php print $this->getDefault('ckan_config_file_path'); ?>" <?php print $this->isRequired('ckan_config_file_path'); ?>></p>
      </div>
      <div class="tools width35 top green height60">
        <span>This is the path to CKAN configuration file. Ex. <i>/etc/ckan/default/production.ini</i></span>
      </div>
    </div>
    <!--  Env file-->
    <div class="form-block margin-top-20px height150">
      <div class="form-label">
        <span <?php print $this->isRequired('ckan_env_activate_file_path'); ?>><?php print $this->formItems['ckan_env_activate_file_path']['title']; ?></span>
      </div>
      <div class="form-radio">
        <p><input name="ckan_env_activate_file_path" type="text" value="<?php print $this->getDefault('ckan_env_activate_file_path'); ?>" <?php print $this->isRequired('ckan_env_activate_file_path'); ?>></p>
      </div>
      <div class="tools width35 top green height140">
        <span>This is the path Python virtual environment activate file. The virtualenv has to remain active for the rest of the installation and deployment process, or commands will fail. Ex. <i>/usr/lib/ckan/default/bin/activate</i></span>
      </div>
    </div>

    <!--  Form actions-->
    <div class="form-block form-submit margin-top-20px">
      <input type="submit" class="submit-button button button-submit" value="Continue" name="next">
    </div>
  </form>
</div>


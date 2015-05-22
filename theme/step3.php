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

    <!--  cloud -->
    <div class="form-block margin-top-20px height70">
      <div class="form-label"><span><?php print $this->formItems['ckan_sysadmin_skip']['title']; ?></span></div>
      <div class="form-radio">
        <p><input name="ckan_sysadmin_skip" type="checkbox" value="1" ></p>
      </div>
      <div class="tools">
        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus consequatur deleniti esse expedita harum illo in maiores molestiae nam nesciunt nihil nisi nobis, provident quaerat repellendus similique tenetur vero.</span>
      </div>
    </div>

    <!-- Name -->
    <div class="form-block margin-top-20px height70">
      <div class="form-label"><span <?php print $this->isRequired('ckan_sysadmin_name'); ?>><?php print $this->formItems['ckan_sysadmin_name']['title']; ?></span></div>
      <div class="form-radio">
        <p><input name="ckan_sysadmin_name" type="text" value="<?php print $this->getDefault('ckan_sysadmin_name'); ?>" <?php print $this->isRequired('ckan_sysadmin_name'); ?>></p>
      </div>
      <div class="tools">
        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, quod?</span>
      </div>
    </div>
    <!-- Email -->
    <div class="form-block margin-top-20px height70">
      <div class="form-label"><span <?php print $this->isRequired('ckan_sysadmin_email'); ?>><?php print $this->formItems['ckan_sysadmin_email']['title']; ?></span></div>
      <div class="form-radio">
        <p><input name="ckan_sysadmin_email" type="text" value="<?php print $this->getDefault('ckan_sysadmin_email'); ?>" <?php print $this->isRequired('ckan_sysadmin_email'); ?>></p>
      </div>
      <div class="tools">
        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, quod?</span>
      </div>
    </div>
    <!-- Password -->
    <div class="form-block margin-top-20px height70">
      <div class="form-label"><span <?php print $this->isRequired('ckan_sysadmin_pswd'); ?>><?php print $this->formItems['ckan_sysadmin_pswd']['title']; ?></span></div>
      <div class="form-radio">
        <p><input name="ckan_sysadmin_pswd" type="password" value="<?php print $this->getDefault('ckan_sysadmin_pswd'); ?>" <?php print $this->isRequired('ckan_sysadmin_pswd'); ?>></p>
      </div>
      <div class="tools">
        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, quod?</span>
      </div>
    </div>
    <!-- Confirm password -->
    <div class="form-block margin-top-20px height70">
      <div class="form-label"><span <?php print $this->isRequired('ckan_sysadmin_pswd_rpt'); ?>><?php print $this->formItems['ckan_sysadmin_pswd_rpt']['title']; ?></span></div>
      <div class="form-radio">
        <p><input name="ckan_sysadmin_pswd_rpt" type="password" value="<?php print $this->getDefault('ckan_sysadmin_pswd_rpt'); ?>" <?php print $this->isRequired('ckan_sysadmin_pswd_rpt'); ?>></p>
      </div>
      <div class="tools">
        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, quod?</span>
      </div>
    </div>
    <!--  Form actions-->
    <div class="form-block form-submit margin-top-20px">
      <input type="submit" class="submit-button button button-back" value="Back" name="prev">
      <input type="submit" class="submit-button button button-submit" value="Continue" name="next">
    </div>
  </form>
</div>

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
      <div class="form-label"><span <?php print $this->isRequired('ckan_cloud_storage_enable'); ?>><?php print $this->formItems['ckan_cloud_storage_enable']['title']; ?></span></div>
      <div class="form-radio">
        <p><input name="ckan.cloud_storage_enable" type="checkbox" value="1" <?php print $this->isRequired('ckan_cloud_storage_enable'); ?> <?php print $this->getDefault('ckan_cloud_storage_enable') == '1' ? 'checked=checked' : ''; ?>></p>

        <div class="tools width35 top green height60">
          <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus consequatur deleniti esse expedita harum illo in maiores molestiae nam nesciunt nihil nisi nobis, provident quaerat repellendus similique tenetur vero.</span>
        </div>
      </div>
    </div>
    <!--  failover -->
    <div class="form-block margin-top-20px height70">
      <div class="form-label"><span <?php print $this->isRequired('ckan_cloud_failover'); ?>><?php print $this->formItems['ckan_cloud_failover']['title']; ?></span></div>
      <div class="form-radio">
        <p>
          <input class="top green" <?php print $this->getDefault('ckan_cloud_failover') == '1' ? 'checked=checked' : ''; ?> title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, veritatis!" name="ckan.cloud_failover" type="radio" value="1" <?php print $this->isRequired('ckan_cloud_failover'); ?>>
          <label for="ckan.cloud_failover">Write upload to localAbort upload</label>
        </p>
        <p>
          <input class="bottom red" <?php print $this->getDefault('ckan_cloud_failover') == '2' ? 'checked=checked' : ''; ?> title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet distinctio impedit molestiae voluptas. Adipisci distinctio possimus quisquam sit voluptatem?" name="ckan.cloud_failover" type="radio" value="2" <?php print $this->isRequired('ckan_cloud_failover'); ?>>
          <label for="ckan.cloud_failover">Abort upload</label>
        </p>

        <div class="tools width35 green top height60">
          <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, veritatis!</span>
        </div>
      </div>
    </div>
    <!-- AWS key -->
    <div class="form-block margin-top-20px height40">
      <div class="form-label"><span <?php print $this->isRequired('ckan_s3_aws_key'); ?>><?php print $this->formItems['ckan_s3_aws_key']['title']; ?></span></div>
      <div class="form-radio">
        <p><input name="ckan.s3_aws_key" type="text" value="<?php print $this->getDefault('ckan_s3_aws_key'); ?>" <?php print $this->isRequired('ckan_s3_aws_key'); ?>></p>
        <div class="tools width35 top green height60">
          <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi culpa doloribus facilis harum in ipsa nam suscipit unde vero voluptatibus.</span>
        </div>
      </div>
    </div>
    <!--AWS secret key -->
    <div class="form-block margin-top-20px height70">
      <div class="form-label"><span <?php print $this->isRequired('ckan_s3_secret_key'); ?>><?php print $this->formItems['ckan_s3_secret_key']['title']; ?></span></div>
      <div class="form-radio">
        <p><input name="ckan.s3_secret_key" type="text" value="<?php print $this->getDefault('ckan_s3_secret_key'); ?>" <?php print $this->isRequired('ckan_s3_secret_key'); ?>></p>
        <div class="tools width35 top green height60">
          <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, quod?</span>
        </div>
      </div>
    </div>
    <!--  Form actions-->
    <div class="form-block form-submit margin-top-20px">
      <input type="submit" class="submit-button" value="Back" name="prev">
      <input type="submit" class="submit-button" value="Continue" name="next">
    </div>
  </form>
</div>

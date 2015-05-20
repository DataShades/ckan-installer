<div class="module-content">

  <span class="page-heading-grayed">CKAN Shades Configuration Wizard</span>

  <h1 class="page-heading">Basic Architecture</h1>

  <p>You can leave everything as default for now and can change it later throught this Configuration Wizard, in the CKAN
    administration interface or via command line over SSH.</p>

  <p>In fact you can escape this wizard right now and go straight to your brand new CKAN instance, although it's going
    to look a bit bland and not do much so if this is the first time you've installed and used CKAN then we recommend
    you to stay with us.</p>

  <form method="post" name="form-name">

    <!--  Site title-->
    <div class="form-block margin-top-20px height70">
      <div class="form-label"><span <?php print $this->isRequired('ckan_site_title'); ?>><?php print $this->formItems['ckan_site_title']['title']; ?></span></div>
      <div class="form-radio">
        <p><input name="ckan.site_title" type="text" value="<?php print $this->getDefault('ckan_site_title'); ?>" <?php print $this->isRequired('ckan_site_title'); ?>></p>

        <div class="tools width35 top green height60">
          <span>This is the title of this CKAN instance It appears in various places throughout CKAN.</span>
        </div>
      </div>
    </div>
    <!--  Site style-->
    <div class="form-block margin-top-10px height90">
      <div class="form-label"><span <?php print $this->isRequired('ckan_main_css'); ?>><?php print $this->formItems['ckan_main_css']['title']; ?></span></div>
      <div class="form-radio">
        <select id="field-ckan-main-css" name="ckan.main_css">
          <option value="/base/css/main.css" <?php print $this->getDefault('ckan_main_css') == '/base/css/main.css' ? 'selected=selected' : ''; ?>>Default</option>
          <option value="/base/css/red.css" <?php print $this->getDefault('ckan_main_css') == '/base/css/red.css' ? 'selected=selected' : ''; ?>>Red</option>
          <option value="/base/css/green.css" <?php print $this->getDefault('ckan_main_css') == '/base/css/green.css' ? 'selected=selected' : ''; ?>>Green</option>
          <option value="/base/css/maroon.css" <?php print $this->getDefault('ckan_main_css') == '/base/css/maroon.css' ? 'selected=selected' : ''; ?>>Maroon</option>
          <option value="/base/css/fuchsia.css" <?php print $this->getDefault('ckan_main_css') == '/base/css/fuchsia.css' ? 'selected=selected' : ''; ?>>Fuchsia</option>
        </select>
        <div class="tools width35 top green height80">
          <span>Choose from a list of simple variations of the main colour scheme to get a very quick custom theme working.</span>
        </div>
      </div>
    </div>
    <!--Site description-->
    <div class="form-block margin-top-20px height40">
      <div class="form-label"><span <?php print $this->isRequired('ckan_site_description'); ?>><?php print $this->formItems['ckan_site_description']['title']; ?></span></div>
      <div class="form-radio">
        <p><input name="ckan.site_description" type="text" value="<?php print $this->getDefault('ckan_site_description'); ?>" <?php print $this->isRequired('ckan_site_description'); ?>></p>

      </div>
    </div>
    <!--Site logo-->
    <div class="form-block margin-top-20px height70">
      <div class="form-label"><span <?php print $this->isRequired('ckan_site_logo'); ?>><?php print $this->formItems['ckan_site_logo']['title']; ?></span></div>
      <div class="form-radio">
        <p><input name="ckan.site_logo" type="text" value="<?php print $this->getDefault('ckan_site_logo'); ?>" <?php print $this->isRequired('ckan_site_logo'); ?>></p>
        <div class="tools width35 top green height60">
          <span>This is the logo that appears in the header of all the CKAN instance templates.</span>
        </div>
      </div>
    </div>
    <!--  About-->
    <div class="form-block margin-top-20px height150">
      <div class="form-label"><span <?php print $this->isRequired('ckan_site_about'); ?>><?php print $this->formItems['ckan_site_about']['title']; ?></span></div>
      <div class="form-radio">
        <p>
          <textarea class="editor" name="ckan.site_about" rows="5" <?php print $this->isRequired('ckan_site_about'); ?>><?php print $this->getDefault('ckan_site_about'); ?></textarea>
          <span class="editor-info-block">You can use <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">Markdown formatting</a> here</span>
        </p>
        <div class="tools width35 top green height40">
          <span>This text will appear on this CKAN instances about page.</span>
        </div>
      </div>
    </div>
    <!--  Intro text-->
    <div class="form-block margin-top-20px height150">
      <div class="form-label"><span <?php print $this->isRequired('ckan_site_intro_text'); ?>><?php print $this->formItems['ckan_site_intro_text']['title']; ?></span></div>
      <div class="form-radio">
        <p>
          <textarea class="editor" name="ckan.site_intro_text" rows="5" <?php print $this->isRequired('ckan_site_intro_text'); ?>><?php print $this->getDefault('ckan_site_intro_text'); ?></textarea>
          <span class="editor-info-block">You can use <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">Markdown formatting</a> here</span>
        </p>

        <div class="tools width35 top green height60">
          <span>This text will appear on this CKAN instances home page as a welcome to visitors.</span>
        </div>
      </div>
    </div>
    <!--  Custom css-->
    <div class="form-block margin-top-20px height130">
      <div class="form-label"><span <?php print $this->isRequired('ckan_site_custom_css'); ?>><?php print $this->formItems['ckan_site_custom_css']['title']; ?></span></div>
      <div class="form-radio">
        <p>
          <textarea name="ckan.site_custom_css" rows="5"  <?php print $this->isRequired('ckan_site_custom_css'); ?>><?php print $this->getDefault('ckan_site_custom_css'); ?></textarea>
        </p>

        <div class="tools width35 top green height120">
          <span>This is a block of CSS that appears in &lt;head&gt; tag of every page. If you wish to customize the templates more fully we recommend reading the documentation.</span>
        </div>
      </div>
    </div>
    <!--  Homepage-->
    <div class="form-block margin-top-10px height90">
      <div class="form-label"><span <?php print $this->isRequired('ckan_homepage_style'); ?>><?php print $this->formItems['ckan_homepage_style']['title']; ?></span></div>
      <div class="form-radio">
        <select id="field-ckan-homepage-style" name="ckan.homepage_style">
          <option value="1" <?php print $this->getDefault('ckan_homepage_style') == '1' ? 'selected=selected' : ''; ?>>Introductory area, search, featured group and featured organization</option>
          <option value="2" <?php print $this->getDefault('ckan_homepage_style') == '2' ? 'selected=selected' : ''; ?>>Search, stats, introductory area, featured organization and featured group</option>
          <option value="3" <?php print $this->getDefault('ckan_homepage_style') == '3' ? 'selected=selected' : ''; ?>>Search, introductory area and stats</option>
        </select>

        <div class="tools width35 top green height80">
          <span>This is for choosing a predefined layout for the modules that appear on your homepage.</span>
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

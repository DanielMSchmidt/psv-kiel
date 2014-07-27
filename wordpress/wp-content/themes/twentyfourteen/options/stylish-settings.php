<?php

// Begins the settings
function settingsPage(){ // Updates Settings Options
  // Set the Themename for display in Backend
  $themename = 'Stylish Framework';

  // Read Post data and set options 
  if(isset($_POST['submitted']) && $_POST['submitted'] == "yes"){
    //Get form data
    $Favicon = $_POST['Favicon'];
    $UseSlider = $_POST['UseSlider'];
    $SliderImage_01 = $_POST['SliderImage_01'];
    $SliderImage_02 = $_POST['SliderImage_02'];
    $SliderImage_03 = $_POST['SliderImage_03'];
    $SliderImage_04 = $_POST['SliderImage_04'];
    $SliderImage_05 = $_POST['SliderImage_05'];
    $SliderUrl_01 = $_POST['SliderUrl_01'];
    $SliderUrl_02 = $_POST['SliderUrl_02'];
    $SliderUrl_03 = $_POST['SliderUrl_03'];
    $SliderUrl_04 = $_POST['SliderUrl_04'];
    $SliderUrl_05 = $_POST['SliderUrl_05'];
    $SliderEffect = $_POST['SliderEffect'];
    $SliderDuration = $_POST['SliderDuration'];
    $SliderControl = $_POST['SliderControl'];
    $SliderDirection = $_POST['SliderDirection'];    
    $ShareRSS = $_POST['ShareRSS'];
    $ShareTwitter = $_POST['ShareTwitter'];
    $ShareFacebook = $_POST['ShareFacebook'];
    $ShareXing = $_POST['ShareXing'];
    $ShareYoutube = $_POST['ShareYoutube'];
    $UseTeaser = $_POST['UseTeaser'];
    $LeftTeaserHead = $_POST['LeftTeaserHead'];
    $LeftTeaserImg = $_POST['LeftTeaserImg'];
    $LeftTeaserContent = $_POST['LeftTeaserContent'];
    $LeftTeaserLink = $_POST['LeftTeaserLink'];
    $MiddleTeaserHead = $_POST['MiddleTeaserHead'];
    $MiddleTeaserImg = $_POST['MiddleTeaserImg'];
    $MiddleTeaserContent = $_POST['MiddleTeaserContent'];
    $MiddleTeaserLink = $_POST['MiddleTeaserLink'];
    $RightTeaserHead = $_POST['RightTeaserHead'];
    $RightTeaserImg = $_POST['RightTeaserImg'];
    $RightTeaserContent = $_POST['RightTeaserContent'];
    $RightTeaserLink = $_POST['RightTeaserLink'];
    $AboutHead = $_POST['AboutHead'];
    $AboutContent = $_POST['AboutContent'];
    $TwitterFeed = $_POST['TwitterFeed'];

    // Set Option
    update_option("Favicon", $Favicon);
    update_option("UseSlider", $UseSlider);
    update_option("SliderImage_01", $SliderImage_01);
    update_option("SliderImage_02", $SliderImage_02);
    update_option("SliderImage_03", $SliderImage_03);
    update_option("SliderImage_04", $SliderImage_04);
    update_option("SliderImage_05", $SliderImage_05);
    update_option("SliderUrl_01", $SliderUrl_01);
    update_option("SliderUrl_02", $SliderUrl_02);
    update_option("SliderUrl_03", $SliderUrl_03);
    update_option("SliderUrl_04", $SliderUrl_04);
    update_option("SliderUrl_05", $SliderUrl_05);
    update_option("SliderEffect", $SliderEffect);
    update_option("SliderDuration", $SliderDuration);
    update_option("SliderControl", $SliderControl);
    update_option("SliderDirection", $SliderDirection);
    update_option("ShareRSS", $ShareRSS);    
    update_option("ShareTwitter", $ShareTwitter);
    update_option("ShareFacebook", $ShareFacebook);
    update_option("ShareXing", $ShareXing);
    update_option("ShareYoutube", $ShareYoutube);
    update_option("UseTeaser", $UseTeaser);
    update_option("LeftTeaserHead", $LeftTeaserHead);
    update_option("LeftTeaserImg", $LeftTeaserImg);
    update_option("LeftTeaserContent", $LeftTeaserContent);
    update_option("LeftTeaserLink", $LeftTeaserLink);
    update_option("MiddleTeaserHead", $MiddleTeaserHead);
    update_option("MiddleTeaserImg", $MiddleTeaserImg);
    update_option("MiddleTeaserContent", $MiddleTeaserContent);
    update_option("MiddleTeaserLink", $MiddleTeaserLink);
    update_option("RightTeaserHead", $RightTeaserHead);
    update_option("RightTeaserImg", $RightTeaserImg);
    update_option("RightTeaserContent", $RightTeaserContent);
    update_option("RightTeaserLink", $RightTeaserLink);
    update_option("AboutHead", $AboutHead);
    update_option("AboutContent", $AboutContent);
    update_option("TwitterFeed", $TwitterFeed);
  
    echo "<div id=\"message\" class=\"updated fade\"><p><strong>" . __('Your settings have been saved.', 'stylish') . "</strong></p></div>";
  }
  
?>

<div class="wrap options">
  
  <form method="post" name="markted" target="_self">
  
  <h2><a href="http://www.stylish-templates.de?utm_source=Template-Links&utm_medium=Banner&utm_content=<? echo $themename; ?>&utm_campaign=Template-Links" target="_blank"><?php _e($themename . ' Settings', 'stylish'); ?></a></h2>

  <!-- #begin Site Settings -->
  <div class="settingsBox"> 
    <div class="setHead">
      <h3><?php _e('Site settings', 'stylish'); ?></h3>
      <div class="setButton">
        <input name="submitted" type="hidden" value="yes" />
        <input type="submit" name="Submit" value="<?php _e('Save', 'stylish'); ?>" />  
      </div>
      <div class="clear"></div>
    </div>
    
    <!-- Header image link -->
    <?php if(!get_option('UseSlider')) : ?>
      <div id="headerimg" class="settings">
        <div class="setting">
            <div class="left header">
              <strong><?php _e('Header image', 'stylish'); ?></strong>
              <?php _e('Upload your own', 'stylish'); ?><br />
            </div>
            <div class="right">
              <?php _e('Upload your own header image', 'stylish'); ?> <a href="?page=custom-header"><?php _e('here', 'stylish'); ?></a>
            </div>
            <div class="clear"></div>
          </div>
      </div>
    <?php endif; ?>

    <!-- Favicon URL -->
    <div class="settings">
      <div class="setting">
          <div class="left header">
            <strong><?php _e('Favicon', 'stylish'); ?></strong>
            <?php _e('URL of your Favicon', 'stylish'); ?><br />
          </div>
          <div class="right">
            <input type="text" name="Favicon" value="<?php echo htmlentities(get_option('Favicon')); ?>" />
            <small><strong><?php _e('Upload your Favicon', 'stylish'); ?> <a href="upload.php"><?php _e('here', 'stylish'); ?></a> <?php _e('and copy its URL into this box', 'stylish'); ?></strong></small>
          </div>
          <div class="clear"></div>
        </div>
    </div>
    
  </div>
  <!-- #end Site settings -->
  
  <!-- #begin Slider settings -->
  <div class="settingsBox">
    <div class="setHead">
      <h3><?php _e('Front page slider', 'stylish'); ?></h3>
      <div class="setButton">
        <input name="submitted" type="hidden" value="yes" />
        <input type="submit" name="Submit" value="<?php _e('Save', 'stylish'); ?>" />  
      </div>
      <div class="clear"></div>
    </div>
    
        <!-- Use Slider -->
    <div class="settings">
      <div class="setting">
        <div class="left slider">
          <strong><?php _e('Activate slider', 'stylish'); ?></strong>
          <?php _e('Activate slider with up to five images', 'stylish'); ?>
        </div>
        <div class="right">
            <input type="checkbox" id="useslider" name="UseSlider" <?php if(get_option('UseSlider') == 'on') { echo 'checked=\"checked\"'; } else { echo ''; }; ?> />
        </div>
        <div class="clear"></div>
      </div>
    </div>
    
    <div class="sliderboxes">
    
      <!-- Slider image 1 -->
      <div class="settings">
        <div class="setting">
          <div class="left slider">
            <strong><?php _e('1st slider image', 'stylish'); ?></strong>
            <?php _e('URL to slider image', 'stylish'); ?><br />(<?= get_option('SliderImgWidth'); ?>px x <?= get_option('SliderImgHeight'); ?>px) 
          </div>
          <div class="right">
              <input type="text" name="SliderImage_01" value="<?php echo get_option('SliderImage_01'); ?>" />
              <small><strong><?php _e('Upload your slider image', 'stylish'); ?> <a href="upload.php"><?php _e('here', 'stylish'); ?></a> <?php _e('and copy its URL into this box', 'stylish'); ?></strong></small><br /><br />
              <input type="text" name="SliderUrl_01" value="<?php echo get_option('SliderUrl_01'); ?>" />
              <small><strong><?php _e('URL where the image should link to', 'stylish'); ?></strong></small>
          </div>
          <div class="clear"></div>
        </div>
      </div>

      <!-- Slider image 2 -->
      <div class="settings">
        <div class="setting">
          <div class="left slider">
            <strong><?php _e('2nd slider image', 'stylish'); ?></strong>
            <?php _e('URL to slider image', 'stylish'); ?><br />(<?= get_option('SliderImgWidth'); ?>px x <?= get_option('SliderImgHeight'); ?>px)
          </div>
          <div class="right">
              <input type="text" name="SliderImage_02" value="<?php echo get_option('SliderImage_02'); ?>" />
              <small><strong><?php _e('Upload your slider image', 'stylish'); ?> <a href="upload.php"><?php _e('here', 'stylish'); ?></a> <?php _e('and copy its URL into this box', 'stylish'); ?></strong></small><br /><br />
              <input type="text" name="SliderUrl_02" value="<?php echo get_option('SliderUrl_02'); ?>" />
              <small><strong><?php _e('URL where the image should link to', 'stylish'); ?></strong></small>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      
      <!-- Slider image 3 -->
      <div class="settings">
        <div class="setting">
          <div class="left slider">
            <strong><?php _e('3rd slider image', 'stylish'); ?></strong>
            <?php _e('URL to slider image', 'stylish'); ?><br />(<?= get_option('SliderImgWidth'); ?>px x <?= get_option('SliderImgHeight'); ?>px)
          </div>
          <div class="right">
              <input type="text" name="SliderImage_03" value="<?php echo get_option('SliderImage_03'); ?>" />
              <small><strong><?php _e('Upload your slider image', 'stylish'); ?> <a href="upload.php"><?php _e('here', 'stylish'); ?></a> <?php _e('and copy its URL into this box', 'stylish'); ?></strong></small><br /><br />
              <input type="text" name="SliderUrl_03" value="<?php echo get_option('SliderUrl_03'); ?>" />
              <small><strong><?php _e('URL where the image should link to', 'stylish'); ?></strong></small>              
          </div>
          <div class="clear"></div>
        </div>
      </div>

      <!-- Slider image 4 -->
      <div class="settings">
        <div class="setting">
          <div class="left slider">
            <strong><?php _e('4th slider image', 'stylish'); ?></strong>
            <?php _e('URL to slider image', 'stylish'); ?><br />(<?= get_option('SliderImgWidth'); ?>px x <?= get_option('SliderImgHeight'); ?>px)
          </div>
          <div class="right">
              <input type="text" name="SliderImage_04" value="<?php echo get_option('SliderImage_04'); ?>" />
              <small><strong><?php _e('Upload your slider image', 'stylish'); ?> <a href="upload.php"><?php _e('here', 'stylish'); ?></a> <?php _e('and copy its URL into this box', 'stylish'); ?></strong></small><br /><br />
              <input type="text" name="SliderUrl_04" value="<?php echo get_option('SliderUrl_04'); ?>" />
              <small><strong><?php _e('URL where the image should link to', 'stylish'); ?></strong></small>
          </div>
          <div class="clear"></div>
        </div>
      </div>

      <!-- Slider image 5 -->
      <div class="settings">
        <div class="setting">
          <div class="left slider">
            <strong><?php _e('5th slider image', 'stylish'); ?></strong>
            <?php _e('URL to slider image', 'stylish'); ?><br />(<?= get_option('SliderImgWidth'); ?>px x <?= get_option('SliderImgHeight'); ?>px)
          </div>
          <div class="right">
              <input type="text" name="SliderImage_05" value="<?php echo get_option('SliderImage_05'); ?>" />
              <small><strong><?php _e('Upload your slider image', 'stylish'); ?> <a href="upload.php"><?php _e('here', 'stylish'); ?></a> <?php _e('and copy its URL into this box', 'stylish'); ?></strong></small><br /><br />
              <input type="text" name="SliderUrl_05" value="<?php echo get_option('SliderUrl_05'); ?>" />
              <small><strong><?php _e('URL where the image should link to', 'stylish'); ?></strong></small>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      
      <!-- Slider effect -->
      <div class="settings">
        <div class="setting">
          <div class="left slider">
            <strong><?php _e('Slider effect', 'stylish'); ?></strong>
            <?php _e('Change the blending effect of your slider', 'stylish'); ?>
          </div>
          <div class="right">
              <?php 
                $effects = array('random','sliceDown','sliceDownLeft','sliceUp','sliceUpLeft','sliceUpDown','slideUpDownLeft','fold','fade');
              ?>
              <select style="width: 380px;" name="SliderEffect" id="SliderEffect"> 
              <?php foreach ($effects as $effect) { ?>
                <option <?php if(get_option('SliderEffect') == $effect) { echo 'selected="selected"'; } ?> value="<?php echo $effect; ?>"><?php echo $effect; ?></option>
              <?php } ?>
              </select> 
              <small><strong><?php _e('Choose your favourite slider effect', 'stylish'); ?></strong></small>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      
      <!-- Slider duration -->
      <div class="settings">
        <div class="setting">
          <div class="left slider">
            <strong><?php _e('Slider pause time', 'stylish'); ?></strong>
            <?php _e('Change the pause time of your slider', 'stylish'); ?>
          </div>
          <div class="right">
            <input type="text" name="SliderDuration" value="<?php echo get_option('SliderDuration'); ?>" />
            <small><strong><?php _e('Enter pause time in ms (e. g. 5000)', 'stylish'); ?></strong></small>
          </div>
          <div class="clear"></div>
        </div>
      </div>        

      <!-- Slider Control Nav -->
      <div class="settings">
        <div class="setting">
          <div class="left slider">
            <strong><?php _e('Slider Control', 'stylish'); ?></strong>
            <?php _e('Display slider navigation', 'stylish'); ?>
          </div>
          <div class="right">
              <?php 
                $navs = array('false', 'true');
              ?>
              <select style="width: 380px;" name="SliderControl" id="SliderControl"> 
              <?php foreach ($navs as $nav) { ?>
                <option <?php if(get_option('SliderControl') == $nav) : echo 'selected="selected"'; endif; ?> value="<?php echo $nav; ?>"><?php echo $nav; ?></option>
              <?php } ?>
              </select> 
              <small><strong><?php _e('Select true if you want to display a slider navigation', 'stylish'); ?></strong></small>
          </div>
          <div class="clear"></div>
        </div>
      </div> 
      
      <!-- Slider Direction Nav -->
      <div class="settings">
        <div class="setting">
          <div class="left slider">
            <strong><?php _e('Slider Direction', 'stylish'); ?></strong>
            <?php _e('Display slider prev/next buttons', 'stylish'); ?>
          </div>
          <div class="right">
              <?php 
                $dirs = array('false', 'true');
              ?>
              <select style="width: 380px;" name="SliderDirection" id="SliderDirection"> 
              <?php foreach ($dirs as $dir) { ?>
                <option <?php if(get_option('SliderDirection') == $dir) : echo 'selected="selected"'; endif; ?> value="<?php echo $dir; ?>"><?php echo $dir; ?></option>
              <?php } ?>
              </select> 
              <small><strong><?php _e('Select true if you want to display a prev/next navigation', 'stylish'); ?></strong></small>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      
    </div>
    
  </div>  
  <!-- #end Slider -->
  
  <!-- #begin Social Media -->
  <div class="settingsBox">
    <div class="setHead">
      <h3><?php _e('Social media profiles', 'stylish'); ?></h3>
      <div class="setButton">
        <input name="submitted" type="hidden" value="yes" />
        <input type="submit" name="Submit" value="<?php _e('Save', 'stylish'); ?>" />  
      </div>
      <div class="clear"></div>
    </div>
    
    <!-- Show RSS-Feed -->
    <div class="settings">
      <div class="setting">
        <div class="left rssprofile">
          <strong><?php _e('Activate RSS-Link', 'stylish'); ?></strong>
          <?php _e('Check to display a link to your Feed', 'stylish'); ?>
        </div>
        <div class="right">
            <input type="checkbox" id="userss" name="ShareRSS" <?php if(get_option('ShareRSS')) : echo 'checked=\"checked\"'; else : echo ''; endif; ?> />
        </div>
        <div class="clear"></div>
      </div>
    </div>
    
    <!-- Twitter URL -->
    <div class="settings">
      <div class="setting">
        <div class="left twitterprofile">
          <strong><?php _e('Twitter', 'stylish'); ?></strong>
          <?php _e('Enter your Twitter username', 'stylish'); ?>
        </div>
        <div class="right">
          <input type="text" name="ShareTwitter" value="<?php echo get_option('ShareTwitter'); ?>" />
        </div>
        <div class="clear"></div>
      </div>
    </div>
    
    <!-- Facebook URL -->
    <div class="settings">
      <div class="setting">
        <div class="left facebookprofile">
          <strong><?php _e('Facebook', 'stylish'); ?></strong>
          <?php _e('Enter your Facebook username', 'stylish'); ?>
        </div>
        <div class="right">
          <input type="text" name="ShareFacebook" value="<?php echo get_option('ShareFacebook'); ?>" />
        </div>
        <div class="clear"></div>
      </div>
    </div>
    
    <!-- XING URL -->
    <div class="settings">
      <div class="setting">
        <div class="left xingprofile">
          <strong><?php _e('Xing', 'stylish'); ?></strong>
          <?php _e('Enter your Xing username', 'stylish'); ?>
        </div>
        <div class="right">
          <input type="text" name="ShareXing" value="<?php echo get_option('ShareXing'); ?>" />
        </div>
        <div class="clear"></div>
      </div>
    </div>

    <!-- Youtube URL -->
    <div class="settings">
      <div class="setting">
        <div class="left youtubeprofile">
          <strong><?php _e('Youtube', 'stylish'); ?></strong>
          <?php _e('Enter your Youtube username', 'stylish'); ?>
        </div>
        <div class="right">
          <input type="text" name="ShareYoutube" value="<?php echo get_option('ShareYoutube'); ?>" />
        </div>
        <div class="clear"></div>
      </div>
    </div>
    
  </div>
  <!-- #end Social Media -->
  
  <!-- #begin Teaser Boxes -->
  <div class="settingsBox">
    <div class="setHead">
      <h3><?php _e('Front page teaser', 'stylish'); ?></h3>
      <div class="setButton">
        <input name="submitted" type="hidden" value="yes" />
        <input type="submit" name="Submit" value="<?php _e('Save', 'stylish'); ?>" />  
      </div>
      <div class="clear"></div>
    </div>
    
    <!-- Use Teaser -->
    <div class="settings">
      <div class="setting">
        <div class="left teaser">
          <strong><?php _e('Activate Teaser boxes', 'stylish'); ?></strong>
          <?php _e('Activate three customizable teaser boxes, display above the content on your front page', 'stylish'); ?>
        </div>
        <div class="right">
            <input type="checkbox" id="useteaser" name="UseTeaser" <?php if(get_option('UseTeaser')) : echo 'checked=\"checked\"'; else : echo ''; endif; ?> />
        </div>
        <div class="clear"></div>
      </div>
    </div>
    
    <div class="teaserboxes">
    
      <!-- Left Teaser -->
      <div class="settings">
        <div class="setting">
          <div class="left teaser_l">
            <strong><?php _e('Left teaser', 'stylish'); ?></strong>
            <?php _e('Settings for left front page teaser', 'stylish'); ?>
          </div>
          <div class="right">
              <input type="text" name="LeftTeaserHead" value="<?php echo get_option('LeftTeaserHead'); ?>" />
              <small><strong><?php _e('Your headline', 'stylish'); ?></strong></small>
              <?php if(get_option("UseTeaserImg")) : ?>
              <p>
                <input type="text" name="LeftTeaserImg" value="<?php echo htmlentities(get_option('LeftTeaserImg')); ?>" />
                <small><strong><?php _e('Upload your left teaser image', 'stylish'); ?> <a href="upload.php"><?php _e('here', 'stylish'); ?></a> <?php _e('and copy its URL into this box', 'stylish'); ?>. Recommended size: <?= get_option("TeaserImgWidth"); ?>px x <?= get_option("TeaserImgHeight"); ?>px</strong></small>
              </p>
              <? endif; ?>                            
              <p>
                <textarea name="LeftTeaserContent" cols="10" rows="5"><?php echo get_option('LeftTeaserContent'); ?></textarea>
                <small><strong><?php _e('Your content', 'stylish'); ?></strong></small>
              </p>
              <input type="text" name="LeftTeaserLink" value="<?php echo get_option('LeftTeaserLink'); ?>" />
              <small><strong><?php _e('Your link', 'stylish'); ?></strong></small>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      
      <!-- Middle Teaser -->
      <div class="settings">
        <div class="setting">
          <div class="left teaser_m">
            <strong><?php _e('Middle teaser', 'stylish'); ?></strong>
            <?php _e('Settings for middle front page teaser', 'stylish'); ?>
          </div>
          <div class="right">
              <input type="text" name="MiddleTeaserHead" value="<?php echo get_option('MiddleTeaserHead'); ?>" />
              <small><strong><?php _e('Your headline', 'stylish'); ?></strong></small>
              <?php if(get_option("UseTeaserImg")) : ?>
              <p>
                <input type="text" name="MiddleTeaserImg" value="<?php echo htmlentities(get_option('MiddleTeaserImg')); ?>" />
                <small><strong><?php _e('Upload your middle teaser image', 'stylish'); ?> <a href="upload.php"><?php _e('here', 'stylish'); ?></a> <?php _e('and copy its URL into this box', 'stylish'); ?></strong></small>
              </p>
              <? endif; ?>                
              <p>
                <textarea name="MiddleTeaserContent" cols="10" rows="5"><?php echo get_option('MiddleTeaserContent'); ?></textarea>
                <small><strong><?php _e('Your content', 'stylish'); ?></strong></small>
              </p>
              <input type="text" name="MiddleTeaserLink" value="<?php echo get_option('MiddleTeaserLink'); ?>" />
              <small><strong><?php _e('Your link', 'stylish'); ?></strong></small>
          </div>
          <div class="clear"></div>
        </div>
      </div>
  
      <!-- Right Teaser -->
      <div class="settings">
        <div class="setting">
          <div class="left teaser_r">
            <strong><?php _e('Right teaser', 'stylish'); ?></strong>
            <?php _e('Settings for right front page teaser', 'stylish'); ?>
          </div>
          <div class="right">
              <input type="text" name="RightTeaserHead" value="<?php echo get_option('RightTeaserHead'); ?>" />
              <small><strong><?php _e('Your headline', 'stylish'); ?></strong></small>
              <?php if(get_option("UseTeaserImg")) : ?>
              <p>
                <input type="text" name="RightTeaserImg" value="<?php echo htmlentities(get_option('RightTeaserImg')); ?>" />
                <small><strong><?php _e('Upload your right teaser image', 'stylish'); ?> <a href="upload.php"><?php _e('here', 'stylish'); ?></a> <?php _e('and copy its URL into this box', 'stylish'); ?></strong></small>
              </p>
              <?php endif; ?>                
              <p>
                <textarea name="RightTeaserContent" cols="10" rows="5"><?php echo get_option('RightTeaserContent'); ?></textarea>
                <small><strong><?php _e('Your content', 'stylish'); ?></strong></small>
              </p>
              <input type="text" name="RightTeaserLink" value="<?php echo get_option('RightTeaserLink'); ?>" />
              <small><strong><?php _e('Your link', 'stylish'); ?></strong></small>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      
    </div>
    
  </div>
  <!-- #end Teaser Boxes -->
  
  <!-- #begin Footer Settings -->
  <div class="settingsBox">
    <div class="setHead">
      <h3><?php _e('Footer settings', 'stylish'); ?></h3>
      <div class="setButton">
        <input name="submitted" type="hidden" value="yes" />
        <input type="submit" name="Submit" value="<?php _e('Save', 'stylish'); ?>" />  
      </div>
      <div class="clear"></div>
    </div>
    
    <!-- Footer About Text -->
    <div class="settings">
      <div class="setting">
        <div class="left footer">
          <strong><?php _e('Footer about text', 'stylish'); ?></strong>
          <?php _e('Informations about you, display in footer', 'stylish'); ?>
        </div>
        <div class="right">
            <input type="text" name="AboutHead" value="<?php echo get_option('AboutHead'); ?>" />
            <small><?php _e('e. g.', 'stylish'); ?>: <strong>About Us</strong></small>
            <p>
              <textarea name="AboutContent" cols="10" rows="5"><?php echo get_option('AboutContent'); ?></textarea>
              <small><?php _e('e. g.', 'stylish'); ?>: <strong>Lorem ipsum dolor</strong></small>
            </p>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    
    <!-- Footer Feeds -->
    <div class="settings">
      <div class="setting">
        <div class="left twitterprofile">
          <strong><?php _e('Activate Twitter feed', 'stylish'); ?></strong>
          <?php _e('If you entered your twitter user, you can display your last tweet in the footer', 'stylish'); ?>
        </div>
        <div class="right">
            <input type="checkbox" id="usefeed" name="TwitterFeed" <?php if(get_option('TwitterFeed') == 'on') { echo 'checked=\"checked\"'; } else { echo ''; }; ?> />
        </div>
        <div class="clear"></div>
      </div>
    </div>
                
  </div>
  <!-- #end Footer Settings -->

  <!-- #begin ST info DO NOT DELETE -->  
  <div id="st-info" class="settingsBox">
    <div class="setHead">
      <h3><?php _e('Stylish Templates', 'stylish'); ?> </h3>
    <div class="clear"></div>
  </div>
  
  <div class="settings">    
    <div class="setting">
      <div class="left buy">
        <strong><?php _e('Buy this theme', 'stylish'); ?></strong>
        <?php _e('Buy this theme and get rid of sponsor links', 'stylish'); ?>      
      </div>
      <div class="right">
        <p><a href="http://www.stylish-templates.de/templates-kaufen?utm_medium=Themes&utm_content=Themesettings" title="" target="_blank"><?php _e('Buy this Wordpress theme', 'stylish'); ?></a></p>
      </div>
      <div class="clear"></div>      
    </div>
    
    <div class="setting">
      <div class="left news">
        <strong><?php _e('Newsletter', 'stylish'); ?></strong>
        <?php _e('Sign up for our newsletter to get updates for our themes', 'stylish'); ?>      
      </div>
      <div class="right">
        <p><a href="http://www.stylish-templates.de/newsletter?utm_medium=Themes&utm_content=Themesettings" title="" target="_blank"><?php _e('Sign up for our newsletter', 'stylish'); ?></a></p>
      </div>
      <div class="clear"></div>      
    </div>
          
    <div class="setting">
      <div class="left bug">
        <strong><?php _e('Report a bug', 'stylish'); ?></strong>
        <?php _e('Found a bug? Let us know! Please include informations about your browser', 'stylish'); ?>       
      </div>
      <div class="right">
        <p><a href="http://www.stylish-templates.de/bug-reporting?utm_medium=Themes&utm_content=Themesettings" title="" target="_blank"><?php _e('Report a bug in this theme', 'stylish'); ?></a></p>
      </div>
      <div class="clear"></div>      
    </div>
  
    <div class="setting">
      <div class="left license">
        <strong><?php _e('Terms of License', 'stylish'); ?></strong>
        <?php _e('Please read our licensing terms before using this Wordpress theme', 'stylish'); ?>
      </div>
      <div class="right">
        <p><a href="<?php _e('http://www.stylish-templates.de/lizenzbedingungen?utm_medium=Themes&utm_content=Themesettings', 'stylish'); ?>" target="_blank"><?php _e('Stylish Templates Theme License', 'stylish'); ?></a></p>
      </div>
      <div class="clear"></div>      
    </div>
  </div>
  <!-- #end ST info DO NOT DELETE -->
    
<?php 
}

function settingsPage_display() { // Adds Dashboard Menu Item
  add_menu_page('Stylish Templates Settings', 'Stylish Templates Settings', 'edit_themes', __FILE__, 'settingsPage');
}

function stylish_options() {
  $cssurl = get_bloginfo('stylesheet_directory') . '/options/css/st-theme-options.css';
  $jsurl = get_bloginfo('stylesheet_directory') . '/options/js/st-theme-options.js';
  echo '<link rel="stylesheet" type="text/css" href="' . $cssurl . '" />';
  echo '<script type="text/javascript" src="' . $jsurl . '"></script>';  
}

add_action('admin_head', 'stylish_options');

?>
<?php 

 if($status < 1){
 	/*public*/
 	?>
 	<div class="pull-left"><jdoc:include type="modules" name="topmenu" style="custom"/></div>
     <?php 
      if ($this->countModules( 'Login' )) { ?>  
        <div class="bt_login pull-left" id="loginbtn">  
         		<jdoc:include type="modules" name="Login"/>  
        </div>  
     <?php } ?>  
 	<?php

 }else{
 ?>
 	<div id="btl">  
     <!-- Panel top -->  
     <div class="pull-left"><jdoc:include type="modules" name="innertop" style="xhtml"/> </div>
     <div class="navbar pull-right">  
          <!-- menu -->
           <ul class="nav nav-tabs">
            <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span id="btl-panel-profile" class="btl-dropdown">
                    <?php

                    if (!class_exists('OSMembershipController')) {
                      JLoader::register('OSMembershipHelper', JPATH_SITE.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_osmembership'.DIRECTORY_SEPARATOR.'helper'.DIRECTORY_SEPARATOR.'helper.php');
                    }

                    $avatar = OSMembershipHelper::getAvatar();

                    if($avatar){
                      ?>
                      <img class="profile-avatar-h" src="<?php echo $avatar?>">
                      <?php
                    }
              
                    if($user->name) : {
                      echo $user->name;
                    } else : {
                      echo $user->username;
                    } endif;
                    ?>
                  </span> 
                  <span class="caret"></span>
              </a>
              <?php $returnURL = base64_encode(JURI::root() . ""); ?>
              <ul class="dropdown-menu">
                <li>
                    <a href="<?php echo JURI::root(); ?>index.php?option=com_users&task=user.logout&<?php echo JSession::getFormToken(); ?>=1&return=<?php echo $returnURL; ?>">
                    <input  type="button" name="Submit" class="button" value="Logout">
                    </a>
                </li>

              </ul>
            </li>
          </ul>
     </div>  
     <!-- content dropdown/modal box -->  
     <div class="clear"></div>  
   </div> 
 <?php
 }

?>
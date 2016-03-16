<?php
include('header.php');
include('vendor/autoload.php');

$siteKey = '';
$secret = '';

$lang = 'en';

$recaptcha = new \ReCaptcha\ReCaptcha($secret);

?>
<div class="grid_10">
  <div class="grid ">
    <h2 class="h2">CoBUG Membership</h2>
    <hr size="1" class="hr"/>
    <p class="p">Membership is open to absolutely anyone and affords you access to the official CoBUG XMPP server and the chance to win sweet prizes!
    </p>
    <h3 class="h3">Membership Form</h3>
	<input type="text" class="form wfid_fname textbox" placeholder="First Name" value=""/><br class="br"/>
	<input type="text" class="form wfid_lname textbox" placeholder="Last Name" value=""/><br class="br"/>
	<input type="text" class="form wfid_nname textbox" placeholder="Nick Name (IRC name?)" value=""/> * This will be your XMPP account name if you choose to create one.<br class="br"/>
	<input type="text" class="form wfid_email textbox" placeholder="Email" value=""/><br class="br"/>
	<input type="text" class="form wfid_emailconf textbox" placeholder="Confirm Email" value=""/><br class="br"/>
	<label for=""><input id="" type="checkbox" class="wfid_createxmpp checkbox" value="on" checked="checked"/>Create XMPP account?</label><br class="br"/>
	<label for=""><input id="" type="checkbox" class="wfid_isco checkbox" value="on" checked="checked"/>Do you currently live in Colorado?</label><br class="br"/>
	<label for=""><input id="" type="checkbox" class="wfid_reminders checkbox" value="on"/>Subscribe me to the &#39;announce@&#39; mailing list!</label><br class="br"/>
<?php
?>
      <p class="p"style="clear:both"></p>
    </div><br class="br"/><br class="br"/>
<?php
include('footer.php');
?>

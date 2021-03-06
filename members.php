<?php
include('header.php');
include('vendor/autoload.php');
include('secrets.php');

$constr = sprintf('pgsql:user=%s dbname=%s password=%s host=%s', $db['user'], $db['name'], $db['pass'], $db['server']);

function checkUser($user, $cstr) {
    $dbh = new PDO($cstr);

    $sth = $dbh->prepare("select * from members where username = ?");
    $sth->execute(array($user));
    $exists = $sth->fetchAll();

    return $exists;
}

function insertUser($u, $cstr) {
    $dbh = new PDO($cstr);

    $sth = $dbh->prepare("insert into user_queue (username, email, fname, lname, wants_xmpp, announce, native) values (?, ?, ?, ?, ?, ?, ?)");
    $sth->execute(array($u['nick'], $u['email'], $u['fname'], $u['lname'], $u['xmpp'], $u['sub'], $u['native']));
}

$lang = 'en';
$post = array();
$invalid = false;
$exists = false;

if (isset($_POST['g-recaptcha-response'])) {

    $saniDefs = array(
	'fname' => FILTER_SANITIZE_STRING,
	'lname' => FILTER_SANITIZE_STRING,
	'nick' => FILTER_SANITIZE_STRING,
	'email' => FILTER_SANITIZE_EMAIL,
	'email2' => FILTER_SANITIZE_EMAIL,
	'g-recaptcha-response' => FILTER_SANITIZE_STRING
    );
    $validDefs = array(
	'email' => FILTER_VALIDATE_EMAIL,
	'email2' => FILTER_VALIDATE_EMAIL
    );

    $post = filter_var_array($_POST, $saniDefs);

    $post['xmpp'] = isset($_POST['xmpp']) && $_POST['xmpp']  ? 1 : 0;
    $post['native'] = isset($_POST['native']) && $_POST['native']  ? 1 : 0;
    $post['sub'] = isset($_POST['sub']) && $_POST['sub']  ? 1 : 0;

    $valids = filter_var_array($post, $validDefs);

    if(in_array(null, $valids, false)) {
	$invalid = true;
    }

    if ($post['email'] != $post['email2']) {
	$invalid = true;
    }

    if (checkUser($post['nick'], $constr)) {
	$invalid = true;
	$exists = true;
    }

    if (! $invalid && ! $exists) {
	insertUser($post, $constr);

	curl_setopt_array($ch = curl_init(), array(
	    CURLOPT_URL => "https://api.pushover.net/1/messages.json",
	    CURLOPT_RETURNTRANSFER => TRUE,
	    CURLOPT_POSTFIELDS => array(
		"token" => $pushoverToken,
		"user" => $pushoverUser,
		"message" => sprintf('New member: %s', $post['fname']),
	    ),
	    CURLOPT_SAFE_UPLOAD => true,
	));

	curl_exec($ch);
	curl_close($ch);
    }
}

?>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang; ?>"></script>
<div class="grid_10">
    <div class="grid ">
	<h2 class="h2">CoBUG Membership</h2>
	<?php
	if (isset($post['g-recaptcha-response']) && ($invalid == false)):
        $recaptcha = new \ReCaptcha\ReCaptcha($captchaSecret);

	$resp = $recaptcha->verify($post['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
	if ($resp->isSuccess()):
	?>
	    <h2>Success!</h2>
	    <?php
	    ;
	    ?>
	    Thanks <?php echo $post['fname']; ?>! Please check your email (<?php echo $post['email']; ?>) for further instructions!
        <?php
	else:
	// If it's not successful, then one or more error codes will be returned.
	?>
	    <b>Something went wrong</b>
	    <p><a href="/members.php">Try again</a></p>
    <?php
    endif;
    else:
    ?>
    <hr size="1" class="hr"/>
    <p class="p">Membership is open to absolutely anyone and affords you access to the official CoBUG XMPP server and the chance to win sweet prizes!
    </p>
    <h3 class="h3">Membership Form</h3>
    <form action="/members.php" method="post">
	<input type="text" name="fname" class="form wfid_fname textbox" placeholder="First Name" value="<?php if ($invalid) { echo $post['fname']; } ?>"/><br class="br"/>
	<input type="text" name="lname" class="form wfid_lname textbox" placeholder="Last Name" value="<?php if ($invalid) { echo $post['lname']; } ?>"/><br class="br"/>
	<?php
	$pholder = "Nick Name (IRC name?)";
	if ($exists) {
	    $pholder = "Nick already exists!";
	}
	?>
	<input type="text" name="nick" class="form wfid_nname textbox <?php if ($exists) { echo "exists"; } ?>" placeholder="<?php echo $pholder; ?>" value="<?php if ($invalid && !$exists) { echo $post['nick']; } ?>"/> * This will be your XMPP account name if you choose to create one.<br class="br"/>
	<input type="text" name="email" class="form wfid_email textbox <?php if ($invalid && !$exists) { echo 'invalid'; } ?>" placeholder="Email" value="<?php if ($invalid) { echo $post['email']; } ?>"/><br class="br"/>
	<input type="text" name="email2" class="form wfid_emailconf textbox <?php if ($invalid && !$exists) { echo 'invalid'; } ?>" placeholder="Confirm Email" value="<?php if ($invalid) { echo $post['email2']; } ?>"/><br class="br"/>
	<label for=""><input id="" name="xmpp" type="checkbox" class="wfid_createxmpp checkbox" value="1" checked="checked"/>Create XMPP account?</label><br class="br"/>
	<label for=""><input id="" name="native" type="checkbox" class="wfid_isco checkbox" value="1" checked="checked"/>Do you currently live in Colorado?</label><br class="br"/>
	<label for=""><input id="" name="sub" type="checkbox" class="wfid_reminders checkbox" value="1"/>Subscribe me to the &#39;announce@&#39; mailing list!</label><br class="br"/>
	<p class="p"style="clear:both"></p>
	<div class="g-recaptcha" data-sitekey="<?php echo $captchaKey; ?>"></div>

	<p><input type="submit" value="Submit" /></p>
    </form>
    <p>
    </div><br class="br"/><br class="br"/>
	<?php endif;
	?>


	<?php
	include('footer.php');
	?>

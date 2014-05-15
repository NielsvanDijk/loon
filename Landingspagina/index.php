<?php
	
	include_once dirname(__FILE__).'/includes/config.inc.php';
	include_once dirname(__FILE__).'/includes/functions.inc.php';
	include_once dirname(__FILE__).'/includes/translations.inc.php';

	if (false === ($mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS))) {
		die(sprintf('Er is een fout opgetreden tijdens het connecten met de server (%s, %s', mysqli_connect_errno(), mysqli_connect_error()));
	} else if (false === mysqli_select_db($mysqli, DB_NAME)) {
		die(sprintf('Er is een fout opgetreden tijdens het selecteren van de database (%s, %s', mysqli_connect_errno($mysqli), mysqli_connect_error($mysqli)));
	}
	
	$errors 	= array();
	$succes 	= array();
	$values 	= array('nationality' => LANG, 'nationality-else' => '', 'email' => '');
	
	switch ($_SERVER['REQUEST_METHOD']) {
		case 'POST':
			$values = array_merge($values, $_POST);
	
			if (empty($values['nationality'])) {
				$errors['nationality'] = $lexicons['form.error_empty'];
			} else if ('else' == $values['nationality'] && empty($values['nationality-else'])) {
				$errors['nationality-else'] = $lexicons['form.error_empty'];
			}
			
			if ('else' != $values['nationality']) {
				$values['nationality-else'] = '';
			}
			
			if (empty($values['email'])) {
				$errors['email'] = $lexicons['form.error_empty'];
			} else if (false === filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = $lexicons['form.error_invalid_email'];
			}
	
			if (0 == count($errors)) {
				$postValues = escapeVars($values, $mysqli);
	
				if (false === ($query = mysqli_query($mysqli, 'SELECT id FROM subscriptions WHERE email = "'.$postValues['email'].'"'))) {
					$errors['form'] = $lexicons['form.error_subscription'];
				} else if (0 < mysqli_num_rows($query)) {
					$errors['form'] = $lexicons['form.error_email_exists'];
				} else {
					if (false === ($query = mysqli_query($mysqli, 'INSERT INTO subscriptions SET lang = "'.LANG.'", nationality = "'.$postValues['nationality'].'", nationality_else = "'.$postValues['nationality-else'].'", email = "'.$postValues['email'].'"'))) {
						$errors['form'] = $lexicons['form.error_subscription'];
					} else {
						$succes['form'] = $lexicons['form.succes'];
						
						include_once dirname(__FILE__).'/includes/phpmailer/phpmailer.class.php';
						
						$title = str_replace('%site_name%', SITE_NAME, $lexicons['email.title']);
						$content = file_get_contents(dirname(__FILE__).'/mail.tpl');
						
						$content = str_replace(array('%title%', '%content%'), array($title, parseUBB($lexicons['email.content'])), $content);
						$content = str_replace(array('%site_url%', '%link%', '%site_name%'), array(SITE_URL, sprintf('%s?lang=%s&email=%s', SITE_URL, LANG, $values['email']), SITE_NAME), $content);
						
						$mail = new PHPMailer();

						$mail->Subject = $title;
						
						$mail->SetFrom(SITE_EMAIL, SITE_NAME);
						$mail->MsgHTML($content);
						$mail->AddAddress($values['email'], $values['email']);
						
						$mail->Send();
					}
				}
			}
		
			break;
		case 'GET':
			if (isset($_GET['email'])) {
				$getValues = escapeVars($_GET, $mysqli);
				
				if (false === ($query = mysqli_query($mysqli, 'SELECT id FROM subscriptions WHERE email = "'.$getValues['email'].'"'))) {
					$errors['form'] = $lexicons['form.error_subscription'];
				} else if (0 == mysqli_num_rows($query)) {
					$errors['form'] = $lexicons['form.error_email_not_existing'];
				} else {
					if (false === ($query = mysqli_query($mysqli, 'UPDATE subscriptions SET active = "1" WHERE email = "'.$getValues['email'].'"'))) {
						$errors['form'] = $lexicons['form.error_subscription'];
					} else {
						$succes['form'] = $lexicons['form.succes_subscription'];
					}
				}
			}
			
			break;
	}

?>
	
	<!doctype html>
	<html lang="nl" class="no-js">
		<head>
			<meta charset="utf-8" /> 
			<title><?php echo $lexicons['title']; ?></title> 
			<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
			<meta name="description" content="" />
			
			<!-- Live gang dit wijzigen -->
			<meta name="robots" content="noindex, nofollow" />
	
			<!--
			<meta property="og:title" content="" />
			<meta property="og:image" content="" />
			<meta property="og:site_name" content="" />
			<meta property="og:description" content="" />
			
			<meta name="twitter:card" content="summary" />
			<meta name="twitter:url" content="" />
			<meta name="twitter:title" content="" />
			<meta name="twitter:description" content="" />
			<meta name="twitter:image" content="" />
			-->
			
			<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Sanchez:400,400italic|Source+Sans+Pro:400,700" />
			<link rel="stylesheet" href="assets/interface/css/main.css" />
			<link rel="stylesheet" href="assets/interface/css/responsive.css" />
			
			<link rel="shortcut icon" type="image/ico" href="assets/interface/images/favicon.png" />
			<link rel="apple-touch-icon" sizes="152x152" href="assets/interface/images/152x152.png" />
		</head>
		
		<body>
			<ul class="languages">
			
				<?php
				
					foreach (array('nl', 'en', 'de', 'pl') as $language) {
						echo sprintf('<li class="%s"><a href="?lang=%s" title="%s">%s</a></li>', trim($language.' '.($language == LANG ? 'active' : '')), $language, $lexicons['lang_'.$language], $lexicons['lang_'.$language]);
					}
					
				?>
				
			</ul>
			<div class="landings-page">
				<div class="landings-page-inner">
					<h1><?php echo $lexicons['title']; ?></h1>
					<p><?php echo parseUBB($lexicons['content']); ?></p>
					
					<?php
					
						if (isset($succes['form'])) {
							echo sprintf('<p class="form-succes-desc">%s</p>', $succes['form']);
						} else {
							if (isset($errors['form'])) {
								echo sprintf('<p class="form-error-desc">%s</p>', $errors['form']);
							}
							
					?>
					
						<form action="" method="post" name="subscribe" class="form-no-labels">
							<div class="form-element <?php echo isset($errors['nationality']) ? 'error' : ''; ?>">
								<label for="nationality"><?php echo $lexicons['form.label_nationality']; ?></label>
								<div class="form-element-container">
									<select name="nationality" id="nationality">
										
										<?php
										
											foreach (array('', 'bu', 'cz', 'ee', 'gr', 'lv', 'lt', 'hu', 'nl', 'pl', 'ro', 'sl', 'sk', 'else') as $language) {
												echo sprintf('<option value="%s" %s>%s</option>', $language, $language == $values['nationality'] ? 'selected="selected"' : '', $lexicons['nationality_'.$language]);
											}
											
										?>
							
									</select>
									<?php echo isset($errors['nationality']) ? sprintf('<span class="error-desc">%s</span>', $errors['nationality']) : ''; ?>
								</div>
							</div>
							<div class="form-element form-element-hide <?php echo isset($errors['nationality-else']) ? 'error' : ''; ?>">
								<label for="nationality-else"><?php echo $lexicons['form.label_nationality_namely']; ?></label>
								<div class="form-element-container">
									<input type="text" name="nationality-else" id="nationality-else" placeholder="<?php echo $lexicons['form.label_nationality_namely']; ?>" value="<?php echo $values['nationality-else']; ?>" />
									<?php echo isset($errors['nationality-else']) ? sprintf('<span class="error-desc">%s</span>', $errors['nationality-else']) : ''; ?>
								</div>
							</div>
							<div class="form-element <?php echo isset($errors['email']) ? 'error' : ''; ?>">
								<label for="email"><?php echo $lexicons['form.label_email']; ?></label>
								<div class="form-element-container">
									<input type="text" name="email" id="email" placeholder="<?php echo $lexicons['form.label_email']; ?>" value="<?php echo $values['email']; ?>" />
									<?php echo isset($errors['email']) ? sprintf('<span class="error-desc">%s</span>', $errors['email']) : ''; ?>
								</div>
							</div>
							<div class="form-element">
								<div class="form-element-container">
									<button type="submit" name="submit" title="<?php echo $lexicons['form.label_submit']; ?>"><?php echo $lexicons['form.label_submit']; ?></button>
								</div>
							</div>
						</form>
						<p class="contact"><?php echo str_replace('%site_contact%', SITE_CONTACT, parseUBB($lexicons['contact'])); ?></p>
						
					<?php
						}
					?>

				</div>
			</div>
			
			<ul class="banners">
				<li><a href="http://www.nhl.nl" target="_blank" title="NHL"><img src="assets/interface/images/logo-nhl.png" alt="NHL" /></a></li>
				<li><a href="http://www.caop.nl" target="_blank" title="CAOP"><img src="assets/interface/images/logo-caop.png" alt="CAOP" /></a></li>
				<li><a href="http://www.abu.nl" target="_blank" title="De Abu"><img src="assets/interface/images/logo-abu.png" alt="De Abu" /></a></li>
			</ul>
			
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
			<script type="text/javascript" src="assets/interface/javascript/jquery.functions.js"></script>
		</body>
	</html>
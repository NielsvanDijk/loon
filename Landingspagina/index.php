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
	$values 	= array('lang' => LANG, 'email'	=> '');
	$languages 	= array('nl', 'en', 'de', 'pl');
	
	switch ($_SERVER['REQUEST_METHOD']) {
		case 'POST':
			$values = array_merge($values, $_POST);
	
			if (empty($values['lang'])) {
				$errors['lang'] = $lexicons['form.error_empty'];
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
					if (false === ($query = mysqli_query($mysqli, 'INSERT INTO subscriptions SET language = "'.$postValues['lang'].'", email = "'.$postValues['email'].'"'))) {
						$errors['form'] = $lexicons['form.error_subscription'];
					} else {
						$succes['form'] = $lexicons['form.succes'];
						
						include_once dirname(__FILE__).'/includes/phpmailer/phpmailer.class.php';
						
						$title = str_replace('%site_name%', SITE_NAME, $lexicons['email.title']);
						$content = file_get_contents(dirname(__FILE__).'/mail.tpl');
						
						$content = str_replace(array('%title%', '%content%'), array($title, parseUBB($lexicons['email.content'])), $content);
						$content = str_replace(array('%site_url%', '%link%', '%site_name%'), array(SITE_URL, sprintf('%s?lang=%s&email=%s', SITE_URL, $values['lang'], $values['email']), SITE_NAME), $content);
						
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
			
			<link rel="stylesheet" href="assets/interface/css/main.css" />
			
			<link rel="shortcut icon" type="image/ico" href="assets/interface/images/favicon.png" />
			<link rel="apple-touch-icon" sizes="152x152" href="assets/interface/images/152x152.png" />
		</head>
		
		<body>
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
							<div class="form-element <?php echo isset($errors['lang']) ? 'error' : ''; ?>">
								<label for="lang"><?php echo $lexicons['form.label_lang']; ?></label>
								<div class="form-element-container">
									<select name="lang" id="lang">
										
										<?php
										
											foreach (array_merge(array(''), $languages) as $language) {
												echo sprintf('<option value="%s" %s>%s</option>', $language, $language == $values['lang'] ? 'selected="selected"' : '', $lexicons['lang_'.$language]);
											}
											
										?>
							
									</select>
									<?php echo isset($errors['lang']) ? sprintf('<span class="error-desc">%s</span>', $errors['lang']) : ''; ?>
								</div>
							</div>
							<div class="form-element form-element-last <?php echo isset($errors['email']) ? 'error' : ''; ?>">
								<label for="email"><?php echo $lexicons['form.label_email']; ?></label>
								<div class="form-element-container">
									<input type="text" name="email" id="email" placeholder="<?php echo $lexicons['form.label_email']; ?>" value="<?php echo $values['email']; ?>" />
									<?php echo isset($errors['email']) ? sprintf('<span class="error-desc">%s</span>', $errors['email']) : ''; ?>
								</div>
							</div>
							<div class="form-element form-element-button">
								<div class="form-element-container">
									<button type="submit" name="submit" title="<?php echo $lexicons['form.label_submit']; ?>"><?php echo $lexicons['form.label_submit']; ?></button>
								</div>
							</div>
						</form>
						
					<?php
						}
					?>
					
					<ul class="languages">
					
						<?php
						
							foreach ($languages as $language) {
								echo sprintf('<li class="%s"><a href="?lang=%s" title="%s">%s</a></li>', trim($language.' '.($language == LANG ? 'active' : '')), $language, $lexicons['lang_'.$language], $lexicons['lang_'.$language]);
							}
							
						?>
						
					</ul>
				</div>
			</div>
		</body>
	</html>
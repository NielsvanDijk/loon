<?php

	$lexicons = array(
		'nationality_'					=> 'Your country of origin',
		'nationality_bu'				=> 'България',
		'nationality_cz'				=> 'Česká republika',
		'nationality_ee'				=> 'Eesti',
		'nationality_gr'				=> 'Ελλάδα',
		'nationality_lv'				=> 'Latvija',
		'nationality_lt'				=> 'Lietuva',
		'nationality_hu'				=> 'Magyarország',
		'nationality_nl'				=> 'Nederland',
		'nationality_pl'				=> 'Polska',
		'nationality_ro'				=> 'România',
		'nationality_sl'				=> 'Slovenija',
		'nationality_sk'				=> 'Slovensko',
		'nationality_else'				=> 'Else',
		'lang_de'						=> 'Deutsch',
		'lang_en'						=> 'English',
		'lang_nl'						=> 'Nederlands',
		'lang_pl'						=> 'Polski',
		'title'							=> 'Landingspage',
		'content'						=> 'Lorem Ipsum is simply dummy text of the printing industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled',
		'contact'						=> 'Heb je vragen? Neem contact op met [url=mailto:%site_contact%]%site_contact%[url]',
		'form.label_nationality'		=> 'Your country of origin',
		'form.label_nationality_namely'	=> 'Namely',
		'form.label_email'				=> 'Youre e-mailaddress',
		'form.label_submit'				=> 'Subscibe',
		'form.error_empty'				=> 'This field is required',
		'form.error_invalid_email'		=> 'This field does not contain a valid e-mailaddress',
		'form.error_email_exists'		=> 'Er is al een inschrijving met dit e-mailadres, er is een nieuwe e-mail met een bevestigingslink gestuurd.',
		'form.error_email_not_existing'	=> 'Er is geen e-mailadres gevonden om te bevestigen, probeer het nog eens.',
		'form.error_subscription'		=> 'Er is een fout opgetreden tijdens het inschrijven, probeer het nog eens.',
		'form.succes'					=> 'Uw e-mailadres is ingeschreven, om uw inschrijving compleet te maken moet u uw e-mailadres nog <strong>bevestigen</strong> door op de bevestigingslink te klikken die u toe gestuurd is via e-mail.',	
		'form.succes_subscription'		=> 'Uw e-mailadres is bevestigd en uw inschrijving is nu voldaan.',
		'email.title'					=> 'Bevestig uw e-mail inschrijving op %site_name%',
		'email.content'					=> '[p]Om uw e-mail inschrijving op [url=%site_url%]%site_name%[url] te voldoen dient u nog op de volgende [url=%link%]link[url] te klikken.[p][p]Werkt deze link niet? Kopieer en plak de volgende volgende link dan in je webbrowser adresbalk[br][br][url=%link%]%link%[url][p][p]Met vriendelijke groet,[br]%site_name%[p]'
	);

	switch (LANG) {
		case 'pl':
			$lexicons = array_merge($lexicons, array(
				'nationality_'					=> 'Twój kraj pochodzenia',
				'nationality_else'				=> 'Inaczej',
				'title'							=> 'Strona docelowa',
				'content'						=> 'Lorem Ipsum jest po prostu obojętne tekst i skład przemysłu poligraficznego. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled',
				'form.label_nationality'		=> 'Twój kraj pochodzenia',
				'form.label_nationality_namely'	=> 'Mianowicie',
				'form.label_email'				=> 'Twój adres e-mail',
				'form.label_submit'				=> 'Zarejestrować',
				'form.error_empty'				=> 'Pole to jest konieczne',
				'form.error_invalid_email'		=> 'To pole nie posiada ważnego adresu e-mail'
			));
			
			break;
		case 'de':
			$lexicons = array_merge($lexicons, array(
				'nationality_'					=> 'Ihr Herkunftsland',
				'nationality_else'				=> 'Sonst',
				'title'							=> 'Landing Page',
				'content'						=> 'Lorem Ipsum ist einfach Dummy-Text der Druck und Satz Industrie. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled',
				'form.label_nationality'		=> 'Ihr Herkunftsland',
				'form.label_nationality_namely'	=> 'Nämlich',
				'form.label_email'				=> 'Ihre E-Mail-Adresse',
				'form.label_submit'				=> 'Registrieren',
				'form.error_empty'				=> 'Dieses Feld ist erforderlich',
				'form.error_invalid_email'		=> 'Dieses Feld enthält keine gültige E-Mail-Adresse'
			));
			
			break;
		case 'nl':
			$lexicons = array_merge($lexicons, array(
				'nationality_'					=> 'Uw land van herkomst',
				'nationality_else'				=> 'Anders',
				'title'							=> 'Meld je nu aan voor de beta en help ons het product te verbeteren',
				'content'						=> 'Lorem Ipsum is simpele dummy tekst van de druk industrie. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled',
				'form.label_nationality'		=> 'Uw land van herkomst',
				'form.label_nationality_namely'	=> 'Namelijk',
				'form.label_email'				=> 'Uw e-mailadres',
				'form.label_submit'				=> 'Houd mij op de hoogte',
				'form.error_empty'				=> 'Dit veld is verplicht',
				'form.error_invalid_email'		=> 'Dit veld heeft geen geldig e-mailadres',
				'form.error_email_exists'		=> 'Er is al een inschrijving met dit e-mailadres, er is een nieuwe e-mail met een bevestigingslink gestuurd.',
				'form.error_email_not_existing'	=> 'Er is geen e-mailadres gevonden om te bevestigen, probeer het nog eens.',
				'form.error_subscription'		=> 'Er is een fout opgetreden tijdens het inschrijven, probeer het nog eens.',
				'form.succes'					=> 'Uw e-mailadres is ingeschreven, om uw inschrijving compleet te maken moet u uw e-mailadres nog <strong>bevestigen</strong> door op de bevestigingslink te klikken die u toe gestuurd is via e-mail.',
				'form.succes_subscription'		=> 'Uw e-mailadres is bevestigd en uw inschrijving is nu voldaan.',
				'email.title'					=> 'Bevestig uw e-mail inschrijving op %site_name%',
				'email.content'					=> '[p]Om uw e-mail inschrijving op [url=%site_url%]%site_name%[url] te voldoen dient u nog op de volgende [url=%link%]link[url] te klikken.[p][p]Werkt deze link niet? Kopieer en plak de volgende volgende link dan in je webbrowser adresbalk[br][br][url=%link%]%link%[url][p][p]Met vriendelijke groet,[br]%site_name%[p]'
			));
			
			break;
	}

?>
<?php

//if (!isset($_POST['url'])) exit;

include('sendgrid-php/SendGrid_loader.php');
$sendgrid = new SendGrid('','');



//Data collection - Put the values receieved here
$submittedEmail = strip_tags(trim($_POST["email"]));
$submittedEmail = addslashes($submittedEmail);


$submittedDailyMatches = strip_tags(trim($_POST["daily-matches"]));
$submittedDailyMatches = addslashes($submittedDailyMatches);

$submittedWeeklyMatches = strip_tags(trim($_POST["weekly-matches"]));
$submittedWeeklyMatches = addslashes($submittedWeeklyMatches);


$dailyMatchesArray = explode(",", $submittedDailyMatches);
$weeklyMatchesArray  = explode(",", $submittedWeeklyMatches);

if(strlen($submittedEmail)>5) { //Only send if an email address has been provided
	sendEmail($submittedEmail, $dailyMatchesArray, $weeklyMatchesArray);
}






function sendEmail($toEmail, $dailyArray, $weeklyArray) {
  $sendgrid = new SendGrid('','');

  $mail = new SendGrid\Mail();
  $from_name = 'Bioré® Skincare';
  $from_email = 'noreply@biore.co.uk';
  $to_email = $toEmail;

  //These will contain the outputted HTML for each section.
  $dailyHTML = "";
  $weeklyHTML = "";

  $template = file('cleanskinplan-min.html');
  $htmlMessage =  $template[0];

	foreach ($dailyArray as &$value) {
	   $dailyHTML .= generateProductSectionHTML($value);
	}

	foreach ($weeklyArray as &$value) {
	   $weeklyHTML .= generateProductSectionHTML($value);
	}

	$htmlMessage = str_replace("[daily-html]", $dailyHTML, $htmlMessage);
	$htmlMessage = str_replace("[weekly-html]", $weeklyHTML, $htmlMessage);

	$plainMessage = "Your Clean Skin Plan.";

	$mail->setFrom($from_email)->setFromName($from_name)->setReplyTo($from_email);

	// Custom unsubscribe link
	$mail->addFilterSetting('subscriptiontrack', 'enable', 1);
	$mail->addFilterSetting('subscriptiontrack', 'text/html', "If you don't want to receive any more emails, you can <%block them%>.");

	$mail->addTo($to_email);

	$mail->setSubject('Your Clean Skin Plan')->
	setHTML(nl2br($htmlMessage))->
	setText($plainMessage);

	$response = $sendgrid->smtp->send($mail);

}


function generateProductSectionHTML($productID){

	switch($productID) {
		case 0:
			$name = "Bioré Charcoal Anti Blemish Cleanser";
			$blurb = "<span style='font-family:Arial, sans-serif;font-size:16px; line-height: 19px; color:#000000; text-align: left'>Daily anti-spots cleanser with natural charcoal to absorb excess oil and clear breakouts for clearer skin in just 2 days.</span>";
			$description = "<span>Skin acting up? Meet Charcoal. This daily charcoal anti-blemish cleanser with Salicylic Acid deep cleans and penetrates pores to absorb oil and help stop breakouts.</span><ul style='margin-bottom:0;padding-bottom:0;'><li>With Salicylic Acid</li><li>Dermatologist tested</li><li>Hypoallergenic</li><li>Non-comedogenic</li></ul>";
			$howToUse = "<p>Wet face. Pump product into hands, massaging over entire face and neck. Rinse thoroughly. For optimal results, use daily.</p>";
			$whenToUse = "Daily";
			$image = "charcoal-anti-blemish-cleanser.jpg"; 
			$link = "https://www.superdrug.com/Skin/Face/Cleansers/Bior%C3%A9-Charcoal-Anti-Blemish-Cleanser-200ml/p/759719";
		break;
		case 1:
			$name = "Charcoal Anti Blemish Scrub";
			$blurb = "<span style='font-family:Arial, sans-serif;font-size:16px; line-height: 19px; color:#000000; text-align: left'>Gently exfoliates & absorbs oil for clearer skin in just 2 days.</span>";
			$description = "<p>Formulated with natural charcoal and 2% Salicylic Acid, this power scrub exfoliates away blemish causing dirt and absorbs excess oil to help eliminate breakouts for clearer skin in just 2 days!</p><ul style='margin-bottom:0;padding-bottom:0;'><li>With Salicylic Acid</li><li>Dermatologist Tested</li><li>Hypoallergenic</li><li>Non-Comedogenic</li></ul>";
			$howToUse = "<p>Wet face. Squeeze product into hands. Gently massage over entire face. Rinse thoroughly.</p><p>CAUTION: Avoid eye contact. If contact occurs, rinse thoroughly with water.</p>";
			$whenToUse = "For optimal results, use 2 – 3 times per week.";
			$image = "charcoal-antiblemish-scrub.jpg"; 
			$link = "https://amzn.to/2HoeDsp";
		
		break;
		case 2:
			$name = "Deep Cleansing Charcoal Pore Strips";
			$blurb = "<span style='font-family:Arial, sans-serif;font-size:16px; line-height: 19px; color:#000000; text-align: left'>Unclogs pores & draws out excess oil forthe deepest clean</span>";
			$description = "<p>These pore strips work like a magnet, instantly locking onto and drawing out deep-down dirt & oil that can cause blackheads. Infused with natural charcoal, known for its ability to draw out and trap deep-down impurities, these pore strips draw out excess oil for the deepest clean. In just 10 minutes, you'll remove a week's worth of dirt build-up and see 3x less oil.</p>";
			$howToUse = "<ol style='margin-bottom:0;padding-bottom:0;'><li>Remove strip from pouch. Twist strip to loosen and separate slits prior to use (see illustration).</li><li>After washing your face, thoroughly wet your nose. The strip won't stick on a dry nose.</li><li>Dry hands. Peel strip off plastic liner. Apply to nose area, smooth side down, pressing down to ensure good contact with skin.</li><li>Let dry for about 10-15 minutes until stiff to the touch – like papier-mâché.</li><li>Slowly and carefully peel off starting at edges, pulling toward centre. Any residue left on skin is easily removed with rinsing.</li></ol>";
			$whenToUse = "Once a week";
			$image = "charcoal-pore-strips.jpg"; 
			$link = "https://amzn.to/2GNoUBl";
		
		break;
		case 3:
			$name = "Deep Pore Charcoal Cleanser";
			$blurb = "<span style='font-family:Arial, sans-serif;font-size:16px; line-height: 19px; color:#000000; text-align: left'>Deep cleans 2x better & naturally purifies.</span>";
			$description = "<p>Meet our secret weapon for fighting clogged pores. Draw out and trap 2x more dirt and impurities than a basic cleanser with this black cleanser that foams white and rinses clean. Infused with Japanese Skin Purifying Technology, this facial cleanser gives you results after just one use!</p><ul style='margin-bottom:0;padding-bottom:0;'><li>Oil-Free</li><li>Dermatologist Tested</li><li>Gentle enough for everyday use</li></ul><br/><p>Prefer bar soap instead?</p><p>Our Pore Penetrating Charcoal Bar draws out and binds to deep-down dirt and oil. Infused with jojoba beads and peppermint, this bar gently exfoliates and leaves skin feeling tingly smooth. Feel the deep clean in every last pore!</p><p><a style='font-weight:bold; color:##65b632; text-decoration:none;' href='http://www.biore.co.uk/charcoal-for-oily-to-normal-skin/pore-penetrating-charcoal-bar'>Click here</a> to find out more.</p><br/><p>*than a basic cleanser</p>";
			$howToUse = "<p>Wet face. Pump cleanser into hands, gently work into a foam. Massage over entire face. Rinse thoroughly.</p><p>For external use only. Avoid eye contact. If contact occurs, rinse thoroughly with water. Keep out of reach of children.</p>";
			$whenToUse = "For optimal results use daily. ";
			$image = "charcoal-soap-cleanser.jpg"; 
			$link = "https://amzn.to/2qndqt5";
		
		break;
		case 4:
			$name = "Charcoal Pore Minimizer";
			$blurb = "<span style='font-family:Arial, sans-serif;font-size:16px; line-height: 19px; color:#000000; text-align: left'>Instantly reduces appearance of pores.</span>";
			$description = "<p>This scrub activates with water to draw out deep-down impurities and remove dirt & oil. Our unique formula, with natural micro-crystals, smoothes skin and leaves pores visibly smaller. See results in just one use! With natural charcoal, known for its ability to draw out and trap deep-down impurities.</p>";
			$howToUse = "<p>Wet hands and face with warm water. Dispense 1 pump into hands and work into a rich lather. Massage gently over face. Immediately rinse thoroughly with warm water. For optimal results, use up to 2-3 times per week.</p><p>For external use only. Avoid eye contact. If contact occurs, rinse thoroughly with water. Do not apply to broken skin. Discontinue use if rash or irritation occurs.</p>";
			$whenToUse = "2-3 times a week";
			$image = "charcoal-minimiser-scrub.jpg"; 
			$link = "https://amzn.to/2GKDBFf";
		
		break;
		case 5:
			$name = "Self Heating One Minute Mask";
			$blurb = "<span style='font-family:Arial, sans-serif;font-size:16px; line-height: 19px; color:#000000; text-align: left'>Heats on contact and purifies pores in just one minute.</span>";
			$description = "<p>Melt away dirt and oil that clogs pores. Infused with natural charcoal, this self-heating mask heats to open pores, melt sebum and draw out dirt. It finishes with a cooling sensation for tingly-smooth skin in just one minute.</p><ul style='margin-bottom:0;padding-bottom:0;'><li>Oil-Free</li><li>Dermatologist Tested</li></ul>";
			$howToUse = "<ol style='margin-bottom:0;padding-bottom:0;'><li>WET FACE. Leave face wet – the mask is activated by water.</li><li>APPLY MASK. Dry hands, open single-use packette, dispense contents into hand and apply mask to face. You may add a little water to your fingers to help spread the mask and activate warming.</li><li>MASSAGE for about 1 minute. As you massage, the mask will heat up. For more heating action or for your preferred consistency, massage in a little water. The mask does not dry/harden.</li><li>RINSE. After one minute has passed, thoroughly rinse with water to remove the mask.</li></ol>";
			$whenToUse = "Once a week";
			$image = "charcoal-self-heating-one-minute-mask.jpg"; 
			$link = "https://amzn.to/2HdtXuk";
		
		break;
		case 6:
			$name = "Charcoal Cleansing Micellar Water";
			$blurb = "<span style='font-family:Arial, sans-serif;font-size:16px; line-height: 19px; color:#000000; text-align: left'>Removes makeup, deep cleans pores & refreshes</span>";
			$description = "<p>Specially formulated for oily to normal skin, this micellar water delivers an all-in-one clean, refreshed face anytime, anywhere.</p><p>Makeup Remover: Removes even heavy makeup</p><p>Cleanser: Removes dirt & oil from pores</p><p>Refresher: Absorbs excess oil</p><ul style='margin-bottom:0;padding-bottom:0;'><li>Non-comedogenic (won't clog pores)</li><li>Hypoallergenic</li><li>Dermatologist & ophthalmologist tested</li></ul>";
			$howToUse = "<p>Wet a cotton pad and wipe all over the face until skin is completely clean. To remove eye makeup, hold the pad over closed eyes for a few seconds, and then just swipe away – no need for harsh rubbing. </p>";
			$whenToUse = "Use daily – morning, day or night. No need to rinse..";
			$image = "product-placeholder.png"; 
			$link = "#";
		
		break;
		case 7:
			$name = "Baking Soda Anti-Blemish Cleansing Foam";
			$blurb = "<span style='font-family:Arial, sans-serif;font-size:16px; line-height: 19px; color:#000000; text-align: left'>Deep clean with unique foam to help clear and prevent breakouts without over-drying. It's surprisingly strong yet gentle, and oh-so-fun!</span>";
			$description = "<p>Got combination skin? This gentle daily anti-blemish cleansing foam with natural Baking Soda immediately deep cleans and targets breakouts to help keep it under control. For clearer skin in just 2 days!</p><ul style='margin-bottom:0;padding-bottom:0;'><li>With Salicylic Acid</li><li>Oil free</li><li>pH balanced formula</li><li>Dermatologist tested</li></ul>";
			$howToUse = "<p>Wet face. Pump product into hands. (1-2 pumps). Massage over entire face and neck. Rinse thoroughly.</p>";
			$whenToUse = "For optimal results, use daily.";
			$image = "baking-soda-anti-blemish-cleansing-foam.jpg"; 
			$link = "https://amzn.to/2GNdNs6";
		
		break;
		case 8:
			$name = "Baking Soda Cleansing Scrub";
			$blurb = "<span style='font-family:Arial, sans-serif;font-size:16px; line-height: 19px; color:#000000; text-align: left'>Powder scrub deep cleans & gently exfoliates.</span>";
			$description = "<p>This scrub with powder-to-foam formula gently cleanses and exfoliates pores then naturally dissolves so you never over-scrub. Dial up or dial down this scrub's intensity by adding water; once activated, it fizzes and expands, providing that deep cleansing. The polishing formulation, brightens and evens the complexion and eliminates dullness.</p><ul style='margin-bottom:0;padding-bottom:0;'><li>pH balanced</li><li>Dermatologist tested</li><li>Oil free</li><li>Hypoallergenic</li></ul>";
			$howToUse = "<p>Push button to open lid. Wet face. Dispense a small amount of product into hands. Add water to activate the cleanser. More water will soften cleansing action. Massage over entire face. Rinse thoroughly. If dryness occurs reduce usage frequency.</p><p>Ensure lid is closed to avoid letting in moisture.</p><p>Avoid eye contact. If contact occurs, rinse thoroughly with water. Do not apply to broken skin. Discontinue use if rash or irritation occurs. Keep out of reach of children.</p>";
			$whenToUse = "2-3 times a week";
			$image = "baking-soda-cleansing-scrub.jpg"; 
			$link = "https://amzn.to/2Hq1Kha";
		
		break;
		case 9:
			$name = "Baking Soda Pore Cleanser";
			$blurb = "<span style='font-family:Arial, sans-serif;font-size:16px; line-height: 19px; color:#000000; text-align: left'>Deep cleans pores & gently exfoliates.</span>";
			$description = "<p>This cleanser is gentle enough for daily use. It exfoliates dry, flaky skin and deep cleans, removing high levels of dirt and oil, without stripping skin’s natural moisture. It improves the appearance of pores and skin texture, leaving your skin feeling clean, soft and smooth.</p><ul style='margin-bottom:0;padding-bottom:0;'><li>Dermatologist tested</li><li>Oil free</li><li>Hypoallergenic</li></ul>";
			$howToUse = "<p>Wet face. Pump cleanser into hands and work into a lather. Massage over entire face. Rinse thoroughly.</p><p>Avoid eye contact. If contact occurs, rinse thoroughly with water. Do not apply to broken skin. Discontinue use if rash or irritation occurs.</p>";
			$whenToUse = "For optimal results use daily.";
			$image = "baking-soda-pore-cleanser.jpg"; 
			$link = "https://amzn.to/2qkCm4q";
		
		break;
		case 10:
			$name = "Ultra Deep Cleansing Pore Strips";
			$blurb = "<span style='font-family:Arial, sans-serif;font-size:16px; line-height: 19px; color:#000000; text-align: left'>Removes 2X more deep-down dirt and oil* for the deepest clean. With Witch Hazel & Tea Tree Oil.</span>";
			$description = "<p>These pore strips, formulated with tea tree oil, witch hazel, and menthol, lock onto deep-down dirt and oil that can cause blackheads. Don't be grossed out by what you see on the strip. Unclogged, invigorated pores are a good thing.</p><p>*Bioré Ultra Deep Cleansing Pore Strips is 2x better at removing deep pore clogs than previous Bioré Ultra Deep Cleansing Pore Strips.</p>";
			$howToUse = "<ol style='margin-bottom:0;padding-bottom:0;'><li>Remove strip from pouch. Twist strip to loosen and separate slits prior to use (see illustration).</li><li>After washing your face, thoroughly wet your nose. The strip won't stick on a dry nose.</li><li>Dry hands. Peel strip off plastic liner. Apply to nose area, smooth side down, pressing down to ensure good contact with skin.</li><li>Let dry for about 10-15 minutes until stiff to the touch - like papier-mâché.</li><li>Slowly and carefully peel off starting at edges, pulling toward centre. Any residue left on skin is easily removed with rinsing.</li></ol>";
			$whenToUse = "Once a week";
			$image = "ultra-deep-cleansing-pore-strips.jpg"; 
			$link = "https://amzn.to/2IGr81M";
		
		break;
		case 11:
			$name = "Baking Soda Cleansing Micellar Water";
			$blurb = "<span style='font-family:Arial, sans-serif;font-size:16px; line-height: 19px; color:#000000; text-align: left'>Removes makeup, deep cleans pores & refreshes</span>";
			$description = "<p>Wet a cotton pad and wipe all over the face until skin is completely clean. To remove eye makeup, hold the pad over closed eyes for a few seconds, and then just swipe away – no need for harsh rubbing.</p>";
			$howToUse = "<p>Wet a cotton pad and wipe all over the face until skin is completely clean. To remove eye makeup, hold the pad over closed eyes for a few seconds, and then just swipe away – no need for harsh rubbing.</p>";
			$whenToUse = "Use daily – morning, day or night. No need to rinse.";
			$image = "product-placeholder.png"; 
			$link = "#";
		
		break;
	}


	if($productID == 0 || $productID == 3 || $productID == 6 || $productID == 7 || $productID == 9 || $productID == 11 ) {
		$colour = "#65b632";
	} else {
		$colour = "#e8218a";
	}




	$html = ' <tr> <td valign="top"><table align="center" class="em_wrapper" style="width: 640px;" width="640" border="0" cellspacing="0" cellpadding="0"> <tr> <td valign="top"><table align="left" class="em_wrapper" style="width: 320px;" width="320" border="0" cellspacing="0" cellpadding="0"> <tr> <td align="center" valign="top"><img src="https://cleanskinplan.biore.co.uk/static/[image]" class="em_full_img" width="250" height="261" border="0" style="display: block; font-family:Arial, sans-serif;font-size:18px; line-height: 24px; color:#000000; font-weight: bold;" alt=""/></td></tr></table><!--[if gte mso 9]> </td><td valign="top"><![endif]--> <table width="320" align="right" class="em_wrapper" style="width: 320px;" border="0" cellspacing="0" cellpadding="0"> <tr> <td width="30" class="em_side" style="width: 65px;">&nbsp;</td><td align="center" valign="top"><table class="em_wrapper" style="width: 260px;" width="260" border="0" cellspacing="0" cellpadding="0"> <tr> <td valign="top" style="font-family:Arial, sans-serif;font-size:16px; line-height: 19px; color:#000000; text-align: left"> <span style="color: #000000; font-size: 19px; line-height: 23px; text-align: left"> <b>[name]</b></span><br/><br/> <b>[blurb]</b><br/><br/> [description]<br /><br /><span style="color: [colour]"><b>How to use</b></span><br/> [how-to-use]<br/><br/> <span style="color: [colour]"><b>When to use</b></span><br/> [when-to-use]<br/><br/> </td></tr><tr> <td valign="top"><a href="[link]" target="_blank" style="text-decoration: none;"><img src="https://cleanskinplan.biore.co.uk/static/shopnow.gif" width="149" height="41" border="0" style="display: block; background-color: #1d1d1b; font-family:Arial, sans-serif;font-size:13px; line-height: 24px; color:#ffffff;" alt="SHOP NOW &gt;"/></a></td></tr><tr> <td height="15" class="em_h30">&nbsp;</td></tr></table></td><td width="30" class="em_side" style="width: 65px;">&nbsp;</td></tr></table></td></tr></table></td></tr><tr> <td height="30" bgcolor="#ffffff" class="em_height" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>';

	$html = str_replace("[name]", $name, $html);
	$html = str_replace("[blurb]", $blurb, $html);
	$html = str_replace("[how-to-use]", $howToUse, $html);
	$html = str_replace("[description]", $description, $html);
	$html = str_replace("[when-to-use]", $whenToUse, $html);
	$html = str_replace("[image]", $image, $html);
	$html = str_replace("[link]", $link, $html);
	$html = str_replace("[colour]", $colour, $html);

	

	return $html;
                        
}




?>
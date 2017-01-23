<?php
if(get_language() == "nl"){
?>
<div>
	<img class='float-alt' src='<?php echo $vars["url"]; ?>mod/pleio_main_template/_graphics/logo_normal.png' />
	<p>
		<i>
		Je krijgt dit bericht omdat je lid bent van Pleio en/of een website die gebruik maakt van Pleio als onderliggend
		platform.
		</i>
	</p>
	
	<p>
		<h2>Algemene Voorwaarden voor Pleio</h2>
	</p>
	
	<p>
		Pleio heeft als doel het ondersteunen van de samenwerking aan de publieke zaak. Het gebruik van Pleio
		staat open voor zowel ambtenaren als burgers. Het platform wordt onderhouden door samenwerking van
		diverse overheidsorganisaties en gebruikers. Alle betrokkenen zetten zich maximaal in om Pleio te onderhouden
		en verder te ontwikkelen overeenkomstig het Pleio-manifest.
	</p>
	
	<p>
		Pleio is van de gebruikers en voor de gebruikers. Iedereen kan een bijdrage leveren en daardoor meehelpen
		om het platform te verbeteren. Je kunt dit bijvoorbeeld doen door vragen te stellen en/of te beantwoorden
		via de Pleio Helpdesk.
	</p>
	
	<p>
		Om deel te nemen aan Pleio vragen we je akkoord te gaan met het volgende:
	</p>
	
	<p>
		<ul style='list-style: disc inside;'>
			<li>Gebruik Pleio voor dingen die bijdragen aan de publieke zaak. Misbruik het platform niet voor andere
			doeleinden dan de publieke zaak, zoals reclame- en commerciële doeleinden.</li>
			<li>Gebruik je eigen naam en doe je niet voor als iemand anders.</li>
			<li>Zorg ervoor, en wees je er van bewust, dat je zichtbaar bent en gevonden kunt worden.</li>
			<li>Behandel de ander zoals deze behandeld wil worden.</li>
			<li>Neem je verantwoordelijkheid over de mate van openbaarheid die je kiest. Pleio streeft naar openbaarheid,
			maar dat is niet altijd mogelijk.</li>
			<li>Maak geen inbreuk op het intellectueel eigendom van een ander. Pleio respecteert intellectueel eigendom
			en verwacht van de gebruikers hetzelfde.</li>
			<li>Plaats niets op Pleio wat in strijd is met enige wet of met het doel van Pleio. Als je dat toch doet, kan de
			beheerder van Pleio deze inhoud verwijderen, je account blokkeren en, indien de wet wordt overtreden,
			aangifte doen.</li>
			<li>Je bent en blijft eindverantwoordelijk voor de informatie die je op Pleio zet.</li>
			<li>Meld onrechtmatige informatie (die in strijd is met enige wet of met het doel van Pleio) meteen aan de
			beheerder van de deelsite of groep, of via de “dit vind ik niet OK” link op de pagina.</li>
			<li>Ben je eigenaar van een groep of deelsite en ontvang je een melding van onrechtmatige informatie,
			verwijder deze informatie dan onmiddellijk.</li>
			<li>Help mee om Pleio schoon en actueel te houden. Ruim regelmatig je verouderde documenten en andere
			informatie op en deactiveer je account als je geen gebruik meer wilt maken van Pleio.</li>
			<li>De Stichting Pleio is niet aansprakelijk voor schade veroorzaakt door enig gebruik van Pleio.</li>
			<li>Pleio zal wijzigingen in de functionaliteit of de vormgeving van Pleio vooraf communiceren, onder andere
			via deelsite-eigenaren en Twitter (<a href='http://www.twitter.com/pleinoverheid' target='_blank'>@pleinoverheid</a>).</li>
			<li>Pleio zal voorstellen tot wijziging van de Algemene Voorwaarden vooraf communiceren via diverse kanalen,
			waaronder Twitter (<a href='http://www.twitter.com/pleinoverheid' target='_blank'>@pleinoverheid</a>). Definitieve wijzigingen worden aan elke gebruiker gemeld.</li>
			<li>Word lid van de werkgroep Pleio als je ideeën hebt over aanpassingen of zelf een bijdrage wilt leveren
			aan de ontwikkeling van Pleio.</li>
		</ul>
	</p>
	
	<p>
		<h3>Om Pleio te kunnen (blijven) gebruiken dien je akkoord te gaan
		met deze Algemene Voorwaarden.</h3>
	</p>
	
	<p>
		<h3 style="color:red">
		Let op: Niet akkoord gaan leidt tot de-activatie van je account,
		dit kan alleen ongedaan gemaakt worden door de beheerder
		</h3>
	</p>
	
	<p>
		<a href="<?php echo elgg_add_action_tokens_to_url($vars["url"] . "action/accept_terms/accept?forward=" . urlencode($_SESSION["terms_forward_from"])); ?>" class="elgg-modifications-accept-terms-accept"></a>
		<a href="<?php echo $vars["url"]?>pg/accept_terms/deactivate" class="elgg-modifications-accept-terms-no"></a>
		<a href="<?php echo $vars["url"]?>action/logout" class="elgg-modifications-accept-terms-cancel"></a>
		
		
		<div class="clearfloat"></div>
	</p>
</div>
<?php } else { ?>
<div>
	<img class='float-alt' src='<?php echo $vars["url"]; ?>mod/pleio_main_template/_graphics/logo_normal.png' />
	<p>
		<i>
		You receive this message because you are a member of Pleio and/or a website that is based on Pleio.
		</i>
	</p>
	
	<p>
		<h2>Terms and conditions of Pleio</h2>
	</p>
	
	<p>
		Pleio aims to support cooperation for public benefit. Public officials and private citizens alike can make use of Pleio.
		The Pleio platform is maintained through the collaborative efforts of government organizations and users. All those
involved do their utmost to ensure the maintenance and further development of Pleio, in accordance with the Pleio
manifesto.
	</p>
	
	<p>
		Pleio is by and for users. Everyone can contribute to improving the platform, for example by asking or responding to
questions using the Pleio Helpdesk.
	</p>
	
	<p>
		By using Pleio, you are agreeing to comply with following terms and conditions:
	</p>
	
	<p>
		<ul style='list-style: disc inside;'>
			<li>Use Pleio for public benefit. Do not misuse the platform by using it for other purposes, such as advertising and
other commercial ends.</li>
			<li>Use your real name; impersonation of others is prohibited.</li>
			<li>Ensure, and be aware, that you are visible and can be traced.</li>
			<li>Treat others as you would like to be treated.</li>
			<li>Take responsibility for the degree of openness you opt for. Pleio strives for full openness and transparency, but this
is not always possible.</li>
			<li>Do not infringe on the intellectual property rights of another. Pleio respects intellectual property rights and demands
the same of users.</li>
			<li>Do not post anything on Pleio that is in violation of the law or contrary to the aims and principles of Pleio. The
Pleio administrator reserves the right to remove content, block access, terminate accounts, and in the case of illegal
activity, to notify the proper authorities.</li>
			<li>You remain solely responsible for the information you post on Pleio.</li>
			<li>Please report any unlawful conduct or conduct in conflict with the aim of Pleio to the site or subsite administrator.
Please use the "This is not OK" link for this purpose.</li>
			<li>Owners of a Pleio group or subsite must immediately remove any information deemed unlawful.</li>
			<li>Help keep Pleio uncluttered and up to date. Remove obsolete documents and other information on a regular basis,
and deactivate your account if you no longer wish to make use of Pleio.</li>
			<li>The Pleio Foundation is not in any way responsible for damage attributed to use of Pleio.</li>
			<li>Pleio will announce ahead of time any changes in the functionality or design of the Pleio platform, to subsite owners
and on Twitter (<a href='http://www.twitter.com/pleinoverheid' target='_blank'>@pleinoverheid</a>).</li>
			<li>Pleio will announce any proposed changes to these Terms and Conditions through several channels, including
Twitter (<a href='http://www.twitter.com/pleinoverheid' target='_blank'>@pleinoverheid</a>). Definitive changes will be communicated to all users.</li>
			<li>Join the Pleio work group to share your ideas on changes to Pleio or to help develop Pleio further.</li>
		</ul>
	</p>
	
	<p>
		<h3>To continue the use of Pleio, you have to agree with these Terms and Conditions.</h3>
	</p>
	
	<p>
		<h3 style="color:red">
		Note: Disagreement will result in de-activation of your account,
which can only be restored by the administrator!
		</h3>
	</p>
	
	<p>
		<a href="<?php echo elgg_add_action_tokens_to_url($vars["url"] . "action/accept_terms/accept?forward=" . urlencode($_SESSION["terms_forward_from"])); ?>" class="elgg-modifications-accept-terms-en-accept"></a>
		<a href="<?php echo $vars["url"]?>pg/accept_terms/deactivate" class="elgg-modifications-accept-terms-en-no"></a>
		<a href="<?php echo $vars["url"]?>action/logout" class="elgg-modifications-accept-terms-en-cancel"></a>
		
		<div class="clearfloat"></div>
	</p>
</div>
<?php
}
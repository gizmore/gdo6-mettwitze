<?php
use GDO\Mettwitze\GDO_Mettwitz;
use GDO\UI\GDT_Card;
use GDO\UI\GDT_Headline;
use GDO\UI\GDT_Paragraph;
/** @var $gdo GDO_Mettwitz **/
$gdo instanceof GDO_Mettwitz;

$card = GDT_Card::make()->gdo($gdo);
$card->withCreated()->withCreator();
$card->addFields(array(
	$gdo->getVoteCountColumn(),
	$gdo->getVoteRatingColumn(),
	GDT_Headline::make()->withHTML($gdo->displayQuestion()),
	GDT_Paragraph::make()->withHTML($gdo->displayAnswer()),
));

echo $card->render();

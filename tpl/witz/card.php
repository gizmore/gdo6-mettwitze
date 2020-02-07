<?php
use GDO\Mettwitze\GDO_Mettwitz;
use GDO\UI\GDT_Card;
use GDO\UI\GDT_Headline;
use GDO\UI\GDT_Paragraph;
use GDO\UI\GDT_Divider;
/** @var $gdo GDO_Mettwitz **/
$gdo instanceof GDO_Mettwitz;

$card = GDT_Card::make()->gdo($gdo);
$card->withCreated()->withCreator();
$card->addFields(array(
	GDT_Headline::make()->withHTML($gdo->displayQuestion()),
	GDT_Paragraph::make()->withHTML($gdo->displayAnswer()),
	GDT_Divider::make(),
	$gdo->getVoteCountColumn(),
	$gdo->getVoteRatingColumn(),
));

echo $card->render();

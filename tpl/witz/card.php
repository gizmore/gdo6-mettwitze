<?php
use GDO\Mettwitze\GDO_Mettwitz;
use GDO\UI\GDT_Card;
use GDO\UI\GDT_Headline;
use GDO\UI\GDT_Paragraph;
use GDO\UI\GDT_Divider;
use GDO\UI\GDT_Label;
/** @var $gdo GDO_Mettwitz **/
$card = GDT_Card::make()->gdo($gdo);
$card->creatorHeader();
$card->addFields(array(
    GDT_Label::make('mw_question'),
	GDT_Headline::make()->withHTML($gdo->displayQuestion()),
    GDT_Label::make('mw_answer'),
    GDT_Paragraph::make()->withHTML($gdo->displayAnswer()),
	GDT_Divider::make(),
	$gdo->getVoteCountColumn(),
	$gdo->getVoteRatingColumn(),
));
echo $card->render();

<?php
use GDO\Mettwitze\GDO_Mettwitz;
use GDO\User\GDO_User;
use GDO\Vote\GDT_VotePopup;
use GDO\UI\GDT_EditButton;
/** @var $gdo GDO_Mettwitz **/
$gdo instanceof GDO_Mettwitz;
$user = GDO_User::current();
$hrefCommentWrite = href('Mettwitze', 'AddComment', '&id='.$gdo->getID());
$hrefComments = href('Mettwitze', 'ListComments', '&id='.$gdo->getID());
?>
<div
 style="cursor: pointer;"
 onclick="GDO.Mettwitze.revealJoke('<?=$gdo->getID()?>')"
 class="list-group-item list-group-item-action flex-column align-items-start">
  <div class="d-flex w-100 justify-content-between">
    <?=GDT_VotePopup::make()->gdo($gdo)->renderCell()?>
    <small class="text-muted ri"><?=t('witz_meta', [$gdo->displayAge(), $user->displayNameLabel()])?></small>
  </div>
  <span class="cb"></span>
  <h5 class="mb-1"><?=$gdo->displayQuestion()?></h5>
  <p id="joke_<?=$gdo->getID()?>"
   class="mb-1"
   style="opacity: 0.0;"><?=$gdo->displayAnswer()?></p>
  <small class="text-muted">
    <a href="<?=$hrefCommentWrite?>"><?=t('btn_write_comment')?></a>
    (<a href="<?=$hrefComments?>"><?=t('link_comments', [$gdo->getCommentCount()])?></a>)
<?php if ($gdo->canEdit($user)) : ?>
<?= GDT_EditButton::make()->gdo($gdo)->addClass('ri')->renderCell(); ?>
<?php endif; ?>
  </small>
  <span class="cb"></span>
</div>

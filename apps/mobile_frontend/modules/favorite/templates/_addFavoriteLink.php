<?php
$form = new sfForm();
if ($id !== $sf_user->getMemberId())
{
  echo link_to(__('Add favorite'), 'favorite/add?id='.$id.'&'.$form->getCSRFFieldName().'='.$form->getCSRFToken());
}
?>
<br>

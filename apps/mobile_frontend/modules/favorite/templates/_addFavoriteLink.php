<?php
$form = new BaseForm();
if ($id !== $sf_user->getMemberId())
{
  echo link_to(__('Add favorite'), '@favorite_add?id='.$id.'&'.$form->getCSRFFieldName().'='.$form->getCSRFToken());
}
?>
<br>

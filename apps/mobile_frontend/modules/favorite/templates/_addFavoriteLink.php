<?php
if ($id !== $sf_user->getMemberId())
{
  echo link_to(__('Add favorite'), '@favorite_add?id=' . $id);
}
?>
<br>

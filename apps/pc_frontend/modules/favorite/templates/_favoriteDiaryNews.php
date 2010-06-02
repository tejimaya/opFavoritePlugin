<?php if (count($diaryList)): ?>

<?php
include_parts(
  'diaryListBox',
  'favoriteHomeDiary_'.$gadget->getId(),
  array(
    'title' => __('The favorite newest diary'),
    'list' => $diaryList,
    'showName' => true,
    'moreInfo' => '@favorite_diary',
    'link_to' => '@diary_show?id=%d'
  )
)
?>

<?php endif ?>

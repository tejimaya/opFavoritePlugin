<?php if (count($diaryList)): ?>

<?php
op_include_parts(
  'diaryListBox',
  'favoriteHomeDiary_'.$gadget->getId(),
  array(
    'class' => 'homeRecentList',
    'title' => __('The favorite newest diary'),
    'list' => $diaryList,
    'moreInfo' => array(link_to(__('More info'), '@favorite_diary')),
  )
)
?>

<?php endif ?>

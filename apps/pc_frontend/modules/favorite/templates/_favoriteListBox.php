<?php
$option = array(
  'title' => __('Favorite list'),
  'list' => $members,
  'link_to' => 'member/profile?id=',
  'moreInfo' => array(sprintf('%s(%d)', __('Show all'), $cnt) => 'favorite/list'),
  'type' => 'full',
  'row' => $row,
  'col' => $col,
);

include_parts('nineTable', 'favoriteList', $option);

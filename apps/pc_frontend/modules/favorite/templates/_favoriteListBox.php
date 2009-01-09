<?php
$option = array(
  'title' => __('お気に入りリスト'),
  'list' => $members,
  'link_to' => 'member/profile?id=',
  'moreInfo' => array(sprintf('%s(%d)', __('全てを見る'), $cnt) => 'favorite/list'),
  'type' => 'full',
  'row' => $row,
  'col' => $col,
);

include_parts('nineTable', 'favoriteList', $option);

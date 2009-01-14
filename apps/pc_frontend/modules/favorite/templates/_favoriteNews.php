<?php

$list = array();

if ($diary_list)
{
  $diary = array(
      'caption' => sprintf(__('The favorite%snewest diary'), '<br />'),
      'link_to_detail' => 'diary/%d',
      'content' => array(),
      'moreInfo' => 'favorite/diarybloglist'
    );

  foreach ($diary_list as $res)
  {
      $diary['content'][] = $res;
  }

  $list[] = $diary;
}

if (!empty($list))
{
  include_news('favoriteNews', __('The favorite newest information'), $list);
}

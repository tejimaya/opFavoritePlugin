<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class opFavoritePluginUpdate_1_0beta3_to_1_0beta4_dev_200901221532 extends opUpdate
{
  public function update()
  {
    $c = new Criteria();
    $c->add(NavigationPeer::TYPE, 'default');
    $c->add(NavigationPeer::URI, 'favorite/list');
    $c->add(NavigationPeer::SORT_ORDER, 21);
    $favoriteNavigationList = NavigationPeer::doSelectOne($c);
    if ($favoriteNavigationList)
    {
      $favoriteNavigationList->setSortOrder(19);
      $favoriteNavigationList->save();
    }
  }
}

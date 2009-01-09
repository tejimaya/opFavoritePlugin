<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class favoriteComponents extends sfComponents
{
  public function executeFavoriteListBox()
  {
    $c = new Criteria();
    $c->addAscendingOrderByColumn(Propel::getDB()->random(time()));
    $this->row = $this->widget->getConfig('row');
    $this->col = $this->widget->getConfig('col');
    $this->cnt = FavoritePeer::countByMemberId($this->getUser()->getMemberId());
    $this->favorites = FavoritePeer::retrieveFavorites($this->getUser()->getMemberId(), $this->row * $this->col, $c);
    $this->members = FavoritePeer::retrieveMembers($this->favorites);
  }
}

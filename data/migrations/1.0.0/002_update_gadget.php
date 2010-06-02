<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class Revision2_UpdateGadget extends Doctrine_Migration_Base
{
  public function migrate($direction)
  {
    $gadgets = Doctrine::getTable('Gadget')->findByName('favoriteNews');
    foreach ($gadgets as $gadget)
    {
      $insert = new Gadget();
      $insert->setType($gadget->getType());
      $insert->setName('favoriteDiaryNews');
      $insert->setSortOrder($gadget->getSortOrder());
      $insert->save();

      $insert = new Gadget();
      $insert->setType($gadget->getType());
      $insert->setName('favoriteBlogNews');
      $insert->setSortOrder($gadget->getSortOrder());
      $insert->save();

      $gadget->delete();
    }
  }
}

<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class Revision3_InsertMobileGadget extends Doctrine_Migration_Base
{
  public function migrate($direction)
  {
    $insert = new Gadget();
    $insert->setType('mobileContents');
    $insert->setName('favoriteDiaryNews');
    $insert->setSortOrder(105);
    $insert->save();
  }
}

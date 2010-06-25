<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class Revision4_AddForeignKeyForFavorite extends Doctrine_Migration_Base
{
  public function migrate($direction)
  {
    $this->foreignKey($direction, 'favorite', 'member_id_to_member_id', array(
      'name' => 'member_id_to_member_id',
      'local' => 'member_id_to',
      'foreign' => 'id',
      'foreignTable' => 'member',
      'onDelete'=>'CASCADE'
    ));

    $this->foreignKey($direction, 'favorite', 'member_id_from_member_id', array(
      'name' => 'member_id_from_member_id',
      'local' => 'member_id_from',
      'foreign' => 'id',
      'foreignTable' => 'member',
      'onDelete'=>'CASCADE'
    ));
  }
}

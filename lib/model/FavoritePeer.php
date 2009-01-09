<?php

class FavoritePeer extends BaseFavoritePeer
{
  public static function countByMemberId($member_id)
  {
    $c = new Criteria();
    $c->add(self::MEMBER_ID, $member_id);

    return self::doCount($c);
  }

  public static function retrievePager($member_id, $page = 1, $size = 20)
  {
    $c = new Criteria();
    $c->add(self::MEMBER_ID, $member_id);
    $c->addDescendingOrderbyColumn(self::ID);

    $pager = new sfPropelPager('Favorite', $size);
    $pager->setCriteria($c);
    $pager->setPage($page);
    $pager->init();
 
    return $pager;
  }

  public static function retrieveFavorites($member_id, $limit = null, Criteria $c = null)
  {
    if (!$c)
    {
      $c = new Criteria();
    }
    if (!is_null($limit))
    {
      $c->setLimit($limit);
    }
    $c->add(FavoritePeer::MEMBER_ID, $member_id);
    return FavoritePeer::doSelect($c);
  }

  public static function retrieveMembers($favorites)
  {
    $members = array();
    foreach($favorites as $favorite)
    {
      $members[] = MemberPeer::retrieveByPk($favorite->getTargetMemberId());
    }

    return $members;
  }

  public static function add($member_id, $target_member_id)
  {
    $c = new Criteria();
    $c->add(self::MEMBER_ID, $member_id);
    $c->add(self::TARGET_MEMBER_ID, $target_member_id);
    $favorite = FavoritePeer::doSelectOne($c);
    if($favorite == null) $favorite = new Favorite();
    $favorite->setMemberId($member_id);
    $favorite->setTargetMemberId($target_member_id);
    $favorite->save();
  }

  public static function delete($member_id, $target_member_id)
  {
    $c = new Criteria();
    $c->add(self::MEMBER_ID, $member_id);
    $c->add(self::TARGET_MEMBER_ID, $target_member_id);
    $favorite = FavoritePeer::doSelectOne($c);
    if($favorite == null) return;
    $favorite->delete();
  }


}

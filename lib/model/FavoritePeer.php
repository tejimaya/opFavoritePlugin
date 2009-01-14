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
    foreach ($favorites as $favorite)
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

  public static function retrieveDiaryList($member_id, $size = 10)
  {
    $c = new Criteria();
    $c->add(FavoritePeer::MEMBER_ID, $member_id);
    $c->addJoin(FavoritePeer::TARGET_MEMBER_ID, MemberPeer::ID);
    $c->addJoin(FavoritePeer::TARGET_MEMBER_ID, DiaryPeer::MEMBER_ID);
    $c->addSelectColumn(MemberPeer::NAME);
    $c->addSelectColumn(DiaryPeer::TITLE);
    $c->addSelectColumn(DiaryPeer::CREATED_AT);
    $c->addSelectColumn(DiaryPeer::ID);
    $c->addSelectColumn(DiaryPeer::HAS_IMAGES);
    $c->addDescendingOrderbyColumn(DiaryPeer::ID);
    $c->setLimit($size);

    if (!FavoritePeer::doCount($c))
    {
      return null;
    }

    $stmt = FavoritePeer::doSelectStmt($c);

    $list = array();
    for ($i = 0; $row = $stmt->fetch(); $i++)
    {
      $list[$i] = array();
      $list[$i]['id'] = $row['ID'];
      $list[$i]['name'] = $row['NAME'];
      $list[$i]['title'] = $row['TITLE'];
      $list[$i]['date'] = $row['CREATED_AT'];
      $list[$i]['image'] = $row['HAS_IMAGES'];
    }

    return $list;
  }

  public static function retrieveDiaryPager($member_id, $page = 1, $size = 10)
  {
    $favorites = self::retrieveFavorites($member_id);
    $c = new Criteria();
    foreach ($favorites as $favorite)
    {
      $c->addOr(DiaryPeer::MEMBER_ID, $favorite->getTargetMemberId());
    }
    $c->addDescendingOrderbyColumn(DiaryPeer::ID);

    $pager = new sfPropelPager('Diary', $size);
    $pager->setCriteria($c);
    $pager->setPage($page);
    $pager->init();
    return $pager;
  }

  public static function retrieveDiaryListFromPager($pager)
  {
    $list = array();
    foreach ($pager->getResults() as $i => $diary)
    {
      $list[$i] = array();
      $list[$i]['id'] = $diary->getId();
      $list[$i]['name'] = MemberPeer::retrieveByPk($diary->getMemberId())->getName();
      $list[$i]['title'] = $diary->getTitle();
      $list[$i]['date'] = $diary->getCreatedAt();
      $list[$i]['image'] = $diary->getHasImages();
    }

    return $list;
  }
}

<?php
/**
 */
class PluginFavoriteTable extends Doctrine_Table
{
  public function countByMemberId($member_id_from)
  {
    return $this->createQuery()
      ->where('member_id_from = ?', $member_id_from)
      ->orderBy('id')->execute()->count();
  }

  public function retrievePager($member_id_from, $page = 1, $size = 20)
  {
    $q = $this->createQuery()
      ->where('member_id_from = ?', $member_id_from)
      ->orderBy('id');

    $pager = new sfDoctrinePager('Favorite', $size);
    $pager->setQuery($q);
    $pager->setPage($page);
    $pager->init();

    return $pager;
  }

  public function retrievesByMemberIdFrom($member_id_from, $limit = null)
  {
    $q = $this->createQuery()->where('member_id_from = ?', $member_id_from);
    if (!is_null($limit))
    {
      $q->limit($limit);
    }

    return $q->execute();
  }

  public function retrieveMembers($favorites)
  {
    $members = array();
    foreach ($favorites as $favorite)
    {
      $members[] = Doctrine::getTable('Member')->find($favorite->getMemberIdTo());
    }

    return $members;
  }

  public function add($member_id_from, $member_id_to)
  {
    $favorite = $this->retrieveByMemberIdFromAndTo($member_id_from, $member_id_to);
    if (!$favorite)
    {
      $favorite = new Favorite();
    }

    $favorite->setMemberIdFrom($member_id_from);
    $favorite->setMemberIdTo($member_id_to);
    $favorite->save();
  }

  public function delete($member_id_from, $member_id_to)
  {
    $favorite = $this->retrieveByMemberIdFromAndTo($member_id_from, $member_id_to);
    if (!$favorite)
    {
      return;
    }

    $favorite->delete();
  }

  public function retrieveDiaryList($member_id_from, $size = 10)
  {
    if (!class_exists('Diary'))
    {
      return array();
    }

    $q = Doctrine::getTable('Diary')->createQuery()
      ->select('Diary.*')
      ->leftJoin('Favorite ON Diary.member_id = Favorite.member_id_to')
      ->where('Favorite.member_id_from = ?', $member_id_from)
      ->orderBy('Diary.created_at DESC')
      ->limit($size);

    $list = array();
    foreach ($q->execute() as $diary)
    {
      $list[] = $this->setDiary(
        strtotime($diary->getCreatedAt()),
        $diary->getTitle(),
        $diary->getId(),
        $diary->getMember()->getName(),
        $diary->getHasImages()
      );
    }

    return $list;
  }

  public function retrieveDiaryPager($member_id_from, $page = 1, $size = 10)
  {
    if (!class_exists('Diary'))
    {
      return false;
    }

    $q = Doctrine::getTable('Diary')->createQuery()
      ->select('Diary.*')
      ->leftJoin('Favorite ON Diary.member_id = Favorite.member_id_to')
      ->where('Favorite.member_id_from = ?', $member_id_from)
      ->orderBy('Diary.created_at DESC');

    $pager = new sfDoctrinePager('Diary', $size);
    $pager->setQuery($q);
    $pager->setPage($page);
    $pager->init();

    return $pager;
  }

  public function retrieveDiaryListFromPager($pager)
  {
    if (!class_exists('Diary'))
    {
      return array();
    }

    $list = array();
    foreach ($pager->getResults() as $diary)
    {
      $list[] = self::setDiary(
        $diary->getCreatedAt(),
        $diary->getTitle(),
        $diary->getId(),
        $diary->getMember()->getName(),
        $diary->getHasImages()
      );
    }

    return $list;
  }

  public function setDiary($date, $title, $id, $name, $image)
  {
    return array(
      'date' => $date,
      'title' => $title . ' ('. Doctrine::getTable('DiaryComment')->getMaxNumber($id) .') ',
      'id' => $id,
      'name' => $name,
      'image' => $image & 1
    );
  }

  public function getBlogListOfFavorite($member_id_from, $size=20, $limitTitle = false)
  {
    if (!class_exists('opBlogPlugin'))
    {
      return array();
    }

    $q = $this->createQuery()
       ->select('member_id_to')
       ->where('member_id_from = ?', $member_id_from);

    $list = array();
    foreach ($q->execute() as $row)
    {
      opBlogPlugin::getBlogListByMemberId($row->getMemberIdTo(), $list);
    }
    $list = opBlogPlugin::sortBlogList($list, $size);
    if ($limitTitle)
    {
      opBlogPlugin::limitBlogTitle($list);
    }

    return $list;
  }

  public function retrieveByMemberIdFromAndTo($member_id_from, $member_id_to)
  {
    $q = $this->createQuery()
       ->where('member_id_to = ?', $member_id_to)
       ->andWhere('member_id_from = ?', $member_id_from);

    return $q->fetchOne();
  }
}

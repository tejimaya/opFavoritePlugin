<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * favorite actions.
 *
 * @package    OpenPNE
 * @subpackage favorite
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class favoriteActions extends sfActions
{
 /**
  * member id check
  */
  public function idCheck()
  {
    // id check
    if(!$this->hasRequestParameter('id')) $this->forward404Unless( NULL, 'Undefined id.');
    $this->id = $this->getRequestParameter('id', $this->getUser()->getMemberId());

    if ($this->id != $this->getUser()->getMemberId())
    {
      sfConfig::set('sf_navi_type', 'friend');
    }
  }

 /**
  * Executes list action
  *
  * @param sfRequest $request A request object
  */
  public function executeList($request)
  {
    $this->pager = FavoritePeer::retrievePager($this->getUser()->getMemberId());
    $this->members = FavoritePeer::retrieveMembers($this->pager->getResults());
    if (!$this->pager->getNbResults())
    {
      return sfView::ERROR;
    }
  }

 /**
  * Executes add action
  *
  * @param sfRequest $request A request object
  */
  public function executeAdd($request)
  {
    $this->idCheck();
    if ($request->isMethod('post'))
    {
      if ($request->hasParameter('add'))
      {
        FavoritePeer::add($this->getUser()->getMemberId(), $this->id);
        $this->redirect('favorite/list');
      }
      $this->redirect('member/profile?id=' . $this->id);
    }
    $this->member = MemberPeer::retrieveByPk($this->id);
  }

 /**
  * Executes delete action
  *
  * @param sfRequest $request A request object
  */
  public function executeDelete($request)
  {
    FavoritePeer::delete( $this->getUser()->getMemberId(), $request->getParameter('id'));
    $this->redirect('favorite/list');
  }
}

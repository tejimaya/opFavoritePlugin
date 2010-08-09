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
 * @author     Masato Nagasawa
 */
class opFavoritePluginFavoriteActions extends sfActions
{
 /**
  * member id check
  */
  public function idCheck()
  {
    // id check
    if (!$this->hasRequestParameter('id')) $this->forward404Unless( NULL, 'Undefined id.');
    $this->id = $this->getRequestParameter('id', $this->getUser()->getMemberId());

    $this->forward404Unless( $this->getUser()->getMemberId() != $this->id, 'Can\'t add your id' );

    if ($this->id != $this->getUser()->getMemberId())
    {
      sfConfig::set('sf_nav_type', 'friend');
    }
  }

 /**
  * Executes list action
  *
  * @param sfRequest $request A request object
  */
  public function executeList($request)
  {
    $favoriteTable = Doctrine::getTable('Favorite');
    $this->pager = $favoriteTable->retrievePager($this->getUser()->getMemberId(), $request->getParameter('page'));
    if (!$this->pager->getNbResults())
    {
      return sfView::ERROR;
    }
    $this->members = $favoriteTable->retrieveMembers($this->pager->getResults());
  }

 /**
  * Executes delete action
  *
  * @param sfRequest $request A request object
  */
  public function executeDelete($request)
  {
    $request->checkCSRFProtection();
    Doctrine::getTable('Favorite')->delete( $this->getUser()->getMemberId(), $request->getParameter('id'));
    $this->redirect('favorite/list');
  }

 /**
  * Executes diary action
  *
  * @param sfRequest $request A request object
  */
  public function executeDiary($request)
  {
    $this->pager = Doctrine::getTable('Favorite')->retrieveDiaryPager($this->getUser()->getMemberId(), $request->getParameter('page', 1));
    if (!$this->pager->getNbResults())
    {
      return sfView::ERROR;
    }
  }
}

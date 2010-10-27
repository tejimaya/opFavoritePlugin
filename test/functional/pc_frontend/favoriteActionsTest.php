<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

include dirname(__FILE__).'/../../bootstrap/functional.php';
include dirname(__FILE__).'/../../bootstrap/database.php';

$browser = new opTestFunctional(new opBrowser(), new lime_test(null, new lime_output_color()));
$browser
  ->info('Login')
  ->login('sns@example.com', 'password')
  ->isStatusCode(302)

// CSRF
  ->info('/favorite/add?id=2 - CSRF')
  ->post('/favorite/add?id=2', array('add' => '1'))
  ->checkCSRF()

  ->info('/favorite/delete/2 - CSRF')
  ->get('/favorite/delete/2')
  ->checkCSRF()

// XSS
  ->info('/favorite/add?id=3 - XSS')
  ->get('/favorite/add', array('id' => '3'))
  ->with('html_escape')->begin()
    ->isAllEscapedData('Member', 'name')
  ->end()

  ->info('/favorite/list - XSS')
  ->get('/favorite/list')
  ->with('html_escape')->begin()
    ->isAllEscapedData('Member', 'name')
  ->end()
;

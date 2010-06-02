<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opFavoritePluginPcFrontendRouteCollection
 *
 * @package    opFavoritePlugin
 * @subpackage routing
 * @author     Masato Nagasawa <nagasawa@tejimaya.com>
 */
class opFavoritePluginPcFrontendRouteCollection extends opFavoritePluginBaseRouteCollection
{
  protected function generateRoutes()
  {
    return array(
      'favorite_add' => new sfRoute(
        '/favorite/add',
        array('module' => 'favorite', 'action' => 'add'),
        array('id' => '\d+', 'sf_method' => array('get')),
        array('model' => 'Member', 'type' => 'object')
      ),
      'favorite_diary' => new sfRoute(
        '/favorite/diary',
        array('module' => 'favorite', 'action' => 'diary')
      ),
      'favorite_blog' => new sfRoute(
        '/favorite/blog',
        array('module' => 'favorite', 'action' => 'blog')
      ),
    );
  }
}

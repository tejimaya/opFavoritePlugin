<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opFavoritePluginMobileFrontendRouteCollection
 *
 * @package    opFavoritePlugin
 * @subpackage routing
 * @author     Masato Nagasawa <nagasawa@tejimaya.com>
 */
class opFavoritePluginMobileFrontendRouteCollection extends opFavoritePluginBaseRouteCollection
{
  protected function generateRoutes()
  {
    return array(
      'favorite_add' => new sfRoute(
        '/favorite/add',
        array('module' => 'favorite', 'action' => 'add')
      ),
    );
  }
}

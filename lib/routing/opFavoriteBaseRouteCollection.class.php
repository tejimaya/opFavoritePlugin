<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opFavoritePluginBaseRouteCollection
 *
 * @package    opFavoritePlugin
 * @subpackage routing
 * @author     Masato Nagasawa <nagasawa@tejimaya.com>
 */
abstract class opFavoritePluginBaseRouteCollection extends sfRouteCollection
{
  public function __construct(array $options)
  {
    parent::__construct($options);

    $this->routes = $this->generateRoutes();
    $this->routes += array(
      'favorite_delete' => new sfDoctrineRoute(
        '/favorite/delete/:id',
        array('module' => 'favorite', 'action' => 'delete'),
        array('id' => '\d+', 'sf_method' => array('get')),
        array('model' => 'Member', 'type' => 'object')
      ),
      'favorite_list' => new sfRoute(
        '/favorite/list',
        array('module' => 'favorite', 'action' => 'list')
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
    $this->routes += $this->generateNoDefaults();
  }

  abstract protected function generateRoutes();

  protected function generateNoDefaults()
  {
    return array(
      'favorite_nodefaults' => new sfRoute(
        '/favorite/*',
        array('module' => 'default', 'action' => 'error')
      ),
    );
  }
}

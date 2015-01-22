<?php
/**
 * BRS Silex\ControllerCollection Extension
 *
 * PHP version 5
 * 
 * LICENSE: This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by the Free
 * Software Foundation, either version 3 of the License, or (at your option) any
 * later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 *
 * This license is available through the world-wide-web at the following URI:
 * http://opensource.org/licenses/GPL-3.0.
 * 
 * @author Michael Mulligan <michael@bigroomstudios.com> 
 * @copyright 2002-2015 Big Room Studios, Inc. 
 * @license http://opensource.org/licenses/GPL-3.0 GLP version 3 
 */

namespace BRS;

/**
 * ControllerController
 *
 * The sole purpose of this class is to extend the Silex ControllerCollection so
 * that it correctly cascades calls to ControllerCollection childern of the
 * Collection.  Lots of Controllers and Collections, try and keep it straight. 
 * 
 * @see \Silex\ControllerCollection
 * 
 * @author Michael Mulligan <michael@bigroomstudios.com> 
 */
class ControllerCollection extends \Silex\ControllerCollection
{
	/**
	 * {@inheritdoc} 
	 *
	 * Cascades the method call to fellow ContorllerCollections.
	 * 
	 * @return self
	 * 
	 * @access public 
	 *
	 * @author Michael Mulligan <michael@bigroomstudios.com> 
	 */
	public function __call($method, $arguments)
	{
		parent::__call($method, $arguments);
		
		foreach ($this->controllers as $controller) {
            if ($controller instanceof \Silex\ControllerCollection) {
                call_user_func_array(array($controller, $method), $arguments);
            }
        }
		
		return $this;
	}
}


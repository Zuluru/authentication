<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Authentication\Identifier;

use Authentication\Identifier\Backend\DatasourceAwareTrait;

/**
 * Token Identifier
 */
class TokenIdentifier extends AbstractIdentifier
{

    use DatasourceAwareTrait;

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'tokenField' => 'token',
        'dataField' => 'token',
        'datasource' => 'Authentication.Orm'
    ];

    /**
     * Identify method.
     *
     * @param array $data Authentication credentials.
     * @return \ArrayAccess|null
     */
    public function identify($data)
    {
        $dataField = $this->getConfig('dataField');
        if (!isset($data[$dataField])) {
            return null;
        }

        $conditions = [
            $this->getConfig('tokenField') => $data[$dataField]
        ];

        return $this->getDatasource()->find($conditions);
    }
}

<?php
/**
 * Copyright 2015 Justin Atack (http://www.justinatack.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2015 Justin Atack (http://www.justinatack.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Deleteable Plugin
 *
 * Deleteable Behavior
 *
 * @package Deleteable
 * @subpackage deletable.models.behaviors
 */
class DeleteableBehavior extends ModelBehavior
{

    /**
     * Configuration of model
     *
     * @param Model $Model
     * @param array $settings
     * @return void
     */
    public function setup(Model $Model, $settings = array())
    {
        if (!isset($this->settings[$Model->alias])) {
            $this->settings[$Model->alias] = array(
                'field' => 'delete',
                'boolean' => false
            );
        }
        $this->settings[$Model->alias] = array_merge(
            $this->settings[$Model->alias],
            (array)$settings
        );
    }

    /**
     * isDeleteable
     * @param Model  $Model
     * @return boolean
     */
    public function isDeleteable($Model)
    {
        $boolean = $this->settings[$Model->alias]['boolean'];
        $field = $this->settings[$Model->alias]['field'];

        $find = $Model->find('first', ['conditions' => [$Model->primaryKey => $Model->id]]);

        if (isset($find[$Model->alias][$field])) {
            return $find[$Model->alias][$field] != $boolean;
        }

        return true;

    }

    /**
     * beforeDelete
     * @param  Model   $Model
     * @param  boolean $cascade
     * @return boolean
     */
    public function beforeDelete(Model $Model, $cascade = true)
    {
        return $this->isDeleteable($Model);
    }
}

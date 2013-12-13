<?php

/**
 * An Eloquent Model: 'AssignedRoles'
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $role_id
 */
class AssignedRoles extends Eloquent {
    protected $guarded = array();

    public static $rules = array();

}

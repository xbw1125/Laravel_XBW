<?php
/**
 * Created by PhpStorm.
 * User: XIBINWEI
 * Date: 2018/11/2
 * Time: 12:04
 */

namespace App;
use Illuminate\Database\Eloquent\Model;


class Admin extends Model
{
    protected $guarded = [];
    const CREATED_AT = 'creation_time';
    const UPDATED_AT = 'update_time';
}
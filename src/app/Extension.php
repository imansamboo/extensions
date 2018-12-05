<?php
/**
 * Created by PhpStorm.
 * User: admirer
 * Date: 12/4/18
 * Time: 12:25 PM
 */

namespace PPF\Extensions\App;
use Illuminate\Database\Eloquent\Model;


class Extension extends Model
{
    protected $fillable = ['name', 'extension', 'secret'];
}
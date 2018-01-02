<?php
/**
 * Created by PhpStorm.
 * User: evgen
 * Date: 02.05.2017
 * Time: 11:06
 */

namespace Eugen\Cstat\Models;

use Illuminate\Database\Eloquent\Model;
class Cstatvisitors extends Model {
    protected $table = 'cstat_visitors';
    public $fillable = ['id','remote','self','country','countrycode','timestamp'];
    public $incrementing = false;
}
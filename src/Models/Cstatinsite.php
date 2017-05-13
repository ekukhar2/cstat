<?php
/**
 * Created by PhpStorm.
 * User: evgen
 * Date: 02.05.2017
 * Time: 11:08
 */

namespace Eugen\Cstat\Models;

use Illuminate\Database\Eloquent\Model;
class Cstatinsite extends Model {
    protected $table = 'cstat_insite';
    public $fillable = ['id','remote','self','times','username','country','countrycode'];
    public $incrementing = false;

}
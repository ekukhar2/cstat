<?php
/**
 * Created by PhpStorm.
 * User: evgen
 * Date: 02.05.2017
 * Time: 11:11
 */

namespace Eugen\Cstat\Models;

use Illuminate\Database\Eloquent\Model;
class Cstatcounteralldays extends Model {
    protected $table = 'cstat_counteralldays';
    public $fillable = ['id','unidays','alldays'];
    public $incrementing = false;
    public $timestamps = false;
}
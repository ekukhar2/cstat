<?php
/**
 * Created by PhpStorm.
 * User: evgen
 * Date: 02.05.2017
 * Time: 10:21
 */
namespace Eugen\Cstat\Models;

use Illuminate\Database\Eloquent\Model;
class Cstatcounter extends Model {
    protected $table = 'cstat_counter';
    public $fillable = ['id','today','tomorrow','alld','todaydate'];
    public $incrementing = false;
}
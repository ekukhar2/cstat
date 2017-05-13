<?php
/**
 * Created by PhpStorm.
 * User: evgen
 * Date: 01.05.2017
 * Time: 13:20
 */

namespace Eugen\Cstat\Facade;

use Illuminate\Support\Facades\Facade;
class Cstat extends Facade {

    protected static function getFacadeAccessor() { return 'cstat'; }
}
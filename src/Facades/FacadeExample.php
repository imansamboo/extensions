<?php

namespace PPF\Extensions\Facades;

use Illuminate\Support\Facades\Facade;

class FacadeExample extends Facade{

    protected static function getFacadeAccessor() { return 'ClassExample'; }

}
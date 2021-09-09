<?php

namespace App\Data;

use App\Entity\Nationalities;


class SearchData
{

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var string
     */
    public $search = '';

    /**
     * @var Nationalities[]
     */
    public $nationalities = [];

    /**
     * @var null|integer
     */
    public $max;

    /**
     * @var null|integer
     */
    public $min;

    /**
     * @var boolean
     */
    public $promo = false;

}

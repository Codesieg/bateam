<?php

namespace App\Data;

use App\Entity\Category;
use Symfony\Component\Form\FormTypeInterface;

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
     * @var Nationalite[]
     */
    public $nationalite = [];

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

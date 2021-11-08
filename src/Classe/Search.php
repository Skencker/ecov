<?php

namespace App\Classe;

use App\Entity\Categories;
use App\Entity\Deal;

class Search 
{
    /**
     * @var string
     */
    public $string = "";
    /**
     * @var Categories[]
     */
    public $categories = [];
    /**
     * @var Deal[]
     */
    public $deal = [];
}
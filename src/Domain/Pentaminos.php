<?php

namespace app\Domain;

class Pentaminos
{
    public $decalage;

    public $variante;

    public function __construct($decalage, $variante)
    {
        $this->decalage = $decalage;
        $this->variante = $variante;
    }
}

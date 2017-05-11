<?php

namespace app\Domain;

class Plateau
{
    public $variantesDejaAjoutees = [];

    public function add(Pentaminos $p)
    {
        if ($this->variantesDejaAjoutees[$p->variante])
        {
            return false;
        }
        else
        {
            $this->variantesDejaAjoutees[$p->variante] = true;
            return true;
        }
    }

    public function solutionTrouvee()
    {
        return true;
    }
}

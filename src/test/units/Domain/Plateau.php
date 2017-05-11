<?php
namespace app\test\units\Domain;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use atoum;

class Plateau extends atoum
{
    /** @var \app\Domain\Plateau */
    private $plateau;
    private $pentamino;

    public function beforeTestMethod($method)
    {
        $this->plateau = new \app\Domain\Plateau();
        $factory = new \app\Domain\PentaminosFactory();
        $this->pentamino = $factory->getList()[0];
    }

    public function testAjoutPentamino()
    {
        $this->boolean($this->plateau->add($this->pentamino))
            ->isEqualTo(true);
    }

    public function testAjoutPentaminoSansRepetition()
    {
        $this->plateau->add($this->pentamino);

        $this->boolean($this->plateau->add($this->pentamino))
        ->isEqualTo(false);
    }

    public function testSolutionTrouveePlateauVide()
    {
        $this->boolean($this->plateau->solutionTrouvee())
            ->isEqualTo(true);
    }
}

<?php
namespace app\test\units\Domain;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use atoum;

class PentaminosFactory extends atoum
{
    public function testCountPossibilities()
    {
        $factory = new \app\Domain\PentaminosFactory();

        $this->integer(count($factory->getList()))
            ->isEqualTo(63)
        ;
    }

    public function testPositionDuPentominoX()
    {
        $factory = new \app\Domain\PentaminosFactory();

        $p = $factory->getList()[2];

        $this->integer($p->decalage[0])
            ->isEqualTo(9)
            ->integer($p->decalage[1])
            ->isEqualTo(10)
            ->integer($p->decalage[2])
            ->isEqualTo(11)
            ->integer($p->decalage[3])
            ->isEqualTo(20)
            ->integer($p->variante)
            ->isEqualTo(2);
    }
}

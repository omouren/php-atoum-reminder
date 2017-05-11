<?php
namespace app\test\units\Domain;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use atoum;

class Model extends atoum
{
    public function testVar()
    {
        $this->given($this->newTestedInstance)
            ->string($this->testedInstance->var)
            ->isEqualTo('test')
        ;
    }
}

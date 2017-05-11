# Tuto Atoum


Tests unitaires en php

==================

## Introduction
Atoum est un framework de tests unitaires pour PHP.

Il existe aussi sous forme de bundle pour tester une application Symfony : https://github.com/atoum/AtoumBundle

### La philosophie d’atoum
http://docs.atoum.org/fr/latest/start_with_atoum.html
```
Vous avez besoin d’écrire une classe de test pour chaque classe testé. Lorsque vous voulez tester une valeur, vous devez :

- indiquer le type de cette valeur (entier, décimal, tableau, chaîne de caractères, etc.)
- indiquer les contraintes devant s’appliquer à cette valeur (égal à, nulle, contenant quelque chose, etc.)
```

## Prerequis
- PHP
- Composer

## Installation
```
composer require atoum/atoum atoum/stubs
```

## Tester avec Atoum
- Créer d'abord une classe qui sera testée (ex: src/Domain/Plateau.php, qui aura comme namespace "app\Domain")
- Créer la classe de test
  - doit être dans un répertoire test/units
  - doit suivre la même arborescence que la classe à tester
  - doit avoir le même nom que la classe à tester
  - doit étendre la classe "atoum"
  - ici : src/test/units/Domain/Plateau.php

- Classe de test src/test/units/Domain/Plateau.php :

```php
<?php
namespace app\test\units\Domain;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use atoum;

class Plateau extends atoum
{
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
```

- Chaque méthode est un test
- On peut instancier la classe à tester manuellement avec un "new ..." ou utiliser  `$this->given($this->newTestedInstance);`, l'instance de la classe sera alors accessible dans `$this->testedInstance`
- `$this->boolean($this->plateau->add($this->pentamino))->isEqualTo(true);` : tester un booleen (ici le résultat de la méthode "add")
- `$this->string($this->testedInstance->var)->isEqualTo('test')` : tester une chaine de caractère
- `$this->boolean($this->testedInstance->var)
->isEqualTo(true)` : tester un booleen
- `$this->integer($this->testedInstance->var)
->isLowerThanOrEqualTo(2)` : tester un entier <= 2
- Pour rendre les tests plus lisibles, il est possible d'utiliser les mots clefs given/when/if/and/then (ne sert qu'à la lisibilité) : http://docs.atoum.org/fr/latest/how_to_write_test_cases.html

- Des méthodes de la classe de test peuvent être implémentées pour être lancées à des moments précis :
  - Avant de lancer les tests : appel de la méthode `setUp()`
  - Avant chaque test : appel de la méthode `beforeTestMethod()`
  - Avant chaque test : appel de la méthode `afterTestMethod()`
  - Une fois tous les tests finis : appel de la méthode `tearDown()`
  - Plus d'info : http://docs.atoum.org/fr/latest/fine_tuning.html


## Lancer les tests
```
php vendor/atoum/atoum/bin/atoum -d src
```

## En plus : les mocks
Lorsqu'on doit tester une classe, il peut être utile de l'isoler des autres classes dont son comportement peut dépendre (typiquement si on utilise de l'injection de dépendance). On pourrait donc soit modifier ces autres classes, soit créer des mocks de ces classes.

Un mock est une classe "virtuelle", copie d'une classe, dont on peut redéfinir les méthodes.

Pour créer un mock d'une classe avec Atoum (dans une classe de test) :
```php
<?php
// Créer le mock
$factory = new \mock\app\Domain\PentaminosFactory();

// Redéfinir ses méthodes, ici on veut que la méthode getList retourne un tableau vide tout le temps
$this->calling($factory)->getList = function() {
    return [];
};
```

- Plus d'info : http://docs.atoum.org/fr/latest/mocking_systems.html

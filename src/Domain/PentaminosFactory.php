<?php

namespace app\Domain;

class PentaminosFactory
{
    private $list = [];

    public function __construct()
    {
        foreach ($this->getPossibilities() as $p) {
            $this->list[] = new Pentaminos([$p[1], $p[2], $p[3], $p[4]], $p[0]);
        }
    }

    public function getList(): array
    {
        return $this->list;
    }

    private function getPossibilities()
    {
        return [
            [ 1, 1,2,3,4 ],         // This array represents everything the program
            [ 1, 10,20,30,40 ],     // knows about the individual pentominos.  Each
            [ 2, 9,10,11,20 ],      // row in the array represents a particular
            [ 3, 1,10,19,20 ],      // pentomino in a particular orientation.  Different
            [ 3, 10,11,12,22 ],     // orientations are obtained by rotating or flipping
            [ 3, 1,11,21,22 ],      // the pentomino over.  Note that the program must
            [ 3, 8,9,10,18 ],       // try each pentomino in each possible orientation,
            [ 4, 10,20,21,22 ],     // but must be careful not to reuse a piece if
            [ 4, 1,2,10,20 ],       // it has already been used on the board in a
            [ 4, 10,18,19,20 ],     // different orientation.
            [ 4, 1,2,12,22 ],       //     The pentominoes are numbered from 1 to 12.
            [ 5, 1,2,11,21 ],    // The first number on each row here tells which pentomino
            [ 5, 8,9,10,20 ],       // that line represents.  Note that there can be
            [ 5, 10,19,20,21 ],     // up to 8 different rows for each pentomino.
            [ 5, 10,11,12,20 ],     // some pentominos have fewer rows because they are
            [ 6, 10,11,21,22 ],     // symmetric.  For example, the pentomino that looks
            [ 6, 9,10,18,19 ],      // like:
            [ 6, 1,11,12,22 ],      //           GGG
            [ 6, 1,9,10,19 ],       //           G G
            [ 7, 1,2,10,12 ],       //
            [ 7, 1,11,20,21 ],      // can be rotated into three additional positions,
            [ 7, 2,10,11,12 ],      // but flipping it over will give nothing new.
            [ 7, 1,10,20,21 ],      // So, it has only 4 rows in the array.
            [ 8, 10,11,12,13 ],     //     The four remaining entries in the array
            [ 8, 10,20,29,30 ],     // describe the given piece in the given orientation,
            [ 8, 1,2,3,13 ],        // in a way convenient for placing the piece into
            [ 8, 1,10,20,30 ],      // the one-dimensional array that represents the
            [ 8, 1,11,21,31 ],      // board.  As an example, consider the row
            [ 8, 1,2,3,10 ],        //
            [ 8, 10,20,30,31 ],     //           [ 7, 1,2,10,19 ]
            [ 8, 7,8,9,10 ],        //
            [ 9, 1,8,9,10 ],        // If this piece is placed on the board so that
            [ 9, 10,11,21,31 ],     // its topmost/leftmost square fills position
            [ 9, 1,2,9,10 ],        // p in the array, then the other four squares
            [ 9, 10,20,21,31 ],     // will be at positions  p+1, p+2, p+10, and p+19.
            [ 9, 1,11,12,13 ],      // To see whether the piece can be played at that
            [ 9, 10,19,20,29 ],     // position, it suffices to check whether any of
            [ 9, 1,2,12,13 ],       // these five squares are filled.
            [ 9, 9,10,19,29 ],
            [ 10, 8,9,10,11 ],
            [ 10, 9,10,20,30 ],
            [ 10, 1,2,3,11 ],
            [ 10, 10,20,21,30 ],
            [ 10, 1,2,3,12 ],
            [ 10, 10,11,20,30 ],
            [ 10, 9,10,11,12 ],
            [ 10, 10,19,20,30 ],
            [ 11, 9,10,11,21 ],
            [ 11, 1,9,10,20 ],
            [ 11, 10,11,12,21 ],
            [ 11, 10,11,19,20 ],
            [ 11, 8,9,10,19],
            [ 11, 1,11,12,21 ],
            [ 11, 9,10,11,19 ],
            [ 11, 9,10,20,21 ],
            [ 12, 1,10,11,21 ],
            [ 12, 1,2,10,11 ],
            [ 12, 10,11,20,21 ],
            [ 12, 1,9,10,11 ],
            [ 12, 1,10,11,12 ],
            [ 12, 9,10,19,20 ],
            [ 12, 1,2,11,12 ],
            [ 12, 1,10,11,20 ]
        ];
    }
}

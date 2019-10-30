<?php

namespace App\Http\Controllers;

class ImATeapotController extends Controller
{
    /**
     * Display I'm a Teapot.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teapot = <<<EOF
                       (
            _           ) )
         _,(_)._        ((      I'm a little teapot
    ___,(_______).        )       short and stout
  ,'__.   /       \    /\_        here is my handle
 /,' /  |""|       \  /  /        here is my spout
| | |   |__|       |,'  /         when I get all steamed up
 \`.|                  /          hear me shout:
  `. :           :    /           "tip me over and pour me out!"
    `.            :.,'
      `-.________,-'            - Benji
EOF;

        return response($teapot, 418);
    }
}

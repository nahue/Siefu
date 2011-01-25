<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Crypt
 *
 * @author strato1986
 */
class Crypt {

    public static function claveAleatoria() {



        $chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKMNLOPQRSTUVXWYZ023456789";

        srand((double) microtime() * 1000000);

        $i = 0;

        $pass = '';



        while ($i <= 10) {

            $num = rand() % 33;

            $tmp = substr($chars, $num, 1);

            $pass = $pass . $tmp;

            $i++;
        }



        return $pass;
    }

}

?>

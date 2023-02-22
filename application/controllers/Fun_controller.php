<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fun_controller extends CI_Controller
{

    public function fun()
    {
        echo $this->fun2(5, 6);
    }
    private function fun2($x, $y)
    {
        $sum =  $x + $y;
        echo "sum of two value is" ." ". $x. " and" ." ". $y. " are = " . $sum;
        
    }

    public function fun1()
    {
        echo number_format("456723900",2)."<br>";
    }
}

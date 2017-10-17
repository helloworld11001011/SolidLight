<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class FightersTable extends Table
{
    function test(){
        return "Ok";
    }

    function getBestFighter(){
        $bestFighter = $this->find('all')->order(["Fighters.level" => "DESC"])->first();
        return $bestFighter["name"];
    }
}

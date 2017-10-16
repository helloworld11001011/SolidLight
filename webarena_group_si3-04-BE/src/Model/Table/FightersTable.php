<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class FightersTable extends Table
{
    function test(){
        return "Ok";
    }   
    
    function getBestFighter(){
        
        $bestFighter = $this->find('all')->where(["Fighters.player_id" === "545f827c-576c-4dc5-ab6d-27c33186dc3e"])->first();
        return $bestFighter["name"];
    }
    
     function getId(){
        
        $id = $this->find('all')->where(["Fighters.player_id" === "545f827c-576c-4dc5-ab6d-27c33186dc3e"])->first();
        return $id["id"];
    }
    
    function getPosX(){
        
        $PosX = $this->find('all')->where(["Fighters.player_id" === "545f827c-576c-4dc5-ab6d-27c33186dc3e"])->first();
        return $PosX["coordinate_x"];
    }
    
    function getPosY(){
        
        $PosY = $this->find('all')->where(["Fighters.player_id" === "545f827c-576c-4dc5-ab6d-27c33186dc3e"])->first();
        return $PosY["coordinate_y"];
    }
    
    function getLvl(){
        
        $LVL = $this->find('all')->where(["Fighters.player_id" === "545f827c-576c-4dc5-ab6d-27c33186dc3e"])->first();
        return $LVL["level"];
    }
    
    function getXp(){
        
        $Xp = $this->find('all')->where(["Fighters.player_id" === "545f827c-576c-4dc5-ab6d-27c33186dc3e"])->first();
        return $Xp["xp"];
    }
    
    function getSight(){
        
        $Sight = $this->find('all')->where(["Fighters.player_id" === "545f827c-576c-4dc5-ab6d-27c33186dc3e"])->first();
        return $Sight["skill_sight"];
    }
    
     function getStrength(){
        
        $Strength = $this->find('all')->where(["Fighters.player_id" === "545f827c-576c-4dc5-ab6d-27c33186dc3e"])->first();
        return $Strength["skill_strength"];
    }
    
     function getHealth(){
        
        $Health= $this->find('all')->where(["Fighters.player_id" === "545f827c-576c-4dc5-ab6d-27c33186dc3e"])->first();
        return $Health["skill_health"];
    }
    
    function getCHealth(){
        
        $CHealth= $this->find('all')->where(["Fighters.player_id" === "545f827c-576c-4dc5-ab6d-27c33186dc3e"])->first();
        return $CHealth["current_health"];
    }
    
    
}


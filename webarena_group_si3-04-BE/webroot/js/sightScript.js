function hoverOver(mat, isTooFar, name, level, strenght, health) {
    if(!isTooFar){
        if(mat == 0){
            $("#info").text("Just some grass.");
        }else{
            $("#info").text(name+" "+level+" "+strenght+" "+health);
        }
        
    }else{
        $("#info").text("Doesn't look like anything to me.");
    }
}
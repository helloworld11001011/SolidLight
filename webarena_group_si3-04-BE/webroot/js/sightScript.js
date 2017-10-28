function hoverOver(mat, isTooFar, health) {
    if(!isTooFar){
        $("#info").text(health);
    }else{
        $("#info").text("Doesn't look like anything to me.");
    }
}
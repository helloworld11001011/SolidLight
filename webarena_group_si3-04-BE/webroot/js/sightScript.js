function hoverOver(mat, isTooFar) {
        
    
    if(!isTooFar){
        $("#info").text(mat);
    }else{
        $("#info").text("Doesn't look like anything to me.");
    }
    
    
}
let Square=class{
    constructor(c, x, y){
        this.x = x;
        this.y = y;
        this.c = c;
    }
    show(){
        this.c.fillStyle = (this.c==c1)? baseColor : topColor;
        this.c.fillRect(size*this.x+border+padding+gap, size*this.y+border+padding+gap, size-gap, size-gap);
    }
}
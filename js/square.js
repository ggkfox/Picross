let Square=class{
    constructor(c, x, y, color){
        this.x = x;
        this.y = y;
        this.c = c;
        this.color = color;
    }
    show(){
        this.c.fillStyle = this.color;
        this.c.fillRect(size*this.x+border+padding+gap, size*this.y+border+padding+gap, size-gap, size-gap);
    }
}
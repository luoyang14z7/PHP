function dir(ele){
    this.el=$(ele);
    this.width=$(ele).width();
    this.height=$(ele).height();
};
dir.prototype.init=function(){
    this.addEvent();
};
dir.prototype.addEvent=function(){
    var dir=this;
    this.el.on('mouseenter mouseleave',function(e){
        dir.getPos(e.target);
        var w = dir.width,
            h = dir.height,
            x = ( e.pageX - $(this).offset().left - ( w/2 )) * ( w > h ? ( h/w ) : 1 ),
            y = ( e.pageY - $(this).offset().top  - ( h/2 )) * ( h > w ? ( w/h ) : 1 );
        dir.way = Math.round( ( ( ( Math.atan2(y, x) * (180 / Math.PI) ) + 180 ) / 90 ) + 3 ) % 4;
        if(e.type=="mouseenter") {
            dir.changeDir(dir.way,0);
            dir.showDir();
        }else{
            dir.changeDir(dir.way,1)
        }
    })
};
dir.prototype.getPos=function(e){
    var parent= e.parentNode;
    var el=e;
    this.elLeft=0;
    this.elTop=0;
    while(parent){
        this.elLeft+=el.offsetLeft;
        this.elTop+=el.offsetTop;
        el=parent;
        parent=el.parentNode;
        if(el.className == "dirBox")
            return true
    }
};
dir.prototype.changeDir=function(ori,type){
    switch(ori){
        case 0:
            this.childPos={ top:'-100%', left:'0%'};
            break;
        case 1:
            this.childPos={ top:'0%', left:'100%'};
            break;
        case 2:
            this.childPos={ top:'100%', left:'0%'};
            break;
        case 3:
            this.childPos={ top:'0%', left:'-100%'};
            break;
    }
    if(type===0)
        $(this.el).find('div').hide().css(this.childPos)
    else
        $(this.el).find('div').css(this.childPos)
};
dir.prototype.showDir=function(){
    $(this.el).find('div').show(0,function(){
        $(this).css({
            top:'0%',
            left:'0%'
        });
    })
}
$('.dirBox ul li').each(function(){
    var obj= new dir(this);
    obj.init();
})


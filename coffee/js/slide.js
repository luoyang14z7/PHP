var slideList=[
    {'ind':0,'img':'images/s-1.jpg'},
    {'ind':1,'img':'images/s-2.jpg'},
    {'ind':2,'img':'images/s-3.jpg'},
    {'ind':3,'img':'images/s-4.jpg'},
    {'ind':4,'img':'images/s-5.jpg'},
    {'ind':5,'img':'images/s-6.jpg'}
]
//slide 对象
var slide={
    itmes:5,//初始化显示轮播个数
    mheight:0,//外层盒子高度
    speed:2000,//动画速度
    autospeed:2500,//轮播间隔
    mwidth:0,//每张图片宽度
    showItems:0,//实际显示个数
    timer:0,//计时器
    canMmove:true,//用来判断是否可以进行下一个动画
    //响应式窗口大小及显示个数
    responsiveSize: {
        xs: {
            size:480,
            Items: 2
        },
        sm: {
            size:640,
            Items: 3
        },
        md: {
            size:768,
            Items: 3
        }
    },
    //初始化函数
    init:function(){
        slide.screenChange();
        slide.itemsChange();
        slide.widthChange();
        slide.heightChange();
        $(".slideBox").css('left',-slide.mwidth);
        slide.autoPlay();
    },
    //当屏幕大小发生改变
    screenChange:function(){
        $(window).resize(function(){
            $(".slideBox").css('left',-slide.mwidth);
            slide.itemsChange();
            slide.widthChange();
            slide.heightChange();
        })
    },
    //改变高度
    heightChange:function(){
        slide.mheight=$('.slide .slideBox>div img').height();
        $('.slide').css('height',slide.mheight+"px");
    },
    //改变宽度
    widthChange:function(){
        slide.mwidth=$('.slide div').width()/slide.showItems;
        $('.slide .slideBox div').css('width',slide.mwidth+"px");
    },
    //改变显示个数
    itemsChange:function(){
        if($('.slide div').width()<=slide.responsiveSize.xs.size){
            slide.showItems=slide.responsiveSize.xs.Items;
        }else if($('.slide div').width()<=slide.responsiveSize.sm.size){
            slide.showItems=slide.responsiveSize.sm.Items;
        }else if($('.slide div').width()<=slide.responsiveSize.md.size){
            slide.showItems=slide.responsiveSize.md.Items;
        }else{
            slide.showItems=slide.itmes;
        }
    },
    //向左移动
    moveLeft:function(){
        slide.canMmove=false;
        var space=parseInt($(".slideBox").css('left'))-slide.mwidth;
        $(".slideBox").stop().animate({
            left: space
        }, {
            queue:false, duration:slide.speed,
            easing: "linear",complete:function(){
                $(".slideBox").css('left',-slide.mwidth);
                $('.slideBox div:first-child').insertAfter( $('.slideBox div:last-child'));
                slide.canMmove=true;
            }
        } );
    },
    //向右移动
    moveRight:function(){
        slide.canMmove=false;
        var space=parseInt($(".slideBox").css('left'))+slide.mwidth;
        $(".slideBox").animate({
            left: space
        },{
            queue:false, duration:slide.speed,
            easing: "linear",complete:function(){
                $(".slideBox").css('left',-slide.mwidth);
                $('.slideBox div:last-child').insertBefore( $('.slideBox div:first-child'));
                slide.canMmove=true;
            }
        });
    },
    //自动播放
    autoPlay:function(){
        slide.timer=setInterval(function(){
            slide.moveRight();
        },slide.autospeed)
    }
}
//给左箭头添加事件
$('.leftRow').click(function(){
    if(slide.canMmove===true){
        clearInterval(slide.timer);
        slide.moveLeft();
        slide.autoPlay();
    }
});
//给右箭头添加事件
$('.rightRow').click(function(){
    if(slide.canMmove===true) {
        clearInterval(slide.timer);
        slide.moveRight();
        slide.autoPlay();
    }
});
//执行初始化事件
slide.init();

var slideList=[
    {'ind':0,'img':'images/s-1.jpg'},
    {'ind':1,'img':'images/s-2.jpg'},
    {'ind':2,'img':'images/s-3.jpg'},
    {'ind':3,'img':'images/s-4.jpg'},
    {'ind':4,'img':'images/s-5.jpg'},
    {'ind':5,'img':'images/s-6.jpg'}
]
//slide ����
var slide={
    itmes:5,//��ʼ����ʾ�ֲ�����
    mheight:0,//�����Ӹ߶�
    speed:2000,//�����ٶ�
    autospeed:2500,//�ֲ����
    mwidth:0,//ÿ��ͼƬ���
    showItems:0,//ʵ����ʾ����
    timer:0,//��ʱ��
    canMmove:true,//�����ж��Ƿ���Խ�����һ������
    //��Ӧʽ���ڴ�С����ʾ����
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
    //��ʼ������
    init:function(){
        slide.screenChange();
        slide.itemsChange();
        slide.widthChange();
        slide.heightChange();
        $(".slideBox").css('left',-slide.mwidth);
        slide.autoPlay();
    },
    //����Ļ��С�����ı�
    screenChange:function(){
        $(window).resize(function(){
            $(".slideBox").css('left',-slide.mwidth);
            slide.itemsChange();
            slide.widthChange();
            slide.heightChange();
        })
    },
    //�ı�߶�
    heightChange:function(){
        slide.mheight=$('.slide .slideBox>div img').height();
        $('.slide').css('height',slide.mheight+"px");
    },
    //�ı���
    widthChange:function(){
        slide.mwidth=$('.slide div').width()/slide.showItems;
        $('.slide .slideBox div').css('width',slide.mwidth+"px");
    },
    //�ı���ʾ����
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
    //�����ƶ�
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
    //�����ƶ�
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
    //�Զ�����
    autoPlay:function(){
        slide.timer=setInterval(function(){
            slide.moveRight();
        },slide.autospeed)
    }
}
//�����ͷ����¼�
$('.leftRow').click(function(){
    if(slide.canMmove===true){
        clearInterval(slide.timer);
        slide.moveLeft();
        slide.autoPlay();
    }
});
//���Ҽ�ͷ����¼�
$('.rightRow').click(function(){
    if(slide.canMmove===true) {
        clearInterval(slide.timer);
        slide.moveRight();
        slide.autoPlay();
    }
});
//ִ�г�ʼ���¼�
slide.init();

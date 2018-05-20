var app=angular.module('myApp',['ng','ngRoute']);
app.config(function ($routeProvider) {
    //����·��
    $routeProvider
        .when('/main',{
            templateUrl:'tpl/main.html',
            controller:'indexCtr'
        })
        .when('/gallery',{
            templateUrl:'tpl/gallery.html',
            controller:'galleryCtr'
        })
        .when('/about',{
            templateUrl:'tpl/about.html',
            controller:'aboutCtr'
        })
        .when('/game',{
            templateUrl:'tpl/game.html',
            controller:'gameCtr'
        })
        .when('/register',{
            templateUrl:'tpl/register.html',
            controller:'registerCtr'
        })
        .when('/login',{
            templateUrl:'tpl/login.html',
            controller:'loginCtr'
        })
        .when('/shop',{
            templateUrl:'tpl/shop.html',
            controller:'shopCtr'
        })
        .when('/center',{
            templateUrl:'tpl/center.html',
            controller:'centerCtr'
        })
        .when('/pdetail/:id',{
            templateUrl:'tpl/productDetail.html',
            controller:'pdCtr'
        })
        .otherwise({
            redirectTo:'/main'
        });

})
app.controller("mainCtr",["$rootScope","$scope","$location","$http",function($rootScope,$scope,$location,$http){
    //导航切换
    $scope.Go=function(url){
        $location.path(url);
    }
    //判断banner是否显示
    $rootScope.bannerShow=false;
    $scope.user={};
    //显示登录框
    $scope.loginin=function(){
        event.preventDefault();
        $('.banner .banner-content').toggleClass('loginShow');
    }
    //登录和注册共用方法
    $scope.sub=function(type){
        //用来判断手机和密码的正则
        var regp=/^1[345678]\d{9}$/;
        var regpwd=/^\w{6,12}$/;
        //用来确定输入内容是否正确和返回所显示的值
        $scope.checkP={flag:false,msg:""};
        $scope.checkW={flag:false,msg:""};
        $scope.checkCW={flag:false,msg:""};
        //判断手机
        if($scope.user.uphone){
            if(regp.test(parseInt($scope.user.uphone))){
                $scope.checkP.flag=false;
                $scope.checkP.msg=""
            }
            else{
                $scope.checkP.flag=true;
                $scope.checkP.msg="请填写正确的手机号"
            }
        }else{
            $scope.checkP.flag=true;
            $scope.checkP.msg="手机号不能为空"
        }
        //判断密码
        if($scope.user.upwd){
            if(regpwd.test($scope.user.upwd)){
                $scope.checkW.flag=false;
                $scope.checkW.msg=""
            }
            else{
                $scope.checkW.flag=true;
                $scope.checkW.msg="请填写正确的密码"
            }
        }else{
            $scope.checkW.flag=true;
            $scope.checkW.msg="密码不能为空"
        }
        //type用来判断是登录还是注册
        if(type===1) {
            //判断再次输入密码
            if ($scope.user.cpwd) {
                if ($scope.user.upwd === $scope.user.cpwd) {
                    $scope.checkCW.flag = false;
                    $scope.checkCW.msg = ""
                }
                else {
                    $scope.checkCW.flag = true;
                    $scope.checkCW.msg = "两次密码不一致"
                }
            } else {
                $scope.checkCW.flag = true;
                $scope.checkCW.msg = "确认密码不能为空"
            }
        }
        //如果三个都正确异步提交
        if($scope.checkCW.flag===$scope.checkW.flag===$scope.checkP.flag===false){
            $scope.user.type=type;
            $.ajax({
                type:"POST",
                url:"data/register.php",
                data:$scope.user,
                success:function(obj){
                    //code===3时为账号已存在或账号密码正确
                    if(obj.code===3){
                        //用type来区分登录与注册
                        if(type===1)
                            alert('该账号已存在');
                        else{
                            //缓存uid和uphone
                            sessionStorage.setItem('uid',obj.uid);
                            sessionStorage.setItem('uphone',$scope.user.uphone);
                            $('.login').css('display','none');
                            $('.logined').css('display','block');
                            $('.banner-content').css('display','none');
                            $('.logined span').html($scope.user.uphone+",");
                            $scope.user={};
                            location.href="#/main";
                        }
                    }else{
                        //返回账号不存在或账号密码错误
                        if(type===1) {
                            alert('注册成功');
                            $scope.user={};
                            location.href = '#/main';
                        }else
                            alert('账号或密码错误');
                    }
                }
            })
        }
    }
    //退出登录方法
    $scope.exit=function(){
        event.preventDefault();
        sessionStorage.removeItem('uid');
        sessionStorage.removeItem('uphone');
        $('.login').css('display','block');
        $('.logined').css('display','none');
        $('.banner-content').css('display','none');
        $('.logined span').html("");
    }
    //判断是否登录，否跳回主页提示登录
    $scope.checkLogin=function(){
        if(!sessionStorage.uid){
            $location.path('/login');
            return false;
        }
        return true;
    }
    //添加商品到购物车中
    $scope.addcart=function(){
        if($scope.checkLogin()) {
            $http.post('data/addProToCart.php?uid=' + sessionStorage.uid + '&pid=' + $(event.target).attr('data-product')).success(function (obj) {
                if (obj.code === 0) {
                    $('.addSuccess').css('opacity', '0.8');
                    var timer = setTimeout(function () {
                        $('.addSuccess').css('opacity', '0');
                        clearTimeout(timer);
                    }, 1000)
                }
            })
        }
    }
}])
app.controller("indexCtr",["$rootScope","$scope","$location",function($rootScope,$scope,$location){
    $rootScope.bannerShow=false;
}])
app.controller("aboutCtr",["$rootScope","$scope","$location",function($rootScope,$scope,$location){
    $rootScope.bannerShow=false;
}])
app.controller("galleryCtr",["$rootScope","$scope","$location",function($rootScope,$scope,$location){
    $rootScope.bannerShow=false;

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
    setTimeout(function(){
        $('.dirBox ul li').each(function(){
            var obj= new dir(this);
            obj.init();
        })
    },300)
}])
app.controller("gameCtr",["$rootScope","$scope","$location",function($rootScope,$scope,$location){
    $rootScope.bannerShow=false;
}])
app.controller("registerCtr",["$rootScope","$scope","$location",function($rootScope,$scope,$location){
    $rootScope.bannerShow=true;

}])
app.controller("loginCtr",["$rootScope","$scope","$location",function($rootScope,$scope,$location){
    $rootScope.bannerShow=true;
}])
app.controller("shopCtr",["$rootScope","$scope","$location","$http",function($rootScope,$scope,$location,$http){
    $rootScope.bannerShow=false;
    $scope.loadProductByPage=function(Num){
        //用jquery的异步请求有问题，最后使用ng的HTTP
        $http.get('data/product.php?pageNum='+Num).success(function(obj){
            $scope.productlist=obj.data;
            var html='';//分页条中的内容
            if((obj.pageNum-2)>0){
                html+=`<li ><a href='${obj.pageNum-2}'>${obj.pageNum-2}</a></li>`;
            }
            if((obj.pageNum-1)>0){
                html+=`<li ><a href='${obj.pageNum-1}'>${obj.pageNum-1}</a></li>`;
            }
            html+=`<li ><a class='olactive' href='${obj.pageNum}'>${obj.pageNum}</a></li>`;
            if((obj.pageNum+1)<=obj.pageCount){
                html+=`<li ><a href='${obj.pageNum+1}'>${obj.pageNum+1}</a></li>`;
            }
            if((obj.pageNum+2)<=obj.pageCount){
                html+=`<li ><a href='${obj.pageNum+2}'>${obj.pageNum+2}</a></li>`;
            }
            $('.pager').html(html);
        })
    }
    $scope.loadProductByPage(1);
    $('.pager').on('click','a',function(e){
        e.preventDefault();
        var pn=$(this).attr('href');//要显示的页号
        $scope.loadProductByPage(pn);//异步加载商品数据
    });
}])
app.controller("pdCtr",["$rootScope","$scope","$location","$routeParams","$http",function($rootScope,$scope,$location,$routeParams,$http){
    $rootScope.bannerShow=true;
    //获取路由传过来的商品ID
    $scope.pid=$routeParams.id;
    //异步请求商品数据
    //用jquery的异步请求会出问题，最后使用ng的HTTP
    $http.get('data/productDetail.php?pid='+$scope.pid).success(function(obj){
        //将该用户购物车中的商品详细信息存起来
        $scope.productdetailt=obj.data;
    })
}])
app.controller("centerCtr",["$rootScope","$scope","$location","$http",function($rootScope,$scope,$location,$http){
    $rootScope.bannerShow=true;
    $scope.checkLogin();
    $scope.hidecart=false;
    //用来判断购物车中是否有东西，没有就隐藏
    //切换购物车与我的订单
    $scope.togCartAndOrder=function(type){
        event.preventDefault();
        if(type===0) {
             if($('.mycart').find('.listitem').length!==0)
                $scope.hidecart = false;
            else {
                 $scope.getOrder();
                 $scope.hidecart = true;
             }
        }
        else{
            $scope.getOrder();
            $scope.hidecart=true;
        }

    }
    //用来存储订单信息
    $scope.orderInfo={'oprice':0};
    //异步请求每个商品的详细信息
    $scope.getCartDetail=function() {
        $http.get('data/getCartDetail.php?uid=' + sessionStorage.uid).success(function (obj) {
            //code为6时购物车为空
            if (obj.code == 6) {
                $scope.hidecart = true;
            } else
                $scope.productdetailt = obj.data;
            //计算首次获取所有商品的总价格
            for (var k in obj.data) {
                obj.data[k].allprice = parseInt(obj.data[k].count) * parseInt(obj.data[k].price);
                $scope.orderInfo.oprice += obj.data[k].allprice;
            }
            $('.mycart .pay ul').on('click', 'li', function () {
                $(this).siblings('.payactive').removeClass('payactive');
                $(this).addClass('payactive');
            })
        })
    }
    $scope.getCartDetail();
    //当点击加号时执行的函数
    $scope.add=function(){
        $(event.target).next().html(parseInt($(event.target).next().html())+1);
        $scope.changeprice($(event.target).next(),0);
    }
    //当点击减号时所执行的函数
    $scope.del=function(){
        //数量最少为1
        if(parseInt($(event.target).prev().html())-1>=1) {
            $(event.target).prev().html(parseInt($(event.target).prev().html()) - 1);
            $scope.changeprice($(event.target).prev(), 1);
        }
    }
    //此函数用来更新页面数据el是该商品的总价，type 0加 1减 3删除
    $scope.changeprice=function(el,type){
        //当加减时
        if(el!=undefined&& type!==3) {
            //获取该商品的单价，单价存在于自定义属性data-price中
            var price = parseInt($(el).attr('data-price'));
            //获取该商品数量
            var count = parseInt($(el).html());
            //计算该商品总价并赋值
            $(el).parent().next().children().html(price * count);
            //更新所有商品的总价
            if(type==0)
                $scope.orderInfo.oprice= $scope.orderInfo.oprice+price;
            else
                $scope.orderInfo.oprice= $scope.orderInfo.oprice-price;
        }
        //点击删除时执行操作
        if(type===3){
            //所有商品总价减去删除商品的总价
            $scope.orderInfo.oprice-=parseInt(el.html());
        }

    }
    //点击删除所执行的函数
    $scope.delete=function(){
        var $el=$(event.target)
        $http.get('data/deleteCartProduct.php?did='+$el.attr('data-did')).success(function(obj){
            if(obj.code==0){
                $scope.changeprice($el.parents('.listitem').find('.allpay').children(),3);
                $el.parents('.listitem').remove();
            }
            if($('.mycart').find('.listitem').length===0)
                $scope.hidecart=true;
        })
    }
    //提交订单
    $scope.subOrder=function(){
        var regp=/^1[345678]\d{9}$/;
        if(!$scope.orderInfo.oname)
            return   alert('请填写收件人');
        if(!$scope.orderInfo.ophone)
            return alert('请填写手机号');
        if(!regp.test(parseInt($scope.orderInfo.ophone)))
            return alert('请填写正确的手机号');
        if(!$scope.orderInfo.oaddress)
            return alert('请填写收件地址');
        if($('.mycart .pay ul li[class=payactive]').length===0)
            return alert('请填选择支付方式');
        else
            $scope.orderInfo.opay=$('.mycart .pay ul li[class=payactive]').html();
//        $scope.orderInfo.otime= Date.parse( new Date() ).toString();
        $scope.orderInfo.otime=new Date().getTime();
        $scope.orderInfo.ostate="未确认";
        $scope.orderInfo.uid=parseInt(sessionStorage.uid);
        //如要使用angularsjs 中的POST请求需设置它的请求头部
        $http.defaults.headers.post = {
            'Content-Type' : 'application/x-www-form-urlencoded'
        };
        //并将传输对象序列化使用Jquery的$.param()
        $http.post('data/addOrder.php',$.param($scope.orderInfo)).success(function(obj){
            if(obj.code===0){
                var oid=obj.oid;
                $('.list .listitem').each(function(i,e){
                    var data={'oid':oid,'pid':$(e).attr('data-productid'),'count':$(e).find('.num').children(':nth-child(2)').html()};
                    $http.post('data/addOrderDetail.php',$.param(data)).success(function(obj){

                    })
                    $http.get('data/deleteCartProduct.php?did='+$(e).find('.del').attr('data-did')).success(function(obj){

                    })
                })
                $('.mycart').remove();
                alert('订单提交成功');

            }

        })
    }
    //异步获取订单信息
    $scope.getOrder=function(){
        $http.get('data/getOrder.php?uid='+parseInt(sessionStorage.uid)).success(function(obj){
                if(obj.code===1){
                    $scope.orderlist=obj.data;
                }else{
                    $orderlist={};
                }
        })
    }
    $scope.getOrder();
}])

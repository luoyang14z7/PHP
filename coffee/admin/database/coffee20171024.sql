set names utf8;CREATE TABLE `adminusers` (
  `username` varchar(20) NOT NULL,
  `password` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into `adminusers`(`username`,`password`) values('admin','123456');

CREATE TABLE `cartdetail` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `cartid` int(11) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
insert into `cartdetail`(`did`,`cartid`,`productid`,`count`) values('1','2','1','2');
insert into `cartdetail`(`did`,`cartid`,`productid`,`count`) values('3','2','2','5');

CREATE TABLE `orderdetail` (
  `opid` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`opid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
insert into `orderdetail`(`opid`,`oid`,`pid`,`count`) values('1','1','2','1');
insert into `orderdetail`(`opid`,`oid`,`pid`,`count`) values('2','2','2','2');
insert into `orderdetail`(`opid`,`oid`,`pid`,`count`) values('3','2','1','1');
insert into `orderdetail`(`opid`,`oid`,`pid`,`count`) values('4','2','5','1');
insert into `orderdetail`(`opid`,`oid`,`pid`,`count`) values('5','2','9','1');
insert into `orderdetail`(`opid`,`oid`,`pid`,`count`) values('6','3','1','3');
insert into `orderdetail`(`opid`,`oid`,`pid`,`count`) values('7','4','2','3');

CREATE TABLE `orderlist` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `oname` varchar(32) DEFAULT NULL,
  `ophone` varchar(64) DEFAULT NULL,
  `oaddress` varchar(64) DEFAULT NULL,
  `opay` varchar(32) DEFAULT NULL,
  `oprice` int(11) DEFAULT NULL,
  `otime` bigint(20) DEFAULT NULL,
  `ostate` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
insert into `orderlist`(`oid`,`uid`,`oname`,`ophone`,`oaddress`,`opay`,`oprice`,`otime`,`ostate`) values('3','8','赵莹','18851733799','金陵科技学院','微信支付','897','1508469152464','发货中，订单号为：5135135135');
insert into `orderlist`(`oid`,`uid`,`oname`,`ophone`,`oaddress`,`opay`,`oprice`,`otime`,`ostate`) values('4','9','18851733799','18851733799','1','支付宝支付','1197','1508469249272','未确认');

CREATE TABLE `product` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(32) DEFAULT NULL,
  `ptitle` varchar(64) DEFAULT NULL,
  `pinfo` varchar(128) DEFAULT NULL,
  `pOrigin` varchar(16) DEFAULT NULL,
  `pwork` varchar(16) DEFAULT NULL,
  `ptasty` varchar(64) DEFAULT NULL,
  `pacidity` varchar(16) DEFAULT NULL,
  `palcohol` varchar(16) DEFAULT NULL,
  `pmfood` varchar(64) DEFAULT NULL,
  `plike` varchar(32) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `img` varchar(128) DEFAULT NULL,
  `bmimg` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
insert into `product`(`pid`,`pname`,`ptitle`,`pinfo`,`pOrigin`,`pwork`,`ptasty`,`pacidity`,`palcohol`,`pmfood`,`plike`,`price`,`img`,`bmimg`) values('1','凤舞祥云综合','均衡的风味带有草本和可可粉的香味','这款与众不同的综合咖啡是首款采用中国云南保山地区的咖啡豆和其他来自亚洲、太平洋地区的咖啡混合制成的综合咖啡豆。','亚洲/太平洋','水洗法/半水洗法','温和清爽的酸度，中等醇度，均衡的风味并带有草本和可可粉的香味','较低','中等','奶油芝士类食品，太妃、枫糖和坚果类食品','低因祥龙综合咖啡®','299','images/p13.jpg','images/lp13.jpg');
insert into `product`(`pid`,`pname`,`ptitle`,`pinfo`,`pOrigin`,`pwork`,`ptasty`,`pacidity`,`palcohol`,`pmfood`,`plike`,`price`,`img`,`bmimg`) values('2','哥伦比亚','果仁味，可可味','醇度适中，口感顺滑平和，喝下去满口丰盈，并留下清脆而带有坚果的回味。','拉丁美洲','水洗法','果仁味，可可味','中等','中等','胡桃，山核桃，焦糖','首选咖啡、危地马拉安提瓜咖啡','399','images/p2.jpg','images/lp2.jpg');
insert into `product`(`pid`,`pname`,`ptitle`,`pinfo`,`pOrigin`,`pwork`,`ptasty`,`pacidity`,`palcohol`,`pmfood`,`plike`,`price`,`img`,`bmimg`) values('3','综合咖啡豆','清爽，且极为平和','首选咖啡是一款中等醇度的拉丁美洲综合咖啡，其特点是具有活泼的酸度，以及清爽且极为平和的风味。','拉丁美洲','水洗法','清爽，且极为平和','中等','中等','果仁，苹果，蓝莓','危地马拉安提瓜咖啡','399','images/p6.jpg','images/lp6.jpg');
insert into `product`(`pid`,`pname`,`ptitle`,`pinfo`,`pOrigin`,`pwork`,`ptasty`,`pacidity`,`palcohol`,`pmfood`,`plike`,`price`,`img`,`bmimg`) values('4','派克市场®烘焙','可可味，烘烤果仁味','中等醇度并伴随着可可和烤果仁的微妙风味，呈现出一杯令人愉悦而口感平衡的咖啡。','拉丁美洲','水洗法','可可味，烘烤果仁味','中等','中等','巧克力，肉桂，果仁','首选咖啡、危地马拉安提瓜咖啡','399','images/p10.jpg','images/lp10.jpg');
insert into `product`(`pid`,`pname`,`ptitle`,`pinfo`,`pOrigin`,`pwork`,`ptasty`,`pacidity`,`palcohol`,`pmfood`,`plike`,`price`,`img`,`bmimg`) values('5','肯亚','葡萄柚味，浆果味','肯亚咖啡拥有多层次复杂的风味，包含果汁般的酸度、明显的葡萄柚味和葡萄酒的醇香，醇度中等。','非洲/阿拉伯','水洗法','葡萄柚味，浆果味','较高','中等','葡萄柚，浆果，无核葡萄干，葡萄干','埃塞俄比亚斯丹摩咖啡','399','images/p8.jpg','images/lp8.jpg');
insert into `product`(`pid`,`pname`,`ptitle`,`pinfo`,`pOrigin`,`pwork`,`ptasty`,`pacidity`,`palcohol`,`pmfood`,`plike`,`price`,`img`,`bmimg`) values('6','危地马拉安提瓜','可可味，香料味','这是一款典雅、丰富并具有深度的咖啡，其精致的酸度与微妙的可可粉质感以及柔和的香料风味完美地平衡在了一起。','拉丁美洲','水洗法','可可味，香料味','中等','中等','可可，苹果，焦糖，果仁','首选咖啡','399','images/p5.jpg','images/lp5.jpg');
insert into `product`(`pid`,`pname`,`ptitle`,`pinfo`,`pOrigin`,`pwork`,`ptasty`,`pacidity`,`palcohol`,`pmfood`,`plike`,`price`,`img`,`bmimg`) values('7','早餐综合','明亮，香气扑鼻','这款醇度清淡的综合咖啡活泼而清爽，唤醒你的味蕾，带给你明快的第一印象，让你焕然一新，开始新的一天。','拉丁美洲','水洗法','明亮，香气扑鼻','较高','清淡','果仁，苹果，蓝莓，柠檬','首选咖啡，危地马拉安提瓜咖啡','399','images/p1.jpg','images/lp1.jpg');
insert into `product`(`pid`,`pname`,`ptitle`,`pinfo`,`pOrigin`,`pwork`,`ptasty`,`pacidity`,`palcohol`,`pmfood`,`plike`,`price`,`img`,`bmimg`) values('8','埃塞俄比亚','柑橘，可可味','这款醇度清淡的综合咖啡活泼而清爽，唤醒你的味蕾，带给你明快的第一印象，让你焕然一新，开始新的一天。','拉丁美洲','水洗法','明亮，香气扑鼻','较高','清淡','果仁，苹果，蓝莓，柠檬','首选咖啡，危地马拉安提瓜咖啡','399','images/p4.jpg','images/lp4.jpg');
insert into `product`(`pid`,`pname`,`ptitle`,`pinfo`,`pOrigin`,`pwork`,`ptasty`,`pacidity`,`palcohol`,`pmfood`,`plike`,`price`,`img`,`bmimg`) values('9','意式烘焙','烘烤甜味，淡淡的烟熏味','这是一款醇度浓郁的多区域综合咖啡，经过比浓缩烘焙咖啡更深度的烘焙，它浓烈而香甜，并带有淡淡的烟熏风味。','多区域','水洗法','烘烤甜味，淡淡的烟熏味','较低','中等','巧克力，焦糖，香料','浓缩烘焙咖啡，佛罗娜咖啡®','399','images/p7.jpg','images/lp7.jpg');
insert into `product`(`pid`,`pname`,`ptitle`,`pinfo`,`pOrigin`,`pwork`,`ptasty`,`pacidity`,`palcohol`,`pmfood`,`plike`,`price`,`img`,`bmimg`) values('10','浓缩烘焙','焦糖味，烘焙味','这款综合咖啡是我们所有浓缩咖啡饮料的核心，其特点是浓郁的香味以及柔和的酸度，且与浓厚的焦糖香甜味平衡搭配。','多区域','水洗法','焦糖味，烘焙味','较低','厚重','焦糖，香料，巧克力，果仁','佛罗娜咖啡®，危地马拉安提瓜咖啡','399','images/p3.jpg','images/lp3.jpg');
insert into `product`(`pid`,`pname`,`ptitle`,`pinfo`,`pOrigin`,`pwork`,`ptasty`,`pacidity`,`palcohol`,`pmfood`,`plike`,`price`,`img`,`bmimg`) values('11','佛罗娜®咖啡','烘烤甜味','这是一款来自拉丁美洲咖啡和亚洲／太平洋地区咖啡的综合咖啡，醇度厚重，并带有意式烘焙咖啡的香甜味。','多区域','水洗法，半水洗法','烘烤甜味','中等','厚重','牛奶和黑巧克力、焦糖','浓缩烘焙咖啡','399','images/p12.jpg','images/lp12.jpg');
insert into `product`(`pid`,`pname`,`ptitle`,`pinfo`,`pOrigin`,`pwork`,`ptasty`,`pacidity`,`palcohol`,`pmfood`,`plike`,`price`,`img`,`bmimg`) values('12','低因祥龙综合','泥土芳香，草药味，香料味','具有浓郁的草药味、香料味和泥土芳香；这款浓郁而平和的亚洲/太平洋地区综合咖啡展现出厚重的醇度以及令人惊奇的酸度之间的良好平衡。','亚洲/太平洋','水洗法，半水洗法','泥土芳香，草药味，香料味','较低','厚重','肉桂，燕麦片，枫糖，黄油面包','苏门答腊咖啡','399','images/p9.jpg','images/lp9.jpg');
insert into `product`(`pid`,`pname`,`ptitle`,`pinfo`,`pOrigin`,`pwork`,`ptasty`,`pacidity`,`palcohol`,`pmfood`,`plike`,`price`,`img`,`bmimg`) values('13','苏门答腊','草药味，泥土芳香','带有强烈的泥土芳香，风味异常集中；醇度厚重而浓郁，苏门答腊咖啡是我们非常畅销的其中一款单品咖啡。','亚洲/太平洋','半水洗法','草药味,泥土芳香','较低','厚重','肉桂，燕麦片，枫糖，黄油，太妃糖','低因祥龙综合咖啡®','399','images/p11.jpg','images/lp11.jpg');

CREATE TABLE `shopcart` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
insert into `shopcart`(`cid`,`uid`) values('1','1');
insert into `shopcart`(`cid`,`uid`) values('2','2');
insert into `shopcart`(`cid`,`uid`) values('3','8');
insert into `shopcart`(`cid`,`uid`) values('4','9');

CREATE TABLE `users` (
  `uid` int(100) NOT NULL AUTO_INCREMENT,
  `uphone` varchar(24) DEFAULT NULL,
  `upwd` varchar(12) DEFAULT NULL,
  `ucid` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
insert into `users`(`uid`,`uphone`,`upwd`,`ucid`) values('8','13270753218','123456','');
insert into `users`(`uid`,`uphone`,`upwd`,`ucid`) values('9','18851733799','159951','');


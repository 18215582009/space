<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="css/swiper-4.2.0.min.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.min.css" />
    <style type="text/css">
        body,
        html {
            width: 100%;
            height: 100%;
            margin: 0;
            font-family: "微软雅黑";
        }
        * {
			margin: 0px;
			padding: 0px;
			box-sizing: border-box;
			-webkit-tap-highlight-color: transparent;
		}
        #allmap {
            height: 100%;
            width: 100%;
        }

        #r-result {
            width: 100%;
        }

        .location {
            position: fixed;
            bottom: 50px;
            z-index: 555;
            right: 5%;
            border-radius: 50%;
        }

        .location img {
            height: 60px;
            width: 60px;
        }

        .footer {
            width: 100%;
            height: 49px;
            box-shadow: 0px -1px 1px 0px rgba(0, 0, 0, 0.1);
            position: fixed;
            bottom: 0;
            left: 0;
            z-index: 5;
            background-color: #FFFFFF;
        }

        li,
        ol {
            list-style: none
        }

        .footer li {
            float: left;
            width: 33.33%;
            height: 48px;
            text-align: center;
            line-height: 73px;
            color: #999999;
            font-size: 12px;
            background-repeat: no-repeat;
            background-position: center 7px;
            background-size: 20px 20px;
        }

        .footer .footer_on {
            color: #e68d61;
            background-image: url(../img/person-h.png);
        }

        .footer .footer_no_me {
            color: #999;
            background-image: url(../img/me.png);
        }

        .swiper-container {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            /* font-size: 18px; */
            background: transparent;
            height:48px;
            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
            width: 80px;
        }

        .swiper-slide {
            color: #fff;
        }

        .index_search {
            width: 40px;
            position: absolute;
            height: 28px;
            padding-top: 4px;
            z-index: 10000000;
           margin-top:10px;
            border-right:2px solid #fff;
        }

        .index_search_y input {
            width: 80%;
            height: 30px;
            position: relative;
            top: -2px;
            padding-left: 5px;
            border:none;
            border-radius: 4px;
        }

        .index_search img{
            padding:0 5px;
            width:33px;
            position: relative;
            top: -8px;
        }

		.index_search_y img {
			padding: 0 5px;
			margin-top: 4px;
			position: relative;
			width:33px;
			top:5px;
		}

		.index_search_y {
			position: absolute;
			z-index: 10000000000;
			padding-left: 15px;
			width: 100%;
			height: 100%;
			background: #BB694F;
		}
        .search_txt{
            font-size: 14px;
            color:#fff;
            padding:15px 10px;
            background: rgba(0, 0, 0, 0.4);
            font-weight: bold;
            position: fixed;
            top:45%;
            z-index: 555;
            left: 40%;
        }
        
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=XVYedbv9ZDSuHaqGzDoxDhWnzabWycIc"></script>
    <script type="text/javascript" src="js/swiper-4.2.0.min.js"></script>
    <title>126+</title>
</head>

<body onload="setIndex()">
    <div class="lr_nb">
        <div class="index_search">
            <img src="img/nav-search.png" alt="" onclick="showSearch()">
        </div>
        <div class="index_search_y display_flex align-items_center animated" style="display:none">
            <input id="search_input" type="text">
            <img src="img/nav-search.png" alt="">
        </div>

        <div class="swiper-container" style="margin-left:48px;">
            <div class="swiper-wrapper">
                <div class="swiper-slide current">51文青节</div>
                <div class="swiper-slide ">餐饮娱乐</div>
                <div class="swiper-slide">体育健身</div>
                <div class="swiper-slide">设计手工</div>
                <div class="swiper-slide">酒店旅社</div>
                <div class="swiper-slide">音乐演出</div>
                <div class="swiper-slide">摄影摄像</div>
                <div class="swiper-slide">婚庆周边</div>
                <div class="swiper-slide">美术相关</div>
                <div class="swiper-slide">办公文教</div>
                <div class="swiper-slide">园区服务</div>
                <div class="swiper-slide"></div>
               
                
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="search_txt"  style="display:none">
        没有搜索到关键字哦~
    </div>
    <!-- 厕所 -->
    <div class="position_wc">
        <span class="position_arc"></span>
        <span>公共厕所</span>
    </div>
    <div class="lr_nb_after"></div>
    <div id="allmap"></div>

    <footer class="footer" style="z-index:10000000000">
        <li class="footer_on" style="background-image: url(img/map-h.png);">在线地图</li>
        <li style="background-image: url(img/share.png);" onclick="javascript:window.location.href='shareList.html'">分享榜</li>
        <li style="background-image: url(img/me.png);" onclick="javascript:window.location='person.html?time='+(new Date()).getTime()">个人中心</li>
    </footer>
    <div class="location" onclick="toDetail()">
        <img src="img/list.png">
    </div>
</body>

</html>
<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/login.js"></script>
<script type="text/javascript">
    //分类id
    var catid = GetUrlString('catid');
    //商户id
    var id = GetUrlString('id');
    var all_data = [
    [116.326305, 39.957734, "纯音剧场-副会场", 1],
        [116.34657, 39.966251, "舶宫剧场-副会场", 1],
        [116.331623, 39.965477, "草坪-主会场", 1],
        [116.384228,39.949438, "原创集市", 2],
        [116.371435, 39.950544, "艺轩书画", 278],
        [116.372585, 39.945234, "艺术家工作室", 279],
        [116.377185, 39.943243, "青少年文创中心", 280],
        [116.423465, 39.932842, "绵阳美协", 282],
        [116.430939, 39.929854, "艺术家工作室", 283],
        [116.46026, 39.940587, "重工展览", 284],
        [116.329754, 39.956186, "麦道格斗馆", 286],
        [116.353901, 39.950876, "广场舞协会", 287],
        [116.39242, 39.949438, "飞越丛林", 288],
        [116.453792, 39.946562, "悟道馆", 289],
        [116.356056, 39.950434, "壹半之旅", 291],
        [116.372298, 39.951429, "三之首", 292],
        [116.381784, 39.943243, "星榜样", 293],
        [116.357575, 39.915014, "愿望树", 294],
        [116.364034,39.926369, "易家科技", 295],
        [116.372083,39.926811, "众创空间", 296],
        [116.371364,39.924266, "帆恒科技", 322],
        [116.36389,39.924377, "阳扬科技", 326],
        [116.412254, 39.925207, "幸福时光", 297],
        [116.42634, 39.927199, "莱士顿", 298],
        [116.427777, 39.930297, "青之蓝", 299],
        [116.441719, 39.923436, "涪泉乳液", 300],
        [116.454367, 39.949659, "尚辰幼儿园", 301],
        [116.380347, 39.955854, "图腾摄影", 305],
        [116.364968, 39.95331, "乐町摄影", 306],
        [116.374454, 39.953088, "俞飞摄影", 307],
        [116.371867, 39.950212, "六月摄影", 308],
        [116.371292, 39.925539, "群丽婚纱", 309],
        [116.41901, 39.933838, "爵士影像", 310],
        [116.423034, 39.931072, "北京闪耀", 311],
        [116.431227, 39.928748, "博纳文化", 312],
        [116.430652, 39.925871, "初木视觉", 313],
        [116.342546, 39.949549, "蜜地便利店", 302],
        [116.380059, 39.925649, "乐汇云", 303],
        [116.458679, 39.937932, "园区办公室", 304],
        [116.330401, 39.957347, '', 0],
        [116.355122, 39.970066, '', 0],
        [116.352679, 39.950821, '', 0],
        [116.37007, 39.950599, '', 0],
        [116.373807, 39.948498, '', 0],
        [116.36044, 39.935553, '', 0],
        [116.37237, 39.936328, '', 0],
        [116.398744, 39.933395, '', 0],
        [116.417429, 39.942579, '', 0],
        [116.418579, 39.938706, '', 0],
        [116.427921, 39.934944, '', 0],
        [116.368848, 39.95508, "蒲公英旅社", 253],
        [116.391701, 39.937932, "CC26酒店", 254],
        [116.364824, 39.942911, "鸟之巢", 234],
        [116.394288, 39.937047, "云上茶坊", 317],
        [116.381784, 39.954748, "白也咖啡", 320],
        [116.420878, 39.944349, "老友记", 318],
        [116.376897, 39.927973, "花喜", 316],
        [116.345708, 39.953973, "无非饭局", 229],
        [116.353757, 39.951208, "心馨甜品", 232],
        [116.367267, 39.947115, "咖啡门", 233],
        [116.361087, 39.935719, "壹贰山房", 235],
        [116.377616, 39.938706, "小雅书屋", 236],
        [116.371004, 39.928084, "丝嘉智造", 237],
        [116.385952, 39.961882, "樱之味", 238],
        [116.398456, 39.943906, "大禾小串", 239],
        [116.399319, 39.925207, "VIVIAN奶茶", 240],
        [116.409955, 39.935719, "D7西点", 242],
        [116.418722, 39.936825, "一路向西", 243],
        [116.419153, 39.932842, "小室旅咖", 244],
        [116.412757, 39.931016, "吉咖啡", 245],
        [116.420016, 39.928416, "黑蚂蚁", 246],
        [116.425621, 39.924875, "醉雨花间", 247],
        [116.433239, 39.927531, "neverland", 248],
        [116.429646, 39.932842, "卡卡秘语", 249],
        [116.433957, 39.92078, "威手咖", 250],
        [116.455373, 39.932953, "大吉料理", 251],
        [116.454942, 39.928637, "肆季", 252],
        [116.315166,39.964205, "云上·瓦尔登森林", 323],
        [116.368705, 39.955743, "君君工作", 275],
        [116.355769, 39.950212, "睫座", 276],
        [116.359362, 39.946562, "喜来婚庆", 277],
        [116.34657, 39.966251, "舶宫剧场", 270],
        [116.326305, 39.957734, "纯音剧场", 271],
        [116.320555, 39.955301, "圆舞社", 272],
        [116.308482, 39.952314, "节奏之家", 273],
        [116.356559, 39.955356, "归园田居", 290],
        [116.34887, 39.95519, "苗苗工作", 274],
        [116.40169, 39.925262, "瓦尤阿苏", 241],
        [116.3138, 39.965256, "瓦尔登湖", 255],
        [116.315381, 39.960942, "山果女红", 256],
        [116.3161, 39.950765, "了凡泊景", 257],
        [116.33306, 39.948221, "上层设计", 258],
        [116.365111, 39.954858, "栗栗栗", 259],
        [116.376322, 39.956075, "加美之造", 260],
        [116.375604, 39.953199, "元素环艺", 261],
        [116.370429, 39.950655, "原野立方", 262],
        [116.38164, 39.951872, "抟泥社", 263],
        [116.409092, 39.934502, "子墨手工", 264],
        [116.404924, 39.927973, "标庭装饰", 265],
        [116.412254, 39.925539, "我喜欢你呀", 266],
        [116.422603, 39.933838, "艺想工作", 267],
        [116.424615, 39.928858, "子子服饰", 268],
        [116.433526, 39.92576, "旗袍馆", 269]
    ]
    var first_data = [
        [116.326305, 39.957734, "纯音剧场-副会场", 1],
        [116.34657, 39.966251, "舶宫剧场-副会场", 1],
        [116.331623, 39.965477, "草坪-主会场", 1],
        [116.384228,39.949438, "原创集市", 2]
    ]
    //	美术相关
    var art_data = [
        [116.371435, 39.950544, "艺轩书画", 278],
        [116.372585, 39.945234, "艺术家工作室", 279],
        [116.377185, 39.943243, "青少年文创中心", 280],
        [116.423465, 39.932842, "绵阳美协", 282],
        [116.430939, 39.929854, "艺术家工作室", 283],
        [116.46026, 39.940587, "重工展览", 284]]
        // [116.458966, 39.936604, "重工展览", 285]];
    //	体育健身
    var sports_data = [
        [116.329754, 39.956186, "麦道格斗馆", 286],
        [116.353901, 39.950876, "广场舞协会", 287],
        [116.39242, 39.949438, "飞越丛林", 288],
        [116.453792, 39.946562, "悟道馆", 289]
    ]
    //办公文教
    var office_data = [
        [116.356056, 39.950434, "壹半之旅", 291],
        [116.372298, 39.951429, "三之首", 292],
        [116.381784, 39.943243, "星榜样", 293],
        [116.357575, 39.915014, "愿望树", 294],
        [116.364034,39.926369, "易家科技", 295],
        [116.372083,39.926811, "众创空间", 296],
        [116.371364,39.924266, "帆恒科技", 322],
        [116.36389,39.924377, "阳扬科技", 326],
        [116.412254, 39.925207, "幸福时光", 297],
        [116.42634, 39.927199, "莱士顿", 298],
        [116.427777, 39.930297, "青之蓝", 299],
        [116.441719, 39.923436, "涪泉乳液", 300],
        [116.454367, 39.949659, "尚辰幼儿园", 301]
    ]
    //摄影摄影
    var photo_data = [
        [116.380347, 39.955854, "图腾摄影", 305],
        [116.364968, 39.95331, "乐町摄影", 306],
        [116.374454, 39.953088, "俞飞摄影", 307],
        [116.371867, 39.950212, "六月摄影", 308],
        [116.371292, 39.925539, "群丽婚纱", 309],
        [116.41901, 39.933838, "爵士影像", 310],
        [116.423034, 39.931072, "北京闪耀", 311],
        [116.431227, 39.928748, "博纳文化", 312],
        [116.430652, 39.925871, "初木视觉", 313]
    ]
    //园区服务
    var zone_data = [
        [116.342546, 39.949549, "蜜地便利店", 302],
        [116.380059, 39.925649, "乐汇云", 303],
        [116.458679, 39.937932, "园区办公室", 304],
        [116.330401, 39.957347, '', 0],
        [116.355122, 39.970066, '', 0],
        [116.352679, 39.950821, '', 0],
        [116.37007, 39.950599, '', 0],
        [116.373807, 39.948498, '', 0],
        [116.36044, 39.935553, '', 0],
        [116.37237, 39.936328, '', 0],
        [116.398744, 39.933395, '', 0],
        [116.417429, 39.942579, '', 0],
        [116.418579, 39.938706, '', 0],
        [116.427921, 39.934944, '', 0]

    ]
    //  酒店旅社
    var hotel_data = [
        [116.368848, 39.95508, "蒲公英旅社", 253],
        [116.391701, 39.937932, "CC26酒店", 254],
        [116.364824, 39.942911, "鸟之巢", 234],
    ]
    //餐饮娱乐
    var canteen_data = [
        [116.394288, 39.937047, "云上茶坊", 317],
        [116.381784, 39.954748, "白也咖啡", 320],
        [116.420878, 39.944349, "老友记", 318],
        [116.376897, 39.927973, "花喜", 316],
        [116.345708, 39.953973, "无非饭局", 229],
        [116.353757, 39.951208, "心馨甜品", 232],
        [116.367267, 39.947115, "咖啡门", 233],
        [116.361087, 39.935719, "壹贰山房", 235],
        [116.377616, 39.938706, "小雅书屋", 236],
        [116.371004, 39.928084, "丝嘉智造", 237],
        [116.385952, 39.961882, "樱之味", 238],
        [116.398456, 39.943906, "大禾小串", 239],
        [116.399319, 39.925207, "VIVIAN奶茶", 240],
        [116.409955, 39.935719, "D7西点", 242],
        [116.418722, 39.936825, "一路向西", 243],
        [116.419153, 39.932842, "小室旅咖", 244],
        [116.412757, 39.931016, "吉咖啡", 245],
        [116.420016, 39.928416, "黑蚂蚁", 246],
        [116.425621, 39.924875, "醉雨花间", 247],
        [116.433239, 39.927531, "neverland", 248],
        [116.429646, 39.932842, "卡卡秘语", 249],
        [116.433957, 39.92078, "威手咖", 250],
        [116.455373, 39.932953, "大吉料理", 251],
        [116.454942, 39.928637, "肆季", 252],
        [116.315166,39.964205, "云上·瓦尔登森林", 323]
    ]
    //婚庆周边
    var marry_data = [
        [116.368705, 39.955743, "君君工作", 275],
        [116.355769, 39.950212, "睫座", 276],
        [116.359362, 39.946562, "喜来婚庆", 277]
    ]
    // 音乐演出
    var music_data = [
        [116.34657, 39.966251, "舶宫剧场", 270],
        [116.326305, 39.957734, "纯音剧场", 271],
        [116.320555, 39.955301, "圆舞社", 272],
        [116.308482, 39.952314, "节奏之家", 273]
    ]
    //设计手工
    var handmade_data = [
        [116.356559, 39.955356, "归园田居", 290],
        [116.34887, 39.95519, "苗苗工作", 274],
        [116.40169, 39.925262, "瓦尤阿苏", 241],
        [116.3138, 39.965256, "瓦尔登湖", 255],
        [116.315381, 39.960942, "山果女红", 256],
        [116.3161, 39.950765, "了凡泊景", 257],
        [116.33306, 39.948221, "上层设计", 258],
        [116.365111, 39.954858, "栗栗栗", 259],
        [116.376322, 39.956075, "加美之造", 260],
        [116.375604, 39.953199, "元素环艺", 261],
        [116.370429, 39.950655, "原野立方", 262],
        [116.38164, 39.951872, "抟泥社", 263],
        [116.409092, 39.934502, "子墨手工", 264],
        [116.404924, 39.927973, "标庭装饰", 265],
        [116.412254, 39.925539, "我喜欢你呀", 266],
        [116.422603, 39.933838, "艺想工作", 267],
        [116.424615, 39.928858, "子子服饰", 268],
        [116.433526, 39.92576, "旗袍馆", 269]
    ]
   
    // 创建Map实例
    var map = new BMap.Map("allmap", { minZoom: 12, maxZoom: 15, enableMapClick: false });
    // 地图中心
    var center = '';
    var center_lng = '';
    var center_lat = '';
    var markernav = 0
    if (!catid) {
        center = new BMap.Point(116.35735,39.946119);
        indexSwiper(0)
        navChange(first_data);
        setIndex()
    } else {
        var makerjson;
        switch (catid) {
            case '1': makerjson = first_data; markernav = 0; break;
            case '70': makerjson = canteen_data; markernav = 1; break;
            case '71': makerjson = hotel_data; markernav = 4; break;
            case '69': makerjson = handmade_data; markernav = 3; break;
            case '68': makerjson = music_data; markernav = 5; break;
            case '55': makerjson = photo_data; markernav = 6; break;
            case '56': makerjson = marry_data; markernav = 7; break;
            case '57': makerjson = art_data; markernav = 8; break;
            case '58': makerjson = sports_data; markernav = 2; break;
            case '59': makerjson = office_data; markernav = 9; break;
            case '60': makerjson = zone_data; markernav = 10; break;
        }
        //顶部导航选中与位移
        $.each($('.swiper-wrapper .swiper-slide'), function () {
            if (markernav == $(this).index()) {
                $(this).addClass('current').siblings().removeClass('current');
                indexSwiper($(this).index())
                
            }

        });
        if (!id) {
            if (catid == 1) {
                center = new BMap.Point(116.35735,39.946119);
                navChange(makerjson)
            } else {
                center = new BMap.Point(116.385449, 39.934889);
                navChange(makerjson)
            }

        } else {
            //如果传过来有ID匹配中心点
            $.each(makerjson, function (n, val) {
                if (val[3] == id) {
                    center = new BMap.Point(val[0], val[1]);
                    center_lng = val[0];
                    center_lat = val[1];
                    return false;
                }
            });
            navChange(makerjson, center_lng, center_lat);
        }
    }

    // 居中放大
    map.centerAndZoom(center, 14);
    // 启用滚轮放大缩小
    map.enableScrollWheelZoom();
    // 西南角和东北角
    var SW = new BMap.Point(116.29579, 39.837146);
    var NE = new BMap.Point(116.475451, 39.9764);
    // 地图个性化皮肤
    map.setMapStyle({
        styleJson: [
            {
                "featureType": "background",
                "elementType": "all",
                "stylers": {
                    "color": "#E8F5D6",
                    "hue": "#E8F5D6"
                }
            },
            {
                "featureType": "road",
                "elementType": "all",
                "stylers": {
                    "visibility": "off"
                }
            },
            {
                "featureType": "administrative",
                "elementType": "all",
                "stylers": {
                    "visibility": "off"
                }
            },
            {
                "featureType": "poilabel",
                "elementType": "all",
                "stylers": {
                    "visibility": "off"
                }
            }
        ]
    });
    //覆盖层滚动级别控制
    groundOverlayOptions = {
        opacity: 0,
        displayOnMinLevel: 1,
        displayOnMaxLevel: 18
    };
    // 初始化GroundOverlay
    var groundOverlay = new BMap.GroundOverlay(new BMap.Bounds(SW, NE), groundOverlayOptions);
    // 设置GroundOverlay的图片地址
    groundOverlay.setImageURL('map.png');
    // 添加图片覆盖物
    map.addOverlay(groundOverlay);
    // 设置覆盖层的层级
    setTimeout(function () {
        setIndex();
    }, 100);

    function setIndex() {
        $.each($('img'), function () {
            if ($(this).attr('src') == 'map.png') {
                $(this).parents('div').css('z-index', '400')
            }
        });
    }
    //  删除标注
    function deletePoint() {
        var allOverlay = map.getOverlays();
        for (var i = 0; i < allOverlay.length; i++) {
            map.removeOverlay(allOverlay[i]);
        }
    }
    // 顶部导航切换
    $(".swiper-wrapper .swiper-slide").click(function () {
       if($(this).index()!==11){
        map.centerAndZoom(center, 14);
        $(this).addClass('current').siblings().removeClass('current');
        var attr = [first_data, canteen_data, sports_data, handmade_data, hotel_data, music_data, photo_data, marry_data, art_data, office_data, zone_data];
        var item_index = $(this).index();
        markernav = item_index
        for (var i = 0; i < attr.length; i++) {
            if (item_index == i) {
                navChange(attr[i]);
            }
        }
    }
    });
    // 点击切换标注点
    // data:标注数组
    // center_lng:中心经度
    // center_lat:中心纬度
    function navChange(data, center_lng, center_lat) {
        deletePoint();
        map.addOverlay(groundOverlay);
        setIndex();
        $.each(data, function (n, val) {
            var point = new BMap.Point(val[0], val[1]);
            var label = new BMap.Label(val[2], { offset: new BMap.Size(0, 0) });
            //对label 样式区分中心点与普通点
            if (val[0] == center_lng && val[1] == center_lat) {
                label.setStyle({
                    color: '#fff',
                    border: '1px solid #94441c',
                    padding: '4px',
                    backgroundColor: 'rgba(148,68,28,0.8)'
                });

            } else if (val[3] == 0) {
                label.setStyle({
                    height: '4px',
                    width: '4px',
                    border: '3px solid #000',
                    borderRadius: '50%',
                    backgroundColor: '#fff'
                });
                $('.position_wc').css({ 'opacity': 1 })
            } else {
                label.setStyle({
                    color: '#fff',
                    border: '1px solid #aaa',
                    backgroundColor: 'rgba(000,000,000,0.5)'
                });
                $('.position_wc').css({ 'opacity': 0 })
            }

            var label_w = val[2].length * 15;
            addMarker(point, label, val[3], label_w);
        });
    }
    // 创建标注
    function addMarker(point, label, i, label_w) {
        var myIcon = new BMap.Icon("icon.png",
            new BMap.Size(label_w, 20), {
                offset: new BMap.Size(10, 25),
                imageOffset: new BMap.Size(0, 0 - label * 25)
            });
        var marker = new BMap.Marker(point, { icon: myIcon });
        map.addOverlay(marker);
        marker.setLabel(label);
        marker.addEventListener("click", function () {
            if (i==1) {
              window.location.href='https://mp.weixin.qq.com/s/lpP5wAXfGaEqhmdjjA9Qcw'      
            }else if(i==2){
    window.location.href='http://mp.weixin.qq.com/s?__biz=MzIxNTg2ODcwMg==&mid=100001312&idx=1&sn=fe458ba5a7d2d4cad429f2f6b42bbe06&chksm=1790f25120e77b4755df70806fe7e725fb7231dca15c6bc4dc87d994b9b468f7ed5b55b70e59#rd'
            }else if(i){
                  window.location.href = "details.html?id=" + i;
            }else{
                return
            }

        });
    }
    //获取地址栏参数
    //name:地址栏参数名
    function GetUrlString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]);
        return '';
    }
    // 跳转列表
    function toDetail() {
        var t;
        switch (markernav) {
            case 0: t = 1; break;
            case 1: t = 70; break;
            case 4: t = 71; break;
            case 3: t = 69; break;
            case 5: t = 68; break;
            case 6: t = 55; break;
            case 7: t = 56; break;
            case 8: t = 57; break;
            case 2: t = 58; break;
            case 9: t = 59; break;
            case 10: t = 60; break;
        }
        window.location.href = 'goodslist.html?type=' + t;
        // 
    }
    // 获取鼠标经过的点
    // map.addEventListener("click", function (e) {
    //     prompt("鼠标单击地方的经纬度为：", e.point.lng + "," + e.point.lat);
    // });

    function indexSwiper(i) {
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 'auto',
            spaceBetween: 30,
            initialSlide: i,//设置初始化Index
            spaceBetween: 30
        });
    }
    //    搜索
    function showSearch() {
        //  var h='<div class="index_search_y display_flex align-items_center animated" ><input type="text"><img src="img/search.png" alt=""></div> '
        //  $('.add_box').html(h)

        $('.index_search_y').css({ 'display': 'block' }).addClass('fadeInLeft')
        $('.index_search').fadeOut()
    }
    $('.index_search_y img').click(function () {
        search_data()

    })
    function search_data() {
        var txt = $('#search_input').val()
        if (txt) {
            getL('.goods', 'post', wrUrl + '/LetterPool/search', { title: txt }, getData);
        } else {
           
            $('.index_search_y').removeClass('fadeInLeft').addClass('bounceOutLeft')   
           setTimeout(function(){
            $('.index_search').fadeIn()
           },500)
        }
    }
    var search_data_num = []
    function getData(obj, r) {
        search_data_num = []
        if (r.data.length == 0) {
            $('.index_search').show()
            $('.search_txt').fadeIn()
            setTimeout(function(){
                $('.search_txt').fadeOut() 
            },1000)
        } else {
            map.setZoom(13)
            var all_id = []
            for (var i = 0; i < r.data.length; i++) {
                all_id.push(r.data[i].id)
            }
            for (var j = 0; j < all_id.length; j++) {
                for (var a = 0; a < all_data.length; a++) {
                    if (all_id[j] == all_data[a][3]) {
                        search_data_num.push(all_data[a])
                    }
                }
            }
            navChange(search_data_num)
            $('.index_search').show()
            $('.swiper-wrapper .swiper-slide').removeClass('current');
        }
        $('.index_search_y').removeClass('fadeInLeft').addClass('bounceOutLeft')   
    }
</script>
<style>
    /*滚动水平导航栏 start*/

    .lr_nb {
        background: url('img/bg.png') no-repeat center center;
        height: 46px;
        line-height: 46px;
        width: 100%;
        position: fixed;
        box-sizing: border-box;
        z-index: 10000;
        max-width: 1080px;
        opacity: 1;
        top: 0;
    }

    .lr_nb .slider_wrap.line {
        overflow: hidden;
        overflow-x: scroll;
        width: 100%;
        -webkit-overflow-scrolling: touch;
    }

    .lr_nb .slider_wrap.line .item_cell {
        display: inline-block;
        margin: 0px 10px;
        overflow: hidden;
        position: relative;
    }

    .lr_nb .slider_wrap.box {
        overflow: hidden;
        width: 100%
    }

    .lr_nb .slider_wrap::-webkit-scrollbar {
        display: none
    }

    .anchorBL {
        z-index: 10000 !important;
    }

    /* 改动 */

    .lr_nb .wx_items {
        white-space: nowrap;
        width: 100%;
        position: relative;
        left: 0;
        transition: .3s all;
    }

    /* 改动 */

    .lr_nb .wx_items span {
        color: #fff;
        font-size: 15px;
        white-space: nowrap;
        display: block;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        text-align: center;
        cursor: pointer
    }

    .current,
    .current a:visited,
    .current a:link,
    .current a:hover,
    .current a:focus {
        color: #fff;
        font-size: 17px;
        height: 46px;
        border-bottom: 2px solid #fff;
        font-weight: bold;
    }

    .position_wc {
        position: absolute;
        z-index: 1000000000;
        font-size: 14px;
        right: 103px;
        bottom: 75px;
        color: #000;
        opacity: 0;
    }

    .position_arc {
        display: inline-block;
        height: 8px;
        width: 8px;
        border: 3px solid #000;
        border-radius: 50%;
        background-color: #fff;
    }

    .txt_wc {
        margin: -8px 0 0 10px;
        font-weight: bold;
        font-size: 15px;
    }

    /*滚动水平导航栏 end*/
</style>
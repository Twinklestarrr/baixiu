<?php 
  //接收從首页传递过来的分类id号
  // $categoryId = $_GET['categoryId'];
  // //连接数据库
  // $conn = mysqli_connect("localhost","root","root","baixiu");
  // //构建sql语句
  // $list_sql = "SELECT p.id,p.title,p.feature,p.created,p.content,p.views,p.likes,u.nickname,c.`name`,
  //   (SELECT COUNT(*) FROM comments WHERE comments.post_id = p.id) AS commentsCount 
  //   FROM posts AS p
  //   LEFT JOIN users AS u ON u.id = p.user_id
  //   LEFT JOIN categories AS c ON c.id = p.category_id
  //   WHERE p.category_id = $categoryId
  //   LIMIT 10";
  //   // 执行sql语句生成数据
  // $list_res = mysqli_query($conn,$list_sql);
  // while ($list_row = mysqli_fetch_assoc($list_res)) {
  //   $list_arr[] = $list_row;
  // }
  // print_r($list_arr);

// ----------------------------------------------
  include_once './common/mysql.php';
  $categoryId = $_GET['categoryId'];
  $conn = connect();
  $list_sql = "SELECT p.id,p.title,p.feature,p.created,p.content,p.views,p.likes,u.nickname,c.`name`,
     (SELECT COUNT(*) FROM comments WHERE comments.post_id = p.id) AS commentsCount 
     FROM posts AS p
     LEFT JOIN users AS u ON u.id = p.user_id
     LEFT JOIN categories AS c ON c.id = p.category_id
     WHERE p.category_id = $categoryId
     LIMIT 10";
  $list_arr = query($conn,$list_sql);
  // print_r($list_arr);
 ?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="static/assets/css/style.css">
  <link rel="stylesheet" href="static/assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>
    <?php include_once "./common/aside.php" ?>
    <div class="content">
      <div class="panel new">
        <h3><?php echo $list_arr[0]['name'] ?></h3>
        <!-- <div class="entry">
          <div class="head">
            <a href="javascript:;">星球大战：原力觉醒视频演示 电影票68</a>
          </div>
          <div class="main">
            <p class="info">admin 发表于 2015-06-29</p>
            <p class="brief">星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯</p>
            <p class="extra">
              <span class="reading">阅读(3406)</span>
              <span class="comment">评论(0)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(167)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="static/uploads/hots_2.jpg" alt="">
            </a>
          </div>
        </div>
        <div class="entry">
          <div class="head">
            <a href="javascript:;">星球大战：原力觉醒视频演示 电影票68</a>
          </div>
          <div class="main">
            <p class="info">admin 发表于 2015-06-29</p>
            <p class="brief">星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯</p>
            <p class="extra">
              <span class="reading">阅读(3406)</span>
              <span class="comment">评论(0)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(167)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="static/uploads/hots_2.jpg" alt="">
            </a>
          </div>
        </div>
        <div class="entry">
          <div class="head">
            <a href="javascript:;">星球大战：原力觉醒视频演示 电影票68</a>
          </div>
          <div class="main">
            <p class="info">admin 发表于 2015-06-29</p>
            <p class="brief">星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯</p>
            <p class="extra">
              <span class="reading">阅读(3406)</span>
              <span class="comment">评论(0)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(167)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="static/uploads/hots_2.jpg" alt="">
            </a>
          </div>
        </div> -->
        <?php foreach ($list_arr as $key => $value) { ?>
        
        <div class="entry">
          <div class="head">
            <span class="sort"><?php echo $value['name'] ?></span>
            <a href="detail.php?id=<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $value['nickname'] ?> 发表于 <?php echo $value['created'] ?></p>
            <p class="brief"><?php echo $value['content'] ?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $value['views'] ?>)</span>
              <span class="comment">评论(<?php echo $value['commentsCount'] ?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $value['likes'] ?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span><?php echo $value['name'] ?></span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="./uploads/hots_2.jpg" alt="">

            </a>
          </div>
        </div>
        <?php } ?>
        <div class="loadmore">
          <span class="btn">加载更多</span>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>

  <script src="./static/assets/vendors/jquery/jquery.js"></script>
  <script src="./static/assets/vendors/art-template/template-web.js"></script>
  <script type="text/template" id="postTpl">
    {{each data value index}}
      <div class="entry">
          <div class="head">
            <span class="sort">{{value.name}}</span>
            <a href="detail.php?id={{value.id}}">{{value.title}}</a>
          </div>
          <div class="main">
            <p class="info">{{value.nickname}}发表于 {{value.created}}</p>
            <p class="brief">{{value.content}}</p>
            <p class="extra">
              <span class="reading">阅读({{value.views}})</span>
              <span class="comment">评论({{value.commentsCount}})</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞({{value.likes}})</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span>{{value.name}}</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="./static/uploads/hots_2.jpg" alt="">
            </a>
          </div>
      </div>
    {{/each}}

  </script>
  <script>
    $(function() {
        //操作页面的id
        var categoryId = location.search.split('=')[1];
        // console.log(categoryId);
        //加载的第几个页面数据--相当于计算点击事件的次数
        var currentPage = 1;
        //每次点击加载几条数据
        var pageSize = 10;
      $('.loadmore .btn').on('click',function(){
        // alert("123");
        $.ajax({
          type:"post",
          url:"./api/getMorePost.php",
          data:{
            "categoryId":categoryId,
            "currentPage":++currentPage,
            "pageSize":pageSize
          },
          dataType:"json",
          success:function(res){
            // console.log(res);
            if(res.code == 1){
              var html = template("postTpl",res);
              $(html).insertBefore('.loadmore');
              // console.log(html);
              //计算最大页数,隐藏点击按钮
              var maxPage = Math.ceil(res.count/pageSize);
              if(currentPage == maxPage){
                $('.loadmore').hide();
              }
            }
          }
        })
      })
    })
  </script>
</body>
</html>
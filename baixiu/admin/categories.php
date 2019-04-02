<?php 
  include_once './common/checkLogin.php';
 ?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../static/assets/css/admin.css">
  <script src="../static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once './common/nav.php' ?> 
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger" style="display:none">
        <strong>错误！</strong><span id="errMsg"></span> 
      </div>
      <div class="row">
        <div class="col-md-4">
          <form>
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/category/<strong>slug</strong>
              </p>
            </div>
            <div class="form-group">
              <label for="classname">图标</label>
              <input id="classname" class="form-control" name="classname" type="text" placeholder="图标名称">
            </div>
            <div class="form-group">
              <!-- <button class="btn btn-primary" type="submit">添加</button> -->
              <input type="button" id="btn-add" class="btn btn-primary" value="添加">
              <input type="button" id="btn-edit" class="btn btn-primary" style="display: none" value="完成编辑">
              <input type="button" id="btn-cancel" class="btn btn-primary" style="display: none" value="取消编辑">
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" id="alldel" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
                <th>Slug</th>
                <th>类名</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              <!-- <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td>fa-fire</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td>fa-fire</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td>fa-fire</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php include_once './common/aside.php' ?> 

  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script src="../static/assets/vendors/art-template/template-web.js"></script>
  <script type="text/template" id="cateTpl">
  {{each data}}
    <tr data-categoryId="{{$value.id}}">
      <td class="text-center">
        <input type="checkbox">
      </td>
      <td>{{$value.name}}</td>
      <td>{{$value.slug}}</td>
      <td>{{$value.classname}}</td>
      <td class="text-center">
        <a href="javascript:;" data-categoryId="{{$value.id}}" class="btn btn-info btn-xs">编辑</a>
        <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
      </td>
    </tr>
  {{/each}}
</script>
<script type="text/template" id="addCate">
    <tr data-categoryId="{{id}}">
      <td class="text-center">
        <input type="checkbox">
      </td>
      <td>{{name}}</td>
      <td>{{slug}}</td>
      <td>{{classname}}</td>
      <td class="text-center">
        <a href="javascript:;" data-categoryId="{{id}}" class="btn btn-info btn-xs">编辑</a>
        <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
      </td>
    </tr>
</script>
  
  <script>
    $(function() {
      //获取分类数据
      $.ajax({
        type:"post",
        url:"./api/getCategories.php",
        // data:{},
        dataType:"json",
        success:function(res){
          // console.log(res);
          if(res.code==1){
            var html = template("cateTpl",res);
            $("tbody").html(html);
          }
        }
      });

      //添加分类
      $("#btn-add").click(function(){
        // alert(123);
        var name = $("#name").val();
        var slug = $("#slug").val();
        var classname = $("#classname").val();
        $.ajax({
          type:"post",
          url:"./api/addCategory.php",
          data:{
            "name":name,
            "slug":slug,
            "classname":classname
          },
          beforeSend:function(){
            if(name.trim()==''||slug.trim()==''||classname.trim()==''){
              $('.alert').show();
              $('#errMsg').html("信息不能为空")
              return false;
            }
          },
          dataType:"json",
          success:function(res){
            // console.log(res);
            if(res.code==0){
              $('.alert').show();
              $('#errMsg').html(res.msg);
            }else{
              var addhtml = template("addCate",{"name":name,"slug":slug,"classname":classname,"id":res.id});
              console.log(addhtml);
              $(addhtml).appendTo('tbody');
              $('.alert').hide();
              $('#name').val('');
              $('#slug').val('');
              $('#classname').val('');
            }
          }
        })
      });


      //更新分类信息
      var currentRow = null;
      //编辑按钮的事件绑定 一定要用事件委托的形式，因为分类信息是动态渲染的
      $('tbody').on("click",".btn-info",function(){
        // alert(123);
        $("#btn-edit").show();
        $("#btn-cancel").show();
        $("#btn-add").hide();

        var name = $(this).parent().parent().children().eq(1).text();
        var slug = $(this).parent().parent().children().eq(2).text();
        var classname = $(this).parent().parent().children().eq(3).text();
        $("#name").val(name);
        $("#slug").val(slug);
        $("#classname").val(classname);
        // 获取当前a标签上保存的自定义属性性，这个属性保存的是分类id号
        // 再将这个id号传递给确认更新按钮
        var categoryId = $(this).attr("data-categoryId");
        $("#btn-edit").attr("data-categoryId",categoryId);

        // 保存当前行元素交给"全局变量",在更新成功后还需要把更新后的数据再填充回去
        currentRow = $(this).parent().parent();

      });

      //更新按钮
      $('#btn-edit').click(function(){
        var name = $('#name').val();
        var slug = $('#slug').val();
        var classname = $('#classname').val();

        var id = $(this).attr('data-categoryId');
        $.ajax({
          type:"post",
          url:"./api/updateCategory.php",
          data:{
            "id":id,
            "name":name,
            "slug":slug,
            "classname":classname
          },
          beforeSend:function(){
            if(name.trim()==""||slug.trim()==""||classname.trim()==""){
              $(".alert").show();
              $("#errMsg").html("请填写完整信息");
              return false;
            }
          },
          dataType:"json",
          success:function(res){
              if(res.code==0){
                $(".alert").show();
                $("#errMsg").html(res.msg);
              }else{
                // 将更新后的数据再填充更新行的td中
                currentRow.children().eq(1).text(name);
                currentRow.children().eq(2).text(slug);
                currentRow.children().eq(3).text(classname);
                // 清空
                $(".alert").hide();
                $("#name").val("");
                $("#slug").val("");
                $("#classname").val("");
              }
          }
        })
      });


      // 取消编辑按钮
        $("#btn-cancel").click(function(){
          $(".alert").hide();
          $("#name").val("");
          $("#slug").val("");
          $("#classname").val("");

          $("#btn-add").show();
          $("#btn-edit").hide();
          $("#btn-cancel").hide();
        });


      // 删除按钮
      $("tbody").on("click",".btn-danger",function(){
        // alert(123);
        var that = this;
        var id = $(this).parent().parent().attr("data-categoryId");
        $.ajax({
          type:"post",
          url:"./api/delCategory.php",
          data:{"id":id},
          dataType:"json",
          success:function(res){
            if(res.code==0){
              $(".alert").show();
              $("#errMsg").html(res.msg);
            }else{
              $(that).parent().parent().remove();
            }
          }
        });
      });

      //全选
      $('thead :checkbox').click(function(){
        var status = $(this).prop("checked");
        // alert(123);
        $("tbody :checkbox").prop("checked",status);
        if($("tbody :checkbox:checked").length>=2){
          $("#alldel").show();
        }else{
          $("#alldel").hide();
        }
      });
      //反选
      $("tbody").on("click","input:checkbox",function(){
        // alert(123);
        var theadcheckbox = $("thead :checkbox");
        var tbodycheckbox = $("tbody :checkbox");
        if(tbodycheckbox.length==$("tbody :checkbox:checked").length){
          theadcheckbox.prop("checked",true);
        }else{
          theadcheckbox.prop("checked",false);
        }
        if($("tbody :checkbox:checked").length>=2){
          $("#alldel").show();
        }else{
          $("#alldel").hide();
        }
      })

      //批量删除
      $("#alldel").click(function(){
        var arr = [];
        $("tbody :checkbox:checked").each(function(index,value){
          var id = $(this).parent().parent().attr("data-categoryId");
          arr.push(id);
        })
        //转换为字符串 符合数据库的语法
        var str = arr.join();
        // console.log(str);
        $.ajax({
          type:"post",
          url:"./api/delCategories.php",
          data:{"ids":str},
          dataType:'json',
          success:function(res){
            // console.log(res);
            if(res.code==0){
              $(".alert").show();
              $("#errMsg").html(res.msg);
            }else{
              $("tbody :checkbox:checked").parent().parent().remove();
            }
          }
        })
      })

    })
  </script>
</body>
</html>

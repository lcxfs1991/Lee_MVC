<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
          <div>文章推荐</div>
          <form action="admin_article" method="post" class="contactForm">                         
               <div>标题<input type="text" name="title" size="50"/></div>
               <div>作者<input type="text" name="author" size="50"/></div>
               <div>简介<textarea name="introduction" rows="5" cols="100"></textarea>
               <div>内容<textarea name="content" rows="15" cols="100"></textarea>
               <div>类型
                  <select name="articleType">
                    <option value='0'>正常文章</option>
                    <option value='1'>关于我们</option>
                  </select>
               </div>
               <div><input type="submit" value="提交"/></div>
          </form>
          <br/>
         <div>精彩预告</div>
          <form action="admin_event" method="post" class="contactForm">                         
               <div>题目<input type="text" name="title" size="50"/></div>
               <div>报名链接<input type="text" name="link" size="50"/></div>
               <div>开始时间<input type="text" name="starttime" size="50"/></div>
               <div>简介<textarea name="intro" rows="15" cols="100"></textarea>
               <div>首页<textarea name="index_promote" rows="5" cols="100"></textarea>
               <div><input type="submit" value="提交"/></div>
         </form>
         <br/>
<!--          <div>往期回顾</div>
          <form action="admin_history.php" method="post" class="contactForm">                         
               <div>题目<input type="text" name="title" size="50"/></div>
               <div>报名链接<input type="text" name="link" size="50"/></div>
               <div>开始时间<input type="text" name="starttime" size="50"/></div>
               <div>简介<textarea name="des" rows="15" cols="100"></textarea>
               <div><input type="submit" value="提交"/></div>
         </form>
          <br/> -->
         <div>我们的团队</div>
          <form action="admin_team" method="post" class="contactForm">                         
               <div>姓名<input type="text" name="name" size="50"/></div>
               <div>简介<textarea name="intro" rows="15" cols="100"></textarea>
               <div>团队<select name="teamType">
                    <option value='投资银行导师团队'>投资银行导师团队</option>
                    <option value='咨询公司导师团队'>咨询公司导师团队</option>
                    <option value='大型外企导师团队'>大型外企导师团队</option>
                    <option value='执行团队'>执行团队</option>
               </select></div>
               <div><input type="submit" value="提交"/></div>
         </form>
         
             
    </body>
</html>
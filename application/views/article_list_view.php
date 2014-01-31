            <div class="content">
                <div class="left"></div>
                <div class="right">
                    <?php 
                          if ($record != "")
                          foreach ($record as $key => $value) 
                          {
                      ?>
                           <div class="article">
                            <div><h3><a href="<?php echo BASE_URL.'/Home/article_show/'; ?><?php echo $record[$key]["id"];?>" title="<?php echo $record[$key]["article_title"];?>" ><?php echo $record[$key]["article_title"];?></a></h3></div>
                            <div><?php echo $record[$key]["article_time"];?></div>
                            <div><?php echo $record[$key]["article_introduction"];?></div>
                        </div>
                   <?php      
                          }
                    ?>
                    
                    <div></div>
                </div>
            </div>
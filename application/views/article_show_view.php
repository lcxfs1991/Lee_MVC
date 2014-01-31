            <div class="content">
                <div class="left"></div>
                <div class="right">
                    <?php 
                          foreach ($record as $key => $value) 
                          {
                      ?>
                           <div class="article">
                            <div><h3><a href="article_show.php" title="<?php echo $record[$key]["article_title"];?>" ><?php echo $record[$key]["article_title"];?></a></h3></div>
                            <div><?php echo $record[$key]["article_time"];?></div>
                            <div><?php echo $record[$key]["article_content"];?></div>
                        </div>
                   <?php      
                          }
                    ?>
                    
                    <div></div>
                </div>
            </div>
          <div class="content">
                <div class="left"></div>
                <div class="right">
                    <?php 
                         foreach ($record as $key => $value) 
                         {      
                      ?>
                           <div class="article">
                            <div><h3><img src="<?php echo BASE_URL.'/pic/EC-logo.jpg'; ?>" alt="Endeavour Career Logo"/>&nbsp&nbsp<?php echo $record[$key]["article_title"];?></h3></div>
                            <div><?php echo $record[$key]["article_content"];?></div>
                        </div>
                   <?php      
                          }
                    ?>
                    
                    <div></div>
                </div>
            </div>
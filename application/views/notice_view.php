            <div class="content">
                    <div class="left"></div>
                <div class="right">
                    <?php 
                          
                        if ($record != "")
                          foreach ($record as $key => $value) 
                          {
                              
                      ?>
                           <div class="article">
                               <div><img src="<?php echo BASE_URL."/".$record[$key]['event_pic'];?>" alt=""/></div>
                               <div>
                                   <div><h3><?php echo $record[$key]['event_title'];?></h3></div>
                                    <div><?php echo $record[$key]['event_start_time'];?></div>
                                    <div><?php echo $record[$key]['event_introduction'];?></div>
                                    <div class="occupy"></div>
                                    <div class="button"><a href="<?php echo $record[$key]['event_link']; ?>" title="<?php echo $notice[$i][1];?>" 报名链接><span>报名链接</span></a></div>
                               </div>
                               
                               <div class="occupy"></div>
                          </div>
                        
                   <?php      
                          }
                    ?>
                    
                </div>
            </div>
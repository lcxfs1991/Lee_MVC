            <div class="content">
                    <div class="left"></div>
                <div class="right">
                    <?php 
                        if ($record != "") 
                          foreach ($record as $key => $value) 
                          {
                      ?>
                           <div class="article">
                               <div>
                                   <div class="button"><a href="<?php echo $record[$key]['event_link'];?>" title="<?php echo $record[$key]['event_title'];?>"><span>报名链接</span></a></div>
                                   <div class="button1"><a href="<?php echo BASE_URL.'/Home/summary/'; ?><?php echo $record[$key]['id'];?>" title="<?php echo $record[$key]['event_title'];?>"><span>讲座总结</span></a></div>
                                   <?php 
                                      if (isset($_SESSION["login"]["authority"]) && $_SESSION["login"]["authority"] == "1")
                                      {
                                   ?>
                                        <div class="button"><a href="<?php echo BASE_URL.'/Admin/admin_event_summary/'; ?><?php echo $record[$key]['id'];?>" title="<?php echo $record[$key]['event_title'];?>"><span>编辑</span></a></div>
                                   <?php
                                      }
                                   ?>
                               </div>
                               <div>
                                   <div><h3><?php echo $record[$key]['event_title'];?></h3></div>
                                    <div><?php echo $record[$key]['event_start_time'];?></div>
                                    <div><?php echo $record[$key]['event_introduction'];?></div>
                                    <div class="occupy"></div>
                                    
                               </div>
                               
                               <div class="occupy"></div>
                        </div>
                        
                   <?php      
                          }
                    ?>
                    
                </div>
            </div>
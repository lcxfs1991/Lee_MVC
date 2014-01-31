            <div class="content">
                <div class="left">
                    <div class="predict">
                        <div class="menuTag"><h2>精彩预告</h2></div>
                        <div>
                            <ul>
                           <?php 
                                foreach ($notice as $key => $value) 
                                {
                            ?>
                                <li><b><?php echo $notice[$key]["event_start_time"]; ?></b></li>
                                <li style="font:9px;"><a href="<?php echo BASE_URL.'/Home/notice/'; ?>"><i><?php echo $notice[$key]["event_title"]; ?></a></i></li>
                                <br/>
                             <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="past">
                        <div class="menuTag"><h2>往期回顾</h2></div>
                        <div>
                            <ul>
                                <?php 
                                  foreach ($history as $key => $value) 
                                  {
                                ?>
                                <li><b><?php echo $history[$key]["event_start_time"]; ?></b></li>
                                <li style="font:9px;"><a href="<?php echo BASE_URL.'/Home/summary/'; ?><?php echo $history[$key]['id'];?>"><i><?php echo $history[$key]["event_title"]; ?></a></i></li>
                                <br/>
                             <?php } ?>
                            </ul>
                            <div>
                                <span>不怕错过！在这里报名，超过一定人数我们会再次进行同主题分享会！</span>
                            </div>
                            <br/>
                        </div> 
                    </div>
                    <div class="activity">
                        <div class="button"><a href="<?php echo BASE_URL.'/Home/tutorial'; ?>"><span>在线教程</span></a></div>                     
                         <div class="button"><a href="<?php echo BASE_URL.'/Home/support'; ?>" title="Endeavour Career Support US 支持我们"><span>支持我们</span></a></div>
                    </div>
                </div>
                
                <div class="colseparate"><p></p></div>
                
                <div class="right">
                    <div class="mainContent">
                    <?php 
                        foreach ($notice as $key => $value) 
                        {
                    ?>
                        <div class="menuTag"><h2><?php echo $notice[$key]["event_title"]; ?></h2></div>
                        <div class="mainContentWrap">
                           
                           <div class="article">
                               <div><img src="<?php echo $notice[$key]['event_pic'];?>" alt=""/></div>
                               <div>
                                    <div><?php echo $notice[$key]["event_start_time"]; ?></div>
                                    <div><?php echo $notice[$key]["event_index_promotion"]; ?></div>
                                    <div class="occupy"></div>                   
                               </div>
                               
                               <div class="occupy"></div>
                          </div>
                        
                   <?php      
                          }
                    ?>
                        <div class="occupy"></div> 
                        </div> 
                        <!-- <div class="occupy"></div>  -->
                    </div>
                </div>
                <div class="occupy"></div>
            </div>
            

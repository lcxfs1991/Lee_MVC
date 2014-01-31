              <div class="content">
                <div class="left"></div>
                <div class="right">
                    <?php 
                          if ($record != "")
                          {
                            echo "<br/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href='".BASE_URL."/Home/team/'>返回</a>";
                            foreach ($record as $key => $value)
                            {
                    ?>
                            <div class="article">
                                <div><h3><?php echo $record[$key]["team_member"];?></h3></div>
                                <div><?php echo $record[$key]["team_introduction"];?></div>
                                <div></div>
                            </div>
                   <?php      
                            }
                          }
                          else {
                   ?>
                    <div class="banner">
                        <div><h1><a href="<?php echo BASE_URL.'/Home/team/ib'; ?>" title="Banking Team">Banking</a></h1></div>
                        <?php for ($k=1;$k<=8;$k++) {?>
                        <span> <img src="<?php echo BASE_URL.'/pic/BANKING/b'; ?><?php echo $k;?>.png"/></span>
                        <?php } ?>
                    </div>
                    <div class="banner">
                        <div><h1><a href="<?php echo BASE_URL.'/Home/team/consultant'; ?>" title="Consulting Team">Consulting</a></h1></div>
                        <?php for ($k=1;$k<=5;$k++) {?>
                        <span> <img src="<?php echo BASE_URL.'/pic/CONSULTING/c'; ?><?php echo $k;?>.png"/></span>
                        <?php } ?>
                    </div>
                    <div class="banner">
                        <div><h1><a href="<?php echo BASE_URL.'/Home/team/foreign'; ?>" title="Foreign Enterprice Team">Corporate</a></h1></div>
                        <?php for ($k=1;$k<=6;$k++) {?>
                        <span> <img src="<?php echo BASE_URL.'/pic/CORPRATE/f'; ?><?php echo $k;?>.png"/></span>
                        <?php } ?>
                    </div>
                    <div class="banner">
                        <div><h1><a href="<?php echo BASE_URL.'/Home/team/executive'; ?>" title="Executive Team">Executive Team</a></h1></div>
                    </div>
                        
                    <?php
                        }
                    ?>
                    
                    <div></div>
                </div>
            </div>
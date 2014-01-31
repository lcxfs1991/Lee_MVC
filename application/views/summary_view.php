            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script> 
            <script src="<?php echo BASE_URL."/";?>js/jquery.easing.1.3.js" type="text/javascript"></script>
            <script src="<?php echo BASE_URL."/";?>js/jquery.slideviewer.1.2.js" type="text/javascript"></script>

            <script type="text/javascript">
                $(window).bind("load", function() {
                    $("div#mygalone").slideView();
                });
            </script>

            <div class="content">
                <div class="left"></div>
                <div class="right">
                    <div id="mygalone" class="svw slideshow">
                    <ul>
                         <?php 
                            foreach ($record as $key => $value) 
                            {
                        ?>
                        <li><img width="600px" src="<?php echo BASE_URL.'/'.$record[$key]['summary_pic'];?>" /></li>
                            <?php } ?>
                    </ul>
                </div>  
                </div>
            </div>
            
            <div class="content">
                <div class="left"></div>
                <div class="right">
                    <div></div>
                    <div>
                        
                        <form action="<?php echo BASE_URL.'/Home/contact_process'; ?>" method="post" class="contactForm">
                            <div>如果你想告诉我们你想听什么、加入我们，或者有任何的意见和建议，请您与我们联系。我们会在第一时间回复。</div>
                            <div>名字<input type="text" name="username"/></div>
                            <div>邮件<input type="text" name="email"/></div>
                            <div>标题<input type="text" name="title"/></div>
                            <div>信息<textarea name="msg" rows="15"></textarea></div>
                            <div><input type="submit" value="提交"/></div>
                        <div>
                            <?php
                                if (isset($_SESSION["msg"])){
                                    echo $_SESSION["msg"];
                                    unset($_SESSION["msg"]);
                                }
                            ?>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
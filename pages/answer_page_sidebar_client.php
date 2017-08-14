<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">         
                    <?php
                    if(!empty($related_topic)){?>
                    <div class="ldr-stat">
                        <h3>Find Out More</h3>
                        <hr>
                        <ul>
                        <?php
                        $j = 0;
                        foreach($related_topic as $topic)
                            {

                                ?>
                                <li> <a href="<?php echo site_url('topic/'.str_replace(" ","-",$topic['name']));?>"><?php echo $topic['name'];?></a> </li>
                                <?php
                                 if($j == 4)
                                    break;
                                $j = $j+1;
                            }
                            
                            ?>
                        <div class=""></div>
                    </div>
                    <?php } ?> 
                
                    
        
                    <div class="ldf-info">
                        <div class="sa-rgt">
                        <h1>Ask a Financial Adviser</h1>
                        <p>Get answer from top rated financial advisers </p>
                        <ul>
                            <li>It's Free</li>
                            <li>It's Easy</li>
                            <li>It's Anonymous</li>
                        </ul>
                        <a class="btn btn-warning" href="<?php echo site_url('ask-a-financial-adviser');?>">Ask a Financial Advicer</a>
                        <p> <?php echo $answer_count;?> Answers this week</p>
                        <p> <?php echo $adviser_count;?> Financial Adviser answering</p>
                        </div>
                    </div>
        
                                         
                </div>              
            </div>          
            
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rlba-head"> 
                <h4>Find Financial Adviser</h4> 
                <hr/>             
                <div class="rlb-activity">                   
                    <!-- <div class="rlba-lft"><img src="<?php echo base_url();?>src/images/rdba-pic.jpg"></div> -->
                        <div class="rlba-rgt">
                            <!-- <p>A lawyer agreed with <span>F.Capriotti's answer</span></p>
                            <p>+5 Quality Points</p> -->
                        </div>
                    </div>
                    
                   
            </div>
        </div>
<script type="text/javascript">
    // $(document).ready(function(){
    //      $("#search_topic").validate({
    //         rules :{
    //         'topic_name':{required:true},
            
    //         }

    //      });
    // });
</script>
<?php
$topic_name = $location ='';

if($this->session->has_userdata('search_by_topic'))
        {
            $search_session = $this->session->userdata('search_by_topic');
            $topic_name = $search_session['topicname'];
            $location = $search_session['location'];
        }
?>
<section class="rsrch-legal-advice">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1>Get free financial advice from top-rated advisers</h1>
                <div class="srch">
                    <form name="search_topic_form" id="search_topic_form" method="post" action="<?php echo site_url('search');?>">
                        <ul>
                            <li class="fn-search"><label>Topic Name <span class="required">*</span></label>
                            <input type="text" name="topic_name" id="topic_name"  placeholder="Legal Topic" value="<?php echo $topic_name;?>" /></li>
                            <li class="cty-zip-srch">
                                <label>City, County</label>
                                <input type="text" name="city_county" id="city_county" placeholder="City, County" value="<?php echo $location;?>" />
                            </li>
                            <li class="srch-btn">
                                <input type="submit" name="search_submit" id="search_submit" value="Search" />                       
                            </li>
                        </ul>
                    </form>
                </div>    
            </div>
        </div>
    </div>
</section>
            
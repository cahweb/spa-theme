<?php
/**
* Template Name: Front Page Template
*
* Description: A page template that provides a key component of WordPress as a CMS
* by meeting the need for a carefully crafted introductory page. The front page template
* in Twenty Twelve consists of a page content area for adding text, images, video --
* anything you'd like -- followed by front-page-only widgets in one or two columns.
*
*/
?>
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
get_header(); 
?>

<!--<script src="<?php //echo get_stylesheet_uri(); ?>/../library/js/particles.js"></script>-->
<?php 
    $carousel_array = array();
    $args = array(
       'post_type' => array('front-slide'),
       'showposts' => 5,
       'order' => 'desc'

    );

   $category_posts = new WP_Query($args);

   if($category_posts->have_posts()) : 
      while($category_posts->have_posts()) : 
        $category_posts->the_post();

        $custom = get_post_custom(get_the_ID());
        $subtitle = $custom["subtitle"][0];
        $link_text = $custom["link_text"][0];
        $link = $custom["link"][0];

        $data = array();
        $data['src'] = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' )["0"];
        $data['title'] = get_the_title();
        $data['subtitle'] = $subtitle;
        $data['link_text'] = $link_text;
        $data['link'] = $link;

        array_push($carousel_array,$data);
    endwhile; endif;
?>
<div class="container carousel-container">
    <div class="row carousel-row" style="">
        <div class="col-md-12" style="padding-left:0px;padding-right:0px;padding-top:0px;height:100%">
            <div id="front-carousel" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                  <?php for($i = 0; $i < sizeof($carousel_array); $i++){ ?>
                        <li data-target="#front-carousel" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0) ? "active" : ""; ?>"></li>
                  <?php }?>
              </ol>
              <div id="particles-js" class="carousel-inner anim">
                <?php
                    for ($i = 0; $i< sizeof($carousel_array); $i++){ ?>
                    <div class="item <?php echo ($i == 0) ? "active" : ""; ?>">
                        <div class="carousel-img-bg" style="background-image:url(<?php echo $carousel_array[$i]['src'];?>)"></div>
                        <!--<img src="<?php echo $carousel_array[$i]['src'];?>">-->
                        <div class="carousel-caption">
                            <?php if($carousel_array[$i]['title'] != "") { ?>
                            <div class="title">
                                <?php echo $carousel_array[$i]['title']; ?>
                            </div> <?php }?>
                            <?php if($carousel_array[$i]['subtitle'] != "") { ?>
                            <div class="subtitle">
                                <i><?php echo $carousel_array[$i]['subtitle']; ?></i>
                            </div><?php }?>
                            <?php if($carousel_array[$i]['link_text'] != "") { ?>
                            <a href="<?php echo $carousel_array[$i]['link']; ?>" class="read-more">
                                <?php echo $carousel_array[$i]['link_text']; ?>
                            </a> <?php } ?>
                        </div>
                    </div>
                <?php } ?>
              </div>
                <a class="left carousel-control" href="#front-carousel" data-slide="prev"><div class="arrow"></div></a>
                <a class="right carousel-control" href="#front-carousel" data-slide="next"><div class="arrow flipped"></div></a>
            </div>
        </div>
    </div>
</div>
<div class="container front-page">

    <div class="row bottom-row">
       <a href="http://devspa.cah.ucf.edu/music/">
           <div class="col-md-4 front-card" style="background-image:url(<?php echo get_stylesheet_uri(); ?>/../img/front-page/column-1-img.png)">
            <div class="color-overlay yellow-butt"></div>
            <p class="title2 black">Music</p>
        </div>
        </a>
        <a href="http://devspa.cah.ucf.edu/theatre/">
        <div class="col-md-4 front-card" style="background-image:url(<?php echo get_stylesheet_uri(); ?>/../img/front-page/column-2-img.png)">
            <div class="color-overlay red-butt"></div>
            <p class="title2 white">Theatre</p>
        </div>
        </a>
        <a href="http://devspa.cah.ucf.edu/dance/">
        <div class="col-md-4 front-card" style="background-image:url(<?php echo get_stylesheet_uri(); ?>/../img/front-page/column-3-img.png)">
            <div class="color-overlay blue-butt"></div>
            <p class="title2 white">Dance</p>
        </div>
        </a>
    </div>
   
</div>

 
<?php get_footer(); ?>
<script>
   // particlesJS.load('particles-js', '<?php //echo get_stylesheet_uri(); ?>/../library/js/particles-config.json', function() {
    //  console.log('callback - particles.js config loaded');
   // });
    
    $(document).ready(function(){
         $(".front-card").mouseenter(function(){
             $(this).find(".color-change").fadeTo( "fast" , 0.75);
             $(this).find(".center .title").addClass("move-up");
             $(this).find(".center .content").addClass("move-down");
             $(this).find(".middle-line").fadeTo( "fast", 1 );
         });
        $(".front-card").mouseleave(function(){
             $(this).find(".color-change").fadeTo( "fast" , 0);
             $(this).find(".center .title").removeClass("move-up");
             $(this).find(".center .content").removeClass("move-down");
             $(this).find(".middle-line").fadeTo( "fast", 0 );
         });
    }); 
</script>


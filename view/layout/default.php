<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>ROCST INTERACTIVE | Rock your Business </title>

    <!-- STYLES -->
    <link rel="stylesheet" href="<?php echo rocstinteractive ?>styles/reset.css" />
    <link rel="stylesheet" href="<?php echo rocstinteractive ?>styles/styles.css" />
    </head>
    <body>

        <div class="site-pusher">

            <div class="header">
                <a href="" id="menu-btn" class="nav-toggle"></a>
                <div class="mobile-logo">
                    <a href="">ROCST</a>
                </div>
                <div class="header-title">
                    <h6>Rock your business</h6>
                </div>

                
            </div>

            <div class="bloc-left">

                <div class="menu">
                    <div class="logo">
                        <a href="">ROCST</a>
                    </div>
                    <div class="nav-bloc">
                        <ul  class="nav-top ">
                            <li><a href="<?php echo rocstinteractive ?>"><span class="nav-one menu-item"></span><p>Accueil</p></a></li>
                            <li><a href="<?php echo rocstinteractive ?>home/services"><span class="nav-two menu-item"></span><p>Services</p></a></li>
                            <li><a href="<?php echo rocstinteractive ?>home/portfolio"><span class="nav-three menu-item"></span><p>Portfolio</p></a></li>
                            <li><a href="<?php echo rocstinteractive ?>home/project"><span class="nav-four menu-item"></span>
                            <p>Projets</p></a></li>
                            <!-- <li><a href=""><span class="nav-five menu-item"></span><p>Client</p></a></li> -->
                        </ul>
                        <ul  class="nav-bottom ">
                            <!-- <li><a href=""><span class="nav-six menu-item"></span><p>Blog</p></a></li> -->
                            <li><a href="<?php echo rocstinteractive ?>home/contact"><span class="nav-seven menu-item"></span><p>Contact</p></a></li>
                        </ul>
                        
                    </div> 
                    
                    
                </div> <!-- end menu -->
                
            </div><!-- end bloc-left -->
            
        
            <div class="bloc-right">

                <div class="container ">
                    
                    <?php echo $content_for_layout ?>
                    
                </div><!-- end container -->

            </div><!-- end bloc-right -->
            
        </div><!-- end site-pusher -->

        

    <!-- SCRIPTS -->
     <script type="text/javascript" src="<?php echo rocstinteractive ?>js/jquery.min.js"></script>
     <script type="text/javascript" src="<?php echo rocstinteractive ?>js/function.js"></script>
  

    </body>
    
</html>
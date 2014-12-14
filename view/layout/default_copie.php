<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>ROCST INTERACTIVE | Rock your Business </title>

    <!-- STYLES -->
    <link rel="stylesheet" href="<?php echo rocstinteractive ?>styles/reset.css" />
    <link rel="stylesheet" href="<?php echo rocstinteractive ?>styles/master.css" />
    <link rel="stylesheet" href="<?php echo rocstinteractive ?>styles/slicknav.css" />
    </head>
    <body>

       

        <!-- <div class="logo">
            <a href="">ROCST</a>
        </div>  -->

    


        <!-- <div class="menu side-menu">   -->     

            <!-- <div class="nav-bar">
                <div class="mobile-logo">
                    <a href="">ROCST</a>
                </div>
                <div class="nav-bar-title">
                    <h6>Rock your business</h6>
                </div>
                <div class="nav-bar-toogle">
                    <a class="menu-btn">menu</a>
                </div> 
            </div> -->
            
            <!-- <ul  class="nav-top ">
                <li><a href="<?php echo rocstinteractive ?>"><span class="nav-one menu-item"></span><p>Accueil</p></a></li>
                <li><a href="<?php echo rocstinteractive ?>home/services"><span class="nav-two menu-item"></span><p>Services</p></a></li>
                <li><a href="<?php echo rocstinteractive ?>home/portfolio"><span class="nav-three menu-item"></span><p>Portfolio</p></a></li>
                <li><a href="<?php echo rocstinteractive ?>home/project"><span class="nav-four menu-item"></span>
                <p>Projets</p></a></li>
                <li><a href=""><span class="nav-five menu-item"></span><p>Client</p></a></li>
            </ul>
            <ul  class="nav-bottom ">
                <li><a href=""><span class="nav-six menu-item"></span><p>Blog</p></a></li> 
                <li><a href="<?php echo rocstinteractive ?>home/contact"><span class="nav-seven menu-item"></span><p>Contact</p></a></li>
            </ul> -->
            
        <!-- </div> --> <!-- end menu -->
    
        <div class="container ">

            <div class="content">

                <ul id="menu">
                    <li><a href="#">item 1</a></li>
                    <li><a href="#">item 2</a></li>
                    <li><a href="#">item 3</a></li>
                    <li><a href="#">item 4</a></li>
                </ul>
                
                <?php echo $content_for_layout ?>
                
            </div><!-- end content -->

        </div><!-- end container -->

    <!-- SCRIPTS -->
    <script type="text/javascript" src="<?php echo rocstinteractive ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo rocstinteractive ?>js/jquery.slicknav.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#menu').slicknav();
        });

    </script>
    
    </body>
    
</html>
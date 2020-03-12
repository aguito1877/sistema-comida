<?php 
    //session_start(); 
    require 'requirelanguage.php';
    error_reporting(E_PARSE);
    if(!isset($_SESSION['contador'])){
        $_SESSION['contador'] = 0;
    }
    $origen = basename($_SERVER['PHP_SELF']);
?>
<section id="container-carrito-compras">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div id="carrito-compras-tienda"></div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <p class="text-center" style="font-size: 80px;">
                    <i class="fa fa-shopping-cart"></i>
                </p>
                <p class="text-center">
                    <a href="pedido.php" class="btn btn-success btn-block"><i class="fa fa-dollar"></i> Confirmar
                        pedido</a>
                    <a href="process/vaciarcarrito.php" class="btn btn-danger btn-block"><i class="fa fa-trash"></i>
                        Vaciar carrito</a>
                </p>
            </div>
        </div>
    </div>
</section>
<nav id="navbar-auto-hidden">
    <div class="row hidden-xs">
        <!-- Menu Alimentos Registrados -->
        <div class="col-xs-4">
            <figure class="logo-navbar"></figure>
            <p class="text-navbar tittles-pages-logo">Fast Lunch</p>
        <!--Seccion de codigo para cambiar el idioma-->    
            <!--<div class="dropdown closed">
                <button class="btn btn-secondary dropdown-toggle" type="button"
                    style="margin-left: 50px;margin-top: 15px;" id="dropdownMenu2" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"> <?php echo $cambiarIdioma; ?>
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <a accesskey="e" href="changelanguage.php?language=es">
                        <button class="dropdown-item" type="button"><?php echo $español; ?></button>
                    </a>
                    <a accesskey="i" href="changelanguage.php?language=en">
                        <button class="dropdown-item" type="button"><?php echo $english; ?></button>
                    </a>
                    <a accesskey="f" href="changelanguage.php?language=fr">
                        <button class="dropdown-item" type="button"><?php echo $frances; ?></button>
                    </a>
                    <a accesskey="a" href="changelanguage.php?language=al">
                        <button class="dropdown-item" type="button"><?php echo $aleman; ?></button>
                    </a>
                </div>
            </div>-->
        <!--Seccion de codigo para cambiar el idioma-->    

        </div>
        <div class="col-xs-8">
            <div class="contenedor-tabla pull-right">
                <div class="contenedor-tr">


                    <div style="display:none">
                        <form action="index.php" method="post">
                            <fieldset class="searchform" style="background:#418783;border-color:#418783;">
                                <input type="text" name="busca" value="Buscar..." class="searchfield"
                                    onfocus="if (this.value == 'Buscar...') {this.value = '';}"
                                    onblur="if (this.value == '') {this.value = 'Buscar...';}" />
                                <input type="submit" name="submit" value="Buscar" class="searchbutton"
                                    style="display:none" />
                            </fieldset>
                        </form>
                    </div>


                    <style>
                    .searchform {

                        display: inline-block;

                        zoom: 1;
                        /* ie7 hack para display:inline-block */

                        *display: inline;

                        border: solid 1px #d2d2d2;

                        padding: 3px 5px;

                        -webkit-border-radius: 2em;

                        -moz-border-radius: 2em;

                        border-radius: 2em;

                        -webkit-box-shadow: 0 1px 0px rgba(0, 0, 0, .1);

                        -moz-box-shadow: 0 1px 0px rgba(0, 0, 0, .1);

                        box-shadow: 0 1px 0px rgba(0, 0, 0, .1);

                        background: #f1f1f1;

                        background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#ededed));

                        background: -moz-linear-gradient(top, #fff, #ededed);

                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed');
                        /* ie7 */

                        -ms-filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed');
                        /* ie8 */

                    }

                    .searchform input {

                        font: normal 12px/100% Arial, Helvetica, sans-serif;

                    }

                    .searchform .searchfield {



                        padding: 6px 6px 6px 8px;

                        width: 202px;

                        border: solid 1px #bcbbbb;

                        outline: none;

                        -webkit-border-radius: 2em;

                        -moz-border-radius: 2em;

                        border-radius: 2em;

                        -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .2);

                        -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .2);

                        box-shadow: inset 0 1px 2px rgba(0, 0, 0, .2);

                    }

                    .searchform .searchbutton {

                        color: #fff;

                        border: solid 1px #494949;

                        font-size: 11px;

                        height: 27px;

                        width: 27px;

                        text-shadow: 0 1px 1px rgba(0, 0, 0, .6);

                        -webkit-border-radius: 2em;

                        -moz-border-radius: 2em;

                        border-radius: 2em;

                        background: #5f5f5f;

                        background: -webkit-gradient(linear, left top, left bottom, from(#9e9e9e), to(#454545));

                        background: -moz-linear-gradient(top, #9e9e9e, #454545);

                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#9e9e9e', endColorstr='#454545');
                        /* ie7 */

                        -ms-filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#9e9e9e', endColorstr='#454545');
                        /* ie8 */

                    }
                    </style>






                    <a accesskey="n" href="index.php" class="table-cell-td"><?php echo $inicio; ?></a>
                    <a accesskey="p" href="http://localhost/OnlineStore/product.php?from=<?php echo $origen; ?>"
                        class="table-cell-td"><?php echo $producto; ?></a>
                    <?php
                            if(!$_SESSION['nombreAdmin']==""){
                                echo ' 
                                    <a href="configAdmin.php" class="table-cell-td">'.$admntra.'</a>
                                    <a href="#" class="table-cell-td carrito-button-nav all-elements-tooltip" data-toggle="tooltip" data-placement="bottom" title="'.$verccom.'">
                                        <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                    </a>
                                    <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-logout">
                                        <i class="fa fa-user"></i>&nbsp;&nbsp;'.$_SESSION['nombreAdmin'].'
                                    </a>
                                 ';
                            }else if(!$_SESSION['nombreUser']==""){
                                echo ' 
                                    <a href="pedido.php" class="table-cell-td">'.$ped.'</a>
                                    <a href="#" class="table-cell-td carrito-button-nav all-elements-tooltip" data-toggle="tooltip" data-placement="bottom" title="'.$verccom.'">
                                        <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                    </a>
                                    <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-logout">
                                        <i class="fa fa-user"></i>&nbsp;&nbsp;'.$_SESSION['nombreUser'].'
                                    </a>
                                 ';
                            }else{
                                echo ' 
                                    <a href="registration.php?from='.$origen.'" class="table-cell-td">'.$regt.'</a>
                                    <a href="#" class="table-cell-td carrito-button-nav all-elements-tooltip" data-toggle="tooltip" data-placement="bottom" title="'.$verccom.'">
                                        <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                    </a>
                                    <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-login">
                                        <i class="fa fa-user"></i>&nbsp;&nbsp;Login
                                    </a>
                                 ';
                            }
                        ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row visible-xs">
        <!-- Mobile menu navbar -->
        <div class="col-xs-12">
            <button class="btn btn-default pull-left button-mobile-menu" id="btn-mobile-menu">
                <i class="fa fa-th-list"></i>&nbsp;&nbsp;Menú
            </button>
            <a href="#" id="button-shopping-cart-xs" class="elements-nav-xs all-elements-tooltip carrito-button-nav"
                data-toggle="tooltip" data-placement="bottom" title="<?php echo $verccom; ?>">
                <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
            </a>
            <?php
                if(!$_SESSION['nombreAdmin']==""){echo '
                    <a href="#"  id="button-login-xs" class="elements-nav-xs" data-toggle="modal" data-target=".modal-logout">
                        <i class="fa fa-user"></i>&nbsp; '.$_SESSION['nombreAdmin'].' 
                    </a>';
                }else if(!$_SESSION['nombreUser']==""){
                    echo '
                    <a href="#"  id="button-login-xs" class="elements-nav-xs" data-toggle="modal" data-target=".modal-logout">
                        <i class="fa fa-user"></i>&nbsp; '.$_SESSION['nombreUser'].' 
                    </a>';
                }else{
                    echo '
                       <a href="#" data-toggle="modal" data-target=".modal-login" id="button-login-xs" class="elements-nav-xs">
                        <i class="fa fa-user"></i>&nbsp; Iniciar Sesión
                        </a> 
                   ';
                }
                ?>
        </div>
    </div>
</nav>
<!-- Modal login -->
<div class="modal fade modal-login" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="modal-form-login">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center text-primary" id="myModalLabel"><?php echo $inise; ?></h4>
            </div>
            <form action="process/login.php" method="post" role="form" style="margin: 20px;" class="FormCatElec"
                data-form="login">
                <div class="form-group">
                    <label><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $nob; ?></label>
                    <input type="text" class="form-control" name="nombre-login" placeholder="<?php echo $esnob; ?>"
                        required="" />
                </div>
                <div class="form-group">
                    <label><span class="glyphicon glyphicon-lock"></span>&nbsp;<?php echo $contr; ?></label>
                    <input type="password" class="form-control" name="clave-login" placeholder="<?php echo $escontr; ?>"
                        required="" />
                </div>
            <!--Como iniciaras session?-->
            <div class="hide" style="visibility: hidden;">    
            <p><?php echo $como; ?></p>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" value="option1" checked>
                        <?php echo $usu; ?>
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" value="option2">
                        <?php echo $adtr; ?>
                    </label>
                </div>
                </div>
            <!--Como iniciaras session?-->
                <div class="modal-footer" style="text-align:center !important;">
                    <button type="submit" class="btn btn-primary btn-sm"><?php echo $inises; ?></button>
                    <button type="button" class="btn btn-danger btn-sm"
                        data-dismiss="modal"><?php echo $canc; ?></button>
                </div>
                <div class="ResFormL" style="width: 100%; text-align: center; margin: 0;"></div>
            </form>
        </div>
    </div>
</div>
<!-- Fin Modal login -->
<div id="mobile-menu-list" class="hidden-sm hidden-md hidden-lg">
    <br>
    <h3 class="text-center tittles-pages-logo">Fast Lunch</h3>
    <button class="btn btn-default button-mobile-menu" id="button-close-mobile-menu">
        <i class="fa fa-times"></i>
    </button>
    <br><br>
    <ul class="list-unstyled text-center">
        <li><a href="index.php"><?php echo $inicio; ?></a></li>
        <li><a href="http://localhost/OnlineStore/product.php?from=<?php echo $origen; ?>">Producto</a></li>
        <?php 
                if(!$_SESSION['nombreAdmin']==""){
                    echo '<li><a href="configAdmin.php">'.$admntra.'</a></li>';
                }elseif(!$_SESSION['nombreUser']==""){
                    echo '<li><a href="pedido.php">'.$ped.'</a></li>';
                }else{
                    echo '<li><a href="registration.php?from='.$origen.'">'.$regt.'</a></li>';
                }
            ?>
    </ul>
</div>
<!-- Modal carrito -->
<div class="modal fade modal-carrito" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
    style="padding: 20px;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <br>
            <p class="text-center"><i class="fa fa-shopping-cart fa-5x"></i></p>
            <p class="text-center"><?php echo $elpr; ?></p>
            <p class="text-center"><button type="button" class="btn btn-primary btn-sm"
                    data-dismiss="modal"><?php echo $acep; ?></button></p>
        </div>
    </div>
</div>
<!-- Fin Modal carrito -->

<!-- Modal logout -->
<div class="modal fade modal-logout" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
    style="padding: 20px;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <br>
            <p class="text-center"><?php echo $qcers; ?></p>
            <p class="text-center"><i class="fa fa-exclamation-triangle fa-5x"></i></p>
            <p class="text-center">
                <a href="process/logout.php" class="btn btn-primary btn-sm"><?php echo $cers; ?></a>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><?php echo $canc; ?></button>
            </p>
        </div>
    </div>
</div>
<!-- Fin Modal logout -->
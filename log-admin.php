<?php 
include './inc/link.php';
?>
<div class="modal-dialog modal-sm">
        <div class="modal-content" id="modal-form-login">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center text-primary" id="myModalLabel">Hola muno</h4>
            </div>
            <form action="process/login.php" method="post" role="form" style="margin: 20px;" class="FormCatElec"
                data-form="login">
                <div class="form-group">
                    <label><span class="glyphicon glyphicon-user"></span>&nbsp;my frei</label>
                    <input type="text" class="form-control" name="nombre-login" placeholder="hola muno1"
                        required="" />
                </div>
                <div class="form-group">
                    <label><span class="glyphicon glyphicon-lock"></span>&nbsp;hola muno2</label>
                    <input type="password" class="form-control" name="clave-login" placeholder="hola muno3"
                        required="" />
                </div>
            <!--Como iniciaras session?-->
            <div class="hide" style="visibility: hidden;">    
            <p>Como</p>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" value="option1">
                        Usuario
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" value="option2" checked>
                        Administrador
                    </label>
                </div>
                </div>
            <!--Como iniciaras session?-->
                <div class="modal-footer" style="text-align:center !important;">
                    <button type="submit" class="btn btn-primary btn-sm">Usuario</button>
                    <button type="button" class="btn btn-danger btn-sm"
                        data-dismiss="modal">Administrador</button>
                </div>
                <div class="ResFormL" style="width: 100%; text-align: center; margin: 0;"></div>
            </form>
        </div>
    </div>
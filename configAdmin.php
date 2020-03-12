<?php
//session_start();
include './library/configServer.php';
include './library/consulSQL.php';
include './process/securityPanel.php';


$usuario = $_SESSION['nombreAdmin'];
$codigo = "INGRESO_OK_CONFIGADMIN";
$curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
$tipoAccion = "INGRESO";
$mensaje = "USUARIO INGRESO CORRECTAMENTE [" . $tipoAccion . ": " . $codigo . "]";
ejecutarSQL::consultar("insert ACCIONES values ('$codigo','$usuario','$tipoAccion','$mensaje','$curPageName',CURRENT_TIMESTAMP) ");



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $ad; ?></title>
    <?php include './inc/link.php'; ?>
    <script type="text/javascript" src="js/admin.js"></script>
    <link href="https://panel.chatcompose.com/static/global/export/css\main.af14124f.css" rel="stylesheet">
    <!--Visitas:--> <script type="text/javascript" src="http://localhost/OnlineStore/process/visitas.php"></script>
    <script async type="text/javascript" src="https://panel.chatcompose.com/static/global/export/js\main.82da0a06.js" user="xlopez-ayuda"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-156978057-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-156978057-2');
    </script>

    <!-- clicky -->

    <script>
        var clicky_site_ids = clicky_site_ids || [];
        clicky_site_ids.push(101232897);
    </script>
    <script async src="//static.getclicky.com/js"></script>



</head>

<body id="container-page-configAdmin">
    <?php include './inc/navbar.php'; ?>
    <section id="prove-product-cat-config">
        <div class="container">
            <div class="page-header">
                <h1><?php echo $panel; ?> <small class="tittles-pages-logo">Fast Luch</small></h1>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#Productos" role="tab" data-toggle="tab"><?php echo $prs; ?></a></li>
                <li role="presentation"><a href="#Proveedores" role="tab" data-toggle="tab"><?php echo $prove; ?></a></li>
                <li role="presentation"><a href="#Categorias" role="tab" data-toggle="tab"><?php echo $cat; ?></a></li>
                <li role="presentation"><a href="#Admins" role="tab" data-toggle="tab"><?php echo $ad; ?></a></li>
                <li role="presentation"><a href="#Pedidos" role="tab" data-toggle="tab"><?php echo $pedd; ?></a></li>
                <li role="presentation" style="display:none;"><a href="#Metricas" role="tab" data-toggle="tab">Metricas</a></li>
            </ul>
            <div class="tab-content">



                <div role="tabpanel" class="tab-pane fade in active" id="Productos">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <br><br>
                            <div id="add-product">
                                <h2 class="text-primary text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;<?php echo $agreg; ?></h2>
                                <form role="form" action="process/regproduct.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label><?php echo $codpr; ?></label>
                                        <input type="text" class="form-control" placeholder="Código" required maxlength="30" name="prod-codigo">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $nompr; ?></label>
                                        <input type="text" class="form-control" placeholder="Nombre" required maxlength="30" name="prod-name">
                                    </div>
                                    <div class="form-group">
                                        <label>Categoría</label>
                                        <select class="form-control" name="prod-categoria">
                                            <?php
                                            $categoriac =  ejecutarSQL::consultar("select * from categoria");
                                            while ($catec = mysqli_fetch_array($categoriac)) {
                                                echo '<option value="' . $catec['CodigoCat'] . '">' . $catec['Nombre'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Precio</label>
                                        <input type="text" class="form-control" placeholder="Precio" required maxlength="20" pattern="[0-9]{1,20}" name="prod-price">
                                    </div>
                                    <div class="form-group">
                                        <label>Sazón</label>
                                        <input type="text" class="form-control" placeholder="Sazón" required maxlength="30" name="prod-model">
                                    </div>
                                    <div class="form-group">
                                        <label>Hora limite reserva</label>
                                        <input type="text" class="form-control" placeholder="Hora" required maxlength="30" name="prod-marca">
                                    </div>
                                    <div class="form-group">
                                        <label>Cantidad de Platos</label>
                                        <input type="text" class="form-control" placeholder="Unidades" required maxlength="20" pattern="[0-9]{1,20}" name="prod-stock">
                                    </div>
                                    <div class="form-group">
                                        <label>Proveedor</label>
                                        <select class="form-control" name="prod-codigoP">
                                            <?php
                                            $proveedoresc =  ejecutarSQL::consultar("select * from proveedor");
                                            while ($provc = mysqli_fetch_array($proveedoresc)) {
                                                echo '<option value="' . $provc['NITProveedor'] . '">' . $provc['NombreProveedor'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Imagen de producto</label>
                                        <input type="file" name="img">
                                        <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg</p>
                                    </div>
                                    <input type="hidden" name="admin-name" value="<?php echo $_SESSION['nombreAdmin'] ?>">
                                    <p class="text-center"><button type="submit" class="btn btn-primary">Agregar a la tienda</button></p>
                                    <div id="res-form-add" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <br><br>
                            <div id="del-prod-form">
                                <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar un producto</h2>
                                <form action="process/delprod.php" method="post" role="form">
                                    <div class="form-group">
                                        <label>Productos</label>
                                        <select class="form-control" name="prod-code">
                                            <?php
                                            $productoc =  ejecutarSQL::consultar("select * from producto");
                                            while ($prodc = mysqli_fetch_array($productoc)) {
                                                echo '<option value="' . $prodc['CodigoProd'] . '">' . $prodc['Marca'] . '-' . $prodc['NombreProd'] . '-' . $prodc['Modelo'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar</button></p>
                                    <br>
                                    <div id="res-form-del-prod" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <br><br>
                            <div class="panel panel-info">
                                <div class="panel-heading text-center"><i class="fa fa-refresh fa-2x"></i>
                                    <h3>Actualizar datos de producto</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="">
                                            <tr>
                                                <th class="text-center">Código</th>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Categoría</th>
                                                <th class="text-center">Precio</th>
                                                <th class="text-center">Sazón</th>
                                                <th class="text-center">Hora limite reserva</th>
                                                <th class="text-center">Unidades</th>
                                                <th class="text-center">Proveedor</th>
                                                <th class="text-center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $productos =  ejecutarSQL::consultar("select * from producto");
                                            $upr = 1;
                                            while ($prod = mysqli_fetch_array($productos)) {
                                                echo '
                                                <div id="update-product">
                                                  <form method="post" action="process/updateProduct.php" id="res-update-product-' . $upr . '">
                                                    <tr>
                                                        <td>
                                                          <input class="form-control" type="hidden" name="code-old-prod" required="" value="' . $prod['CodigoProd'] . '">
                                                          <input class="form-control" type="text" name="code-prod" maxlength="30" required="" value="' . $prod['CodigoProd'] . '">
                                                        </td>
                                                        <td><input class="form-control" type="text" name="prod-name" maxlength="30" required="" value="' . $prod['NombreProd'] . '"></td>
                                                        <td>';
                                                $categoriac3 =  ejecutarSQL::consultar("select * from categoria where CodigoCat='" . $prod['CodigoCat'] . "'");
                                                while ($catec3 = mysqli_fetch_array($categoriac3)) {
                                                    $codeCat = $catec3['CodigoCat'];
                                                    $nameCat = $catec3['Nombre'];
                                                }
                                                echo '<select class="form-control" name="prod-category">';
                                                echo '<option value="' . $codeCat . '">' . $nameCat . '</option>';
                                                $categoriac2 =  ejecutarSQL::consultar("select * from categoria");
                                                while ($catec2 = mysqli_fetch_array($categoriac2)) {
                                                    if ($catec2['CodigoCat'] == $codeCat) {
                                                    } else {
                                                        echo '<option value="' . $catec2['CodigoCat'] . '">' . $catec2['Nombre'] . '</option>';
                                                    }
                                                }
                                                echo '</select>
                                                        </td>
                                                        <td><input class="form-control" type="text-area" name="price-prod" required="" value="' . $prod['Precio'] . '"></td>
                                                        <td><input class="form-control" type="tel" name="model-prod" required="" maxlength="20" value="' . $prod['Modelo'] . '"></td>
                                                        <td><input class="form-control" type="text-area" name="marc-prod" maxlength="30" required="" value="' . $prod['Marca'] . '"></td>
                                                        <td><input class="form-control" type="text-area" name="stock-prod" maxlength="30" required="" value="' . $prod['Stock'] . '"></td>
                                                        <td>';
                                                $proveedoresc3 =  ejecutarSQL::consultar("select * from proveedor where NITProveedor='" . $prod['NITProveedor'] . "'");
                                                while ($provc3 = mysqli_fetch_array($proveedoresc3)) {
                                                    $nombreP = $provc3['NombreProveedor'];
                                                    $nitP = $provc3['NITProveedor'];
                                                }
                                                echo '<select class="form-control" name="prod-Prove">';
                                                echo '<option value="' . $nitP . '">' . $nombreP . '</option>';
                                                $proveedoresc2 =  ejecutarSQL::consultar("select * from proveedor");
                                                while ($provc2 = mysqli_fetch_array($proveedoresc2)) {
                                                    if ($provc2['NITProveedor'] == $nitP) {
                                                    } else {
                                                        echo '<option value="' . $provc2['NITProveedor'] . '">' . $provc2['NombreProveedor'] . '</option>';
                                                    }
                                                }
                                                echo '</select>
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="submit" class="btn btn-sm btn-primary button-UPR" value="res-update-product-' . $upr . '">Actualizar</button>
                                                            <div id="res-update-product-' . $upr . '" style="width: 100%; margin:0px; padding:0px;"></div>
                                                        </td>
                                                    </tr>
                                                  </form>
                                                </div>
                                                ';
                                                $upr = $upr + 1;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--==============================Panel Proveedores===============================-->
                <div role="tabpanel" class="tab-pane fade" id="Proveedores">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <br><br>
                            <div id="add-provee">
                                <h2 class="text-primary text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar un proveedor</h2>
                                <form action="process/regprove.php" method="post" role="form">
                                    <div class="form-group">
                                        <label>NIT</label>
                                        <input class="form-control" type="text" name="prove-nit" placeholder="NIT proveedor" maxlength="30" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input class="form-control" type="text" name="prove-name" placeholder="Nombre proveedor" maxlength="30" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input class="form-control" type="text" name="prove-dir" placeholder="Dirección proveedor" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <input class="form-control" type="tel" name="prove-tel" placeholder="Número telefónico" pattern="[0-9]{1,20}" maxlength="20" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Correo Electrónico</label>
                                        <input class="form-control" type="text" name="prove-web" placeholder="Página web proveedor" required="">
                                    </div>
                                    <p class="text-center"><button type="submit" class="btn btn-primary">Añadir proveedor</button></p>
                                    <br>
                                    <div id="res-form-add-prove" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <br><br>
                            <div id="del-prove">
                                <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar un proveedor</h2>
                                <form action="process/delprove.php" method="post" role="form">
                                    <div class="form-group">
                                        <label>Proveedores</label>
                                        <select class="form-control" name="nit-prove">
                                            <?php
                                            $proveNIT =  ejecutarSQL::consultar("select * from proveedor");
                                            while ($PN = mysqli_fetch_array($proveNIT)) {
                                                echo '<option value="' . $PN['NITProveedor'] . '">' . $PN['NITProveedor'] . ' - ' . $PN['NombreProveedor'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar proveedor</button></p>
                                    <br>
                                    <div id="res-form-del-prove" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <br><br>
                            <div class="panel panel-info">
                                <div class="panel-heading text-center"><i class="fa fa-refresh fa-2x"></i>
                                    <h3>Actualizar datos de proveedor</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="">
                                            <tr>
                                                <th class="text-center">NIT</th>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Dirección</th>
                                                <th class="text-center">Telefono</th>
                                                <th class="text-center">Correo Electrónico</th>
                                                <th class="text-center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $proveedores =  ejecutarSQL::consultar("select * from proveedor");
                                            $up = 1;
                                            while ($prov = mysqli_fetch_array($proveedores)) {
                                                echo '
                                                      <div id="update-proveedor">
                                                        <form method="post" action="process/updateProveedor.php" id="res-update-prove-' . $up . '">
                                                          <tr>
                                                              <td>
                                                                <input class="form-control" type="hidden" name="nit-prove-old" required="" value="' . $prov['NITProveedor'] . '">
                                                                <input class="form-control" type="text" name="nit-prove" maxlength="30" required="" value="' . $prov['NITProveedor'] . '">
                                                              </td>
                                                              <td><input class="form-control" type="text" name="prove-name" maxlength="30" required="" value="' . $prov['NombreProveedor'] . '"></td>
                                                              <td><input class="form-control" type="text-area" name="prove-dir" required="" value="' . $prov['Direccion'] . '"></td>
                                                              <td><input class="form-control" type="tel" name="prove-tel" required="" maxlength="20" value="' . $prov['Telefono'] . '"></td>
                                                              <td><input class="form-control" type="text-area" name="prove-web" maxlength="30" required="" value="' . $prov['PaginaWeb'] . '"></td>
                                                              <td class="text-center">
                                                                  <button type="submit" class="btn btn-sm btn-primary button-UP" value="res-update-prove-' . $up . '">Actualizar</button>
                                                                  <div id="res-update-prove-' . $up . '" style="width: 100%; margin:0px; padding:0px;"></div>
                                                              </td>
                                                          </tr>
                                                        </form>
                                                      </div>
                                                      ';
                                                $up = $up + 1;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--==============================Panel Categorias===============================-->
                <div role="tabpanel" class="tab-pane fade" id="Categorias">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <br><br>
                            <div id="add-categori">
                                <h2 class="text-info text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar categoría</h2>
                                <form action="process/regcategori.php" method="post" role="form">
                                    <div class="form-group">
                                        <label>Código</label>
                                        <input class="form-control" type="text" name="categ-code" placeholder="Código de categoria" maxlength="9" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input class="form-control" type="text" name="categ-name" placeholder="Nombre de categoria" maxlength="30" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <input class="form-control" type="text" name="categ-descrip" placeholder="Descripcióne de categoria" required="">
                                    </div>
                                    <p class="text-center"><button type="submit" class="btn btn-primary">Agregar categoría</button></p>
                                    <br>
                                    <div id="res-form-add-categori" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <br><br>
                            <div id="del-categori">
                                <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar una categoría</h2>
                                <form action="process/delcategori.php" method="post" role="form">
                                    <div class="form-group">
                                        <label>Categorías</label>
                                        <select class="form-control" name="categ-code">
                                            <?php
                                            $categoriav =  ejecutarSQL::consultar("select * from categoria");
                                            while ($categv = mysqli_fetch_array($categoriav)) {
                                                echo '<option value="' . $categv['CodigoCat'] . '">' . $categv['CodigoCat'] . ' - ' . $categv['Nombre'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar categoría</button></p>
                                    <br>
                                    <div id="res-form-del-cat" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <br><br>
                            <div class="panel panel-info">
                                <div class="panel-heading text-center"><i class="fa fa-refresh fa-2x"></i>
                                    <h3>Actualizar categoría</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="">
                                            <tr>
                                                <th class="text-center">Código</th>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Descripción</th>
                                                <th class="text-center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $categorias =  ejecutarSQL::consultar("select * from categoria");
                                            $ui = 1;
                                            while ($cate = mysqli_fetch_array($categorias)) {
                                                echo '
                                                      <div id="update-category">
                                                        <form method="post" action="process/updateCategory.php" id="res-update-category-' . $ui . '">
                                                          <tr>
                                                              <td>
                                                                <input class="form-control" type="hidden" name="categ-code-old" maxlength="9" required="" value="' . $cate['CodigoCat'] . '">
                                                                <input class="form-control" type="text" name="categ-code" maxlength="9" required="" value="' . $cate['CodigoCat'] . '">
                                                              </td>
                                                              <td><input class="form-control" type="text" name="categ-name" maxlength="30" required="" value="' . $cate['Nombre'] . '"></td>
                                                              <td><input class="form-control" type="text-area" name="categ-descrip" required="" value="' . $cate['Descripcion'] . '"></td>
                                                              <td class="text-center">
                                                                  <button type="submit" class="btn btn-sm btn-primary button-UC" value="res-update-category-' . $ui . '">Actualizar</button>
                                                                  <div id="res-update-category-' . $ui . '" style="width: 100%; margin:0px; padding:0px;"></div>
                                                              </td>
                                                          </tr>
                                                        </form>
                                                      </div>
                                                      ';
                                                $ui = $ui + 1;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--==============================Panel Admins===============================-->
                <div role="tabpanel" class="tab-pane fade" id="Admins">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <br><br>
                            <div id="add-admin">
                                <h2 class="text-info text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar administrador</h2>
                                <form action="process/regAdmin.php" method="post" role="form">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input class="form-control" type="text" name="admin-name" placeholder="Nombre" maxlength="9" pattern="[a-zA-Z]{4,9}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Contraseña</label>
                                        <input class="form-control" type="password" name="admin-pass" placeholder="Contraseña" required="">
                                    </div>
                                    <p class="text-center"><button type="submit" class="btn btn-primary">Agregar administrador</button></p>
                                    <br>
                                    <div id="res-form-add-admin" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <br><br>
                            <div id="del-admin">
                                <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar administrador</h2>
                                <form action="process/deladmin.php" method="post" role="form">
                                    <div class="form-group">
                                        <label>Administradores</label>
                                        <select class="form-control" name="name-admin">
                                            <?php
                                            $adminCon =  ejecutarSQL::consultar("select * from administrador");
                                            while ($AdminD = mysqli_fetch_array($adminCon)) {
                                                echo '<option value="' . $AdminD['Nombre'] . '">' . $AdminD['Nombre'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar administrador</button></p>
                                    <br>
                                    <div id="res-form-del-admin" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12"></div>
                    </div>
                </div>
                <!--==============================Panel pedidos===============================-->
                <div role="tabpanel" class="tab-pane fade" id="Pedidos">
                    <div class="row">
                        <div class="col-xs-12">
                            <br><br>
                            <div id="del-pedido">
                                <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar pedido</h2>
                                <form action="process/delPedido.php" method="post" role="form">
                                    <div class="form-group">
                                        <label>Pedidos</label>
                                        <select class="form-control" name="num-pedido">
                                            <?php

                                            $pedidoC =  ejecutarSQL::consultar("select * from venta");
                                            while ($pedidoD = mysqli_fetch_array($pedidoC)) {
                                                echo '<option value="' . $pedidoD['NumPedido'] . '">Pedido #' . $pedidoD['NumPedido'] . ' - Estado(' . $pedidoD['Estado'] . ') - Fecha(' . $pedidoD['Fecha'] . ')</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar pedido</button></p>
                                    <br>
                                    <div id="res-form-del-pedido" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                            <br><br>
                            <div class="panel panel-info">
                                <div class="panel-heading text-center"><i class="fa fa-refresh fa-2x"></i>
                                    <h3>Actualizar estado de pedido</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Fecha</th>
                                                <th class="text-center">Cliente</th>
                                                <th class="text-center">Descuento</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $pedidoU =  ejecutarSQL::consultar("select * from venta where Estado!='Entregado'");
                                            $upp = 1;
                                            while ($peU = mysqli_fetch_array($pedidoU)) {
                                                echo '
                                                    <div id="update-pedido">
                                                      <form method="post" action="process/updatePedido.php?num-pedido=' . $peU['NumPedido'] . ' " id="res-update-pedido-' . $upp . '">
                                                        <tr>
                                                            <td>' . $peU['NumPedido'] . '<input type="hidden" name="num-pedido" value="' . $peU['NumPedido'] . '"></td>
                                                            <td>' . $peU['Fecha'] . '</td>
                                                            <td>';
                                                $conUs = ejecutarSQL::consultar("select * from cliente where NIT='" . $peU['NIT'] . "'");
                                                while ($UsP = mysqli_fetch_array($conUs)) {
                                                    echo $UsP['Nombre'];
                                                }
                                                echo   '</td>
                                                            <td>' . $peU['Descuento'] . '%</td>
                                                            <td>' . $peU['TotalPagar'] . '</td>
                                                            <td>
                                                                <select class="form-control" name="pedido-status">';
                                                if ($peU['Estado'] == "Pendiente") {


                                                    echo '<option selected value="Entregado">Entregado</option>';
                                                }
                                                if ($peU['Estado'] == "Entregado") {
                                                    echo '<option selected value="Entregado">Entregado</option>';
                                                }
                                                echo        '</select>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="submit" class="btn btn-sm btn-primary button-UPPE" value="res-update-pedido-' . $upp . '">Actualizar</button>
                                                                <div id="res-update-pedido-' . $upp . '" style="width: 100%; margin:0px; padding:0px;"></div>
                                                            </td>
                                                        </tr>
                                                      </form>
                                                    </div>
                                                    ';
                                                $upp = $upp + 1;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!--==============================Panel Metricas===============================-->


                <div role="tabpanel" class="tab-pane fade in active" id="Metricas" style="display:none;">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <br><br>

                            <section id="new-prod-index">
                                <div class="container">
                                    <div class="page-header">
                                        <h1>METRICAS DE <small>ENTENDIBILIDAD</small></h1>
                                    </div>
                                    <div class="row">


                                        <div class="page-header">

                                            <br>Numero de paginas web accesadas y numero de paginas abandonadas</br>
                                            <br>
                                            <table border="1">
                                                <tr>
                                                    <td>Id Proceso</td>
                                                     <td>Nombre de la Pagina</td>
                                                      <td>Numero de visitas</td>
                                                      <td>Numero de Abandonos</td>
                                                       <!-- <td>Total de vistas</td>
                                                         <td>Total de abandonos</td>-->
                                                </tr>
                                        <?php
                                 $conexion = mysqli_connect('localhost','root','','store');
                                 
                                 $sqlS="SELECT * FROM visitas_abandonos";
                                 $res = mysqli_query($conexion, $sqlS);
                                  
                                 while($mostrar = mysqli_fetch_array($res)){
                                     $tot = $mostrar['total_visitas'];
                                 $tot1 = $mostrar['total_abandonos'];
                                
                                        ?>
                                           
                                                <tr>
                                                    <td><?php echo $mostrar['id_visitas']?></td>
                                                    <td><?php echo $mostrar['nombre_pagina']?></td>
                                                    <td><?php echo $mostrar['num_visitas']?></td>
                                                    <td><?php echo $mostrar['num_abandonos']?></td>
                                                    <!-- <td><?php echo $mostrar['total_visitas']?></td>
                                                    <td><?php echo $mostrar['total_abandonos']?></td>-->
                                                 </tr>
                                                <?php
                                 }
                                                ?>
                                            </table>
                
                                      <?php echo "Numero total de visitas: ".$tot?></br>
                                      <?php echo "Numero total de abandonos:".$tot1?>
                                            

                                        </div>
                                        <div class="page-header">
                                            <br> </br>
                                        </div>
                                        <?php
                                        
                                        $error = ejecutarSQL::consultar("SELECT COUNT(id) FROM `acciones`");
                                        $errorp = mysqli_fetch_array($error);
                                        
                                        echo "Numero de mensajes de error: " . $errorp[0] . "<br>";
                                      
                                        
                                        
                                        $usuario = $_SESSION['nombreAdmin'];

 

                                        $consulta = ejecutarSQL::consultar("select count(id) AS cant, id, usuario, paginaURL from acciones where tipoAccion = 'ERROR' group by id, usuario, paginaURL");


                                        $totalRegistros = mysqli_num_rows($consulta);
                                        if ($totalRegistros > 0) {
                                            echo '<div class="table-responsive">
													<table class="table table-bordered">
														<thead>
														  <tr>
															  <th class="text-center"># ERROR POR USUARIO</th>
															  <th class="text-center">id</th>
															  <th class="text-center">usuario</th>
															  <th class="text-center">paginaURL</th>
														  </tr>
														</thead>
														<tbody>';

                                            while ($fila = mysqli_fetch_array($consulta)) {
                                                echo "<tr>";
                                                echo "<td>" . $fila['cant'] . "</td>";
                                                echo "<td>" . $fila['id'] . "</td>";
                                                echo "<td>" . $fila['usuario'] . "</td>";
                                                echo "<td>" . $fila['paginaURL'] . "</td>";
                                                echo "</tr>";
                                            }
                                            echo     "</tbody>";
                                            echo "</table>";
                                            echo "</div>";
                                        } else {
                                            echo '<h2>No hay registros en el historial</h2>';
                                        }

                                        ?>

                                        <div class="page-header">
                                            <br></br>
                                        </div>
                                        <?php

                                        $error = ejecutarSQL::consultar("SELECT COUNT(id_visitas) FROM `visitas_abandonos`");
                                        $errorp = mysqli_fetch_array($error);
                                        
                                        echo "Numero de INGRESOS A PAGINA: " . $errorp[0] . "<br>";
                                        
                                       
                                        
                                        

                                        $consulta = ejecutarSQL::consultar("select count(id) AS cant, id, usuario, paginaURL from acciones where tipoAccion = 'INGRESO' group by id, usuario, paginaURL");


                                        $totalRegistros = mysqli_num_rows($consulta);
                                        if ($totalRegistros > 0) {
                                            echo '<div class="table-responsive">
													<table class="table table-bordered">
														<thead>
														  <tr>
															  <th class="text-center"># INGRESOS POR USUARIO</th>
															  <th class="text-center">id</th>
															  <th class="text-center">usuario</th>
															  <th class="text-center">paginaURL</th>
														  </tr>
														</thead>
														<tbody>';

                                            while ($fila = mysqli_fetch_array($consulta)) {
                                                echo "<tr>";
                                                echo "<td>" . $fila['cant'] . "</td>";
                                                echo "<td>" . $fila['id'] . "</td>";
                                                echo "<td>" . $fila['usuario'] . "</td>";
                                                echo "<td>" . $fila['paginaURL'] . "</td>";
                                                echo "</tr>";
                                            }
                                            echo     "</tbody>";
                                            echo "</table>";
                                            echo "</div>";
                                        } else {
                                            echo '<h2>No hay registros en el historial</h2>';
                                        }

                                        ?>

                                        <h2>Tiempo que toma de pasar de una pagina a otra</h2><br>

                                        <div class="panel panel-info">
                                            <div class="panel-heading text-center">
                                                <h3>TABLA TRANSICION ENTRE PAGINAS</h3>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="">
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th class="text-center">PAGINA ORIGEN</th>
                                                            <th class="text-center">PAGINA DESTINO</th>
                                                            <th class="text-center">TIEMPO (s)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $pedidoU =  ejecutarSQL::consultar("select * from tiempo_transicion");
                                                        $upp = 1;
                                                        while ($peU = mysqli_fetch_array($pedidoU)) {
                                                            echo '
                                                    <div id="update-pedido">
                                                      <form method="post" action="process/updatePedido.php" id="res-update-pedido-' . $upp . '">
                                                        <tr>
                                                            <td>' . $peU['id'] . '<input type="hidden" name="num-pedido" value="' . $peU['NumPedido'] . '"></td>
                                                            <td>' . $peU['pagina_origen'] . '</td>
                                                            <td>' . $peU['pagina_llegada'] . '</td> 
                                                            <td>' . $peU['tiempo'] . '</td>
                                                        </tr>
                                                      </form>
                                                    </div>
                                                    ';
                                                            $upp = $upp + 1;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> 



                                        <h2>Tiempo que toma completar una Transaccion</h2><br>

                                        <div class="panel panel-info">
                                            <div class="panel-heading text-center">
                                                <h3>TABLA TRANSACCIONES COMPLETADAS</h3>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="">
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th class="text-center">TRANSACCION</th>
                                                            <th class="text-center">TIEMPO (S)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $pedidoU =  ejecutarSQL::consultar("select * from tiempo_transaccion");
                                                        $upp = 1;
                                                        while ($peU = mysqli_fetch_array($pedidoU)) {
                                                            echo '
                                                    <div id="update-pedido">
                                                      <form method="post" action="process/updatePedido.php" id="res-update-pedido-' . $upp . '">
                                                        <tr>
                                                            <td>' . $peU['id'] . '<input type="hidden" name="num-pedido" value="' . $peU['NumPedido'] . '"></td>
                                                            <td>' . $peU['tipo'] . '</td>
                                                            <td>' . $peU['tiempo'] . '</td>
                                                        </tr>
                                                      </form>
                                                    </div>
                                                    ';
                                                            $upp = $upp + 1;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> 


























                                    </div>
                                </div>
                            </section>

                            <section id="new-prod-index">
                                <div class="container">
                                    <div class="page-header">
                                        <h1>METRICAS DE <small>EFECTIVIDAD</small></h1>
                                    </div>
                                    <div class="row">
                                        <?php
                                        date_default_timezone_set('America/Guayaquil');
                                        $trans = ejecutarSQL::consultar("SELECT COUNT(usuario) FROM efectividad1 WHERE usuario='visitante'");
                                        $us = ejecutarSQL::consultar("SELECT COUNT(usuario) FROM efectividad1 WHERE usuario!='visitante'");
                                        $transp = mysqli_fetch_array($trans);
                                        $usp = mysqli_fetch_row($us);
                                        
                                        
                                        $coldia =  ejecutarSQL::consultar("select * from efectividad1");
                                        $peU = mysqli_fetch_array($coldia);
                                        $dia2 = $peU['dia']; //de la base de datos
                                        $dia1 = date('d'); //dia actual
                                        $comdia = $dia1 - $dia2; //dia actual - dia de la base
                                        
                                        $conteovis1 = ejecutarSQL::consultar("SELECT COUNT(usuario) FROM efectividad1 WHERE usuario='visitante'"
                                                . "and dia =".$dia1);                                        
                                        $contusu1 = ejecutarSQL::consultar("SELECT COUNT(usuario) FROM efectividad1 WHERE usuario!='visitante'"
                                                . "and dia =".$dia1);
                                        $conteovis1p = mysqli_fetch_array($conteovis1);
                                        $contusu1p = mysqli_fetch_row($contusu1);

                                                                                                                       
                                        echo "Ahora</br>";
                                            echo "Numero de transacciones diarias abandonadas: " . $conteovis1p[0] . "<br>";
                                            echo "Numero de sesiones abiertas y abandonadas: " . $contusu1p[0] . "<br>";
                                        
                                        $conteovis2 = ejecutarSQL::consultar("SELECT COUNT(usuario) FROM efectividad1 WHERE usuario='visitante'"
                                                . "and dia =".$dia1."-1");                                        
                                        $contusu2 = ejecutarSQL::consultar("SELECT COUNT(usuario) FROM efectividad1 WHERE usuario!='visitante'"
                                                . "and dia =".$dia1."-1");
                                        $conteovis2p = mysqli_fetch_array($conteovis2);
                                        $contusu2p = mysqli_fetch_row($contusu2);
                                            
                                                                                    
                                            echo "Ayer</br>";
                                            echo "Numero de transacciones diarias abandonadas: " . $conteovis2p[0] . "<br>";
                                            echo "Numero de sesiones abiertas y abandonadas: " . $contusu2p[0] . "<br>";
                                        
                                        $conteovis3 = ejecutarSQL::consultar("SELECT COUNT(usuario) FROM efectividad1 WHERE usuario='visitante'"
                                                . "and dia <=".$dia1."-3");                                        
                                        $contusu3 = ejecutarSQL::consultar("SELECT COUNT(usuario) FROM efectividad1 WHERE usuario!='visitante'"
                                                . "and dia <=".$dia1."-3");
                                        $conteovis3p = mysqli_fetch_array($conteovis3);
                                        $contusu3p = mysqli_fetch_row($contusu3);
                                         
                                            
                                                  
                                            echo "Más de 3 días</br>";
                                            echo "Numero de transacciones diarias abandonadas: " . $conteovis3p[0] . "<br>";
                                            echo "Numero de sesiones abiertas y abandonadas: " . $contusu3p[0] . "<br>";
                                        
                                        


                                        ?>
                                        <div class="panel panel-info">
                                            <div class="panel-heading text-center">
                                                <h3>TABLA EFECTIVIDAD</h3>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="">
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th class="text-center">Usuario</th>
                                                            <th class="text-center">Tiempo</th>
                                                            <th class="text-center">Día</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $pedidoU =  ejecutarSQL::consultar("select * from efectividad1");
                                                        $upp = 1;
                                                        while ($peU = mysqli_fetch_array($pedidoU)) {
                                                            echo '
                                                    <div id="update-pedido">
                                                      <form method="post" action="process/updatePedido.php" id="res-update-pedido-' . $upp . '">
                                                        <tr>
                                                            <td>' . $peU['id_transaccion'] . '<input type="hidden" name="num-pedido" value="' . $peU['NumPedido'] . '"></td>
                                                            <td>' . $peU['usuario'] . '</td>
                                                            <td>' . $peU['tiempo'] . '</td> 
                                                            <td>' . $peU['dia'] . '</td>
                                                        </tr>
                                                      </form>
                                                    </div>
                                                    ';
                                                            $upp = $upp + 1;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>






                                    </div>
                                </div>
                            </section>


                            <section id="new-prod-index">
                                <div class="container">
                                    <div class="page-header">
                                        <h1>METRICAS DE <small>EFICIENCIA</small></h1>
                                    </div>
                                    <div class="row">
                                        <?php
                                        date_default_timezone_set('America/Guayaquil');
                                        $ntrans = ejecutarSQL::consultar("SELECT Fecha, COUNT(Estado) Numero FROM `venta` WHERE Estado='Entregado'");
                                        $transp = mysqli_fetch_array($ntrans);
                                        while ($peU = mysqli_fetch_array($ntrans)) {
                                            echo "Numero de transacciones completas en el periodo " . $ntrans[0] . ": " . $ntrans[1] . "<br>";
                                        }


                                        ?>
                                        <div class="panel panel-info">
                                            <div class="panel-heading text-center">
                                                <h3>TABLA EFECTIVIDAD</h3>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="">
                                                        <tr>
                                                            <th class="text-center">#Entregados</th>
                                                            <th class="text-center">Periodo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $periodo = ejecutarSQL::consultar("SELECT Fecha, COUNT(Estado) Numero FROM `venta` WHERE Estado='Entregado' GROUP BY Fecha");
                                                        $upp = 1;
                                                        while ($peU = mysqli_fetch_array($periodo)) {
                                                            echo '<div id="update-pedido">
                                                    <tr>
                                                        <td>' . $peU['Numero'] . '</td>     '
                                                                . '<td>' . $peU['Fecha'] . '</td>
                                                    </tr>
                                            </div>
                                            ';
                                                            $upp = $upp + 1;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>


                        </div>
                    </div>
                </div>











            </div>
        </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION['S_ID'])) {
  header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>OFICINA DE PERSONAL</title>


  <!-- General CSS Files -->

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- CSS Libraries -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/b-2.2.2/b-html5-2.2.2/r-2.2.9/sl-1.3.4/datatables.min.css" />
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <!-- DATOS DEL USUARIO EN SESION -->
          <input type="text" id="txtprincipalid" value="<?php echo $_SESSION['S_ID']; ?>" hidden>
          <input type="text" id="txtprincipalusu" value="<?php echo $_SESSION['S_USU']; ?>" hidden>
          <input type="text" id="txtprincipalrol" value="<?php echo $_SESSION['S_ROL']; ?>" hidden>
          <input type="text" id="txtprincipalarea" value="<?php echo $_SESSION['S_AREA']; ?>"hidden >
          <!-- notificaciones -->
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep" aria-expanded="false"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons" tabindex="2" style="overflow: hidden; outline: none;">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-code"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Template update is available now!
                    <div class="time text-primary">2 Min Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-success text-white">
                    <i class="fas fa-check"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-danger text-white">
                    <i class="fas fa-exclamation-triangle"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Low disk space. Let's clean it!
                    <div class="time">17 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="fas fa-bell"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Welcome to Stisla template!
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
              <div id="ascrail2001" class="nicescroll-rails nicescroll-rails-vr" style="width: 9px; z-index: 1000; cursor: default; position: absolute; top: 58px; left: 341px; height: 350px; opacity: 0.3; display: none;">
                <div class="nicescroll-cursors" style="position: relative; top: 0px; float: right; width: 7px; height: 306px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;"></div>
              </div>
              <div id="ascrail2001-hr" class="nicescroll-rails nicescroll-rails-hr" style="height: 9px; z-index: 1000; top: 399px; left: 0px; position: absolute; cursor: default; display: none; width: 341px; opacity: 0.3;">
                <div class="nicescroll-cursors" style="position: absolute; top: 0px; height: 7px; width: 350px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px; left: 0px;"></div>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="" class=" inicio-img mr-1" id="img_inicio">
              <div class="d-sm-none d-lg-inline-block user-name">Usuario</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Tiempo de Sesion</div>
              <a onclick="cargar_contenido('contenido_principal','profile.php')" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Perfil
              </a>
              <a href="" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Configuracion
              </a>
              <div class="dropdown-divider"></div>
              <a href="../controller/usuarioC.php?tipo=cerrar_sesion" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Salir
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Oficina de Personal</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">OP</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Pagina Principal</li>
            <li class="nav-item dropdown">
              <a href="index.html" class="nav-link "><i class="fas fa-fire"></i><span>INICIO</span></a>
            </li>
            <li class="menu-header">Secciones</li>
            <?php if ($_SESSION['S_AREA'] == 6 || $_SESSION['S_ROL'] == 'Administrador') { ?>
              <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                  <span>Remuneraciones</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','tramite_area.php')">Bandeja de documentos</a></li>
                <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','tramite_enviado.php')">Documentos Enviados</a></li>
                <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','scandoc.php')">Documentos Guardados</a></li>
                <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','resumen/resumen.php')">Resumen</a></li>
                </ul>
              </li>
            <?php } ?>
            <?php if ($_SESSION['S_AREA'] == '4' || $_SESSION['S_ROL'] == 'Administrador') { ?>
              <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                  <span>Programacion</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','tramite_area.php')">Bandeja de documentos</a></li>
                <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','tramite_enviado.php')">Documentos Enviados</a></li>
                <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','scandoc.php')">Documentos Guardados</a></li>
                </ul>
              </li>
            <?php } ?>
            <?php if ($_SESSION['S_AREA'] == 2 || $_SESSION['S_ROL'] == 'Administrador') { ?>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                <span>Oficina Administrativa</span></a>
              <ul class="dropdown-menu">
              <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','tramite_area.php')">Bandeja de documentos</a></li>
              <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','tramite_enviado.php')">Documentos Enviados</a></li>
              <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','scandoc.php')">Documentos Guardados</a></li>
              </ul>
            </li>
            <?php } ?>

            <?php if ($_SESSION['S_AREA'] == 1 || $_SESSION['S_ROL'] == 'Administrador') { ?>
              <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                  <span>Bienestar</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','tramite_area.php')">Bandeja de documentos</a></li>
                  <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','tramite_enviado.php')">Documentos Enviados</a></li>
                  <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','scandoc.php')">Documentos Guardados</a></li>
                  <li><a class="nav-link" href="layout-top-navigation.html">Subsidios</a></li>
                </ul>
              </li>
            <?php } ?>

            <?php if ($_SESSION['S_AREA'] == 5 || $_SESSION['S_ROL'] == 'Administrador') { ?>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                <span>Seguridad y Salud</span></a>
              <ul class="dropdown-menu">
              <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','tramite_area.php')">Bandeja de documentos</a></li>
              <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','tramite_enviado.php')">Documentos Enviados</a></li>
              <li><a class="nav-link" onclick="cargar_contenido('contenido_principal','scandoc.php')">Documentos Guardados</a></li>
              </ul>
            </li>
            <?php } ?>
            <?php if ($_SESSION['S_ROL'] == 'Administrador') { ?>
              <li class="menu-header">Mantenimiento</li>
              <li class=""><a class="nav-link" onclick="cargar_contenido('contenido_principal','areas.php')"><i class="fas fa-cube"></i> <span>Areas</span></a></li>
              <li class=""><a class="nav-link" onclick="cargar_contenido('contenido_principal','usuarios.php')"><i class="fas fa-users"></i> <span>Usuarios</span></a></li>
              <li class=""><a class="nav-link" onclick="cargar_contenido('contenido_principal','tipo_documento.php')"><i class="far fa-file"></i> <span> Tipo de Documentos</span></a></li>
              <li class=""><a class="nav-link" onclick="cargar_contenido('contenido_principal','tramite.php')"><i class="fas fa-file-alt"></i> <span>Tramites</span></a></li>
              <li class=""><a class="nav-link" onclick="cargar_contenido('contenido_principal','empleado.php')"><i class="far fa-address-card"></i> <span>Empleados</span></a></li>
              <li class="menu-header">Reportes</li>
            <?php } ?>
          </ul>
          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Soporte
            </a>
          </div>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section>
          <div class="card sombrear">
            <div class="card-body">
              <div class="contenido mb-4" id="contenido_principal">

              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <!-- General JS Scripts -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.5/b-2.2.2/b-html5-2.2.2/r-2.2.9/sl-1.3.4/datatables.min.js"></script>
  <script src="../js/console_usuario.js"></script>
  <script>
    function cargar_contenido(contenedor, contenido) {
      $("#" + contenedor).load(contenido);
    }
    traerDatosUsuario()
  </script>


  <!-- Page Specific JS File -->
</body>
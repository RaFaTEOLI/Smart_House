<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/pages/conectar/casas.php" class="brand-link">
    <img src="/dist/img/smarthouselogo.png" alt="Smart House Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Smart House</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo $_SESSION["userFoto"] ? $_SESSION["userFoto"] : "/dist/img/avatar5.png" ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <div class="d-block">
          <a href="#"><?php echo $_SESSION["userNome"] ?></a>
          <a href="/pages/logout/logout.php" style="padding-left: 100px"><i class="fas fa-sign-out-alt"></i></a>
        </div>
      </div>
    </div>


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/smart_house/" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/pages/moradores/moradores.php" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Moradores
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/pages/comodos/comodos.php" class="nav-link">
            <i class="nav-icon fas fa-door-open"></i>
            <p>
              Cômodos
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/pages/aparelhos/aparelhos.php" class="nav-link">
            <i class="nav-icon fas fa-mobile"></i>
            <p>
              Aparelhos
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/pages/cenas/cenas.php" class="nav-link">
            <i class="nav-icon fas fa-person-booth"></i>
            <p>
              Cenas
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/pages/rotinas/rotinas.php" class="nav-link">
            <i class="nav-icon fas fa-clock"></i>
            <p>
              Rotinas
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/pages/ativacoes/ativacoes.php" class="nav-link">
            <i class="nav-icon fas fa-toggle-on"></i>
            <p>
              Ativações
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/pages/relatorios/relatorios.php" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Relatórios
            </p>
          </a>
        </li>
        <?php if ($_SESSION["userAdmin"]) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Gerenciamento
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/pages/usuarios/usuarios.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuários</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/pages/casas/casas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Casas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/pages/logs_sistema/logs_sistema.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logs do Sistema</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/pages/gerenciamento/pedidos_ativacao.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pedidos de Ativação</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <!-- <li class="nav-item">
          <a href="/pages/graficos/graficos.php" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Gráficos
            </p>
          </a>
        </li> -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
</aside>

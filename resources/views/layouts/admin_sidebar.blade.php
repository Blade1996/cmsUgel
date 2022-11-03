<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link logo-switch">
        <img src="{{$companyData->companyInfo->url_icon}}" alt="Logo Small" class="brand-image-xl logo-xs">
        <img src="{{$companyData->companyInfo->url_company}}" alt="Logo Large" class="brand-image-xs logo-xl"
            style="left: 12px">
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">Bienvenido {{ ucfirst(Auth::guard('admin')->user()->name) }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    @if (Session::get('page') == 'dashboard')
                    <?php $active = 'active'; $menuOpen = ''?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">HOME</li>
                <li class="nav-item">
                    @if (Session::get('page') == 'slider')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.slider.index') }}" class="nav-link {{$active}}">
                        <i class="nav-icon far fa-images"></i>
                        <p>
                            Slider
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'sections')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.sections') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-puzzle-piece"></i>
                        <p>
                            Menu Navegación
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'partners')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.partners') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>
                            Partners
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'articles')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.articles.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Articulos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'advertisements')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.advertisements.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Anuncios
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'advertising')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.advertising.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Publicidad
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'links')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.link.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Enlaces
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'normativity')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.normativity.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Normatividad
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'announcement')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.announcement.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Convocatorias
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    @if (Session::get('page') == 'desk')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.desk.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Mesa
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    @if (Session::get('page') == 'auxiliar')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.auxiliar.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Conf. Auxiliar
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'covid')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.covid.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Covid-19
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'control')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.control.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Control Interno
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'contract')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.contract.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Contrato
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'document-tree')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.document-tree.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Jerarquia de Documentos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'rotate')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.rotate.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Rotacion
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'election')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.election.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Eleccion
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'charge')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.charge.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Encargatura
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'reassign')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.reassign.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-sync"></i>
                        <p>
                            Reasignación
                        </p>
                    </a>
                </li>
                <li class="nav-header">CONFIGURACIÓN</li>
                @if (Session::get('page') == 'Company' || Session::get('page') == 'policies')
                <?php $active = 'active'; $menuOpen = 'menu-open'; ?>
                @else
                <?php $active = ''; $menuOpen = ''; ?>
                @endif
                <li class="nav-item has-treeview {{$menuOpen}}">

                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Configurar Compañía
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            @if (Session::get('page') == 'Company')
                            <?php $active = 'active'; ?>
                            @else
                            <?php $active = ''; ?>
                            @endif
                            <a href="{{route('dashboard.company')}}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Actualizar Datos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            @if (Session::get('page') == 'policies')
                            <?php $active = 'active'; ?>
                            @else
                            <?php $active = ''; ?>
                            @endif
                            <a href="{{route('dashboard.policies')}}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Políticas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (Session::get('page') == 'settings' || Session::get('page') == 'upd-admin-details')
                <?php $active = 'active'; $menuOpen = 'menu-open' ?>
                @else
                <?php $active = ''; $menuOpen = '' ?>
                @endif
                <li class="nav-item has-treeview {{$menuOpen}}">

                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Configuración Perfil
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Session::get('page') == 'settings')
                        <?php $active = 'active'; ?>
                        @else
                        <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('dashboard.settings') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cambiar Contraseña</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            @if (Session::get('page') == 'upd-admin-details')
                            <?php $active = 'active'; ?>
                            @else
                            <?php $active = ''; ?>
                            @endif
                            <a href="{{ route('dashboard.update-admin') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cambiar Datos</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

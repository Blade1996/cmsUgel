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
                    @if (Session::get('page') == 'sub-category')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.subcategories.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-stream"></i>
                        <p>
                            SubMenus
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
                    @if (Session::get('page') == 'interest-link')
                    <?php $active = 'active';?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.links.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-link"></i>
                        <p>
                            Enlaces de Interes
                        </p>
                    </a>
                </li>
                @if (Session::get('page') == 'list-documents' || Session::get('page') == 'category')
                <?php $active = 'active'; $menuOpen = 'menu-open'; ?>
                @else
                <?php $active = ''; $menuOpen = ''; ?>
                @endif
                <li class="nav-item has-treeview {{$menuOpen}}">

                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-print"></i>
                        <p>
                            Documentos
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            @if (Session::get('page') == 'list-documents')
                            <?php $active = 'active';?>
                            @else
                            <?php $active = ''; ?>
                            @endif
                            <a href="{{ route('dashboard.documents.index') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Lista de Documentos
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            @if (Session::get('page') == 'category')
                            <?php $active = 'active'; ?>
                            @else
                            <?php $active = ''; ?>
                            @endif
                            <a href="{{route('dashboard.categories.index')}}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categorias</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-header">CONTENIDO</li>
                <li class="nav-item">
                    @if (Session::get('page') == 'courses')
                    <?php $active = 'active'; ?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{route('courses.index')}}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Cursos</p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Session::get('page') == 'units')
                    <?php $active = 'active'; ?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{route('units.index')}}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Unidades</p>
                    </a>
                </li>
                @if (Session::get('page') == 'questions-list' || Session::get('page') == 'type-answer')
                <?php $active = 'active'; $menuOpen = 'menu-open'; ?>
                @else
                <?php $active = ''; $menuOpen = ''; ?>
                @endif
                <li class="nav-item has-treeview {{$menuOpen}}">

                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-question"></i>
                        <p>
                            Preguntas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            @if (Session::get('page') == 'questions-list')
                            <?php $active = 'active'; ?>
                            @else
                            <?php $active = ''; ?>
                            @endif
                            <a href="{{route('questions.index')}}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Preguntas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            @if (Session::get('page') == 'type-answer')
                            <?php $active = 'active'; ?>
                            @else
                            <?php $active = ''; ?>
                            @endif
                            <a href="{{route('type-answers.index')}}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Respuestas</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
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
                <li class="nav-item">
                    @if (Session::get('page') == 'areas')
                    <?php $active = 'active'; ?>
                    @else
                    <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard.areas.index') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-suitcase"></i>
                        <p>Áreas</p>
                    </a>
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
                @if (Session::get('page') == 'users' || Session::get('page') == 'courses-users')
                <?php $active = 'active'; $menuOpen = 'menu-open'; ?>
                @else
                <?php $active = ''; $menuOpen = ''; ?>
                @endif
                <li class="nav-item has-treeview {{$menuOpen}}">

                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Usuarios
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            @if (Session::get('page') == 'users')
                            <?php $active = 'active'; ?>
                            @else
                            <?php $active = ''; ?>
                            @endif
                            <a href="{{route('users.index')}}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lista de Usuarios</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            @if (Session::get('page') == 'courses-users')
                            <?php $active = 'active'; ?>
                            @else
                            <?php $active = ''; ?>
                            @endif
                            <a href="{{url('dashboard/courses-users')}}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Progreso de usuarios</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

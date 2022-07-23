<nav class="main-header navbar navbar-expand-md navbar-light navbar-lightblue">
    <div class="container">
        <a href="/clientesims" class="navbar-brand"
           style="display: flex; align-items: center; justify-content: center; height: 100%; ">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="brand-image elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name', 'Admin-IT') }}</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                @if(false)
                <li class="nav-item">
                    <a href="/dashboards" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                @endif

                @if(false)
                <li class="nav-item dropdown">
                    <a id="dropdownSubjects" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Subjects</a>
                    <ul aria-labelledby="dropdownSubjects" class="dropdown-menu border-0 shadow">
                        <li class="nav-item">
                            <a href="/subjects" class="nav-link">List</a>
                        </li>
                        <li class="nav-item">
                            <a href="/subjects/create" class="nav-link">Create</a>
                        </li>
                        <li class="nav-item">
                            <a href="/categories" class="nav-link">Categories</a>
                        </li>
                        <!-- End Level two -->
                    </ul>
                </li>
                @endif

                <li class="nav-item dropdown">
                    <a id="dropdownClientEsims" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Clients</a>
                    <ul aria-labelledby="dropdownClientEsims" class="dropdown-menu border-0 shadow">
                        <li class="nav-item">
                            <a href="/clientesims" class="nav-link">Clients</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a id="dropdownEsims" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Profiles E-sims</a>
                    <ul aria-labelledby="dropdownEsims" class="dropdown-menu border-0 shadow">
                        <li class="nav-item">
                            <a href="/esims" class="nav-link">E-sims</a>
                        </li>
                        @role('Admin')
                        <li class="nav-item">
                            <a href="/esims.headfiles" class="nav-link">Dump En-tete</a>
                        </li>
                        <li class="nav-item">
                            <a href="/esims.bodyfiles" class="nav-link">Dump Corps</a>
                        </li>
                        @endrole
                    </ul>
                </li>

                @role('Admin')
                <li class="nav-item dropdown">
                    <a id="usersMenu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Utilisateurs</a>
                    <ul aria-labelledby="usersMenu" class="dropdown-menu border-0 shadow">
                        <li class="nav-item">
                            <a href="/users" class="nav-link">Liste</a>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="rolesMenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Profiles</a>
                            <ul aria-labelledby="rolesMenu" class="dropdown-menu border-0 shadow">
                                <li class="nav-item">
                                    <a href="/roles" class="nav-link">Liste</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endrole

                @role('Admin')
                <li class="nav-item dropdown">
                    <a id="systemsMenu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">System</a>
                    <ul aria-labelledby="systemsMenu" class="dropdown-menu border-0 shadow">
                        <li class="nav-item">
                            <a href="/systems.index" class="nav-link">Index</a>
                        </li>
                        <li class="nav-item">
                            <a href="/users.online" class="nav-link">Users Online</a>
                        </li>
                    </ul>
                </li>
                @endrole

                @role('Admin')
                <li class="nav-item dropdown">
                    <a class="button is-warning" size="is-small" href="/howtos">Comment Faire &nbsp;<i class="fa fa-lightbulb"></i> </a>
                </li>
                @endrole

                @role('Admin')
                <li class="nav-item dropdown">
                    <a id="uuidgenerator" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">UUID</a>
                    <ul aria-labelledby="uuidgenerator" class="dropdown-menu border-0 shadow">
                        <li class="nav-item">
                            <b-button size="is-small" type="is-text is-light" @click="$emit('uuid_generator_open')">Generator</b-button>
                        </li>
                    </ul>
                </li>
                @endrole

            </ul>

            <!-- SEARCH FORM -->
{{--            @include('layouts.admin02.nav.search')--}}
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- Messages Dropdown Menu -->
{{--        @include('layouts.admin02.nav.messages')--}}

        <!-- Notifications Dropdown Menu -->
{{--            @include('layouts.admin02.nav.notifications')--}}
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
            </li>
        </ul>
    </div>
</nav>

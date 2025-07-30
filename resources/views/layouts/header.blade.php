<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-délais</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/images/illustration.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>

<body>
    <div class="container-scroller">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
                <a class="sidebar-brand brand-logo" href="#"><img
                        src="{{ asset('assets/images/illustration.png') }}"
                        style="    max-width: 60%;
    height: 56px;" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="#"><img
                        src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <a href="#" class="nav-link">
                        <div class="nav-profile-image">

                            <!--change to offline or busy as needed-->
                        </div>
                        <div class="nav-profile-text d-flex flex-column pr-3">
                            <span class="font-weight-medium mb-2">{{ Auth::user()->nom }}
                                {{ Auth::user()->prenoms }}</span>
                            <span class="font-weight-normal">{{ Auth::user()->role }}</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/recours/home/' . strtolower(Auth::user()->role)) }}">
                        @role('SUPER ADMIN')
                            <a class="nav-link" href="{{ url('/recours/home/admin') }}">
                            @endrole
                            <i class="mdi mdi-home menu-icon"></i>
                            <span class="menu-title">Tableau de bord</span>
                        </a>
                </li>
                @can('recours-create')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('form.recours.create') }}">
                            <i class="mdi mdi-plus-circle menu-icon"></i>
                            <span class="menu-title">Créer un recours</span>
                        </a>
                    </li>
                @endcan


                @can('affecter-recours')
                    <li class="nav-item">
                        <a class="nav-link"
                            href="
       @if (auth()->user()->hasRole('PCA')) {{ route('pca.getlisterecours_a_affectes') }}
       @elseif(auth()->user()->hasRole('PCJ'))
           {{ route('pcj.getlisterecours_a_affectes') }}
       @else
           # @endif
       ">
                            <i class="mdi mdi-shield menu-icon"></i>
                            <span class="menu-title">Affecter des recours</span>
                        </a>
                    </li>
                @endcan


                @can('mesure-execute')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('getlisterecours_en_instructions') }}">
                            <i class="mdi mdi-paperclip menu-icon"></i>
                            <span class="menu-title">Recours à executer</span>
                        </a>
                    </li>
                @endcan

                @can('recours-instruction')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('get_liste_instruire') }}">
                            <i class="mdi mdi-paperclip menu-icon"></i>
                            <span class="menu-title">Recours à instruire</span>
                        </a>
                    </li>
                @endcan


                @can('recours-affecter')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('getlisterecours_a_affectes') }}">
                            <i class="mdi mdi-paperclip menu-icon"></i>
                            <span class="menu-title">Recours à affectés</span>
                        </a>
                    </li>
                @endcan


                @can('instruction-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mesure_instructions.index') }}">
                            <i class="mdi mdi-plus-circle menu-icon"></i>
                            <span class="menu-title">Gestions des mesures</span>

                        </a>
                    </li>
                @endcan



                @can('execute-mesure')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('getlisterecours_en_instructions') }}">
                            <i class="mdi mdi-play menu-icon"></i>
                            <span class="menu-title">Exécuter une mesure</span>

                        </a>
                    </li>
                @endcan

                @can('user-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('liste_users') }}">
                            <i class="mdi mdi-account-switch menu-icon"></i>
                            <span class="menu-title">Gestion des Utilisateurs</span>
                        </a>
                    </li>
                @endcan

                {{--                 @role('SUPER ADMIN')
 --}}

                <li class="nav-item">

                    @hasanyrole('SECRETAIRE|GREFFIER|PCA|PCJ|CONSEILLER|SUPER ADMIN')
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="mdi mdi-settings menu-icon"></i>
                            <span class="menu-title">Paramètres</span>
                            <i class="menu-arrow"></i>
                        </a>
                    @endhasanyrole

                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            @can('structure-list')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('structures.index') }}">
                                        <i class="mdi mdi-home-modern menu-icon"></i>
                                        <span class="menu-title">Gestion structures</span>
                                    </a>
                                </li>
                            @endcan

                            @can('permission-list')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('permissions.index') }}">
                                        <i class="mdi mdi-plus-circle menu-icon"></i>
                                        <span class="menu-title">Gestions des permissions</span>

                                    </a>
                                </li>
                            @endcan

                            @can('section-list')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('sections.index') }}">
                                        <i class="mdi mdi-ungroup menu-icon"></i>
                                        <span class="menu-title">Gestion sections</span>
                                    </a>
                                </li>
                            @endcan
                            @can('role-list')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('roles.index') }}">
                                        <i class="mdi mdi-tag-multiple menu-icon"></i>
                                        <span class="menu-title">
                                            Gestion rôles
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('titre-list')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('titres.index') }}">
                                        <i class="mdi mdi-security menu-icon"></i>
                                        <span class="menu-title">
                                            Gestion titres
                                        </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>

                {{--     <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#uit-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <span class="menu-title">Utilisateurs</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="uit-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('structures.index') }}">Gestion structures</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('sections.index') }}">Gestion sections</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('roles.index') }}">Gestion roles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('titres.index') }}">Gestion titres</a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                {{--                     @endif
 --}}
                {{--                 @endrole
 --}}

                @can('mesure-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mesure_instructions.index') }}">
                            <i class="mdi mdi-view-list menu-icon"></i>
                            <span class="menu-title">Liste des mesures</span>

                        </a>
                    </li>
                @endcan
                @can('recours-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('get_liste') }}">
                            <i class="mdi mdi-folder menu-icon"></i>
                            <span class="menu-title">Liste des recours</span>
                        </a>
                    </li>
                @endcan

                @if (Auth::user())
                    <li class="nav-item sidebar-actions">
                        <div class="nav-link">
                            <div class="mt-4">
                                <ul class="mt-4 pl-0">
                                    <a class="btn btn-warning" href="{{ route('change_pwd_view') }}" role="button"
                                        style="color:white;">Modifier le mot de passe</a>
                                </ul>
                            </div>
                        </div>

                    </li>
                @endif



                <li class="nav-item sidebar-actions">
                    <div class="nav-link">
                        <div class="mt-4">
                            <ul class="mt-4 pl-0">
                                @if (Auth::user())
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" style="width: min-content"
                                            class="btn btn-danger btn-sm">Deconnexion</button>
                                    </form>
                                @endif
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="container-fluid page-body-wrapper">

            <nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
                <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
                    <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="index.html"><img
                            src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
                    <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button"
                        data-toggle="minimize">
                        <i class="mdi mdi-menu"></i>
                    </button>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown"
                                href="#" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="count count-varient1">7</span>
                            </a>
                            <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list"
                                aria-labelledby="notificationDropdown">
                                <h6 class="p-3 mb-0">Notifications</h6>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="../../assets/images/faces/face4.jpg" alt=""
                                            class="profile-pic" />
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="mb-0"> Dany Miles <span class="text-small text-muted">commented on
                                                your photo</span>
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="../../assets/images/faces/face3.jpg" alt=""
                                            class="profile-pic" />
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="mb-0"> James <span class="text-small text-muted">posted a photo on
                                                your wall</span>
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="../../assets/images/faces/face2.jpg" alt=""
                                            class="profile-pic" />
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="mb-0"> Alex <span class="text-small text-muted">just mentioned you
                                                in his post</span>
                                        </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <p class="p-3 mb-0">View all activities</p>
                            </div>
                        </li>


                    </ul>

                    <ul class="navbar-nav navbar-nav-right ml-lg-auto">

                        <li class="nav-item nav-profile dropdown border-0">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                                data-toggle="dropdown">
                                <span class="profile-name">{{ Auth::user()->nom }} {{ Auth::user()->prenoms }}</span>
                            </a>

                            <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
                                @if (Auth::user())
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf

                                        <button type="submit" style="width: min-content"
                                            class=" dropdown-item btn btn-danger btn-sm">Deconnexion</button>
                                    </form>
                                @endif

                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
            <div class="main-panel">

                <main class="py-4">
                    @yield('content')
                </main>
            </div>

        </div>




        {{--     </div>
 --}} <!-- page-body-wrapper ends -->
        {{--     </div>
 --}} <!-- container-scroller -->
        <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/file-upload.js') }}"></script>
        <script src="{{ asset('assets/js/typeahead.js') }}"></script>
        <script src="{{ asset('assets/js/select2.js') }}"></script>
        <!-- plugins:js -->
        <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('assets/vendors/flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset('assets/vendors/flot/jquery.flot.categories.js') }}"></script>
        <script src="{{ asset('assets/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
        <script src="{{ asset('assets/vendors/flot/jquery.flot.stack.js') }}"></script>
        <script src="{{ asset('assets/vendors/flot/jquery.flot.pie.js') }}"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
        <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('assets/js/misc.js') }}"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
        <!-- End custom js for this page -->

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- DataTables JS + Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>

<!-- JSZip + pdfmake for Excel and PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script>
            $(document).ready(function() {
  /*               $('#usersTable').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
                    },
                    paging: true,
                    searching: true,
                    ordering: true,
                }); */
               $('#usersTable').DataTable({
    dom: 'Bfrtip',  // Pour afficher les boutons au-dessus
    buttons: [
        {
            extend: 'pdf',
            text: 'PDF',
            className: 'btn btn-primary',
            exportOptions: {
                columns: [0, 1, 2, 3, 4,]
            }
        },
        {
            extend: 'print',
            text: 'Imprimer',
            className: 'btn btn-primary',
            exportOptions: {
                columns: [0, 1, 2, 3, 4,]
            }
        }
    ],
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
    },
    paging: true,
    searching: true,
    ordering: true
});

                $('#recoursTable').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
                    },
                    paging: true,
                    searching: true,
                    ordering: true,
                });

                $('#recoursInstruireTable').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
                    },
                    paging: true,
                    searching: true,
                    ordering: true,
                });

                $('#recoursAffecteTable').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
                    },
                    paging: true,
                    searching: true,
                    ordering: true,
                });

                $('#permissionsTable').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
                    },
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true
                });

/*                 $(document).ready(function () {
    $('#maTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy',     // Copier dans le presse-papier
            'csv',      // Export CSV
            'excel',    // Export Excel
            'pdf',      // Export PDF
            'print'     // Impression
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        }
    });
}); */


            });
        </script>

</body>

</html>

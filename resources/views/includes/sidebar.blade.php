 <!-- partial:partials/_sidebar.html -->
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item">
             <a class="nav-link" href="{{ route('home') }}">
                 <i class="mdi mdi-home menu-icon"></i>
                 <span class="menu-title">Home</span>
             </a>
         </li>

         @if (auth()->user()->isAdmin())
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('users') }}">
                     <i class="mdi mdi-account-box-multiple menu-icon"></i>
                     <span class="menu-title">Data Users</span>
                 </a>
             </li>
         @endif

         <li class="nav-item">
             <a class="nav-link" href="{{ route('criterias') }}">
                 <i class="mdi mdi-layers menu-icon"></i>
                 <span class="menu-title">Data Kriteria</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link" href="{{ route('alternatives') }}">
                 <i class="mdi mdi-spellcheck menu-icon"></i>
                 <span class="menu-title text-capitalize">Data {{ getApp()->name }}</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link" href="{{ route('selections') }}">
                 <i class="mdi mdi-file-document-box menu-icon"></i>
                 <span class="menu-title">Hasil Seleksi</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                 <i class="mdi mdi-settings menu-icon"></i>
                 <span class="menu-title">Pengaturan</span>
                 <i class="menu-arrow"></i>
             </a>
             @if (auth()->user()->isAdmin())
                 <div class="collapse" id="ui-basic">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('app.settings') }}">
                                 Aplikasi
                             </a>
                         </li>
                     </ul>
                 </div>
             @endif
         </li>

         <li class="nav-item">
             <a class="nav-link" href="{{ route('logout') }}">
                 <i class="mdi mdi-arrow-left menu-icon"></i>
                 <span class="menu-title">Logout</span>
             </a>
         </li>

     </ul>
 </nav>

    <!-- Navbar Transparent -->
    <nav class="navbar navbar-expand-sm position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent ">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="background-color: #FFFC57"></span>
            </button>
            <style>

                /* Gaya untuk teks berwarna putih */
                .navbar-nav .nav-link,
                .btn-outline-danger {
                    color:
                    #FFFC57 !important
                }
                .navbar-nav .nav-link:hover,
                .btn-outline-danger:hover {
                  color: #ffffff !important;
              }
            </style>
            <!-- Navbar links -->
            @auth

                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" aria-current="page"
                                href="/home"> Home </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('buku*') ? 'active' : '' }}" href="/buku/tampilan">Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('pinjam*') ? 'active' : '' }}"
                                href="/pinjam/tampilan">Peminjaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('datapinjam') ? 'active' : '' }}" href="/datapinjam">Data
                                Pinjam </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('user*') ? 'active' : '' }}" href="/user/tampilan">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('pengunjung*') ? 'active' : '' }}"
                                href="/pengunjung/tampilan">Pengunjung </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('kategori') ? 'active' : '' }}" href="/kategori"> Kategori
                            </a>
                        </li>
                        <form action="/" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger" style="color: white;">
                                <i class="bi bi-lock"></i> Logout
                            </button>
                        </form>
                    </ul>
                </div>
            @endauth
        </div>
        </div>
    </nav>

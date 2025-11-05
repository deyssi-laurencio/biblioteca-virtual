<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual - Inicio</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a2e0e6b6c2.js" crossorigin="anonymous"></script>
    <!-- AOS (animaciones) -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(180deg, #a7c7ff 0%, #e0f2ff 100%);
            transition: background-color 0.3s, color 0.3s;
        }

        /* --- Navbar --- */
        .navbar {
            transition: all 0.3s ease;
        }

        .navbar-brand img {
            border-radius: 8px;
        }

        /* --- Buscador --- */
        .search-bar input {
            border-radius: 20px;
            padding: 10px 20px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .search-bar input:focus {
            transform: scale(1.03);
            box-shadow: 0 0 10px rgba(13, 110, 253, 0.4);
        }

        /* --- Imágenes institucionales --- */
        .institution-images img {
            max-height: 220px;
            object-fit: cover;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .institution-images img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        /* --- Tarjetas --- */
        .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        /* --- Footer --- */
        .footer-icon-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .footer-icon-img:hover {
            transform: scale(1.2);
        }

        footer a.social-link {
            text-decoration: none;
        }

        footer h5 {
            color: #ffffff;
        }

        footer p, footer a {
            color: #e0e0e0;
        }

        /* --- Frase dinámica --- */
        .frase-dinamica {
            font-style: italic;
            color: #333;
            margin-top: 15px;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}"> 
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" width="50" class="me-2">
                📚 BIBLIOTECA VIRTUAL G.U.E. LEONCIO PRADO
            </a>

            <!-- Botón responsive -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('libros.index') }}">Libros</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('prestamos.index') }}">Préstamos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('solicitudes.index') }}">Solicitudes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('categorias.index') }}">Categorías</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('reportes.index') }}">Reportes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a></li>

                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrarse</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                👤 {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Encabezado -->
    <div class="container py-5 text-center">
        <div class="mb-4" data-aos="fade-up">
            <h1 class="fw-bold text-primary">
                Bienvenido a la Biblioteca Virtual <br> Gran Unidad Escolar Leoncio Prado
            </h1>
            <p class="frase-dinamica" id="fraseDinamica"></p>
        </div>

        <!-- Buscador -->
        <div class="search-bar mb-5" data-aos="fade-up" data-aos-delay="100">
            <form action="{{ route('buscar') }}" method="GET" class="d-flex justify-content-center">
                <input type="text" name="q" class="form-control w-50" placeholder="🔍 Buscar libros, autores, categorías...">
                <button class="btn btn-primary ms-2">Buscar</button>
            </form>
        </div>

        <!-- Imágenes institucionales estáticas -->
        <div class="institution-images row justify-content-center g-3 mb-5" data-aos="zoom-in">
            <div class="col-md-4">
                <img src="{{ asset('images/colegio.jpg') }}" class="img-fluid rounded-4 shadow" alt="Colegio">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/estudiantes.jpg') }}" class="img-fluid rounded-4 shadow" alt="Estudiantes">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/niños.jpg') }}" class="img-fluid rounded-4 shadow" alt="Niños">
            </div>
        </div>

        <!-- Tarjetas -->
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <a href="{{ route('libros.index') }}" class="text-decoration-none text-dark">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">📖 Libros</h5>
                            <p class="card-text">Consulta, registra y organiza los libros disponibles en la biblioteca.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <a href="{{ route('prestamos.index') }}" class="text-decoration-none text-dark">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">📑 Préstamos</h5>
                            <p class="card-text">Administra los préstamos de libros y su historial fácilmente.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('categorias.index') }}" class="text-decoration-none text-dark">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">📂 Categorías</h5>
                            <p class="card-text">Organiza los libros según sus categorías o materias.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-4" data-aos="fade-up">
                <a href="{{ route('solicitudes.index') }}" class="text-decoration-none text-dark">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">📝 Solicitudes</h5>
                            <p class="card-text">Gestiona las peticiones de libros, reservas y consultas de los usuarios.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <a href="{{ route('reportes.index') }}" class="text-decoration-none text-dark">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">📊 Reportes</h5>
                            <p class="card-text">Visualiza estadísticas, informes de préstamos y actividad de la biblioteca.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('usuarios.index') }}" class="text-decoration-none text-dark">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">👥 Usuarios</h5>
                            <p class="card-text">Administra los perfiles, roles y datos de los estudiantes y personal.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row text-center text-md-start">
                <div class="col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">Síguenos en redes</h5>
                    <div class="d-flex justify-content-center justify-content-md-start align-items-center">
                        <a href="https://www.facebook.com/GUELEONCIOPRADO_OFICIAL" target="_blank" class="social-link">
                            <img src="{{ asset('images/facebook_icon.jpg') }}" alt="Facebook" class="footer-icon-img">
                        </a>
                        <a href="https://www.youtube.com/@gueleoncioprado_oficial" target="_blank" class="social-link">
                            <img src="{{ asset('images/youtube_icon.jpg') }}" alt="YouTube" class="footer-icon-img">
                        </a>
                    </div>
                </div>

                <div class="col-md-6">
                    <h5 class="fw-bold mb-3">Contáctenos</h5>
                    <p>✉️ <a href="mailto:inocentehuamanastete@gmail.com" class="text-white text-decoration-none">inocentehuamanastete@gmail.com</a></p>
                    <p>📍 JR Damaso Beraun S/N (Parque Cartagena) - Huánuco</p>
                    <p>📞 <a href="tel:+51962667520" class="text-white text-decoration-none">962 667 520</a></p>
                </div>
            </div>

            <hr class="border-light">
            <p class="text-center mb-0">&copy; {{ date('Y') }} Biblioteca Virtual G.U.E. Leoncio Prado</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();

        // Frases inspiradoras dinámicas
        const frases = [
            "📚 Leer es soñar con los ojos abiertos.",
            "✨ Cada libro es una nueva aventura.",
            "💡 La lectura es el alimento del alma.",
            "🌟 Un lector vive mil vidas antes de morir."
        ];
        let i = 0;
        setInterval(() => {
            document.getElementById('fraseDinamica').textContent = frases[i];
            i = (i + 1) % frases.length;
        }, 4000);
    </script>

     <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/68f1247bb37ea9194db1fcc1/1j7mvd12t';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>
</html>

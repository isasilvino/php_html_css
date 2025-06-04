<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adote Mais - Encontre seu novo amigo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/ProjetoIntegrador/projeto-ongs/public/css/style.css">
    <style>
        .navbar {
            transition: background-color 0.3s ease;
        }
        .navbar.scrolled {
            background-color: #fff !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        section {
            padding: 80px 0;
        }
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/ProjetoIntegrador/projeto-ongs/public/img/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            color: white;
        }
        .card {
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .navbar-light .navbar-nav .nav-link {
            color: #333;
            font-weight: 500;
        }
        .navbar-scrolled .nav-link {
            color: #333 !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="/ProjetoIntegrador/projeto-ongs/">Adote Mais</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/ProjetoIntegrador/projeto-ongs/">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ProjetoIntegrador/projeto-ongs/animais">Adote</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#quem-somos">Quem Somos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#adocao-responsavel">Adoção Responsável</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ProjetoIntegrador/projeto-ongs/login">Área da ONG</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.navbar');
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('scrolled');
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
    </script>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
</body>
</html> 
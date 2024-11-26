<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Les balises meta, titre et autres liens CSS/JS -->
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-4">
        <div class="flex">
            <!-- Première colonne (menu) -->
            <div class="w-1/4 bg-gray-200">
                <ul>
                    <li><a href="{{ route('gestion_courrier') }}">Gestion de courrier</a></li>
                    <li><a href="{{ route('gestion_decharges') }}">Gestion de décharges</a></li>
                    <li><a href="{{ route('historique') }}">Historique</a></li>
                </ul>
            </div>

            <!-- Deuxième colonne (contenu dynamique) -->
            <div id="main-content" class="w-3/4 p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts JavaScript pour manipuler les liens -->
    <script>
        // JavaScript pour charger les pages dans la deuxième colonne
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('ul a');

            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const url = this.getAttribute('href');
                    fetch(url)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('main-content').innerHTML = data;
                            history.pushState(null, '', url);
                        })
                        .catch(error => console.error('Error fetching content:', error));
                });
            });
        });
    </script>
</body>
</html>

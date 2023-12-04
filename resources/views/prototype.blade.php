<!DOCTYPE html>
<html>
    <head>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
            };
        </script>
    </head>
    <body class="bg-gray-50 dark:bg-gray-900">
        <div id="app"></div>
        @vite('resources/assets/js/prototype/app.js')
        <script>
            window.versionNumber = '{{ $versionNumber }}';
        </script>
    </body>
</html>

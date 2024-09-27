<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
            };
        </script>
        @vite('resources/assets/js/app.js')
        @inertiaHead
    </head>
    <body class="bg-gray-50 dark:bg-gray-900">
        @inertia
    </body>
</html>

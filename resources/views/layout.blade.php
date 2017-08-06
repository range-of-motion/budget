<!DOCTYPE html>
<html>
    <head>
        <title>Budget</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:300,300i" />
        <link rel="stylesheet" href="/style.css" />
    </head>
    <body>
        <div class="navigation">
            <ul>
                <li>
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li>
                    <a href="/reports">Reports</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="/settings">Settings</a>
                </li>
                <li>
                    <a href="/logout">Log out</a>
                </li>
            </ul>
        </div>
        <div class="body">
            @yield('body')
        </div>
    </body>
</html>

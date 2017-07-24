<!DOCTYPE html>
<html>
    <head>
        <title>Budget</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:300,300i" />
        <link rel="stylesheet" href="/style.css" />
    </head>
    <body>
        <div class="navigation">
            <ul>
                <li>
                    <a href="/dashboard">Dashboard</a>
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

<form method="POST">
    {{ csrf_field() }}
    <label>E-mail</label>
    <input type="email" name="email" />
    <label>Password</label>
    <input type="password" name="password" />
    <input type="submit" value="Log in" />
</form>

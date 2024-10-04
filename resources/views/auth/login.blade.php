<form method="POST" action="{{ route('login.submit') }}">
    @csrf
    <div>
        <label for="login">Email atau Nombor IC</label>
        <input type="text" id="login" name="login" required>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>

    <button type="submit">Login</button>

    @if($errors->any())
        <div>
            <strong>{{ $errors->first('login') }}</strong>
        </div>
    @endif
</form>

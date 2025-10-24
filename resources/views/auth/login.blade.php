<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        
        @if(session('error'))
            <p class="error" style="color:red; margin-bottom:15px;">{{ session('error') }}</p>
        @endif

        
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="Masukkan email">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required placeholder="Masukkan password">

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

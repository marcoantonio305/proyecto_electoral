<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <form action="{{ url('/login') }}" method="POST" class="bg-white p-8 rounded shadow-md w-96">
        @csrf
        <h2 class="text-xl font-bold mb-4">Acceso Admin</h2>
        <div class="mb-4">
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" class="w-full border rounded p-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Contraseña</label>
            <input type="password" name="password" class="w-full border rounded p-2" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Entrar</button>

        @if($errors->any())
            <p class="text-red-500 text-sm mt-2">{{ $errors->first() }}</p>
        @endif
    </form>
</body>
</html>

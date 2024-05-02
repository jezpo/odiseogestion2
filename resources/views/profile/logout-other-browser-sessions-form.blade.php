<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <title>Autenticación de Dos Factores</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Autenticación de Dos Factores
            </div>
            <div class="card-body">
                <p>Añade seguridad adicional a tu cuenta usando la autenticación de dos factores.</p>

                <!-- Aquí se simula el estado del sistema de autenticación -->
                <h3 class="text-lg font-medium text-gray-900">
                    No has habilitado la autenticación de dos factores.
                </h3>
                <p class="mt-3 max-w-xl text-sm text-gray-600">
                    Cuando la autenticación de dos factores está habilitada, se te solicitará un token seguro y aleatorio durante la autenticación. Puedes obtener este token desde la aplicación Google Authenticator de tu teléfono.
                </p>
                
                <!-- Acciones de habilitación -->
                <div class="mt-5">
                    <button type="button" class="btn btn-primary" onclick="enableTwoFactor()">Habilitar</button>
                </div>

                <!-- Espacio para QR, Código de Confirmación y Claves de Recuperación (simulación) -->
                <div class="mt-4">
                    <!-- Simular QR si está habilitado -->
                </div>
                <div class="mt-4">
                    <label for="code">Código</label>
                    <input type="text" id="code" class="form-control mt-1 w-50" inputmode="numeric" autocomplete="one-time-code">
                    <!-- Aquí se mostrarían errores si fuera necesario -->
                </div>
                <div class="mt-4">
                    <p class="font-semibold">Almacena estos códigos de recuperación en un gestor de contraseñas seguro. Pueden ser utilizados para recuperar el acceso a tu cuenta si pierdes el dispositivo de autenticación de dos factores.</p>
                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        <!-- Códigos de recuperación simulados -->
                        <div>123456</div>
                        <div>654321</div>
                    </div>
                </div>

                <!-- Botones adicionales de acción -->
                <div class="mt-5">
                    <button type="button" class="btn btn-secondary mr-3" onclick="regenerateCodes()">Regenerar Códigos de Recuperación</button>
                    <button type="button" class="btn btn-danger" onclick="disableTwoFactor()">Deshabilitar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        // Aquí puedes agregar JavaScript para manejar la lógica del formulario
        function enableTwoFactor() {
            console.log('Habilitar la lógica de autenticación de dos factores aquí');
        }
        function regenerateCodes() {
            console.log('Regenerar códigos de recuperación aquí');
        }
        function disableTwoFactor() {
            console.log('Deshabilitar la autenticación de dos factores aquí');
        }
    </script>
</body>
</html>

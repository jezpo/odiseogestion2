<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Actualizar Contraseña</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Actualizar Contraseña
                    </div>
                    <div class="card-body">
                        <p class="card-text">Asegura que tu cuenta esté utilizando una contraseña larga y aleatoria para mantenerla segura.</p>
                        <form action="updatePassword" method="POST">
                            <div class="form-group">
                                <label for="current_password">Contraseña Actual</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required autocomplete="current-password">
                            </div>

                            <div class="form-group">
                                <label for="password">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="alert alert-success" role="alert" style="display: none;" id="successMessage">
                                Guardado.
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

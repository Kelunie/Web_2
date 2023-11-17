<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    //invoca cabecera de la página
    include_once('codigos/encabe.inc');
    ?>
    <title>Reporte Salarial</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    
</head>
<body class = "container-fluid">
    <head>
        <?php
        include_once('codigos/anca.inc');
        ?>
    </head>

    <main class ="row">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Reporte Salarial</h2>
                    </div>
                    <div class="card-body">
                        <form action="impresion.php" method="get">
                            <div class="form-group">
                                <label for="employeeId">ID de Empleado:</label>
                                <input type="text" class="form-control" id="employeeId" name="id" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Generar Reporte</button>
                        </form>
                    </div>
                </div>
                <div class="card mt-3">
    <div class="card-header">
        <h2 class="text-center">Reporte XML</h2>
    </div>
    <div class="card-body">
    <form action="impXML.php" method="get">
        <div class="form-group">
            <label for="departmentCode">Código del Departamento (0 para todos):</label>
            <input type="text" class="form-control" id="departmentCode" name="department_code" required>
        </div>
        <div class="form-group">
            <label for="employeeId">ID del Empleado:</label>
            <input type="text" class="form-control" id="employeeId" name="employee_id" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="action" value="view">Ver Reporte XML</button>
        <button type="submit" class="btn btn-success btn-block" name="action" value="download">Descargar Reporte XML</button>
    </form>
    </div>
</div>
            </div>
        </div>
    </div>
    </main>
    <footer>
        <?php
        include_once('codigos/pie.inc');
        ?>
    </footer>

    <!-- Incluye Bootstrap JS (si es necesario) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

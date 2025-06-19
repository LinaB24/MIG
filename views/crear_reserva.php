<?php include 'views/header.php'; ?>

<div class="container mt-5 d-flex justify-content-center">
    <div class="card p-4 shadow" style="max-width: 600px; width: 100%;">
        <h3 class="mb-4 text-center">Agregar Reserva</h3>

        <form action="index.php?url=reserva/guardar" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Cliente</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>

            <div class="mb-3">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" class="form-control" id="hora" name="hora" required>
            </div>

            <div class="mb-3">
                <label for="personas" class="form-label">Número de Personas</label>
                <input type="number" class="form-control" id="personas" name="personas" min="1" required>
            </div>

            <div class="mb-3">
                <label for="mesa_id" class="form-label">Mesa disponible</label>
                <select class="form-select" id="mesa_id" name="mesa_id" required>
                    <option value="">Seleccione una mesa</option>
                    <?php foreach ($mesas as $mesa): ?>
                        <option value="<?= $mesa['MesaID'] ?>"><?= $mesa['Numero'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Guardar reserva</button>
                <a href="index.php?url=reserva/index" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger mt-3"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </div>
</div>

<?php include 'views/footer.php'; ?>

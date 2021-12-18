<?php
    require '../../src/Piyush/autoload.php';
    use Piyush\Model\VehicleManagement;
    use Piyush\Model\DriverManagement;
?>
<?php include '../layout/header.php' ?>
    <h1>Driver Management</h1>
    <?php 
        $email = $_GET['email'] ?? '';
        $driver = DriverManagement::get($email);
    ?>
    <h2><?= $driver ? 'Edit: ' . $driver->getName() : 'New Driver'; ?></h2>
    <form action ="/travel-fare/controller/driver/save.php" method="post">
        <div>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="<?= $driver ? $driver->getName() : "" ?>">
        </div>
        <div>
            <label for="surname">Surname</label>
            <input id="surname" type="text" name="surname" value="<?= $driver ? $driver->getSurname() : "" ?>">
        </div>
        <div>
            <label for="email">Surname</label>
            <input id="email" type="email" name="email" value="<?= $driver ? $driver->getEmail() : "" ?>">
        </div>
        <div>
            <label for="vehicleType">Vehicle Type</label>
            <select id="vehicleType" name="vehicleType">
                <?php $vehicles = VehicleManagement::getList(); ?>
                <?php foreach ($vehicles as $vehicle): ?>
                    <option <?= $driver && $driver->getVehicleType() === $vehicle->getValue() ? " selected" : ""?>
                      value="<?= $vehicle->getValue(); ?>" ><?= $vehicle->getLabel(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="hidden" name="oldEmail" value="<?= $driver ? $driver->getEmail() : "" ?>" >
        <div>
            <button type="submit" click=>Save</button>
        </div>
    </form>
    <?php include '../layout/footer.php' ?>
</body>

</html>
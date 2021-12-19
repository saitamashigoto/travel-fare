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
        $vehicles = VehicleManagement::getList();
    ?>
    <h2><?= $driver ? 'Edit: ' . $driver->getName() : 'New Driver'; ?></h2>
    <?php if (count($vehicles) > 0): ?>
    <form action ="/travel-fare/controller/driver/save.php" method="post">
        <div>
            <label for="name">Name</label>
            <input id="name" type="text" required="required" name="name" value="<?= $driver ? $driver->getName() : "" ?>">
        </div>
        <div>
            <label for="surname">Surname</label>
            <input id="surname" type="text" required="required" name="surname" value="<?= $driver ? $driver->getSurname() : "" ?>">
        </div>
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" required="required" name="email" value="<?= $driver ? $driver->getEmail() : "" ?>">
        </div>
        <div>
            <label for="vehicleType">Vehicle Type</label>
            <select id="vehicleType" required="required" name="vehicleType">
                <?php foreach ($vehicles as $vehicle): ?>
                    <option <?= $driver && $driver->getVehicleType() === $vehicle->getValue() ? " selected" : ""?>
                      value="<?= $vehicle->getValue(); ?>" ><?= $vehicle->getLabel(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="baseFarePrice">Base Fare Price</label>
            <input id="baseFarePrice" required="required" type="text" name="baseFarePrice" value="<?= $driver ? $driver->getBaseFarePrice() : "" ?>">
        </div>
        <div>
            <label for="baseFareDistance">Base Fare Distance</label>
            <input id="baseFareDistance" required="required" type="text" name="baseFareDistance" value="<?= $driver ? $driver->getBaseFareDistance() : "" ?>">
        </div>
        <input type="hidden" name="oldEmail" value="<?= $driver ? $driver->getEmail() : "" ?>" >
        <div>
            <button type="submit" click=>Save</button>
        </div>
    </form>
    <?php else: ?>
        <div><p>No Vehicle exists. Please add some vehicles.</p></div>
        <?php include '../vehicle/add_button.php' ?>
    <?php endif; ?>
    <?php include '../layout/homepage.php' ?>
</body>

</html>
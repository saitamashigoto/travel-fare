<?php
    require '../../src/Piyush/autoload.php';
    use Piyush\Model\VehicleManagement;
?>
<?php include '../layout/header.php' ?>
    <h1>Vehicle Management</h1>
    <?php 
        $value = $_GET['value'] ?? '';
        $vehicle = VehicleManagement::get($value);
    ?>
    <h2><?= $vehicle ? 'Edit: ' . $vehicle->getLabel() : 'New Vehicle'; ?></h2>
    <form action ="/travel-fare/controller/vehicle/save.php" method="post">
        <div>
            <label for="label">Label</label>
            <input id="label" required="required" type="text" name="label" value="<?= $vehicle ? $vehicle->getLabel() : "" ?>">
        </div>
        <div>
            <label for="value">Value</label>
            <input id="value" required="required" type="text" name="value" value="<?= $vehicle ? $vehicle->getValue() : "" ?>">
        </div>
        <input type="hidden" name="oldValue" value="<?= $vehicle ? $vehicle->getValue() : "" ?>" >
        <div>
            <button type="submit" click=>Save</button>
        </div>
    </form>
    <?php include '../layout/homepage.php' ?>
</body>

</html>
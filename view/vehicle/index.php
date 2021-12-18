<?php
    require '../../src/Piyush/autoload.php';
    use Piyush\Model\VehicleManagement;
    include '../layout/header.php'
?>
    <h1>Vehicle Management</h1>
    <?php $vehicles = VehicleManagement::getList(); ?>
    <div>
        <?php if (!empty($vehicles)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Label</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vehicles as $vehicle): ?>
                        <tr>
                            <td><?= $vehicle->getLabel(); ?></td>
                            <td><a href="/travel-fare/controller/vehicle/edit.php?value=<?= $vehicle->getValue(); ?>">Edit</a></td>
                            <td><a href="/travel-fare/controller/vehicle/delete.php?value=<?= $vehicle->getValue(); ?>">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No vehicle exist. Please add some.</p>
        <?php endif; ?>
    </div>
    <div><button onclick="location.href='<?= '/travel-fare/controller/vehicle/new.php' ?>';" type="button" click=>Add Vehicle</button></div>
    <?php include '../layout/footer.php' ?>
</body>

</html>
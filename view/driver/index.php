<?php
    require '../../src/Piyush/autoload.php';
    use Piyush\Model\DriverManagement;
    include '../layout/header.php'
?>
    <h1>Driver Management</h1>
    <?php $drivers = DriverManagement::getList(); ?>
    <div>
        <?php if (!empty($drivers)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($drivers as $driver): ?>
                        <tr>
                            <td><?= $driver->getName(); ?></td>
                            <td><?= $driver->getEmail(); ?></td>
                            <td><a href="/travel-fare/controller/driver/view.php?value=<?= $driver->getEmail(); ?>">View</a></td>
                            <td><a href="/travel-fare/controller/driver/edit.php?value=<?= $driver->getEmail(); ?>">Edit</a></td>
                            <td><a href="/travel-fare/controller/driver/delete.php?value=<?= $driver->getEmail(); ?>">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No driver exist. Please add some.</p>
        <?php endif; ?>
    </div>
    <div><button onclick="location.href='<?= '/travel-fare/controller/driver/new.php' ?>';" type="button" click=>Add driver</button></div>
    <?php include '../layout/footer.php' ?>
</body>

</html>
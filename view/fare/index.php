<?php
    require '../../src/Piyush/autoload.php';
    use Piyush\Model\FareManagement;
    use Piyush\Model\DriverManagement;
    include '../layout/header.php'
?>
    <h1>Fare Management</h1>
    <?php $drivers = DriverManagement::getList(); ?>
    <div>
        <?php if (!empty($drivers)): 
            ini_set('display_errors', 1);
            $fares = FareManagement::getList();
            
            ?>
            <div>
                <?php if (empty($fares)): ?>
                    <p>
                        No fare Data Available. Please upload a csv file. 
                    </p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Distance Traveled</th>
                                <th>Traveled Unit</th>
                                <th>Cost Per Distance Traveled</th>
                                <th>Cheapest Fare</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($fares as $fare): ?>
                                <tr>
                                    <td><?= $fare->getDistanceTraveled(); ?></td>
                                    <td><?= $fare->getTraveledUnit(); ?></td>
                                    <td><?= $fare->getCostPerDistanceTraveled(); ?></td>
                                    <td><?= $fare->getCheapestFare(); ?></td>
                                    <td><a href="/travel-fare/controller/fare/update.php?hash=<?= $fare->calculateHash(); ?>">Recalculate</a></td>
                                    <td><a href="/travel-fare/controller/fare/delete.php?hash=<?= $fare->calculateHash(); ?>">Delete</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>No driver exist. Please add some.</p>
            <?php include '../driver/add_button.php' ?>
        <?php endif; ?>
        <?php
            if (!empty(DriverManagement::getList())) {
                include './upload.php';
            }
        ?>
    </div>
    <?php include '../layout/homepage.php' ?>
</body>

</html>
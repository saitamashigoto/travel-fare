<?php
    require '../../src/Piyush/autoload.php';
    use Piyush\Model\FareManagement;
    use Piyush\Model\DriverManagement;
    include '../layout/header.php'
?>
    <h1 class="title has-text-centered has-text-primary">Fare Management</h1>
    <?php $drivers = DriverManagement::getList(); ?>
    
    <div class="columns is-multiline is-mobile is-centered">
        <?php if (!empty($drivers)): 
            $fares = FareManagement::getList();
        ?>
            <div class="column is-12 has-text-centered">
                <?php if (empty($fares)): ?>
                    <p class="has-text-danger is-size-4">
                        No fare Data Available. Please upload a csv file. 
                    </p>
                <?php else: ?>
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <tr>
                                    <th class="is-primary">Distance Traveled</th>
                                    <th class="is-primary">Traveled Unit</th>
                                    <th class="is-primary">Cost Per Distance Traveled</th>
                                    <th class="is-primary">Cheapest Fare</th>
                                    <th class="is-primary" colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($fares as $fare): ?>
                                    <tr>
                                        <td><?= $fare->getDistanceTraveled(); ?></td>
                                        <td><?= $fare->getTraveledUnit(); ?></td>
                                        <td><?= $fare->getCostPerDistanceTraveled(); ?></td>
                                        <td><?= $fare->getCheapestFare(); ?></td>
                                        <td><a class="button is-primary" href="/travel-fare/controller/fare/update.php?hash=<?= $fare->calculateHash(); ?>">Recalculate</a></td>
                                        <td><a class="button is-primary" href="/travel-fare/controller/fare/delete.php?hash=<?= $fare->calculateHash(); ?>">Delete</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="column is-12 has-text-centered">
                <p class="has-text-danger is-size-4">No driver exist. Please add some.</p>
            </div>
            <div class="column is-12 has-text-centered">
                <?php include '../driver/add_button.php' ?>
            </div>
        <?php endif; ?>
        <?php
            if (!empty(DriverManagement::getList())) {
                include './upload.php';
            }
        ?>
    <div class="column is-12 has-text-centered">
        <?php include '../layout/homepage.php' ?>
    </div>
    </div>
    <?php include '../layout/footer.php' ?>
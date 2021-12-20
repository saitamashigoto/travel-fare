<?php
    require '../../src/Piyush/autoload.php';
    use Piyush\Model\VehicleManagement;
    include '../layout/header.php'
?>
    <h1 class="title has-text-centered has-text-primary">Vehicle Management</h1>
    <?php $vehicles = VehicleManagement::getList(); ?>
    <div class="columns is-multiline is-mobile is-centered">
        <div class="column is-12 has-text-right">
            <?php include './add_button.php' ?>
        </div>
        <div class="column is-12 has-text-centered">
            <?php if (!empty($vehicles)): ?>
                <div class="table-container">
                    <table class="table is-fullwidth">
                        <thead>
                            <tr>
                                <th class="is-primary">Label</th>
                                <th class="is-primary" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vehicles as $vehicle): ?>
                                <tr>
                                    <td><?= $vehicle->getLabel(); ?></td>
                                    <td><a class="button is-primary" href="/travel-fare/controller/vehicle/edit.php?value=<?= $vehicle->getValue(); ?>">Edit</a></td>
                                    <td><a class="button is-primary" href="/travel-fare/controller/vehicle/delete.php?value=<?= $vehicle->getValue(); ?>">Delete</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="has-text-danger is-size-4">No vehicle exist. Please add some.</p>
            <?php endif; ?>
        </div>
        
        <?php include '../layout/footer-navigation.php' ?>
    </div>
    <?php include '../layout/footer.php' ?>
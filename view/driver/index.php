<?php
    require '../../src/Piyush/autoload.php';
    use Piyush\Model\DriverManagement;
    include '../layout/header.php'
?>
    <h1 class="title has-text-centered has-text-primary">Driver Management</h1>
    <div class="columns is-multiline is-mobile is-centered">
        <?php $drivers = DriverManagement::getList(); ?>
        <div class="column is-12 has-text-centered">
            <div class="column is-12 has-text-right">
                <button class="button is-primary"
                onclick="location.href='<?= '/travel-fare/controller/driver/new.php' ?>';"
                type="button" >Add driver</button>
            </div>
            <?php if (!empty($drivers)): ?>
                <div class="table-container">
                    <table class="table is-fullwidth">
                        <thead>
                            <tr>
                                <th class="is-primary">Name</th>
                                <th class="is-primary">Email</th>
                                <th class="is-primary" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($drivers as $driver): ?>
                                <tr>
                                    <td class=""><?= $driver->getName(); ?></td>
                                    <td class=""><?= $driver->getEmail(); ?></td>
                                    <td><a class="button is-primary" href="/travel-fare/controller/driver/edit.php?email=<?= $driver->getEmail(); ?>">Edit</a></td>
                                    <td><a class="button is-primary" href="/travel-fare/controller/driver/delete.php?email=<?= $driver->getEmail(); ?>">Delete</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="has-text-danger is-size-4">No driver exist. Please add some.</p>
            <?php endif; ?>
        </div>
        
        <?php include '../layout/footer-navigation.php' ?>
    </div>
    <?php include '../layout/footer.php' ?>
<?php
    require '../../src/Piyush/autoload.php';
    use Piyush\Model\VehicleManagement;
    use Piyush\Model\DriverManagement;
?>
<?php include '../layout/header.php' ?>
    <?php 
        $email = $_GET['email'] ?? '';
        $driver = DriverManagement::get($email);
        $vehicles = VehicleManagement::getList();
    ?>
    <h1 class="title has-text-centered has-text-primary"><?= $driver ? 'Edit: ' . $driver->getName() : 'New Driver'; ?></h1>
        <div class="columns is-multiline is-mobile is-centered">
            <?php if (count($vehicles) > 0): ?>
                <div class="column is-12">
                    <form action ="/travel-fare/controller/driver/save.php" method="post">
                        <div class="field">
                            <label class="label has-text-primary">Name</label>
                            <div class="control">
                                <input class="input" placeholder="Name" id="name" type="text" required="required" name="name" value="<?= $driver ? $driver->getName() : "" ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label has-text-primary" for="surname">Surname</label>
                            <div class="control">
                                <input placeholder="Surname" class="input" id="surname" type="text" required="required" name="surname" value="<?= $driver ? $driver->getSurname() : "" ?>">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label has-text-primary" for="email">Email</label>
                            <div class="control">
                                <input class="input" id="email" placeholder="Email" type="email" required="required" name="email" value="<?= $driver ? $driver->getEmail() : "" ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label has-text-primary" for="vehicleType">Vehicle Type</label>
                            <div class="control ">
                                <div class="select is-fullwidth">
                                    <select id="vehicleType" required="required" name="vehicleType">
                                        <?php foreach ($vehicles as $vehicle): ?>
                                            <option <?= $driver && $driver->getVehicleType() === $vehicle->getValue() ? " selected" : ""?>
                                            value="<?= $vehicle->getValue(); ?>" ><?= $vehicle->getLabel(); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label has-text-primary" for="baseFarePrice">Base Fare Price</label>
                            <div class="control">
                                <input class="input" placeholder="Base Fare Price" id="baseFarePrice" required="required" type="text" name="baseFarePrice" value="<?= $driver ? $driver->getBaseFarePrice() : "" ?>">
                            </div>            
                        </div>
                        <div class="field">
                            <label class="label has-text-primary" for="baseFareDistance">Base Fare Distance</label>
                            <div class="control">
                                <input class="input" placeholder="Base Fare Distance" id="baseFareDistance" required="required" type="text" name="baseFareDistance" value="<?= $driver ? $driver->getBaseFareDistance() : "" ?>">
                            </div>
                        </div>
                        <input type="hidden" name="oldEmail" value="<?= $driver ? $driver->getEmail() : "" ?>" >
                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php else: ?>
                <div class="column is-12 has-text-centered">
                    <p class="has-text-danger is-size-4">No Vehicle exists. Please add some vehicles.</p>
                </div>
                <div class="column is-12 has-text-centered">
                    <?php include '../vehicle/add_button.php' ?>
                </div>
            <?php endif; ?>
            <?php include '../layout/footer-navigation.php' ?>
    </div>
    <?php include '../layout/footer.php' ?>
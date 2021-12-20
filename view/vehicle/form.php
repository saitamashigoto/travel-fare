<?php
    require '../../src/Piyush/autoload.php';
    use Piyush\Model\VehicleManagement;
?>
<?php include '../layout/header.php' ?>
    <?php
        $value = $_GET['value'] ?? '';
        $vehicle = VehicleManagement::get($value);
    ?>
    <h1 class="title has-text-centered has-text-primary"><?= $vehicle ? 'Edit: ' . $vehicle->getLabel() : 'New Vehicle'; ?></h1>
    <div class="columns is-multiline is-mobile is-centered">
        <div class="column is-12">
            <form action ="/travel-fare/controller/vehicle/save.php" method="post">
                <div class="field">
                    <label class="label has-text-primary" for="label">Label</label>
                    <div class="control">
                        <input class="input" id="label" placeholder="Label" required="required" type="text" name="label" value="<?= $vehicle ? $vehicle->getLabel() : "" ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label has-text-primary" for="value">Value</label>
                    <div class="control">
                        <input class="input" placeholder="Value" id="value" required="required" type="text" name="value" value="<?= $vehicle ? $vehicle->getValue() : "" ?>">
                    </div>
                </div>
                <input type="hidden" name="oldValue" value="<?= $vehicle ? $vehicle->getValue() : "" ?>" >
                <div class="field">
                    <div class="control">
                        <button class="button is-primary" type="submit" >Save</button>
                    </div>
                </div>
            </form>
        </div>
         <div class="column is-12 has-text-centered">
            <?php include '../layout/homepage.php' ?>
        </div>
    </div>
    <?php include '../layout/footer.php' ?>
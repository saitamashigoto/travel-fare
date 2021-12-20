<div class="column is-12 has-text-right">
    <form enctype="multipart/form-data" method="POST" action="/travel-fare/controller/fare/upload.php">
        <div class="field is-grouped is-grouped-right">
            <div class="control file has-name">
                <label class="file-label">
                    <input class="file-input" id="fareData" type="file" name="fareData">
                    <span class="file-cta">
                        <span class="file-icon">
                            <i class="fas fa-upload"></i>
                        </span>
                        <span class="file-label">
                            Upload Csv file
                        </span>
                    </span>
                </label>
            </div>
            <div class="control">
                <button class="button is-primary" type="submit" name="upload" type="button">Upload</button>
            </div>
        </div>
    </form>
</div>
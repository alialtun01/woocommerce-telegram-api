<?php
if(isset($_POST['kaydetbtn'])){
    update_option("token_value",$_POST['token']);
}
?>

<div class="container">
    <div class="row">
        <div class="col-8">
        <h2>Telegram Bot</h2>
        <small>Bot Token'ı girmeden hiç bir işlem yapılmaz.</small>
        <form action="" method="POST">
            <div class="form-group">
                <label for="token">Bot Token:</label>
                <input type="text" class="form-control" id="token" name="token" value="<?php echo get_option("token_value") ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="kaydetbtn">Kaydet</button>
        </form>
        </div>
    </div>
</div>

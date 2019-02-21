<?php
require 'security.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="bootstrap-4.2/css/bootstrap.css">

    <script src="bootstrap-4.2/js/jquery.min.js"></script>
    <script src="bootstrap-4.2/js/popper.min.js"></script>
    <script src="bootstrap-4.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php
require 'navbar.php';
if (isset($_POST['crime']))
{
    require 'db.php';
    extract($_POST);
    $today=date('Y-m-d H:i:s');
    $left= "0000-00-00";
    $sql="INSERT INTO `suspects`(`id`, `names`, `identity`, `gender`, `date`, `crime`, `type`, `date_left`) VALUES 
                                (null,'$names','$identity','$gender','$today','$crime','$type','$left')";

    mysqli_query($conn,  $sql) or die(mysqli_error($conn));
    $message ="Suspect Added";
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card" style="margin-top: 12px">
                <div class="card-header">
                    Add Suspect
                </div>
                <div class="card-body">
                    <h4 class="text-success">
                        <?php
                        if (isset($message))
                            echo $message;
                        ?>
                    </h4>
                    <form action="home.php" method="post">
                        <div class="form-group">
                            <label for="names">Names:</label>
                            <input type="text" class="form-control" id="names" name="names" required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">ID/Passport Number:</label>
                            <input type="text" class="form-control" name="identity" required>
                        </div>

                        <div class="radio">
                            <label><input type="radio" checked value="Male" name="gender">Male </label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="Female" name="gender">Female</label>
                        </div>

                        <div class="form-group">
                            <label>Type of crime</label>
                            <select name="type" class="form-control">
                                <option value="Traffic">Traffic</option>
                                <option value="Theft">Theft</option>
                                <option value="Murder">Murder</option>
                                <option value="Robbery">Robbery</option>
                                <option value="Domestic">Domestic</option>
                                <option value="Other">Other</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label>Describe The Crime</label>
                            <textarea name="crime" rows="5" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </form>
                    <p class="text-danger">
                        <?php
                        if (isset($error))
                            echo $error;
                        ?>
                    </p>
                </div>
            </div>

        </div>

    </div>

</div>
</body>
</html>
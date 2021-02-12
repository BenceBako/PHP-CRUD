<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <title>Pamutlabor</title>
</head>
<body>
    <?php require_once 'process.php'; ?>

    <?php
    if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
    </div>
    <?php endif ?>

    <div class="container">
    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error(mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        //pre_r($result);
    ?>

        <div class="d-flex justify-content-center mt-5 mb-5">
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group mt-2">
                    <label class="mt-2">Név</label>
                    <input type="test" name="name" class="form-control" value="<?php echo $name?>" placeholder="Add meg a neved.." required>
                </div>
                <div class="form-group mt-2">
                <label class="mt-2">Feladat státusza</label>
                <select name="status" class="form-control" placeholder="Feladat státusza.." required>
                    <option value="" disabled selected>Válassz..</option>"
                    <option value="Fejlesztésre szorul"<?php if(isset($row)){if($row['status'] == 'Fejlesztésre szorul') { ?> selected="selected"<?php }} ?>>Fejlesztésre szorul</option>
                    <option value="Folyamatban"<?php if(isset($row)){if($row['status'] == 'Folyamatban') { ?> selected="selected"<?php }} ?>>Folyamatban</option>
                    <option value="Kész"<?php if(isset($row)){if($row['status'] == 'Kész') { ?> selected="selected"<?php }} ?>>Kész</option>
                </select>
                </div>
                <div class="form-group mt-2">
                    <label class="mt-2">Feladat</label>
                    <input type="text" name="feladat" class="form-control" value="<?php echo $feladat?>" placeholder="Feladat leírása.." required>
                </div>
                <div class="form-group">
                    <?php
                    if ($update == true):
                    ?>
                        <button type="submit" class="btn btn-info mt-3" name="update">Frissítés</button>
                    <?php else: ?>
                    <button type="submit" class="btn btn-primary mt-3" name="save">Mentés</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <div class="row justify-content-center pt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Név</th>
                        <th>Státusz</th>
                        <th>Feladat</th>
                        <th colspan="2">Folyamat</th>
                    </tr>
                </thead>
                <?php
                    while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['feladat']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>"
                                class="btn btn-info">Szerkesztés</a>
                            <a href="process.php?delete=<?php echo $row['id']; ?>"
                                class="btn btn-danger">Törlés</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
            </table>
        </div>

        <?php
            function pre_r( $array ) {
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
        ?>
    </div>
</body>
</html>
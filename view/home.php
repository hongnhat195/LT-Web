<?php
include("../config/config.php");
$query = "SELECT * from book;";
$result = mysqli_query($conn, $query);

?>

<?php include "../container/header.php" ?>
<div class="row container-fluid align-center">
    <?php while ($row = $result->fetch_assoc()) {
        $isbn = $row["ISBN"];
        $query1 = "SELECT * FROM book_field where ISBN= $isbn";
        $res = mysqli_query($conn, $query1);

    ?> <div class="card col-3 m-5" style="width: 18rem;">
            <img src=<?php echo $row['IMAGE_URL'] ?> class="card-img-top" alt=<?php echo $row["IMAGE_URL"] ?>>
            <div class="card-body">
                <h5 class="card-title"><?php echo $row["TITLE"] ?></h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Price: <?php echo $row["PRICE"] ?> VND </li>
                <li class="list-group-item">Publisher: <?php echo $row["PUBLISHER_NAME"] ?> </li>
                <li class="list-group-item">Kind of book: <?php
                                                            $i = 0;
                                                            while ($_kind = $res->fetch_assoc()) {
                                                                $i++;
                                                                if ($i == mysqli_num_rows($res)) {
                                                                    echo $_kind["BFIELD"];
                                                                } else
                                                                    echo $_kind["BFIELD"], ", ";
                                                            }  ?></li>
            </ul>
            <div class="card-body row">
                <div class="col-8">
                    <form method="post" action="home.php?action=addToCart&code=<?php echo $row["ISBN"] ?>">
                        <button type="button" class="btn btn-success">Add to cart</button>
                    </form>
                </div>
                <div class="col-4">
                    <form method="get" action="">
                        <button type="submit" class="btn btn-warning">Detail</button>

                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php include("../container/footer.php") ?>
<?php session_start();

if(isset($_SESSION['role']) &&  ($_SESSION['role'] == 1)){

	header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <title>Liste des produits</title>
</head>

<body>

    <?php include_once('menu.php');

    try {

        $bdd = new PDO('mysql:host=localhost;dbname=chariot', 'root', '');

        $query = $bdd->prepare("SELECT * FROM produits");

        $query->execute();

        $result = $query->fetchAll();

        $nombre_des_produits = $query->rowCount();
    } catch (Exception $e) {
        die('Erreur :' . $e->getMessage());
    }

    ?>

    <div class="container-fluid">
        <div class="table-responsive mt-5">

            <table class="table">
            <thead>
                <tr>
                    <th>article</th>
                    <th>code_composant</th>
                    <th>Quantite</th>
                    <th>emplacement</th>
                    <th>Coefficient</th>
                    <th> Supprimer</th>
                  

                </tr>
            </thead>
            <tbody>    
                <?php foreach ($result as $row) {
                ?>
                    <tr>
                        <td> <?php echo $row['article']; ?> </td>
                        <td> <?php echo $row['code_composant']; ?> </td>
                        <td> <?php echo $row['Quantite']; ?> </td>
                        <td> <?php echo $row['emplacement']; ?> </td>
                        <td> <?php echo $row['Coefficient']; ?> </td>
                        <td> <a href="supp_prod.php?id=<?php echo $row['id']; ?>"> Supprimer </a></td>
                        
                    </tr>
                <?php  } ?>
            </tbody>
            </table>
            
               <span class="text-success"><?php echo $nombre_des_produits . " produits trouvés"; ?></span>
            
            
        </div>
    </div>
</body>
</html>
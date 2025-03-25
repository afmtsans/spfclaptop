
<?php

$idkonsultasi=$_GET['idkonsultasi'];

$sql = "DELETE FROM konsultasi WHERE idkonsultasi='$idkonsultasi'";
if ($conn->query($sql) === TRUE) {
    $sql = "DELETE FROM detail_konsultasi WHERE idkonsultasi='$idkonsultasi'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=datakonsultasi");
    }
}
$conn->close();
?>
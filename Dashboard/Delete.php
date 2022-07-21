<?php 
include_once('../includes/config.php');
include_once('master.php');
$logado = $_SESSION['email'];

$id = $_GET['id'];

// $sql4 = "DELETE FROM projects WHERE id='$id'";
// $result = $conexao->query($sql4);
// $delfunc = mysqli_fetch_assoc($result);

$str_consulta = "DELETE FROM projects WHERE id='$id'";
echo $str_consulta;
$sql = mysqli_query($conexao, $str_consulta)  or die(mysqli_error($db));
$result = mysqli_query($conexao, "UPDATE resources SET projects = projects - 1 WHERE uid = '$uid'");


header("Location: Manage-Projects.php");
exit();


?>
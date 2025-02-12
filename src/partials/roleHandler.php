<?php 
if(isset($_SESSION["currentPage"]) && $_SESSION["currentPage"] == "../src/pages/homepage/homepage.php") {
  if(isset($_SESSION["user_role"])){
    switch ($_SESSION["user_role"]) {
    case 'Asistente':
      $_SESSION["currentPage"] = "../src/pages/crudSelector/crudSelector.php";
      break;
    case 'Peluquero':
      $_SESSION["currentPage"] = "../src/pages/appointmentList/appointmentList.php";
      break;
    case 'Veterinario':
      $_SESSION["currentPage"] = "../src/pages/atencionDom/atencionMain.php";
      break;
    case 'Estudiante':
      break;
  }
}
}
?>
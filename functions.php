<?php

function validateUser($userName, $pwd) {
  global $_SG;
  global $isAdmin;
  global $isProfessor;
  global $isClient;

  $cS = ($_SG['caseSensitive']) ? 'BINARY' : '';

  $nuserName = addslashes($userName);
  $npwd = addslashes($pwd);

  $sql = "SELECT * FROM `".$_SG['userTable']."` WHERE ".$cS." `user_name` = '".$nuserName."' LIMIT 1";
  $query = mysqli_query($_SG['link'], $sql);
  $result = mysqli_fetch_assoc($query);

  if (empty($result)) {
    return false;
  } else if (!password_verify($npwd, $result['pwd'])) {
    return false;
  } else {
    $_SESSION['userId'] = $result['id'];
    $_SESSION['userLogin'] = $result['user_name'];
    $_SESSION['userName'] = $result['name'];
    $_SESSION['userTypeId'] = $result['user_type_id'];

    if ($_SESSION['userTypeId'] == 1) {
      $isAdmin = true;
    } else if ($_SESSION['userTypeId'] == 2) {
      $isProfessor = true;
    } else if ($_SESSION['userTypeId'] == 3) {
      $isClient = true;
    }

    if ($_SG['alwaysValidate'] == true) {
      $_SESSION['userLogin'] = $userName;
      $_SESSION['userPwd'] = $pwd;
      $_SESSION['userName'] = $result['name'];
      $_SESSION['userTypeId'] = $result['user_type_id'];
      $_SESSION['sessionTime'] = time();
    }
    return true;
  }
}

function protectPage() {
  global $_SG;
  if (!isset($_SESSION['userId']) OR !isset($_SESSION['userLogin'])) {
    removeVisitor();
  } else if (isset($_SESSION['userId']) OR isset($_SESSION['userLogin'])) {
    $actual_time = time();

    if (($actual_time - $_SESSION['sessionTime']) < 1200) {
      $_SESSION['sessionTime'] = $actual_time;
    } else { removeVisitor(); }

    if ($_SG['alwaysValidate'] == true) {
      if (!validateUser($_SESSION['userLogin'], $_SESSION['userPwd'])) {
        removeVisitor();
      }
    }
  }
}

function removeVisitor() {
  global $_SG;
  unset($_SESSION['userId'], $_SESSION['userLogin'], $_SESSION['userPwd'], $_SESSION['userName'], $_SESSION['userTypeId'], $_SESSION['sessionTime']);
  header("Location: ".$_SG['loginPage']);
}

function addUser($name, $userName, $pwd, $userTypeId) {
  global $_SG;
  $hashPwd = trim(password_hash($pwd, PASSWORD_DEFAULT));
  $timestamp = date('Y-m-d H:i:s');

  $sql = "insert into `".$_SG['userTable']."` \n
  (name, user_name, pwd, user_type_id, created, updated) \n
  values ('$name', '$userName', '$hashPwd', '$userTypeId', '$timestamp', '$timestamp')";

  if (isDuplicatedUser($userName)) {
    return 'duplicated';
  } else if (mysqli_query($_SG['link'], $sql)) {
    return getUserType($userTypeId);
  } else {
    return false;
  }
}

function addImc($userId, $imc, $weight, $height) {
  global $_SG;
  $timestamp = date('Y-m-d H:i:s');

  $sql = "insert into `".$_SG['imcTable']."` \n
  (user_id, height, weight, imc, created) \n
  values ('$userId', '$height', '$weight', '$imc', '$timestamp')";

  if (mysqli_query($_SG['link'], $sql)) {
    return true;
  } else {
    return false;
  }
}

function getUserType($userTypeId) {
  global $_SG;
  $sql = "SELECT `user_type` FROM `".$_SG['userTypeTable']."` WHERE `id` = '".$userTypeId."' LIMIT 1";
  $query = mysqli_query($_SG['link'], $sql);
  $result = mysqli_fetch_assoc($query);
  if (empty($result)) {
    return false;
  } else {
    return $result['user_type'];
  }
}

function getLastImc($userId) {
  global $_SG;
  $sql = "SELECT `imc`, `created` FROM `".$_SG['imcTable']."` WHERE `user_id` = '".$userId."' ORDER BY `created` DESC LIMIT 1";
  $query = mysqli_query($_SG['link'], $sql);
  $result = mysqli_fetch_assoc($query);
  if (empty($result)) {
    return false;
  } else {
    return [$result['imc'], $result['created']];
  }
}

function isDuplicatedUser($userName) {
  global $_SG;

  $nuserName = addslashes($userName);

  $sql = "SELECT * FROM `".$_SG['userTable']."` WHERE `user_name` = '".$nuserName."' LIMIT 1";
  $query = mysqli_query($_SG['link'], $sql);

  if (mysqli_num_rows($query) == 0) {
    return false;
  } else {
    return true;
  }
}

function listUsersByTypeId($userTypeId, $secondType = null) {
  global $_SG;
  if (!$secondType) {
    $sql = "SELECT `id`, `name`, `user_type_id` FROM `".$_SG['userTable']."` WHERE `user_type_id` = '$userTypeId'";
  } else {
    $sql = "SELECT `id`, `name`, `user_type_id` FROM `".$_SG['userTable']."` WHERE `user_type_id` = '$userTypeId' OR `user_type_id` = '$secondType'";
  }
  $userData = mysqli_query($_SG['link'], $sql);
  return $userData;
}

function listUserImc($userId) {
  global $_SG;
  $sql = "SELECT * FROM `".$_SG['imcTable']."` WHERE `user_id` = '$userId'";
  $userData = mysqli_query($_SG['link'], $sql);
  return $userData;
}

function getUserData($userId) {
  global $_SG;
  $sql = "SELECT * FROM `".$_SG['userTable']."` WHERE `id` = '".$userId."' LIMIT 1";
  $userData = mysqli_query($_SG['link'], $sql);

  if (mysqli_num_rows($userData) == 0) {
    return false;
  } else {
    return $userData;
  }
}

function oops() {
  header('Location: 404');
}

function getCountByType($userTypeId) {
  global $_SG;
  $sql = "SELECT COUNT(*) as `countData` FROM `".$_SG['userTable']."` WHERE `user_type_id` = '$userTypeId'";
  $countData = mysqli_query($_SG['link'], $sql);
  $result = mysqli_fetch_assoc($countData);
  return $result['countData'];
}

function deleteUser($userId) {
  global $_SG;
	$sql = "DELETE FROM `".$_SG['userTable']."` WHERE id = '$userId'";
	mysqli_query($_SG['link'], $sql);
}

function deleteImc($imcId) {
  global $_SG;
	$sql = "DELETE FROM `".$_SG['imcTable']."` WHERE id = '$imcId'";
	mysqli_query($_SG['link'], $sql);
}

?>

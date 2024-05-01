<?php
/**
 * Реализовать проверку заполнения обязательных полей формы в предыдущей
 * с использованием Cookies, а также заполнение формы по умолчанию ранее
 * введенными значениями.
 */

// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');
// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Массив для временного хранения сообщений пользователю.
  $messages = array();

  // if ($errors){
  //   $messages['result']='HUY';
  // }
  // else{
  //   $messages['result']='';
  // }

  // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
  // Выдаем сообщение об успешном сохранении.
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
  }
  

  // Складываем признак ошибок в массиве
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['tel'] = !empty($_COOKIE['tel_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['date'] = !empty($_COOKIE['date_error']);
  $errors['gen'] = !empty($_COOKIE['gen_error']);
  $errors['language'] = !empty($_COOKIE['language_error']);
  $errors['biography'] = !empty($_COOKIE['biography_error']);
  $errors['check'] = !empty($_COOKIE['check_error']);
  // Выдаем сообщения об ошибках.
  // Выводим сообщение.
  if ($errors['name']) {
    $messages['name'] = '<div class="message">'.$_COOKIE['name_error'].'</div>';
    // Удаляем куки, указывая время устаревания в прошлом.
    setcookie('name_error', '', 100000);
    setcookie('name_value', '', 100000);
  }
  if ($errors['tel']) {
    if($_COOKIE['tel_error'] == "1"){
      $messages['tel'] = '<div class="message">Укажите телефон</div>';
    }
    if($_COOKIE['tel_error'] == "2"){
      $messages['tel'] = '<div class="message">Неверное количество символов</div>';
    }
    // Удаляем куки, указывая время устаревания в прошлом.
    setcookie('tel_error', '', 100000);
    setcookie('tel_value', '', 100000);
  }
  if ($errors['email']) {
    // Удаляем куки, указывая время устаревания в прошлом.
    setcookie('email_error', '', 100000);
    setcookie('email_value', '', 100000);
    // Выводим сообщение.
    $messages['email'] = '<div class="message">Укажите почту</div>';
  }
  if ($errors['date']) {
    $messages['date'] = '<div class="message">'.$_COOKIE['date_error'].'</div>';
    // Удаляем куки, указывая время устаревания в прошлом.
    setcookie('date_error', '', 100000);
    setcookie('date_value', '', 100000);
  }
  if ($errors['gen']) {
    // Удаляем куки, указывая время устаревания в прошлом.
    setcookie('gen_error', '', 100000);
    setcookie('gen_value', '', 100000);
    // Выводим сообщение.
    $messages['gen'] = '<div class="message">Укажите ваш пол</div>';
  }
  if ($errors['language']) {
    // Удаляем куки, указывая время устаревания в прошлом.
    setcookie('language_error', '', 100000);
    setcookie('language_value', '', 100000);
    // Выводим сообщение.
    $messages['language'] = '<div class="message">Выберите хотя бы один язык</div>';
  }
  if ($errors['biography']) {
    // Удаляем куки, указывая время устаревания в прошлом.
    setcookie('biography_error', '', 100000);
    setcookie('biography_value', '', 100000);
    // Выводим сообщение.
    $messages['biography'] = '<div class="message">Заполните вашу биографию</div>';
  }
  if ($errors['check']) {
    // Удаляем куки, указывая время устаревания в прошлом.
    setcookie('check_error', '', 100000);
    setcookie('check_value', '', 100000);
    // Выводим сообщение.
    $messages['check'] = '<div class="message">Ознакомьтесь с контрактом</div>';
  }
  if(!$errors['name'] && !$errors['tel'] && !$errors['email'] && !$errors['date'] && !$errors['gen'] && !$errors['language'] && !$errors['biography'] && !$errors['check'] && !empty($_COOKIE["setForm"]) && $_COOKIE["setForm"] == "true"){
    $messages['result']="Форма отправлена успешно!";
    $_COOKIE["setForm"] = "false";
  }else if($errors['name'] || $errors['tel'] || $errors['email'] || $errors['date'] || $errors['gen'] || $errors['language'] || $errors['biography'] || $errors['check']){
    $messages['result']="Исправьте ошибки, пожалуйста";
  }
  else{
    $messages['result'] = "Заполните форму";
  }

  // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['tel'] = empty($_COOKIE['tel_value']) ? '' : $_COOKIE['tel_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['date'] = empty($_COOKIE['date_value']) ? '' : $_COOKIE['date_value'];
  $values['gen'] = empty($_COOKIE['gen_value']) ? '' : $_COOKIE['gen_value'];
  $values['language'] = empty($_COOKIE['language_value']) ? '' : $_COOKIE['language_value'];
  $values['biography'] = empty($_COOKIE['biography_value']) ? '' : $_COOKIE['biography_value'];
  $values['check'] = empty($_COOKIE['check_value']) ? '' : $_COOKIE['check_value'];

  // Включаем содержимое файла form.php.
  // В нем будут доступны переменные $messages, $errors и $values для вывода 
  // сообщений, полей с ранее заполненными данными и признаками ошибок.
  include('form.php');
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
  $messages['result']='';
  // Проверяем ошибки.
  $errors = "Debic";
  if (empty($_POST['name'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('name_error', 'Заполните поле имя', time() + 24 * 60 * 60);
    $errors = "NeDebic1";
  }
  //Проверка на Русские буквы в name
  else if(!preg_match('/^[а-яёА-ЯЁ]+$/u', $_POST['name'])){
    setcookie('name_error', 'Неверные символы. Имя состоит из русских букв', time() + 24 * 60 * 60);
    $errors = "NeDebic2";
  }
  // Сохраняем ранее введенное в форму значение на месяц.
  setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);

  if (empty($_POST['tel'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('tel_error', '1', time() + 24 * 60 * 60);
    $errors = "NeDebic3";
  }
  else if(strlen($_POST['tel']) > 11 || strlen($_POST['tel']) < 11){
    setcookie('tel_error', '2', time() + 24 * 60 * 60);
    $errors = "NeDebic4";
  }
  // Сохраняем ранее введенное в форму значение на месяц.
  setcookie('tel_value', $_POST['tel'], time() + 30 * 24 * 60 * 60);

  if (empty($_POST['email'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    $errors = "NeDebic5";
  }
  // Сохраняем ранее введенное в форму значение на месяц.
  setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);

  if (empty($_POST['date'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('date_error', 'Заполните поле даты', time() + 24 * 60 * 60);
    $errors = "NeDebic6";
  }
  // Сохраняем ранее введенное в форму значение на месяц.
  setcookie('date_value', $_POST['date'], time() + 30 * 24 * 60 * 60);

  if (empty($_POST['gen'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('gen_error', '1', time() + 24 * 60 * 60);
    $errors = "NeDebic7";
  }
  // Сохраняем ранее введенное в форму значение на месяц.
  setcookie('gen_value', $_POST['gen'], time() + 30 * 24 * 60 * 60);

  if (empty($_POST['language'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('language_error', '1', time() + 24 * 60 * 60);
    $errors = "NeDebic8";
  }
  // Сохраняем ранее введенное в форму значение на месяц.
  foreach($_POST['language'] as $lan){
    setcookie('language_value', $lan, time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['biography'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('biography_error', '1', time() + 24 * 60 * 60);
    $errors = "NeDebic10";
  }
  // Сохраняем ранее введенное в форму значение на месяц.
  setcookie('biography_value', $_POST['biography'], time() + 30 * 24 * 60 * 60);
  
  if (empty($_POST['check'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('check_error', '1', time() + 24 * 60 * 60);
    $errors = "NeDebic11";
  }
  // Сохраняем ранее введенное в форму значение на месяц.
  setcookie('check_value', $_POST['check'], time() + 30 * 24 * 60 * 60);

  if ($errors != "Debic") {
    setcookie("setForm", "false", time() + 10000);
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  }
  else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('name_error', '', 100000);
    setcookie('tel_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('date_error', '', 100000);
    setcookie('gen_error', '', 100000);
    setcookie('language_error', '', 100000);
    setcookie('biography_error', '', 100000);
    setcookie('check_error', '', 100000);
    setcookie("setForm", "true", time() + 10000);
  }

  // Сохранение в БД.
  if ($errors == "Debic"){
  $user = 'u67427'; 
  $pass = '3193980'; 
  $host='localhost';
  $db_name='u67427';
  $db_l_name='languages';
  $db_table='users';
  $link = mysqli_connect($host, $user, $pass, $db_name);
  $db = new PDO('mysql:host=localhost;dbname=u67427', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); 
  
  $name=htmlspecialchars($_POST['name']);
  $email=htmlspecialchars($_POST['email']);
  $tel=htmlspecialchars($_POST['tel']);
  $date=htmlspecialchars($_POST['date']);
  $gender=htmlspecialchars($_POST['gen']);

  $languages=array();
  foreach($_POST['language'] as $option) {
      array_push($languages,$option);
  }
  $biography=array();
  $text = explode("\n", $_POST['biography']);
  foreach ($text as $value) {
      array_push($biography,$value);
  }
  $box=htmlspecialchars($_POST['check']);
  try {
      $data = array( 'name' => $name, 'email' => $email, 'tel' => $tel, 'date' => $date,'gender'=>$gender, 'biography' => implode("\n",$biography), 'box' => $box); 
      $query = $db->prepare("INSERT INTO $db_table (name, email, tel, date, gender, biography, box) values (:name, :email, :tel, :date,:gender, :biography, :box)");
      $query->execute($data);
      foreach($languages as $language){
          $ldata=array('name'=>$name, 'language'=>$language);
          $query = $db->prepare("INSERT INTO $db_l_name (name, language) values (:name,:language)");
          $query->execute($ldata);
      }
    $result = true;
  }
  catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
  }
}
  // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');
  header('Location: index.php');
}

<html>
  <head>
  <style>
        body{
            height: 1500px;
            width: 100px;
            background-position: center;
            background: -webkit-linear-gradient(34deg, #1c0d10,#341c24,#582a35,#844150);
        }
        .error{
            font-size: 20px;
            font-family: 'Courier New', Courier, monospace;
            color: #BA6071;
        }
        h1{
          display:flex;
          align-items: center;
          font-size: 60px;
          color: #C99E99;
          font-family: 'Courier New', Courier, monospace;
        }

        .text{
            background-color: #C99E99 ;
            align-items: center;
            height: 20px;
            color: #341c24;
            width: 350px;
            font-size: 20px;
            font-family: 'Courier New', Courier, monospace;
            border-radius: 10px;
            border: solid #341c24;
            box-shadow:15px 10px 20px #000000;
            padding: 10px;

        }
        form{
            margin-top: 50px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-left: calc(300%);
            width: 800px;
        }
        .gender{
            font-size: 20px;
            display: flex;
            font-family: 'Courier New', Courier, monospace;
        }
        .chek{
            font-size: 25px;
            padding-left: 50px;
            color:#C99E99;
        }
        input .error{
          border: 2px solid #BA6071 ;
        }
        input[type='radio'] {
            accent-color: #341c24; /* Задаем нужный цвет. */
        }
        input[type='checkbox'] {
            accent-color: #341c24; /* Задаем нужный цвет. */
        }
        .lan{
            width: 380px;
            height: 100px;
            padding: 10px;
            background-color: #C99E99;
            border-radius: 10px;
            font-size: 18px;
            color: #341c24;
            border: #341c24;
            box-shadow:15px 10px 20px #000000;
            margin-top: 25px;
            font-family: monospace;
        }
        option{
            border-bottom: 1px solid #1c0d10;
        }
        .checkLabel{
            font-size: 23px;
            color: #C99E99;
            font-family: 'Courier New', Courier, monospace;
        }
        h2{
            font-size: 20px;
            color: #C99E99;
            font-family: 'Courier New', Courier, monospace;
        }
        .submit{
            margin-top: 50px;
            height: 60px;
            width: 150px;
            border-radius: 10px;
            font-size: 15px;
            font-family: monospace;
            background:none;
            color:#C99E99;
            border: 2px solid #C99E99;
        }
        .submit:hover{
            background-color: #C99E99;
            color: #1c0d10;
        }
        .bio{
            background-color: #C99E99;
            font-size: 20px;
            color:#341c24;
            font-family: 'Courier New', Courier, monospace;
            border: 2px solid;
            border-radius: 10px;
            width: 400px;
            height: 100px;
            resize: none;
        }
    </style>
  </head>
  <body>

    <div class="from">
<form action="" method="POST">
    <h1>
      <?php 
        ($messages['result'] != "" ? print($messages['result']) : 'Заполните форму');
      ?>
    </h1>
    <h2>Введите имя</h2>
        <input name="name" type="text" class='text'<?php if ($errors['name']) {print 'class="error"';} ?> value="<?php print $values['name'];?>" />
        <span class="error"><?php if ($errors['name']) {print ($messages['name']);}?></span>
        <h2>Введите номер телефона</h2>
        <input name="tel" type="number" class='text' <?php if ($errors['tel']) {print 'class="error"';} ?> value="<?php print $values['tel']; ?>">
        <span class="error"><?php if ($errors['tel']) {print ($messages['tel']);}?></span>
        <h2>Введите вашу электронную почту</h2>
        <input name="email" type="email" class='text' <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>">
        <span class="error"><?php if ($errors['email']) {print ($messages['email']);}?></span>    
        <h2>Введите дату вашего рождения</h2>
        <input name="date" type="date"  class='text'<?php if ($errors['date']) {print 'class="error"';} ?> value="<?php print $values['date']; ?>">
        <span class="error"><?php if ($errors['date']) {print ($messages['date']);}?></span>
        <h2>Укажите ваш пол</h2>
        <div class="gender" >
          <label class="chek <?php if ($errors['gen']) {print "error";} ?>" value="<?php print $values['gen']; ?>"> <input type="radio" name="gen" value="man">Мужской</label>
          <label class="chek <?php if ($errors['gen']) {print "error";} ?>" value="<?php print $values['gen']; ?>"> <input type="radio" name="gen" value="woman">Женский</label>
        </div>
        <span class="error"><?php if ($errors['gen']) {print ($messages['gen']);}?></span>
        <h2>Выберете ваш любимый язык программирования</h2>
        <select class='lan' name="language[]" multiple size="5" <?php if ($errors['language']) {print 'class="error"';} ?> value="<?php print $values['language']; ?>">
          <option value="Pascal">Pascal</option>
          <option value="C">C</option>
          <option value="C++">C++</option>
          <option value="JavaScript">JavaScript</option>
          <option value="PHP">PHP</option>
          <option value="Python" >Python</option>
          <option value="Java">Java</option>
          <option value="Haskel" >Haskel</option>
          <option value="Clojure" >Clojure</option>
          <option value="Prolog" >Prolog</option>
          <option value="Scala" >Scala</option>
        </select>
        <span class="error"><?php if ($errors['language']) {print ($messages['language']);}?></span>
        <h2>Напишите о вас</h2>
        <textarea name="biography" placeholder="Биография" class='bio'<?php if ($errors['biography']) {print 'class="error"';} ?> value="<?php print $values['biography']; ?>"></textarea>
        <span class="error"><?php if ($errors['biography']) {print ($messages['biography']);}?></span>
        <label class='checkLabel' <?php if ($errors['check']) {print 'class="error"';} ?> 
            value="<?php print $values['check']; ?>">
            <input type="checkbox" name="check" value="YES" class='check'>С контрактом ознакомлен (а)
        </label>
        <span class="error"><?php if ($errors['check']) {print ($messages['check']);}?></span>
        <input type="submit" value="Сохранить" class="submit">
    </form>
</div>
  </body>
</html>

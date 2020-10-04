<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="css/style.css">
  <title>Курс валют</title>
  <!--[if IE]>
   <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
 </head>
 <body>
   <?php
   // Ссылка куда будем отправлять GET запрос
 $url = "https://www.cbr-xml-daily.ru/daily_json.js";

 // Создаём запрос
 $ch = curl_init();
 // Настройки запроса
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 // Отправка и декодинг ответа
 $data = json_decode(curl_exec($ch), $assoc=true);
 // Закрытие запроса
 curl_close($ch);
 $count=count($data["Valute"]);
//echo '<pre>';
//print_r($data);
//echo '</pre>';
 ?>
<form action="/" method="get">
  <div ><p class="put">Выберите валюту</p>
    <div>
      <select class="list" name="value">
        <?php if($count>0):
          $type=isset($_GET[valye])? $_GET[valye]: "";
          echo $type;
          ?>
          <?php foreach($data["Valute"] as $key => $value):?>
            <option class ="option" value="<?echo $value["CharCode"];?>"<?php if($value["CharCode"]==$type):?>selected="selected"<?php endif; ?>><?php echo $value["Name"];?>(<?php echo $value["CharCode"];?>)</option>
          <?php endforeach; ?>
        <?php endif; ?>
      </select>
      <br/>
      <input class="check_curs" type="submit" name="doGo" value="Узнать Курс">
    </div>
    <br/>
    <output class="curs"name="result"><?php echo $data["Valute"]["$_GET[value]"]["CharCode"];?> = <?php echo $data["Valute"]["$_GET[value]"]["Value"]; ?> RUB</output>
  </div>


</form>
 </body>
</html>

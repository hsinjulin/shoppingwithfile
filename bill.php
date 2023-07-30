<!DOCTYPE html>
<html>
<head>
    <title>購物清單</title>
    <style>
        p{              
            text-align:center;               
        }
        a{
            text-decoration:none;
            color:black;
        }
        table{
            margin-left:auto; 
            margin-right:auto;
            }
    </style>
</head>
<body>
    <?php
    session_start();
    $filename = "product.txt";
    $product = file($filename);
    $pId = $_SESSION['id'];

    $id = array();
    $name = array();
    $price = array();
    $img = array();
    $total = 0;

    foreach($product as $line){
      $productArr = explode(",",$line);
      $id[] = $productArr[0];
      $name[] = $productArr[1];
      $price[] = $productArr[2];
      $img[] = $productArr[3];
    }
    ?>
    <p><a href="buy.php">登入</a> &emsp;<a href="clean_car.php">清空購物車</a></p>
    
    <h3 style=text-align:center>感謝您的購買，商品清單如下:</h3>
    <table cellpadding=10 border=1>
    <?php
    for($i=0; $i<count($pId); $i++){
      for($j=0; $j<count($id); $j++){
        if($pId[$i] == $id[$j]){
          echo
            "<tr>
                <td rowspan=3>
                    <img src=pics/$img[$j] width=150>
                </td>
                <td>
                    編號：$id[$j]
                </td>
            </tr>
            <tr>
              <td>
                名稱：$name[$j]
              </td>
            </tr>
            <tr>
              <td>
                價格：$price[$j]
              </td>
            </tr>";
           //計算總金額
           $total += $price[$j];
        }
      }
    }
    echo"
        <tr>
            <td align=center colspan=2>
                總金額：$total
            </td>
        </tr>";
    echo "</table>";
    //將總金額存入session
    $_SESSION["price"] = $total;
    ?>

</body>
</html>

<!DOCTYPE html>  
<html>
    <head>
        <meta charset="utf-8"/>
        <title>商品列表</title>
        <style>
            p{              
                text-align:center;               
            }
            .11705{
                display: flex;
                width:100%;
            }
            table{
                margin:auto;
                border:3px  #cccccc  solid;    
            }
            a{
                text-decoration:none;
                color:black;
            }
            .btn{
                text-align:center;     
            }          
        </style>
    </head>
    <body>  
        <div class="wrap">
            <div>
                <p><a href="bill.php">結帳去</a>	&emsp;<a href="buy.php">登入</a></p>
            </div>
            <div class="11705">         
                <?php
                session_start();
                if(!isset($_SESSION['tel']))
                    $_SESSION['tel'] = $_POST['tel'];
                if(!isset($_SESSION["id"]))
                    $_SESSION["id"] = array();  
                $idArr = array();
                //抓flie的資料 
                $filename = "product.txt";
                $product = file($filename);
                
                $id = array();
                $name = array();
                $price = array();
                $img = array();

                foreach($product as $line){
                    $productArr = explode(",",$line);
                    $id[] = $productArr[0];
                    $name[] = $productArr[1];
                    $price[] = $productArr[2];
                    $img[] = $productArr[3];
                }
                ?>
                <table cellpadding="10" border='1'>
                    <?php
                        for($i=0; $i<count($id); $i++){
                        echo
                            "<tr>
                                <td rowspan=3>
                                    <img src=pics/$img[$i] width=150>
                                </td>
                                <td>
                                    編號：$id[$i]
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    名稱：$name[$i]
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    價格：$price[$i]
                                </td>
                            </tr>
                            <tr>
                                <td align=center colspan=2>
                                <button> 
                                    <a href=car.php?id=$id[$i]>加入購物車</a>
                                </button>
                                </td>
                            </tr>";
                        }
                    ?>                    
                </table>                
            </div>
        </div>
    </body>
</html>
<?php
/*
    $sorgu = $db -> prepare('INSERT INTO dersler2 SET 
                        baslik = ?, icerik = ?, onay = ?');
    $ekle = $sorgu->execute(['deneme_baslik','icerik',1]);
    if($ekle){
        echo 'Verileriniz Eklendi!';
    }
    else{
        $hata = $sorgu->errorInfo();
        echo 'MySQL Hatası:' . $hata[2];
    }
*/

if(isset($_POST['submit'])){
    $baslik = isset($_POST['baslik']) ? $_POST['baslik'] : null;
    $icerik = isset($_POST['icerik']) ? $_POST['icerik'] : null;
    $onay   = isset($_POST['onay']) ? $_POST['onay'] : null;

    if(!$baslik){
        echo 'Başlık Ekleyin';
    }elseif (!$icerik){
        echo 'İçeriği belirleyin';
    }else{
        $sorgu = $db->prepare('INSERT INTO dersler SET baslik=?,icerik=?,onay=?');
        $ekle = $sorgu -> execute([$baslik,$icerik,$onay]);
        if($ekle){
            header('Location:index.php');
        }else{
            $hata = $sorgu->errorInfo();
            echo 'MySQL Hatası: ' . $hata[2];
        }
    }
}

?>


<form action="" method="post">
    Başlık: <br>
    <input type="text" value="<?php echo isset($_POST['baslik']) ? $_POST['baslik'] : null?>" name="baslik"> <br> <br>

    İçerik: <br>
    <textarea  value="<?php echo isset($_POST['icerik']) ? $_POST['icerik'] : null?>"name="icerik" cols="30" rows="10"></textarea> <br>

    Onay: <br>
    <select name="onay">
        <option value="1">Onaylı</option>
        <option value="0">Onaylı Değil</option>
    </select><br><br>
    <input type="hidden" name="submit" value="1">
    <button type="submit">Gönder</button>
</form>
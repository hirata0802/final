<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<body>
    <nav>
        <ul>
            <li class="menu_title"><h1>Salon List</h1></li>
            <li class="menu_btn"><a href="category.php" class="btn-new">カテゴリ登録</a></li>
        </ul>
    </nav>
    <?php
        if(isset($_GET['db'])){
            echo '<p>すでに登録されたサロンです。</p>';
        }else{
            $_SESSION['newSalon'] = [
                'name' => null,
                'phone' => null,
                'prefecture' => null,
                'city' => null,
                'address' => null,
                'apartment' => null,
                'link' => null,
                'category' => null
            ];
        }
    ?>
    <form action="db.php" method="post" id="new">
        <?php
            echo '<input type="text" class="inp-text" name="name" placeholder="サロン名" value="', $_SESSION['newSalon']['name'], '" required><br>';
            echo '<input type="text" class="inp-text" name="link" placeholder="Instagramのアカウント名" value="', $_SESSION['newSalon']['link'], '"><br>';
            echo '<label  class="inp-select">';
            echo '<select name="category" required>';
            if(!isset($_SESSION['newSalon']['category'])){
                echo '<option value="" hidden><font color="#aaaaaa">カテゴリ</font></option>';
            }else{
                $pdo=new PDO($connect, USER, PASS);
                $sql=$pdo->prepare('select * from category where category_id=?');
                $sql->execute([$_SESSION['newSalon']['category']]);
                foreach($sql as $nameC){
                    echo '<option value="', $_SESSION['newSalon']['category'], '" hidden>', $nameC['category_name'], '</option>';
                }
            }
            $pdo = new PDO($connect, USER, PASS);
            $sql = $pdo -> query('select * from category');
            foreach($sql as $row){
                echo '<option value="', $row['category_id'], '">', $row['category_name'], '</option>';
            }
            echo '</select>';
            echo '</label>';
            echo '<input type="tel" class="inp-text-harf" name="phone" maxlength="11" pattern="^[0-9]+$" placeholder="電話番号(ハイフンなし)" value="', $_SESSION['newSalon']['phone'], '" required><br>';
            echo '<input type="text" class="inp-text-harf" name="prefecture" id="prefecture" placeholder="都道府県" value="', $_SESSION['newSalon']['prefecture'], '" required>';
            echo '<input type="text" class="inp-text-harf" name="city" id="city" placeholder="市区町村" value="', $_SESSION['newSalon']['city'], '" required><br>';
            echo '<input type="text" class="inp-text-harf" name="address" id="address" placeholder="番地" value="', $_SESSION['newSalon']['address'], '" required>';
            echo '<input type="text" class="inp-text-harf" name="apartment" placeholder="建物名・部屋番号" value="', $_SESSION['newSalon']['apartment'], '"><br>';
        ?>    
        <input type="hidden" name="db" value="register">
    </form>
    <a href="list.php" class="btn-rtn">　戻る　</a>
    <button form="new"><a class="btn-next">新規登録</a></button>
</body>
<?php require 'footer.php'; ?>
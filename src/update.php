<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<body>
    <nav>
        <ul>
            <li class="menu_title"><h1>Salon List</h1></li>
        </ul>
    </nav>
    <form action="db.php" method="post" id="up">
        <?php
            $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare('select * from salon inner join category on salon.category_id = category.category_id where salon.salon_id=?');
            $sql->execute([$_GET['id']]);
            foreach($sql as $row){
                echo '<input type="text" class="inp-text" name="name" placeholder="サロン名" value="', $row['salon_name'], '" required><br>';
                echo '<input type="text" class="inp-text" name="link" placeholder="Instagramのアカウント名" value="', $row['link'], '"><br>';
                echo '<label class="inp-select">';
                echo '<select name="category" required>';
                echo '<option value="', $row['category_id'], '" hidden>', $row['category_name'], '</option>';
                $category = $pdo -> query('select * from category');
                foreach($category as $cat){
                    echo '<option value="', $cat['category_id'], '">', $cat['category_name'], '</option>';
                }
                echo '</select>';
                echo '</label>';
                echo '<input type="tel" class="inp-text-harf" name="phone" maxlength="11" pattern="^[0-9]+$" placeholder="電話番号(ハイフンなし)"  value="', $row['phone'], '"required><br>';
                echo '<input type="text" class="inp-text-harf" name="prefecture" id="prefecture" placeholder="都道府県" value="', $row['prefectures'], '" required>';
                echo '<input type="text" class="inp-text-harf" name="city" id="city" placeholder="市区町村" value="', $row['city'], '" required><br>';
                echo '<input type="text" class="inp-text-harf" name="address" id="address" placeholder="番地" value="', $row['address'], '" required>';
                echo '<input type="text" class="inp-text-harf" name="apartment" placeholder="建物名・部屋番号" value="', $row['apartment'], '"><br>';
            }
            echo '<input type="hidden" name="id" value=', $_GET['id'], '>';
        ?>
        <input type="hidden" name="db" value="update">
    </form>
    <a href="list.php" class="btn-rtn">　戻る　</a>
    <button form="up"><a class="btn-next">更新する</a></button>
</body>
<?php require 'footer.php'; ?>
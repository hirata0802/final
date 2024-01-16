<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<body>
    <form action="db.php" method="post" id="new">
        <input type="text" name="name" placeholder="サロン名" required><br>
        <input type="text" name="link" placeholder="Instagramのアカウント名"><br>
        <select name="category" required>
        <?php
            echo '<option value="">カテゴリ</option>';
            $pdo = new PDO($connect, USER, PASS);
            $sql = $pdo -> query('select * from category');
            foreach($sql as $row){
                echo '<option value="', $row['category_id'], '">', $row['category_name'], '</option>';
            }
        ?>
        </select><br>
        <input type="tel" name="phone" maxlength="11" pattern="^[0-9]+$" placeholder="電話番号(ハイフンなし)" required><br>
        <input type="text" name="prefecture" id="prefecture" placeholder="都道府県" required><br>
        <input type="text" name="city" id="city" placeholder="市区町村" required><br>
        <input type="text" name="address" id="address" placeholder="番地" required><br>
        <input type="text" name="apartment" placeholder="建物名・部屋番号"><br>
        <input type="hidden" name="db" value="register"><br>
    </form>
    <a href="list.php" class="btn-rtn">戻る</a>
    <button form="new"><a class="btn-new">新規登録</a></button>
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="./js/add.js"></script>
</body>
<?php require 'footer.php'; ?>
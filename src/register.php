<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<form action="db.php" method="post">
    <input type="text" name="name" placeholder="サロン名" required>
    <select name="category" required>
    <?php
        echo '<option value="">カテゴリ</option>';
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo -> query('select * from category');
        foreach($sql as $row){
            echo '<option value="', $row['category_id'], '">', $row['category_name'], '</option>';
        }
    ?>
    </select>
    <input type="tel" name="phone" maxlength="11" pattern="^[0-9]+$" placeholder="電話番号(ハイフンなし)" required>
    <input type="text" name="prefecture" id="prefecture" placeholder="都道府県" required>
    <input type="text" name="city" id="city" placeholder="市区町村" required>
    <input type="text" name="address" id="address" placeholder="番地" required>
    <input type="text" name="apartment" placeholder="建物名・部屋番号">
    <input type="hidden" name="db" value="register">
</form>
<button onclick="location.href='list.php'">戻る</button>
<button>新規登録</button>
<script src="./js/jquery-3.7.0.min.js"></script>
<script src="./js/add.js"></script>
<?php require 'footer.php'; ?>
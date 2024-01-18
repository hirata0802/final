<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<body>
    <nav>
        <ul>
            <li class="menu_title"><h1>Salon List</h1></li>
        </ul>
    </nav>
    <?php
        if(isset($_GET['db'])){
            if(strcmp($_GET['db'], "register") == 0){
                echo '<p>サロンを登録しました。</p>';
                echo '<a href="list.php" class="btn-rtn">サロン一覧画面へ</a>';
                echo '<a href="register.php" class="btn-next">追加登録</a>';
            }else if(strcmp($_GET['db'], "category") == 0){
                echo '<p>カテゴリを更新しました。</p>';
                echo '<a href="list.php" class="btn-rtn">サロン一覧画面へ</a>';
                echo '<a href="category.php" class="btn-next">追加登録</a>';
            }else if(strcmp($_GET['db'], "update") == 0){
                echo '<p>サロンを更新しました。</p>';
                echo '<a href="list.php" class="btn-rtn">サロン一覧画面へ</a>';
            }else if(strcmp($_GET['db'], "delete") == 0){
                echo '<p>サロンを削除しました。</p>';
                echo '<a href="list.php" class="btn-rtn">サロン一覧画面へ</a>';
            }
        }
    ?>
</body>
<?php require 'footer.php'; ?>
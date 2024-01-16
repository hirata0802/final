<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<body>
    <?php
        if(isset($_GET['db'])){
            if(strcmp($_GET['db'], "register") == 0){
                echo 'サロンを登録しました。';
            }else if(strcmp($_GET['db'], "update") == 0){
                echo 'サロンを更新しました。';
            }else if(strcmp($_GET['db'], "delete") == 0){
                echo 'サロンを削除しました。';
            }
        }
    ?>
    <a href="list.php" class="btn-new">サロン一覧画面へ</a>
</body>
<?php require 'footer.php'; ?>
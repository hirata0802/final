<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php require 'header.php'; ?>
<body>
    <header>
        <nav>
            <ul>
                <li class="menu_title"><h1>Salon List</h1></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <?php
            if(isset($_GET['db'])){
                echo '<p>すでに登録されたカテゴリです。</p>';
            }else{
                $_SESSION['newCategory'] = null;
            }
        ?>
        <form action="db.php" method="post" id="category">
            <?php
                echo '<input type="text" class="inp-text" name="category" placeholder="カテゴリ名" value="', $_SESSION['newCategory'], '" required><br>';
            ?>
            <input type="hidden" name="db" value="category">
        </form>
        <a href="list.php" class="btn-rtn">　戻る　</a>
        <button form="category"><a class="btn-next">カテゴリ登録</a></button>
    </div>
</body>
<?php require 'footer.php'; ?>
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
        <form action="db.php" method="post" id="del">
            <?php
                $pdo = new PDO($connect, USER, PASS);
                $sql = $pdo -> prepare('select * from salon inner join category on salon.category_id=category.category_id where salon_id=?');
                $sql -> execute([$_GET['id']]);
                foreach($sql as $row){
                    echo '<p>『　', $row['salon_name'], '　』を削除しますか？</p>';
                }
                echo '<input type="hidden" name="id" value=', $_GET['id'], '>';
            ?>
            <input type="hidden" name="db" value="delete">
        </form>
        <a href="list.php" class="btn-rtn">　戻る　</a>
        <button form="del"><a class="btn-next">削除する</a></button>
    </divL>
</body>
<?php require 'footer.php'; ?>
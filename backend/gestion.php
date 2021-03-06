
<?php
require '../kernel/db_connect.php';
require '../models/user.php';
$users = findAllUsers();
//var_dump($users);
//die();
// voir la modif
// ok
require 'templates/header.php'?>

<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Gestion des abonnées</h1>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Admin</th>
                    <th>Date d'inscription</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user) :?>
                <tr>
                    <td><?=$user['login']?></td>
                    <td><?=$user['email']?></td>
                    <td><?=strtoupper($user['nom'])?></td>
                    <td><?=ucfirst($user['prenom'])?></td>
                    <td>
                        <?php if($user['is_admin']) :?>
                            <span class="badge badge-primary">admin</span>
                        <?php else :?>
                            <span class="badge badge-dark">user</span>
                        <?php endif ?>
                    </td>


                    <td>
                        <?php $date_creation = date_create($user['created_at']) ?>
                        <?= date_format($date_creation,'d/m/Y H:i') ?>
                    </td>
                </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- .container>.row>.col-12 tabulation-->
<!-- table>thead>tr>th*6 tabulation-->
<!-- ul>li*7 tabulation-->
<?php require 'templates/footer.php'?>
</body>
</html>
<?php ?>
<style>
    nav {
        background-color: #333;
        width: 100%;
    }

    nav > ul > span {
        display: flex;
    }

    nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    nav li a, nav li span {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    nav > ul > span li a:hover {
        background-color: #111;
    }

    .sub-menu .sub-menu-items {
        visibility: hidden;
        background-color: #333;
    }

    .sub-menu:hover .sub-menu-items {
        visibility: visible;
    }

    .sub-menu:hover .sub-menu-items li:hover {
        background-color: #111;
    }
</style>
<nav>
    <ul class="d-flex align-items-center justify-content-between"><?php if (\App\Models\User::isLoggedIn()) { ?>
            <span>
                <li><a href="/dashboard">Home</a></li>

                <?=
                $_SESSION['user']->isAdmin() ?
                    '<li><a href="/users">Users</a></li>' :
                    '';
                ?>
                <li><a href="/musics">Musics</a></li>
                <li><a href="/playlists">Playlists</a></li>
                <li><a href="/games">Games</a></li>
                <li><a href="/tags">Tags</a></li>
            </span>
            <li class="sub-menu position-relative">
                <span><?php echo \App\Models\User::getCurrentUser()->username() ?></span>
                <ul class="sub-menu-items position-absolute top-100 end-0">

                        <?=
                        $_SESSION['user']->isAdmin() ?
                            '' :
                            '<li class="nav-item p-1"><a class="nav-link" href="/profile">Profile</a></li>';
                        ?>

                    <li class="nav-item p-1">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
            </li>


        <?php } else {
            ?>
            <li><a href="/login">Login</a></li>
            <?php
        } ?>
    </ul>
</nav>

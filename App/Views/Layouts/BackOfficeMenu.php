<?php ?>
<style>
    nav {
        background-color: #333;
        height: 50px;
        width: 100%;
    }
    nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }
    nav li {
        float: left;
    }
    nav li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
    nav li a:hover {
        background-color: #111;
    }
</style>
<nav>
    <ul>
        <li><a href="/dashboard">Dashboard</a></li>
        <li><a href="/users">Users</a></li>
        <li><a href="/musics">Musics</a></li>
        <li><a href="/playlists">Playlists</a></li>
        <li><a href="/games">Games</a></li>
        <li><a href="/tags">Tags</a></li>
        <li><a href="/logout">Logout</a></li>
    </ul>
</nav>

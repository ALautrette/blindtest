<?php

echo $user->id();

var_dump($playlists);
include __DIR__.'/../Layouts/head.php';

?>
<script type="text/javascript">
    const users = [];
    function checkUser() {
        var user = document.getElementById("user").value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                console.log(xhr.responseText);
                try{
                    if(!Boolean(JSON.parse(xhr.responseText).error)){
                        addUsers(JSON.parse(xhr.responseText));
                    }
                }catch (e) {
                    console.log(e);
                }

            }
        }
        xhr.open("POST", "/api/play/checkUser", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("username=" + user);
    }

    function addUsers(user){
        users.push(user);
        document.getElementById("user").value = "";
    }

    function buildUsersList(){
        const container = document.querySelector(".usersContainer");
        const usersHTML = "";

        for (const user of users) {
            
        }
    }

    function startGame() {
        var playlist = document.getElementById("playlist").value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost:8000/party/create", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("users=" + users + "&playlist=" + playlist);
    }

</script>
<section>
    <form action="javascript:void(0);">
        <label for="playlist">Choose a playlist</label>
        <select name="playlist" id="playlist">
            <?php foreach ($playlists as $playlist) : ?>
                <option value="<?= $playlist->id() ?>"><?= $playlist->name() ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" id="user" name="user" placeholder="New user">
        <button onclick="checkUser()">Add user</button>
        <div class="usersContainer"></div>
        <button type="submit">Play</button>
    </form>
</section>
<?php include __DIR__.'/../Layouts/footer.php'; ?>


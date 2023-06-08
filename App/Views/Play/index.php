<?php
include __DIR__ . '/../Layouts/head.php';
?>
<script type="text/javascript">
    const users = [];
    const ownerId = <?php echo $user->id() ?>

        function checkUser() {
            var user = document.getElementById("user").value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    console.log(xhr.responseText);
                    try {
                        if (!Boolean(JSON.parse(xhr.responseText).error)) {
                            addUser(JSON.parse(xhr.responseText));
                        }
                    } catch (e) {
                        console.log(e);
                    }

                }
            }
            xhr.open("POST", "/api/play/checkUser", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("username=" + user);
        }

    function addUser(user) {
        //add user to list if not already in
        const isIn = users.find(u => u.userId === user.userId)
        if (isIn || user.userId === ownerId) {
            return;
        }
        users.push(user);
        document.getElementById("user").value = "";
        buildUsersList();
    }

    function deleteUser(userId) {
        users.splice(users.findIndex(user => user.userId === userId), 1);
        buildUsersList();
    }

    function buildUsersList() {
        const container = document.querySelector(".usersContainer");
        let usersHTML = "";

        for (const user of users) {
            usersHTML += `<li class="user">
                            <span>
                            ${user.username}
                            </span>
                            <span>
                                <i onclick="deleteUser(${user.userId})" class="fa-solid fa-trash"></i>
                            </span>
                          </li>`;
        }
        container.innerHTML = usersHTML;
    }

    function startGame() {
        const playlist = document.getElementById("playlist").value;
        const usersIds = [ownerId, ...users.map(user => user.userId)];
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                console.log(xhr.responseText);
                try {
                    if (xhr.responseText) {
                        window.location.href = "/play/" + xhr.responseText;
                    }
                } catch (e) {
                    console.log(e);
                }
            }
        }
        xhr.open("POST", "/api/play/create", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("user_ids=" + usersIds + "&playlist_id=" + playlist + "&owner_id=" + ownerId);
    }

</script>
<section class="container my-5 bg-dark" style="max-width: 1000px;margin:auto;border-radius: 1rem;">
    <div class="text-white p-3">
        <form action="javascript:void(0);">
            <h1>New Game</h1>
            <div class="m-2">
                <label for="playlist">Choose a playlist</label>
                <select name="playlist" id="playlist">
                    <?php foreach ($playlists as $playlist) : ?>
                        <option value="<?= $playlist->id() ?>"><?= $playlist->name() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="m-2">
                <label for="user">Add a user</label>
                <input type="text" id="user" name="user" placeholder="New user">
                <button onclick="checkUser()">Add user</button>
            </div>
            <div class="m-2">
                <h2>Other users in the room</h2>
                <ul class="usersContainer"></ul>
            </div>
            <button role="button" onclick="startGame()" class="btn btn-primary mt-2"
                    type="submit">Play</button>
        </form>
    </div>
</section>
<?php include __DIR__ . '/../Layouts/footer.php'; ?>


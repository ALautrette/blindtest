<?php
include 'App/Views/Layouts/head.php';
?>
<section class="player-container d-block position-relative min-vh-100">
    <div><a href="/dashboard"><i class="fa-solid fa-house m-2" style="font-size:40px;""></i></a></div>
    <div class="position-absolute top-50 start-50 translate-middle">
        <button onclick="onPlayerReady()" id="startButton" class="btn btn-outline-light btn-lg w-100 "
                type="submit">Play song
        </button>
    </div>
    <div class="position-absolute" id="player"></div>
    <span class="loader d-block position-absolute top-50 start-50 translate-middle d-none"></span>
</section>
<section class="choices text-center d-none">
    <h2>Who guessed it first ?</h2>
    <h3>It was : <?php echo $music->artist().' - '. $music->title() ?></h3>
    <div class="d-flex justify-content-center align-items-center flex-wrap">
        <?php
        foreach ($players as $player) {
            echo '
            <div onclick="nextMusic(' . $player->id() . ')" role="button" class="choices-wrap m-2 bg-black rounded-3 position-relative pointer-event" style="width:100px;height:100px;">
                <div class="choice position-absolute top-50 start-50 translate-middle">' . $player->username() . '</div>
            </div>
            ';
        }
        echo '<div onclick="nextMusic(-1)" role="button" class="choices-wrap m-2 bg-black rounded-3 position-relative pointer-event" style="width:100px;height:100px;">
                <div class="choice position-absolute top-50 start-50 translate-middle"> No winner </div>
            </div>';
        ?>
    </div>
</section>
<script>

    function nextMusic($winnerId) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                console.log(xhr.responseText);
                location.reload();

            }
        }
        xhr.open("POST", "/api/play/nextMusic", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("game_id=" + <?php echo $game->id() ?> +"&user_id=" + $winnerId);
    }

    /** Youtube API **/
    /** https://developers.google.com/youtube/iframe_api_reference **/
        // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement("script");

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName("script")[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 3. This function creates an <iframe> (and YouTube player)
    //    after the API code downloads.
    var player;

    const videoId = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/gi.exec(
        "<?php echo $music->url() ?>"
    )[1];

    function onYouTubeIframeAPIReady() {
        player = new YT.Player("player", {
            height: "0",
            width: "0",
            videoId,
            playerVars: {
                start: <?php echo $music->timecode() ?>,
            },
            events: {
                // //     'onReady': onPlayerReady,
                onStateChange: onPlayerStateChange,
            },
        });
    }

    // 4. The API will call this function when the video player is ready.
    function onPlayerReady(event) {
        player.unMute();
        player.setVolume(100);
        player.playVideo();
        document.querySelector('.loader').classList.remove('d-none');
        document.querySelector('#startButton').classList.add('d-none');
    }

    // 5. The API calls this function when the player's state changes.
    //    The function indicates that when playing a video (state=1),
    //    the player should play for six seconds and then stop.
    var done = false;

    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
            setTimeout(stopVideo, 10000);
            done = true;
        }
    }

    function stopVideo() {
        player.stopVideo();
        document.querySelector('.player-container').classList.add('d-none');
        document.querySelector('.choices').classList.remove('d-none');

    }
</script>


<style>
    .loader {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .loader:before, .loader:after {
        content: '';
        border-radius: 50%;
        position: absolute;
        inset: 0;
        box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.3) inset;
    }

    .loader:after {
        box-shadow: 0 2px 0 #FF3D00 inset;
        animation: rotate 2s linear infinite;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0)
        }
        100% {
            transform: rotate(360deg)
        }
    }
</style>
<?php
include 'App/Views/Layouts/footer.php';
?>
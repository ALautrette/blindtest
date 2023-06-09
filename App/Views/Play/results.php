<?php
include __DIR__ . '/../Layouts/head.php';
?>

<section class="container my-5 bg-dark" style="max-width: 1000px;margin:auto;border-radius: 1rem;">
    <div class="text-white p-3">

        <h1>Scoreboard</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Score</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($players as $key => $player) {
                echo '
        <tr>
            <th scope="row">' . ($key + 1) . '</th>
            <td>' . $player->username() . '</td>
            <td>' . $player->score() . '</td>
        </tr>
        
        ';
            }
            ?>
            </tbody>
        </table>
        <button class="btn btn-primary d-block my-1" type="submit"><a href="/dashboard">Back to home</a></button>
        <button class="btn btn-primary d-block my-1" type="submit"><a href="/play">New game</a></button>

    </div>
</section>

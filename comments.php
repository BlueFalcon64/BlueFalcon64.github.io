<?php

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'nmygsbba_test';
$DATABASE_PASS = '0l0*,tQzmt5~V9tV=Y';
$DATABASE_NAME = 'nmygsbba_blog';
try {
    $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
} catch (PDOException $exception) {

    exit('erreur!');
}


//

// temps (de base pour le temps anglais)
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array('y' => 'année.s', 'm' => 'mois', 'w' => 'semaine', 'd' => 'jour.s', 'h' => 'heure.s', 'i' => 'minute.s', 's' => 'seconde.s');
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . '' : '';
}

//classer id
function show_comments($comments, $parent_id = -1) {
    $html = '';
    if ($parent_id != -1) {
        // classer date
        array_multisort(array_column($comments, 'submit_date'), SORT_ASC, $comments);
    }
    // foreach loop
    foreach ($comments as $comment) {
        if ($comment['parent_id'] == $parent_id) {
            // html temp
            $html .= '
            <div class="comment">
                <div>
                    <h3 class="name">' . htmlspecialchars($comment['name'], ENT_QUOTES) . '</h3>
                    <span class="date">' . time_elapsed_string($comment['submit_date']) . '</span>
                </div>
                <p class="content">' . nl2br(htmlspecialchars($comment['content'], ENT_QUOTES)) . '</p>
                <a class="reply_comment_btn" href="#" data-comment-id="' . $comment['id'] . '">Répondre</a>
                ' . show_write_comment_form($comment['id']) . '
                <div class="replies">
                ' . show_comments($comments, $comment['id']) . '
                </div>
            </div>
            ';
        }
    }
    return $html;
}

// template
function show_write_comment_form($parent_id = -1) {
    $html = '
    <div class="write_comment" data-comment-id="' . $parent_id . '">
        <form>
            <input name="parent_id" type="hidden" value="' . $parent_id . '">
            <input name="name" type="text" placeholder="Votre nom" required>
            <textarea name="content" placeholder="Votre commentaire" required></textarea>
            <button type="submit">Envoyer</button>
        </form>
    </div>
    ';
    return $html;
}

// Page id
if (isset($_GET['page_id'])) {
    // Existe
    if (isset($_POST['name'], $_POST['content'])) {
        //SQL
        $stmt = $pdo->prepare('INSERT INTO comments (page_id, parent_id, name, content, submit_date) VALUES (?,?,?,?,NOW())');
        $stmt->execute([ $_GET['page_id'], $_POST['parent_id'], $_POST['name'], $_POST['content'] ]);
        exit('Your comment has been submitted!');
    }
    // Date
    $stmt = $pdo->prepare('SELECT * FROM comments WHERE page_id = ? ORDER BY submit_date DESC');
    $stmt->execute([ $_GET['page_id'] ]);
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Total comm
    $stmt = $pdo->prepare('SELECT COUNT(*) AS total_comments FROM comments WHERE page_id = ?');
    $stmt->execute([ $_GET['page_id'] ]);
    $comments_info = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    exit('ID de la page');
}
?>

<div class="comment_header">
    <span class="total"><?=$comments_info['total_comments']?> commententaires</span>
    <a href="#" class="write_comment_btn" data-comment-id="-1">Écrire un commentaire</a>
</div>

<?=show_write_comment_form()?>

<?=show_comments($comments)?>
<?php
include "includes/check.php";

$str_path = http_build_query(array('art_id' => $art_id));

?>
<tr onclick="window.location='/admin/edit?<?php echo $str_path ?>';">
    <td>
        <picture>
            <img class="art-edit" src="<?php echo htmlspecialchars($file_path); ?>" alt="">
        </picture>
    </td>
    <td>
        <?php echo htmlspecialchars($title); ?>
    </td>
    <td>
        <?php echo htmlspecialchars($descr); ?>
    </td>
    <td>
        <?php echo htmlspecialchars($yr); ?>
    </td>
    <td>
        <!-- Digital Art Source: (original work) Nicole Lin, Shihan Gao -->
        <?php
        $tags = exec_sql_query(
            $db,
            "SELECT tags.name AS 'tags.name'
            FROM art_tags
            INNER JOIN tags ON art_tags.tags_id = tags.id
            WHERE art_tags.art_id = :art_id;",

            array(':art_id' => $art_id)
        );

        $str_path = http_build_query(array('art_id' => $art_id));
        $art_tags = $tags->fetchAll();
        foreach ($art_tags as $art_tag) { ?>
        <?php echo htmlspecialchars($art_tag['tags.name']);
            if (next($art_tags)) {
                echo ',';
            };
        };

        ?>
    </td>

</tr>

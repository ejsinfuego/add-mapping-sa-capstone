<?php
require 'partials/header.php';

// fetch all post from database
$current_user_id = $_SESSION['user-id'];
$query = "SELECT * FROM posts WHERE NOT author_id=$current_user_id ORDER BY date_time DESC";
$posts = mysqli_query($connection , $query);
?>




    <section class="search__bar">
        <form class="container search__bar-container" action="search.php" method="GET">
            <div>
                <i class="uil uil-search"></i>
                <input type="search" name="search" placeholder="Search">
            </div>
            <button type="submit" name="submit" class="btn">Go</button>
        </form>
    </section>
    <!--====================== END OF SEARCH ====================-->





    <section class="posts <?= $featured ? '' : 'section_extra-margin' ?>">
        <div class="container posts__container">
            <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
            <article class="post">
                    <tr>
                        <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id'] ?>" class="btn sm"><img src="<?= ROOT_URL ?>assets/edit.png" class="edit"></a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>" class="btn sm danger"><img src="<?= ROOT_URL ?>assets/delete.png" class="delete"></a></td>
                    </tr>
                <div class="post__thumbnail">
                    <img src="<?= ROOT_URL?>images/<?= $post['thumbnail'] ?>">
                </div>
                <div class="post__info">
                <?php 
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                ?>
                    <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
                    <h3 class="post__title">
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                    </h3>
                    <p class="post__body">
                    <?= substr($post['body'], 0, 150) ?>...
                    </p>
                    <div class="post__author">
                    <?php
                        // fetch author from users tbale using author_id
                        $author_id = $post['author_id'];
                        $author_query = "SELECT *FROM users WHERE id=$author_id";
                        $author_result = mysqli_query($connection, $author_query);
                        $author = mysqli_fetch_assoc($author_result);

                    ?>
                        <div class="post__author-avatar">
                            <img src="<?= ROOT_URL ?>images/<?= $author['avatar'] ?>">
                        </div>
                        <div class="post__author-info">
                            <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                            <small><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></small>
                        </div>
                    </div>
                </div>
            </article>
            <?php endwhile ?>
        </div>
    </section>
<?php
require '../partials/footer.php';

?>

<?php
require_once("./config/database.php");
include_once("./config/App.php");


$app = new App();
$parameters = $_GET;

/**
 * ==============================================
 *      CHECK FOR SHOPIFY STORE
 * ==============================================
 */
    include_once('./config/check_token.php');
?>

<?php include_once("header.php"); ?>
    <section>
        <div class="alert columns twelve">
            <dl>
                <dt>Welcom to Sagar's first shoify app</dt>
            </dl>
        </div>
    </section>
</main>
<?php include_once("footer.php"); ?>
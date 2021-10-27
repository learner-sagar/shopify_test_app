<?php 
require_once("./config/database.php");
include_once("./config/App.php");

$app = new App();
$parameters = $_GET;

include_once('./config/check_token.php');
$script_url = 'https://a054-2402-8100-238c-643f-5940-6b3-1921-9c58.ngrok.io/shopify/script/myscript.js';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if($_POST['action_type'] == "create_script"){
        $scriptTag_data = array(
            "script_tag" => array(
                "event" => "onload",
                "src" => $script_url
            )
        ); 
        $create_script = $app->rest_call("/admin/api/2021-10/script_tags.json", $scriptTag_data, "POST");
        $create_script = json_decode($create_script['body'],true);
    }

    if($_POST['action_type'] == "delete_script"){
       $script_tag = array("scr" => $script_url); 
       $get_script = $app->rest_call('/admin/api/2021-10/script_tags.json',$script_tag, "GET");
       $get_script = json_decode($get_script['body'],true);
       foreach($get_script['script_tags'] as $script){
           $delete_script  = $app->rest_call("/admin/api/2021-10/script_tags/".$script["id"].".json",array(),"DELETE");
       }
    }
}
$script_tags = $app->rest_call('/admin/api/2021-10/script_tags.json',array(),'GET');
$script_tags = json_decode($script_tags['body'], true);

?>
<?php include_once("header.php"); ?>
<section>
    <aside>
        <h2>Install script tags </h2>
        <p>Click install buttont to install script tag to your shopify store</p>
    </aside>
    <article>
        <div class="card">
            <form action="" method="post">
                <input type="hidden" name="action_type" value="create_script">
                <button type="submit">Create Script Tag</button>
            </form>
        </div>
    </article>
</section>
<section>
    <aside>
        <h2>Delete script tags </h2>
        <p>Click delete buttont to remove script tag to your shopify store</p>
    </aside>
    <article>
        <div class="card">
            <form action="" method="post">
                <input type="hidden" name="action_type" value="delete_script">
                <button type="submit">Delete Script</button>
            </form>
        </div>
    </article>
</section>

<?php include_once("footer.php");
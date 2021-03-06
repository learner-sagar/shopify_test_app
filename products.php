<?php 
require_once("./config/database.php");
include_once("./config/App.php");

$app = new App();
$parameters = $_GET;

include_once('./config/check_token.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['product_title']) && isset($_POST['product_body_html']) && $_POST['action_type'] == "create_product")
    {
        $product_data = array(
            "product" => array(
                "title" => $_POST["product_title"],
                "body_html" => $_POST["product_body_html"]
            )
        );
        $create_product = $app->rest_call("/admin/api/2021-10/products.json",$product_data,"POST");
    }
    if(isset($_POST['update_id']) && $_POST['action_type'] == "update")
    {
        $update_data = array(
            "product" => array(
                "id" => $_POST['update_id'],
                "title" => $_POST['update_name']
            )
        );
        
        $update = $app->rest_call('/admin/api/2021-10/products/'.$_POST['update_id'].'.json',$update_data,'PUT');
        $update = json_decode($update['body'], true);
    }
    if(isset($_POST['delete_id']) && $_POST['action_type'] == "delete")
    {
        $delete = $app->rest_call('/admin/api/2021-10/products/'.$_POST['delete_id'].'.json',array(),'DELETE');
        $delete  = json_decode($delete['body'], true);
    }
}
$products = $app->rest_call('/admin/api/2021-10/products.json',array("status" => "active"),'GET');
$products = json_decode($products['body'], true);
// echo "<pre>";
// print_r($products);die;
?>
<?php include_once("header.php"); ?>

<section>
    <aside>
        <h2>Create New Product</h2>
        <p>fill out the following form and submit to creat a new product</p>
    </aside>
    <article>
        <div class="card">
            <form action="" method="post">
                <input type="hidden" name="action_type" value="create_product">
                <div class="row">
                    <label for="productTitle">Title</label>
                    <input type="text" name="product_title" id="productTitle" />
                </div>
                <div class="row">
                    <label for="productDescription">Description</label>
                    <textarea name="product_body_html" id="productDescription"></textarea>
                </div>
                <div class="row">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </article>
</section>

<section>
    <table>
        <thead>
            <tr>
                <th colspan="2">Product</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product){
                foreach($product as $key => $value){   
                    $image = count($value["images"]) > 0 ? $value["images"][0]["src"]:""; 
            ?>
                <tr>
                    <td> <img width="35" src="<?= $image; ?>" /> </td>
                    <td>
                        <form action="" method="post" class="row side-elements ">
                            <input type="hidden" name="update_id" value="<?= $value['id'] ?>" />
                            <input type="text" name="update_name" value="<?= $value['title'] ;?>" />
                            <input type="hidden" name="action_type" value="update" />
                            <button type="submit" class="secondary icon-checkmark"></button>
                        </form>
                    </td>
                    <td><?= $value['status'] ;?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="delete_id" value="<?= $value['id'] ?>" />
                            <input type="hidden" name="action_type" value="delete" />
                            <button type="submit" class="secondary icon-trash"></button>
                        </form>
                    </td>
                <tr>
            <?php } }?>
        </tbody>
    </table>
</section>

<?php include_once("footer.php"); ?>
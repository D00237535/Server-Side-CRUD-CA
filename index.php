<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 2;
}
}

// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get records for selected category
$queryRecords = "SELECT * FROM records
WHERE categoryID = :category_id
ORDER BY recordID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$records = $statement3->fetchAll();
$statement3->closeCursor();
?>

<div class="container">
    <?php
    include('includes/header.php');
    ?>

    <div class = "tags" >
        <h1>Record List</h1>
        <h2>Item</h2>
    </div>

    <aside>
    <div class = "topnav">
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul>
        <?php foreach ($categories as $category) : ?>
        <li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
        <?php echo $category['categoryName']; ?>
        </a>
        </li>
        <?php endforeach; ?>
        </ul>
        </nav>  
    </div>        
    </aside>

    <section>
    <!-- display a table of records -->
    <div = classname = "category">
        <h2><?php echo $category_name; ?></h2>
    <div>
    <div>

    <div>
        <?php foreach ($records as $record) : ?>
        </div>

    <div class = "description">
        <?php echo $record['description']; ?></br></br>
    </div>

    <div class = "image">
        <img src="image_uploads/<?php echo $record['image']; ?>" width="800px" height="450px" />
    </div></br>

    <div class = "DeleteEdit">
        <form action="delete_record.php" method="post" id="delete_record_form">

            <input type="hidden" name="record_id" value="<?php echo $record['recordID']; ?>">

            <input type="hidden" name="category_id" value="<?php echo $record['categoryID']; ?>">

            <input type="submit" value="Delete"></br></br>

            </form>

            <form action="edit_record_form.php" method="post" id="delete_record_form">

            <input type="hidden" name="record_id" value="<?php echo $record['recordID']; ?>">

            <input type="hidden" name="category_id" value="<?php echo $record['categoryID']; ?>">

            <input type="submit" value="Edit">
        </form>
    </div>


    </div>
    <?php endforeach; ?>

    <div>
        <p><a href="add_record_form.php">Add Record</a></p>
        <p><a href="category_list.php">Manage Categories</a></p>
        </section>
    </div>
</div>
<?php
include('includes/footer.php');
?>
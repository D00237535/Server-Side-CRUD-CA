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

    <div class = "tag1" >
        Record List
    </div>
    <div class = "tag2" >
        Item
    </div>

    <aside>
    <div class = "topnav">
        <!-- display a list of categories -->
        <div class = "tag3">
            Categories
        </div>
        <nav>
            <ul>
                <?php foreach ($categories as $category) : ?>
                    <li>
                        <a href=".?category_id=<?php echo $category['categoryID']; ?>">
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
    <div class = "category">
        <div class = "title">
            <?php echo $category_name; ?>
        </div>
    <div></br>
    
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

    <div class = "bottom">
        <a href="add_record_form.php">Add Record</a>
       
    </div>
 </section>
</div>
<?php
include('includes/footer.php');
?>
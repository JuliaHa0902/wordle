
<?php
require 'db_configuration.php';
if (isset($_GET['id'])){
    $conn = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    $id = $_GET['id'];
    $sql = "SELECT * FROM custom_Words WHERE Id = '$id'";
    $result = $conn->query($sql);
    
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $word = $row["word"];
            $email = $row["Email"];
            $clue = $row["clue"];
        }
        $conn -> close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Custom Words Table</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="css/menu.css"> -->
    <link rel="stylesheet" href="css/custom_page.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="js/animals.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<!-- <header>
    <div class="header_bar">
        <div id="main_screen_logo">
            <a href="https://telugupuzzles.com"><img src="images/logo.png" alt="10000 Icon" style="height:80px;width:auto;"></a>
        </div>
        <div>
            <button onclick="window.location.href='index.php'">
                <h1 id="title" style="left: 33.5%">Custom Word List</h1>
            </button>
        </div>
        <div id="menu_buttons">
            <div id="help_button">
                <button onclick="showHelpModal()" class="modalbtn">
                    <img class="img_button" src="images/icons-help.png" alt="Help Icon">
                </button>
            </div>
            <div id="stat_button">
                <button onclick="showStatModal()" class="modalbtn">
                    <img class="img_button" src="images/icons-statistic.png" alt="Stat Icon">
                </button>
            </div>
            <div id="profile_button" class="dropdown">
                <button class="dropbtn">
                    <img class="img_button" src="images/icons-user.png" alt="Profile Icon">
                </button>
                <div id="profile_dropdown" class="dropdown-content">
                    <p id="profile_menu_1">Access Level: GUEST</p>
                    <p id="profile_menu_2" style="color:darkGray">Create Custom Word</p>
                    <p id="profile_menu_3" style="color:darkGray">Puzzle Word List</p>
                    <p id="profile_menu_4" style="color:darkGray">Custom Word List</p>
                    <a id="profile_menu_5" href="login_page.php">Log In</a>
                </div>
            </div>
        </div>
    </div>
</header> -->
<?php include 'navigation.php';?>

<body onload=updateMenus()>
<div>
    <ul class="back" onclick="window.location.href='list_custom_words.php'">
        <li class="prev"><span></span></li>
    </ul>
</div>
<div id="modify_custom_word" class="custom_word_modal">
    <h1>Modify Custom Word</h1>
    <form action="update_custom.php?rn=<?php echo $_GET['id'] ?>" method="POST" autocomplete="off">
        <div class="text_field">
            <input placeholder="<?php echo $word ?>" type="text" name="word">
            <span></span>
            <label>Word</label>
        </div>
        <div class="text_field">
            <input placeholder="<?php echo $email ?>" type="email" name="email">
            <span></span>
            <label>Email</label>
        </div>
        <div class="text_field">
            <input placeholder="<?php echo $clue ?>" type="text" name="clue">
            <span></span>
            <label>Clue</label>
        </div>
        <input type="submit" value="Modify" name="submit">
    </form>
</div>

<!--  Help Modal      -->
<?php $page_title = 'wordle > help modal';
# Page Content
include('wordle_help_modal.php');
?>

<!--   Stat Modal   -->
<?php $page_title = 'wordle > stats modal';
# Page Content
include('statistics_modal.php');
?>


<script>
    function showHelpModal() {
        document.getElementById("help_modal").style.display = "block";
    }
    
    function showStatModal() {
        loadUserStats();
        document.getElementById("stat_modal").style.display = "block";
    }
    
    window.onclick = function (event) {
        if (event.target === helpModal) {
            helpModal.style.display = "none";
        } else if (event.target === statModal) {
            statModal.style.display = "none";
        }
    }
</script>

</body>
</html>
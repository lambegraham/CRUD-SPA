<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
            <div class="row">
                <h3>PHP CRUD Grid</h3>
            </div>
            <div class="row">
            <!--  <p>
                  <a href="combined.php" class="btn btn-success">Create</a>
                </p> -->
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Creator</th>
                      <th>Title</th>
                      <th>Type</th>
                      <th>Identifer</th>
                      <th>Date</th>
                      <th>Language</th>
                      <th>Description</th>
                      <th>Command</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                  // include 'create.php'
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM eBook_MetaData ORDER BY id ASC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['creator'] . '</td>';
                            echo '<td>'. $row['title'] . '</td>';
                            echo '<td>'. $row['type'] . '</td>';
                            echo '<td>'. $row['identifier'] . '</td>';
                            echo '<td>'. $row['date'] . '</td>';
                            echo '<td>'. $row['language'] . '</td>';
                            echo '<td>'. $row['description'] . '</td>';
                            echo '<td width=250>';
                              //  echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
                              //  echo ' ';
                                echo '<a class="btn btn-success" href="combined.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                              //  echo $("delete").hide();
                                echo '<a class="btn btn-danger" href="combined.php?id='.$row['id'].'#bottom">Delete</a>';
                              //  echo $("delete").show();
                                echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                   if ( !empty($_POST)) {
                       // keep track validation errors
                       $creatorError = null;
                       $titleError = null;
                       $typeError = null;
                       $identifierError = null;
                       $dateError = null;
                       $languageError = null;
                       $descError = null;

                       // keep track post values

                       $creator = $_POST['creator'];
                       $title = $_POST['title'];
                       $type = $_POST['type'];
                       $identifier = $_POST['identifier'];
                       $date = $_POST['date'];
                       $language = $_POST['language'];
                       $desc = $_POST['description'];

                       // validate input
                       $valid = true;
                       if (empty($creator)) {
                           $creatorError = 'Please enter Creator';
                           $valid = false;
                       }

                       if (empty($title)) {
                           $titleError = 'Please enter Title';
                           $valid = false;
                       }

                       if (empty($type)) {
                           $typeError = 'Please enter Type';
                           $valid = false;
                       }
                       if (empty($identifier)) {
                           $identifierError = 'Please enter Identifier';
                           $valid = false;
                       }
                       if (empty($date)) {
                           $dateError = 'Please enter Dare';
                           $valid = false;
                       }
                       if (empty($language)) {
                           $languageError = 'Please enter language';
                           $valid = false;
                       }
                       if (empty($desc)) {
                           $descError = 'Please enter Description';
                           $valid = false;
                       }
                       $id = null;
                       if ( !empty($_GET['id'])) {
                           $id = $_REQUEST['id'];
                       }

                       // insert data
                       if ($valid and null==$id) {
                           $pdo = Database::connect();
                           $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                           $sql = "INSERT INTO eBook_MetaData (creator, title, type, identifier, date, language, description) values(?, ?, ?, ?, ?, ?, ?)";
                           $q = $pdo->prepare($sql);
                           $q->execute(array($creator, $title, $type, $identifier, $date, $language, $desc));
                           Database::disconnect();
                           header("Location: combined.php");
                       }
                   }
                //   require 'database.php';
                $id = null;
                if ( !empty($_GET['id'])) {
                    $id = $_REQUEST['id'];
                }


                   if ( null==$id ) {
                    //   header("Location: index.php");
                   }

                   if ( !empty($_POST)) {
                       // keep track validation errors
                       $creatorError = null;
                       $titleError = null;
                       $typeError = null;
                       $identifierError = null;
                       $dateError = null;
                       $languageError = null;
                       $descError = null;

                       // keep track post values
                       $creator = $_POST['creator'];
                       $title = $_POST['title'];
                       $type = $_POST['type'];
                       $identifier = $_POST['identifier'];
                       $date = $_POST['date'];
                       $language = $_POST['language'];
                       $desc = $_POST['description'];

                       // validate input
                       $valid = true;
                       if (empty($creator)) {
                           $creatorError = 'Please enter Creator';
                           $valid = false;
                       }

                       if (empty($title)) {
                           $titleError = 'Please enter Title';
                           $valid = false;
                       }

                       if (empty($type)) {
                           $typeError = 'Please enter Type';
                           $valid = false;
                       }
                       if (empty($identifier)) {
                           $identifierError = 'Please enter Identifier';
                           $valid = false;
                       }
                       if (empty($date)) {
                           $dateError = 'Please enter Dare';
                           $valid = false;
                       }
                       if (empty($language)) {
                           $languageError = 'Please enter language';
                           $valid = false;
                       }
                       if (empty($desc)) {
                           $descError = 'Please enter Description';
                           $valid = false;
                       }

                       // update data
                    //   if ($valid) {
                           $pdo = Database::connect();
                           $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                           $sql = "UPDATE eBook_MetaData SET creator = ?, title = ?, type = ?, identifier= ?, date= ?, language= ?, description= ? WHERE id = ?";
                           $q = $pdo->prepare($sql);
                           $q->execute(array($creator, $title, $type, $identifier, $date, $language, $desc, $id));
                           Database::disconnect();
                           header("Location: combined.php");
                    //   }
                  } //else {
                       $pdo = Database::connect();
                       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                       $sql = "SELECT * FROM eBook_MetaData where id = ?";
                       $q = $pdo->prepare($sql);
                       $q->execute(array($id));
                       $data = $q->fetch(PDO::FETCH_ASSOC);
                       $creator = $data['creator'];
                       $title = $data['title'];
                       $type = $data['type'];
                       $identifier = $data['identifier'];
                       $date = $data['date'];
                       $language = $data['language'];
                       $desc = $data['description'];

                       Database::disconnect();
              //     }
                  // require 'database.php';
    $id = 0;

    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];

        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM eBook_MetaData  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: combined.php");

    }
                  ?>
                  </tbody>
            </table>
        </div>
        <div class="container">

                    <div class="span10 offset1">
                        <div class="row">
                            <h3>Create an Entry</h3>
                        </div>
                        <!--CREATOR-->
                        <form class="form-horizontal" action="combined.php" method="post">
                          <div class="control-group <?php echo !empty($creatorError)?'error':'';?>">
                            <label class="control-label">Creator</label>
                            <div class="controls">
                                <input name="creator" type="text"  placeholder="Creator" value="<?php echo !empty($creator)?$creator:'';?>">
                                <?php if (!empty($creatorError)): ?>
                                    <span class="help-inline"><?php echo $creatorError;?></span>
                                <?php endif; ?>
                            </div>
                          </div>
                          <!--TITLE-->
                          <div class="control-group <?php echo !empty($titleError)?'error':'';?>">
                            <label class="control-label">Creator</label>
                            <div class="controls">
                                <input name="title" type="text" placeholder="Title" value="<?php echo !empty($title)?$title:'';?>">
                                <?php if (!empty($titleError)): ?>
                                    <span class="help-inline"><?php echo $titleError;?></span>
                                <?php endif;?>
                            </div>
                          </div>
                          <!--TYPE-->
                          <div class="control-group <?php echo !empty($typeError)?'error':'';?>">
                            <label class="control-label">Type</label>
                            <div class="controls">
                                <input name="type" type="text"  placeholder="Type" value="<?php echo !empty($type)?$type:'';?>">
                                <?php if (!empty($typeError)): ?>
                                    <span class="help-inline"><?php echo $typeError;?></span>
                                <?php endif;?>
                            </div>
                          </div>
                          <!--identifier-->
                          <div class="control-group <?php echo !empty($identifierError)?'error':'';?>">
                            <label class="control-label">Identifer</label>
                            <div class="controls">
                                <input name="identifier" type="text"  placeholder="Identifer" value="<?php echo !empty($identifier)?$identifier:'';?>">
                                <?php if (!empty($identifierError)): ?>
                                    <span class="help-inline"><?php echo $identifierError;?></span>
                                <?php endif;?>
                            </div>
                          </div>
                          <!--Date-->
                          <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
                            <label class="control-label">Date</label>
                            <div class="controls">
                                <input name="date" type="date"  placeholder="Date" value="<?php echo !empty($date)?$date:'';?>">
                                <?php if (!empty($dateError)): ?>
                                    <span class="help-inline"><?php echo $dateError;?></span>
                                <?php endif;?>
                            </div>
                          </div>
                          <!--Language-->
                          <div class="control-group <?php echo !empty($languageError)?'error':'';?>">
                            <label class="control-label">Language</label>
                            <div class="controls">
                                <input name="language" type="text"  placeholder="Language" value="<?php echo !empty($language)?$language:'';?>">
                                <?php if (!empty($languageError)): ?>
                                    <span class="help-inline"><?php echo $languageError;?></span>
                                <?php endif;?>
                            </div>
                          </div>
                          <div class="control-group <?php echo !empty($descError)?'error':'';?>">
                            <label class="control-label">Description</label>
                            <div class="controls">
                                <input name="description" type="text"  placeholder="Description" value="<?php echo !empty($desc)?$desc:'';?>">
                                <?php if (!empty($descError)): ?>
                                    <span class="help-inline"><?php echo $descError;?></span>
                                <?php endif;?>
                            </div>
                          </div>
                          <div class="form-actions">
                              <button type="submit" class="btn btn-success">Create</button>

                            </div>
                        </form>
                    </div>
                    <body>
    <div class="container">

      <div class="span10 offset1">
          <div class="row">
              <h3>Update an Entry</h3>
          </div>

          <form class="form-horizontal" action="combined.php?id=<?php echo $id?>" method="post">
            <div class="control-group <?php echo !empty($creatorError)?'error':'';?>">
              <label class="control-label">Creator</label>
              <div class="controls">
                  <input name="creator" type="text"  placeholder="Creator" value="<?php echo !empty($creator)?$creator:'';?>">
                  <?php if (!empty($creatorError)): ?>
                      <span class="help-inline"><?php echo $creatorError;?></span>
                  <?php endif; ?>
              </div>
            </div>
            <div class="control-group <?php echo !empty($titleError)?'error':'';?>">
              <label class="control-label">Creator</label>
              <div class="controls">
                  <input name="title" type="text" placeholder="Title" value="<?php echo !empty($title)?$title:'';?>">
                  <?php if (!empty($titleError)): ?>
                      <span class="help-inline"><?php echo $titleError;?></span>
                  <?php endif;?>
              </div>
            </div>
            <div class="control-group <?php echo !empty($typeError)?'error':'';?>">
              <label class="control-label">Type</label>
              <div class="controls">
                  <input name="type" type="text"  placeholder="Type" value="<?php echo !empty($type)?$type:'';?>">
                  <?php if (!empty($typeError)): ?>
                      <span class="help-inline"><?php echo $typeError;?></span>
                  <?php endif;?>
              </div>
            </div>
            <div class="control-group <?php echo !empty($identifierError)?'error':'';?>">
              <label class="control-label">Identifer</label>
              <div class="controls">
                  <input name="identifier" type="text"  placeholder="Identifer" value="<?php echo !empty($identifier)?$identifier:'';?>">
                  <?php if (!empty($identifierError)): ?>
                      <span class="help-inline"><?php echo $identifierError;?></span>
                  <?php endif;?>
              </div>
            </div>
            <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
              <label class="control-label">Date</label>
              <div class="controls">
                  <input name="date" type="date"  placeholder="Date" value="<?php echo !empty($date)?$date:'';?>">
                  <?php if (!empty($dateError)): ?>
                      <span class="help-inline"><?php echo $dateError;?></span>
                  <?php endif;?>
              </div>
            </div>
            <div class="control-group <?php echo !empty($languageError)?'error':'';?>">
              <label class="control-label">Language</label>
              <div class="controls">
                  <input name="language" type="text"  placeholder="Language" value="<?php echo !empty($language)?$language:'';?>">
                  <?php if (!empty($languageError)): ?>
                      <span class="help-inline"><?php echo $languageError;?></span>
                  <?php endif;?>
              </div>
            </div>
            <div class="control-group <?php echo !empty($descError)?'error':'';?>">
              <label class="control-label">Description</label>
              <div class="controls">
                  <input name="description" type="text"  placeholder="Description" value="<?php echo !empty($desc)?$desc:'';?>">
                  <?php if (!empty($descError)): ?>
                      <span class="help-inline"><?php echo $descError;?></span>
                  <?php endif;?>
              </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Update</button>
              </div>
          </form>
      </div>
      <div id="divdelete">
      <div class="span10 offset1">  <span id='bottom'>
          <div class="row">
              <h3>Delete a Customer</h3>
          </div>
          <form class="form-horizontal" action="combined.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
            <p class="alert alert-error">Are you sure you want to delete NAME: <?php echo $creator;?> ID: <?php echo $id;?> ?</p>
            <div class="form-actions">
                <button type="submit" class="btn btn-danger">Yes</button>
                <a class="btn" href="combined.php">No</a>
              </div>
          </form>
        </span>
      </div>
    </div>
    </div> <!-- /container -->


    </div>
  </body>

</html>

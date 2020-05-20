<nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href="index.php"><img src="img/cropped-ba-32x32.png" alt="BA Home"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php if($_SERVER['SCRIPT_NAME']=="/about.php") echo 'active'; ?>">
        <a class="nav-link" href="about.php">About Me<?php if($_SERVER['SCRIPT_NAME']=="/about.php") echo '<span class="sr-only">(current)</span>'; ?></a>
      </li>
      <li class="nav-item dropdown <?php if($_SERVER['SCRIPT_NAME']=="/assignments.php") echo 'active'; ?>">
            <a class="nav-link dropdown-toggle" href="https://salty-ravine-95199.herokuapp.com/" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Assignments</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item <?php if($_SERVER['SCRIPT_NAME']=="/w01/index.php") echo 'active'; ?>" href="/w01/">Week 01</a>
              <a class="dropdown-item <?php if($_SERVER['SCRIPT_NAME']=="/w02/index.php") echo 'active'; ?>" href="/w02/">Week 02</a>
              <a class="dropdown-item <?php if($_SERVER['SCRIPT_NAME']=="/w03/index.php") echo 'active'; ?>" href="/w03/">Week 03</a>
              <a class="dropdown-item <?php if($_SERVER['SCRIPT_NAME']=="/w04/index.php") echo 'active'; ?>" href="/w4/">Week 04</a>
              <a class="dropdown-item <?php if($_SERVER['SCRIPT_NAME']=="/w05/index.php") echo 'active'; ?>" href="/w5/">Week 05</a>

            </div>
      </li>
    </ul>
    <?php
      if(getcwd()=="/w03"){
        echo '<div class="btn-group" role="group" aria-label="Cart Buttons">';
        //echo '<form class="form-inline mt-2 mt-md-0">';
        echo '<button type="button" onclick="document.location = \'w03/cart.php\'" class="btn btn-secondary">Cart: ' . itemCountInCart() . '</button>';
        echo '<button type="button" onclick="document.location = \'w03/checkout.php\'" class="btn btn-secondary"';
        if(itemCountInCart() == 0) {
          echo 'disabled';
        }
        echo '>Check Out</button>';
        //echo '<button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Cart : ' . itemCountInCart() .'</button>';
        //echo '<button class="btn btn-secondary my-2 my-sm-0" type="submit">Check Out</button>';
        //echo '</form>';
        echo '</div>';
      }
  ?>
  </div>
</nav>
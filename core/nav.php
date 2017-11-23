<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">BeMyEar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
    <?php foreach ($sections as $section => $link) { ?>
    	<li class="nav-item <?= isset($current_page) ? (($current_page == $link) ? 'active' : '') : '' ?>">
        <a class="nav-link" href="<?= base_url($link) ?>"><?= $section ?></a>
      </li>
    <?php } ?>
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="<?= base_url('logout') ?>">Logout</a></li>
    </ul>
  </div>
</nav>
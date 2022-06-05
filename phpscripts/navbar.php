<style>
  .dropdown:hover .dropdown-menu {
    display: block;
    margin-top: 5;
    color: #7f0; 
 }
 thead th {
    background-color: #04AA6D;
		color: white;
	}
</style>
<nav class="navbar navbar-expand-lg navbar-white bg-dark">
  <a class="navbar-brand" href="#">Analysis of basis over ELIDEK</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(arxi)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Database
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="ergo_select.php">Erga_Epixorigiseis</a>
          <a class="dropdown-item" href="program_database.php">Programs</a>
		  <a class="dropdown-item" href="organization_select.php">Organisations</a>
		  <a class="dropdown-item" href="researcher_database.php">Ereunites</a>
		  <a class="dropdown-item" href="stelexos_database.php">Stelexi</a>
        </ul>
      </li>
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Views
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="view_1.php">Projects per researcher</a>
          <a class="dropdown-item" href="view_2.php">Projects per field</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="fields.php">Fields-Tomeis and <br> activity </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link " href="samenumorgs.php">Organisations with same <br> number of erga-epixorigiseis</a>
      </li>
	   <li class="nav-item">
        <a class="nav-link " href="top3.php">Top-3 pairs <br> of pair fields</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link " href="youngs.php">Young Researchers <br> than are younger than 40</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link " href="execs.php">Top Stelexi for <br> each company</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link " href="nodeliver.php">Ereunites me count <br> se erga, but with no deliver</a>
      </li>
    </ul>
  </div>
</nav>
  <?php 
  require 'connexionBD/connexionBD.php';
  require 'api/Currency_converter.php';
  require 'models/history.php';

  ?>
<head>
    <title>Currency Converter</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>

<body>
    <!-- Navigation Bar -->
    <nav class="menu navbar-default navbar-menu">
        <div class="container">
            <div class="menu-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">MINI Currency Converter API</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="">Home</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of navbar-->
<br>
<br>
<br>

<div class="container">
  <div class="row">
    <div class="col-md-5">
	
      <div class="panel panel-primary text-center">
        <div class="panel-heading">
          <h4 class="panel-title">Currency Converter</h4>
        </div>
        <div >
          Please enter numeric value
        </div>
        <div class="panel-body">
          <form class="form-vertical" method='POST' action='index.php'>

            <div class="form-group center">
              <label for="">Enter Value:</label>
              <input type="number" class="amount form-control" name='amount' placeholder="Enter value" min="1" required>
            </div>


            <div class="form-group inline-block">
              <label for="">From currency:</label>
              <select class="currency-list form-control" name='currency_from' onchange="exchangeCurrency(this)" required>
				<option>CAD</option>
				<option>USD</option>
				<option>EUR</option>
              </select>
            </div>

            <div class="form-group inline-block">
              <label>To currency:</label>
              <select class="currency-list form-control"  name='currency_to' onchange="exchangeCurrency(this)" required>
				<option>USD</option>
				<option>EUR</option>
				<option>CAD</option>
              </select>
            </div>
			
			
		  
		  
		 
		  <font color='green'>
		  <?php
		  
		   ///ici on affiche le resultat si lutisateur a fait une requete en appelant la classe convertion
		  if (isset($_POST['amount'])){
			  $obj= new convertion();
			  $obj->set_currency_from($_POST['currency_from']);
			  $obj->set_currency_to($_POST['currency_to']);
			  $obj->set_amount($_POST['amount']);
			   
			   echo $_POST['amount'].' '.$_POST['currency_from'].' is '.$obj->result_convertion() .' '.$_POST['currency_to']. ' and rate is '. $obj->rate(). '<br>';
		  
		  //on sauvegarde la convertion dans la base de donnee en appelant le model history
		  $data= new history();
		  $data->set_currency_begin($_POST['currency_from']);
		  $data->set_currency_end($_POST['currency_to']);
		  $data->set_amount($_POST['amount']);
		  $data->set_result($obj->result_convertion());
		  $data->save();
		  }
		  
		  ?>
		  </font>
		  
		  <button type="submit" class="btn btn-primary" style="height:35px;width:120px">Convert</button> 


 </form>
          

        </div>
      </div>
    </div>
	
	 <div class="col-md-7 ">

	
      <div class="panel panel-primary text-center">
        <div class="panel-heading">
          <h4 class="panel-title">Currency Converter</h4>
        </div>
        <div >
         history of convertion
        </div>
        <div class="panel-body">
          

		  
		  
		   <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">from</th>
                    <th scope="col">to</th>
                    <th scope="col">amount</th>
                    <th scope="col">result </th>
                    <th scope="col">date</th>
                    
                  </tr>
                </thead>
                <tbody>
                 

				 <?php 
				 
				 // ce code permet dafficher lhistorique les requetes effectuées par les utilisateurs
					$datas= new history();
					$reponse= $datas->get_history_all_convertion(); 
                    $i=0;
                 
				 while ($donnees = $reponse->fetch())
                        {
                            $i++;
                    ?>
                  <tr>
                    <td><?php echo $donnees['currency_begin']; ?></td>
					<td><?php echo $donnees['currency_end']; ?></td>
					 <td><?php echo $donnees['amount']; ?></td>
					 <td><?php echo $donnees['result']; ?></td>
					 <td><?php echo $donnees['created_at']; ?></td>
                  </tr>
                  
                  <?php 
                            } //fin boucle while
                        
                  ?>
                </tbody>
               
              </table>
               <?php 
                    if ($i==0){
                        echo " <font color='red'>empty for the moment </font>";
                    }     
                  ?>
            </div>
            
		  
		  
		  
         </div>
      </div>	 
	 </div
  </div>
</div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>

    <script src="assets/js/program.js"></script>



    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="text-center">©2021 Kouakam tiojip vaneck</a></p>
        </div>
        </div>
    </footer>
    <!-- End of Footer -->

</body>

</html>

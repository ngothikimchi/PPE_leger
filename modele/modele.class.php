<?php
	// classe model pour faire les actions avec DB
	class Modele 
	{
		private $pdo; 
		private $uneTable ; 

		public function    __construct ($serveur, $bdd, $user, $mdp){
			$this->pdo = null; 
			try{
				$this->pdo = new PDO("mysql:host=".$serveur.";dbname=".$bdd,$user, $mdp); 
			}
			catch (PDOException $exp)
			{
				echo "Erreur de connexion au SGBD"; 
			}
		}

		public function setTable ($uneTable)
		{
			$this->uneTable =$uneTable; 
		}

		public function selectAll ($chaine)
		{
		$requete = "select ".$chaine." from  ".$this->uneTable;
			$select = $this->pdo->prepare ($requete); 
			$select->execute(); 
			return $select->fetchAll ();  
		}
		
		public function selectWhere ($chaine, $where)
		{
			$champs = array(); 
			$donnees = array(); 
			foreach ($where as $cle=>$valeur)
			{
				$champs[] = $cle . "= :".$cle; //nom de colonne: nom = :nom
				$donnees[":".$cle]= $valeur; // valeur 
			}
			$chaineWhere = implode("  and ", $champs);// nom = :nom and prenom = :prenom and ...
			$requete ="select ".$chaine." from  ".$this->uneTable." where ".$chaineWhere;

			//print_r($champs);
			$select = $this->pdo->prepare ($requete); 
			$select->execute($donnees); //remplace :nom = valeur
			return $select->fetch ();
		}
		public function insert ($tab){
			$champs = array(); 
			$nomChamps = array(); 
			$donnees = array(); 
			foreach ($tab as $cle=>$valeur)
			{
				$champs[] = ":".$cle; 
				$nomChamps[] = $cle;
				$donnees[":".$cle]= $valeur; 
			}
			$chaine = implode(",", $champs); 
			$chaineNomChamps = implode(",", $nomChamps); 
			$requete ="insert into "
					.$this->uneTable
					." (".$chaineNomChamps.") "
					." values(".$chaine.");"; 

			//echo $requete ;
			//print_r($donnees);  

			$insert = $this->pdo->prepare($requete); 
			$insert->execute($donnees); 
		}
		public function update ($tab, $where){
			$champs = array(); 
			$donnees = array(); 
			foreach ($tab as $cle=>$valeur)
			{
				$champs[] = $cle . " = :".$cle; 
				$donnees[":".$cle]= $valeur; 
			}
			$chaine = implode(",", $champs);

			$champsWhere =array(); 
			foreach ($where as $cle=>$valeur)
			{
				$champsWhere[] = $cle." = :".$cle; 
				$donnees[":".$cle]= $valeur; 
			}
			$chaineWhere = implode("  and  ", $champsWhere);

			$requete ="update ".$this->uneTable." set ".$chaine ." where ".$chaineWhere;
			$update = $this->pdo->prepare($requete); 
			$update->execute($donnees); 
		}

		public function delete ($where)
		{
			$champs = array(); 
			$donnees = array(); 
			foreach ($where as $cle=>$valeur)
			{
				$champs[] = $cle." = :".$cle; 
				$donnees[":".$cle]= $valeur; 
			}
			$chaine = implode("  and  ", $champs);

			$requete ="delete from   ".$this->uneTable."  where ".$chaine ;
			$delete = $this->pdo->prepare($requete); 
			$delete->execute($donnees);
		}

		public function selectSearch($tab, $mot)
		{
			$donnees =array(); 
			$champs=array(); 
			foreach ($tab as $cle) {
				$champs[] = $cle." like :mot"; 
				$donnees[":mot"] = "%".$mot."%"; 
			}
			$chaineWhere =implode(" or ", $champs); 
			$requete = "select * from ".$this->uneTable." where ".$chaineWhere;
			$select = $this->pdo->prepare($requete); 
			$select->execute($donnees);
			return $select->fetchAll(); 
		}
	
		public function count()
		{
			$requete="select count(*) as nb from ".$this->uneTable;
			$select=$this->pdo->prepare($requete);
			$select->execute();
			//retourner un entier et non un tableu
			return $select->fetch()["nb"]; 
		}

		public function verifiAge()
		{
			$requete="select age_limit from ".$this->uneTable;
			$select=$this->pdo->prepare($requete);
			$select->execute();
			//retourner un entier et non un tableu
			return $select->fetch()["age_limit"]; 
		}
		
	}
?>




















<?php 
        
      
        try 
    {
        $GLOBALS['bdd'] = new PDO("mysql:host=mysql-desenclos.alwaysdata.net;dbname=desenclos_robot;charset=utf8", "desenclos", "sqK8ZUWxuvEpp!y");

        
    }
    catch(PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }
       

    
?>
<?php 
        
      
        try 
    {
        $GLOBALS['bdd'] = new PDO("mysql:host=192.168.65.102:3306;dbname=desenclos_robot;charset=utf8", "user", "user");

        
    }
    catch(PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }
       

    
?>
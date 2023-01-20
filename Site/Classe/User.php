<?php

    class User
    {
        private $id_;
        private $identifiant_;
        private $password_;

        public function __construct($Newid, $Newidentifiant, $Newpassword)
        {
            $this->id_ = $Newid;
            $this->identifiant_ = $Newidentifiant;
            $this->password_ = $Newpassword;
        }

        public function connexion($identifiant, $password)
        {
           
            $verif = " SELECT * FROM user WHERE identifiant='".$identifiant."' AND password ='".$password."'";
            $resultat = $GLOBALS['bdd'] -> query($verif);

          

            return $resultat;
        }
        
        public function deconnexion()
        {
            session_unset();
            session_destroy();

        }
    }
?>
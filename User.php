
<?php

class User
{

    private $_email;
    private $_nom;
    private $_prenom;
    private $_promo;
    private $_id;

    public function requestUserData($email,$bdd){
        $req = $bdd->prepare('SELECT id, password,nom, prenom, email,promo,statue FROM user WHERE email = :email');
        $req->execute(array(
            'email' => $email));
        return $req->fetch();
    }

    public function makeConnection($email,$bdd,$password){
        $resultat=$this->requestUserData($email,$bdd);
        if($resultat){
            $isPasswordCorrect = password_verify($password, $resultat['password']);
            if ($isPasswordCorrect) {
                $this->setAllUserData($resultat['nom'],$resultat['email'],$resultat['prenom'],$resultat['promo']
                ,$bdd);
                return true;
            }
            else {
                return false;
            }
        }else{
            return false;
        }
    }

    public function isertUserInTable($nom,$email,$prenom,$promo,$password,$bdd){
        $sql = "INSERT   user (nom, prenom, email, password, token,promo) VALUES(?,?,?,?,?,?)";
        $token=md5(time().$nom);
        $stmtinsert = $bdd->prepare($sql);
        $result = $stmtinsert->execute([$nom, $prenom, $email, $password,$token,$promo]);
        return $result;

    }

    public function createNewUser($nom,$email,$prenom,$promo,$password,$bdd){

            if($this->requestUserData($email,$bdd)){

                return false;

            }else{
                $result=$this->isertUserInTable($nom,$email,$prenom,$promo,$password,$bdd);
                if($result){

                    $this->setAllUserData($nom,$email,$prenom,$promo,$bdd);
                    return true;

                }else{

                    return false;
                }

            }

    }
    public function isertNewMobilite($bdd,$ville, $pays, $date_debut, $date_fin,$statue){
        $sql = "INSERT   demande_mobilite (ville, pays, date_debut, date_fin, id_personne,statue,nom,promo) VALUES(?,?,?,?,?,?,?,?)";
        $stmtinsert = $bdd->prepare($sql);
        $result = $stmtinsert->execute([$ville, $pays, $date_debut, $date_fin,$this->getId(),$statue,$this->getNom(),$this->getPromo()]);

        return $result ?true:false;
    }

    public function getUserMobilite($bdd,$id_personne){
        $req = $bdd->prepare('SELECT * FROM demande_mobilite WHERE id_personne = :id_personne');
        $req->execute(array(
            'id_personne' => $id_personne
        ));
        return $req;
    }

    public function setAllUserData($nom,$email,$prenom,$promo,$bdd){
        $this->setEmail($email);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setPromo($promo);
        $this->setId($this->getUserId($email,$bdd));

    }

    public function getUserId($email,$bdd){
        $result=$this->requestUserData($email,$bdd);
        return $result['id'];
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->_nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->_nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->_prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->_prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getPromo()
    {
        return $this->_promo;
    }

    /**
     * @param mixed $promo
     */
    public function setPromo($promo)
    {
        $this->_promo = $promo;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    public  function getStatus($email,$bdd){
        $result=$this->requestUserData($email,$bdd);
        return $result['statue'];
    }

}

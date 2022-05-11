<?php


namespace cms\Test\Model;


use Engine\Model\Model;

class TestRepository extends Model
{
    protected $table = 'users';
    protected $orderList = 'name';

    /**
     * @param $login
     * @return mixed
     */
    public function getUserLogin($login)
    {
        return $this->db->query("SELECT * FROM users WHERE username = '".$login."'");
    }

    /**
     * @param $testID
     * @return mixed
     */
    public function getTest($testID)
    {
        return $this->db->query("SELECT * FROM onlinetests WHERE id = $testID");
    }

    /**
     * @param $testID
     * @param false $randomize
     * @param int $limit
     * @return mixed
     */
    public function  getQuestions($testID, $randomize = false, $limit = 0)
    {
        if ($randomize == true) {
            $order = "ORDER BY RAND()";
        } else {
            $order = "ORDER BY id";
        }
        if ($limit > 0) {
            $limitSQL = " LIMIT $limit";
        } else {
            $limitSQL = "";
        }

        return $this->db->query("SELECT * FROM onlinequest WHERE idtest = $testID AND published > 0 $order $limitSQL");
    }

    /**
     * @param $questID
     * @param false $randomize
     * @return mixed
     */
    public function getAnswers($questID, $randomize = false)
    {
        if ($randomize == true) {
            $order = "ORDER BY RAND()";
        } else {
            $order = "ORDER BY id";
        }

        return $this->db->query("SELECT * FROM onlineanswer WHERE idquest = $questID $order");
    }

    /**
     * @param $userID
     * @return mixed
     */
    public function getResult($userID)
    {
        return $this->db->query("SELECT * FROM result_test WHERE idus = $userID");
    }

    /**
     * @param $endTime
     * @param $userID
     * @return mixed
     */
    public function setTimeUser($endTime, $userID)
    {
        $sql = "UPDATE $this->table SET datetest='$endTime' WHERE id = ". $userID;

        return $this->db->query($sql);
    }

    /**
     * @param $idus
     * @param $idTest
     * @param $questID
     * @param $answerID
     * @param $questions
     * @param $answers
     * @param $trues
     */
    public function setResult($idus, $idTest, $questID, $answerID, $questions, $answers, $trues)
    {
        $this->db->query("INSERT INTO result_test (idus, idtest, idquest, idansw, question, answer, trues) VALUES ('$idus', '$idTest', '$questID', '$answerID', '$questions', '$answers', '$trues')");
    }

    /**
     * @param $userBalls
     * @param $testingUser
     * @param $idus
     */
    public function setUserTesting($userBalls, $testingUser, $idus)
    {
        $time = time();

        $this->db->query("UPDATE users SET  lastvisitDate='$time', block=0, result='$userBalls', testinguser='$testingUser', testingstatus=1    WHERE  id = $idus");
    }

    public function getCountQuestions($testID)
    {
        return $this->db->query("SELECT COUNT(*) as kol FROM onlinequest WHERE idtest = $testID AND published > 0");
    }
}
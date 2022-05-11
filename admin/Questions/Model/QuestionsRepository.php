<?php


namespace admin\Questions\Model;


use Engine\Model\Model;

class QuestionsRepository extends Model
{
    protected $table = 'onlinequest';
    protected $orderList = 'title';

    public function createQeustions($data)
    {
        $values = '';
        $valuesData = '';

        foreach ($this->dataFields as $item) {
            if (strlen($data[$item]) > 0) {
                if (is_numeric($data[$item])) {
                    $values .= $item . ",";
                    $valuesData .= "" . $data[$item] . ",";
                } else {
                    $values .= $item . ",";
                    $valuesData .= "'" . $data[$item] . "',";
                }
            }
        }
        $values = mb_substr($values, 0, -1);
        $valuesData = mb_substr($valuesData, 0, -1);

        $this->db->query("INSERT INTO $this->table ($values) VALUES ($valuesData)");

        if ($this->config['PDO_DRIVER'] == 'mysql') {
            return $this->db->query("SELECT LAST_INSERT_ID() as lastID")[0]->lastID;
        }
    }

    public function updateQuestions($data)
    {
        $values = '';

        foreach ($this->dataFields as $item) {
            if (strlen($data[$item]) > 0 && $item <> 'id') {
                if (is_numeric($data[$item])) {
                    $values .= " $item=" . $data[$item] . ",";
                } else {
                    $values .= " $item='" . $data[$item] . "',";
                }
            }
        }
        $values = mb_substr($values, 0, -1);
        $sql = "UPDATE $this->table SET  $values WHERE id = ". $data['id'];

        return $this->db->query($sql);
    }

    public function getAnswersList($idQuestions)
    {
        return $this->db->query("SELECT * FROM onlineanswer  WHERE idquest = $idQuestions");
    }

    public function findAnswerBase($questionID, $answerID)
    {
        return $this->db->query("SELECT COUNT(id) as counts FROM onlineanswer  WHERE idquest = $questionID AND id = $answerID")[0]->counts;
    }


    public function createAnswers($questionID, $title, $trues)
    {
        $this->db->query("INSERT INTO onlineanswer (title, idquest, trues) VALUES ('$title', $questionID, $trues)");
    }

    public function updateAnswers($questionID, $title, $trues, $answerID)
    {
        $sql = "UPDATE onlineanswer  SET title= '$title', idquest=$questionID, trues=$trues   WHERE id = $answerID";

        return $this->db->query($sql);
    }

    public function deleteAnswer($id)
    {
        $id = trim(htmlspecialchars(stripcslashes($id)));

        if (strlen($this->table) > 0 && intval($id) <> 0) {
            $this->db->query("DELETE FROM onlineanswer WHERE id = $id");
        }
    }
}
<?php
//
//
//namespace Engine\Logs;
//
//use Engine\Controller\Controller;
//use Engine\DI\DI;
//
//class Logs extends Controller
//{
//    private $id_user;
//    private $dateTime;
//
//    /**
//     * Logs constructor.
//     * @param DI $di
//     */
//    public function __construct(DI $di)
//    {
//        parent::__construct($di);
//
//        $this->dateTime = time();
//
//        if (isset($this->request->session['id'])) {
//            $this->id_user = $this->request->session['id'];
//        }
//    }
//
//    /**
//     * @param $userID
//     */
//    public function logIn($comments, $userID, $sudirID, $sudirLogin, $sudirRoles)
//    {
//        $this->id_user = $userID;
//
//        $this->save('logIn', $comments, '', '', $sudirID, $sudirLogin, $sudirRoles);
//    }
//
//    /**
//     *
//     */
//    public function logOut($sudirID, $sudirLogin, $sudirRoles)
//    {
//        $this->id_user = $this->request->session['id'];
//
//        $this->save('logOut','', '', '', $sudirID, $sudirLogin, $sudirRoles);
//    }
//
//    /**
//     * @param $comments
//     */
//    public function updateBase($comments, $arrayData, $sudirID, $sudirLogin, $sudirRoles)
//    {
//        $this->save('updateBase', $comments, '', $arrayData, $sudirID, $sudirLogin, $sudirRoles);
//    }
//
//    /**
//     * @param $comments
//     * @param $id
//     * @param $title
//     */
//    public function dropProject($comments, $id, $title)
//    {
//        $this->save('dropProject', $comments, $id, $title);
//    }
//
//    /**
//     * @param $comments
//     * @param $id
//     * @param $title
//     */
//    public function addUser($id, $actions,  $comments, $params, $title, $sudirID, $sudirLogin, $sudirRole)
//    {
//        $title = json_encode($title);
//
//        return $this->db->query(
//            "INSERT INTO users_log
//                  (id_user, actions, comments, params, titlemessage, user_id, user_login, user_role)
//                      VALUES
//                  ('$id', '$actions', '$comments', '$params', '$title', '$sudirID', '$sudirLogin', '$sudirRole')"
//        );
//    }
//
//    /**
//     * @param $comments
//     * @param $id
//     * @param $title
//     */
//    public function editUser($comments, $id, $title)
//    {
//        $this->save('EditUser', $comments, $id, $title);
//    }
//
//    /**
//     * @param $comments
//     * @param $id
//     * @param $title
//     */
//    public function dropUser($comments, $id, $title)
//    {
//        $this->save('DropUser', $comments, $id, $title);
//    }
//
//    /**
//     * @param $comments
//     * @param $id
//     * @param $title
//     */
//    public function addLike($comments, $id, $title)
//    {
//        $this->save('like', $comments, $id, $title);
//    }
//
//    /**
//     * @param $comments
//     * @param $id
//     * @param $title
//     */
//    public function addDislike($comments, $id, $title)
//    {
//        $this->save('dislike', $comments, $id, $title);
//    }
//
//    /**
//     * @param $comments
//     * @param $title
//     */
//    public function saveTemplatePost($comments,  $title)
//    {
//        $this->save('templateEditPost', $comments, '', $title);
//    }
//
//    /**
//     * @param $title
//     */
//    public function saveSettingPost($title)
//    {
//        $this->save('saveSettingPost', '', '', $title);
//    }
//
//    /**
//     * @param $title
//     */
//    public function sendMailing($title)
//    {
//        $this->save('sendMailing', '', '', $title);
//    }
//
//    /**
//     * @param $actions
//     * @param string $comments
//     * @param string $params
//     * @param string $title
//     * @return mixed
//     */
//    private function save($actions, $comments = '', $params = '', $title = '', $sudirID = '', $sudirLogin = '', $sudirRole = '')
//    {
//        $title = json_encode($title);
//
//        return $this->db->query(
//            "INSERT INTO users_log (id_user, actions, comments, params, titlemessage, user_id, user_login, user_role) VALUES ('$this->id_user', '$actions', '$comments', '$params', '$title', '$sudirID', '$sudirLogin', '$sudirRole')"
//        );
//    }
//
//}
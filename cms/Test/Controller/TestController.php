<?php


namespace cms\Test\Controller;


use Engine\Auth\Auth;
use Engine\Controller\Controller;
use Engine\DI\DI;

class TestController extends Controller
{
    private $userObj;
    private $userLogin = '';
    private $userFIO = '';
    private $userBlock = 1;
    private $userAccess = 1;
    private $userActivation = 0;
    private $userTestStatus = 0;
    private $userDateTest = '';
    private $userTestID = 0;
    private $userStartTimeTest = 0;
    private $userAuth = false;

    private $testObj;
    private $limitQuestions = 0;
    private $minuteLimit = 0;
    private $testAccess = 0;
    private $testPublic = 0;
    private $questRandom = false;
    private $answerRandom = false;
    private $questionsData = [];
    private $countQuestions = 0;
    private $lang = 'ru';
    private $langOption = [];

    private $auth;

    /**
     * TestController constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);

        $this->checkAuthorization();
        $this->auth = new Auth();

        if (isset($this->request->session['userID'])) {
            $userID = $this->request->session['userID'];
            $this->setUserData($userID);
        }
    }

    /**
     *
     */
    public function index()
    {
        if (isset($this->request->session['authorized'])) {
            header('Location: ' . \Core_LinkProxy::getLink() . '/profile/', true, 301);
            exit;
        }

        $this->showPageLogin();
    }

    /**
     * authorize user
     */
    public function logIn()
    {
        $login = trim(htmlspecialchars(stripcslashes($this->request->post['login'])));
        $userData = $this->loadModel->repository->getUserLogin($login)[0];

        if (count($userData) > 0) {
            $this->userAuth = true;

            $this->userObj = $userData;
            $token = base64_encode($userData->username . $userData->id);
            $this->auth->authorize($token, $userData->username, $userData->id, $userData->level);
            header('Location: ' . \Core_LinkProxy::getLink() . '/profile/', true, 301);
            exit;
        } else {
            $this->userAuth = false;
            $this->showPageError();
        }
    }

    /**
     * un authorize user
     */
    public function logOut()
    {
        $this->auth->unAuthorize();
        header('Location: ' . \Core_LinkProxy::getLink() . '/', true, 301);
        exit;
    }

    /**
     * check test authorize user
     */
    public function checkAuthorization()
    {
        if (!isset($this->request->session['authorized']) &&
            $this->request->server['REQUEST_URI'] !== '/' &&
            !isset($this->request->post['authrorizated']) &&
            !isset($this->request->get['lang'])) {
            header('Location: ' . \Core_LinkProxy::getLink() . '/', true, 301);
            exit;
        }
    }

    /**
     * show page profile
     */
    public function profile()
    {
        $this->setTestData();
        $this->showPageProfile();
    }

    /**
     * access page testing
     */
    public function testing()
    {
        $this->setTestData();
        $this->setTimeStart();

        if ($this->userBlock > 0 || $this->testPublic == 0 || intval($this->userObj->result) > 0) {
            header('Location: ' . \Core_LinkProxy::getLink() . '/profile/', true, 301);
            exit;
        }

        $this->setQuestionsData();
        $this->showPageTest();
    }

    /**
     * result test save
     */
    public function results()
    {
        if (isset($this->request->session['userID']) && strlen($this->request->session['userID']) > 0) {
            $userID = $this->request->session['userID'];
            $testID = $this->loadModel->repository->getTest($this->userTestID)[0]->id;
        } else {
            $userID = $this->request->post['userID'];
            $testID = $this->request->post['testID'];
        }
        $usersBalls = 0;
        $testConfig = $this->loadModel->repository->getTest($testID)[0];
        $userConfig = $this->loadModel->repository->getList('id:' . $userID)[0];

        if (intval($userConfig->result) <= 0) {
            foreach ($this->request->post['questions'] as $key => $item) {
                $qestionArray = explode('|', $item);
                $answerArray = explode('|', $this->request->post['answer'][$key]);
                if (strlen($answerArray[0]) > 0) {
                    $questionID = $qestionArray[0];
                    $questionTitle = $qestionArray[1];
                    $answerID = $answerArray[0];
                    $answerTitle = $answerArray[1];
                    $truesArray = explode('|', base64_decode($answerArray[2]));
                    if (intval($truesArray[0]) > 0) {
                        $usersBalls++;
                    }

                $this->loadModel->repository->setResult($userID, $testID, $questionID, $answerID, $questionTitle, $answerTitle, $truesArray[0]);
                }
            }

            if ($usersBalls >= $testConfig->bally) {
                $testingUser = 2;
            } else {
                $testingUser = 1;
            }
            $this->loadModel->repository->setUserTesting($usersBalls, $testingUser, $userID);
        }

        header('Location: ' . \Core_LinkProxy::getLink() . '/profile/', true, 301);
        exit;
    }

    /**
     * show page login
     */
    private function showPageLogin()
    {
        if (isset($_GET['lang'])) {
            $lang = trim(htmlspecialchars(stripcslashes($_GET['lang'])));
            if (mb_strtolower($lang) == 'kz') {
                $data['langOption'] = $this->getLanguage('kz');
            } elseif (mb_strtolower($lang) == 'ru') {
                $data['langOption'] = $this->getLanguage('ru');
            }
        } else {
            $data['langOption'] = $this->getLanguage('ru');
        }

        $this->view->render($this->class . '/login', $data);
    }

    /**
     * show page profile
     */
    private function showPageProfile()
    {
        if (intval($this->userObj->testingstatus) > 0) {
            $data['results'] = $this->loadModel->repository->getResult($this->userObj->id);
        }

        $data['langOption'] = $this->langOption;
        $data['user'] = $this->userObj;
        $data['test'] = $this->testObj;

        if (intval($this->testObj->kol_quest) > 0) {
            $data['countTest'] = $this->testObj->kol_quest;
        } else {
            $data['countTest'] = $this->loadModel->repository->getCountQuestions($this->testObj->id)[0]->kol;
        }
        $data['countQuestions'] = $this->countQuestions;

        $this->view->render($this->class . '/profile', $data);
    }

    /**
     * show page test
     */
    private function showPageTest()
    {
        $useDateEndTest = intval($this->loadModel->repository->getList('id:' . $this->request->session['userID'])[0]->datetest);
        $data['timecount'] = intval($useDateEndTest) - time();
        $data['langOption'] = $this->langOption;
        $data['userDateTest'] = date('d-m-Y', $this->userDateTest);
        $data['user'] = $this->userObj;
        $data['test'] = $this->testObj;
        $data['questions'] = $this->questionsData;
        $data['countQuestions'] = $this->countQuestions;


//        var_dump($useDateEndTest);
//        var_dump($data['timecount']);
        $this->view->render($this->class . '/test', $data);
    }

    /**
     * show page error
     */
    private function showPageError()
    {
        if (isset($_GET['lang'])) {
            $lang = trim(htmlspecialchars(stripcslashes($_GET['lang'])));
            if (mb_strtolower($lang) == 'kz') {
                $data['langOption'] = $this->getLanguage('kz');
            } elseif (mb_strtolower($lang) == 'ru') {
                $data['langOption'] = $this->getLanguage('ru');
            }
        } else {
            $data['langOption'] = $this->getLanguage('ru');
        }

        $this->view->render($this->class . '/loockscreen', $data);
    }

    /**
     * @param $userID
     */
    private function setUserData($userID)
    {
        $this->userObj = $this->loadModel->repository->getList('id:' . $userID)[0];
        $this->userLogin = $this->userObj->username;
        $this->userFIO = $this->userObj->name;
        $this->userBlock = intval($this->userObj->block);
        $this->userAccess = intval($this->userObj->level);
        $this->userActivation = intval($this->userObj->activation);
        $this->userTestStatus = intval($this->userObj->testingstatus);
        $this->userDateTest = $this->userObj->lastvisitDate;
        $this->userTestID = $this->userObj->groups;
    }

    /**
     * @param string $lang
     * @return mixed
     */
    private function getLanguage($lang = '')
    {
        if (mb_strtolower($this->lang) == 'kz' || mb_strtolower($lang) == 'kz') {
            $lang = 'KZ';
        } else {
            $lang = 'RU';
        }
        $path = __DIR__ . '/../Lang/' . $lang . '/interface.php';
        $langOption = require_once $path;

        return $langOption;
    }

    /**
     * set data test
     */
    private function setTestData()
    {
        $this->testObj = $this->loadModel->repository->getTest($this->userTestID)[0];

        if (intval($this->testObj->questrandom) == 1) {
            $this->questRandom = true;
        } else {
            $this->questRandom = false;
        }
        if (intval($this->testObj->answerrandom) == 1) {
            $this->answerRandom = true;
        } else {
            $this->answerRandom = false;
        }
        if (intval($this->testObj->kol_quest) > 0) {
            $this->limitQuestions = intval($this->testObj->kol_quest);
        } else {
            $this->limitQuestions = 0;
        }
        if (intval($this->testObj->time_quest) > 0) {
            $this->minuteLimit = intval($this->testObj->time_quest);
        } else {
            $this->minuteLimit = 0;
        }
        $this->testAccess = intval($this->testObj->access);
        $this->testPublic = intval($this->testObj->published);
        $this->langOption = $this->getLanguage($this->testObj->language);
    }

    /**
     * set data questions
     */
    private function setQuestionsData()
    {
        $questions = $this->loadModel->repository->getQuestions($this->userTestID, $this->questRandom, $this->limitQuestions);

        foreach ($questions as $key => $item) {
            $answer = $this->loadModel->repository->getAnswers($item->id, $this->answerRandom);
            $questions[$key]->answer = $answer;
        }

        $this->questionsData = $questions;
        $this->countQuestions = count($this->questionsData);
    }

    /**
     * set time start
     */
    private function setTimeStart()
    {
        $nowTime = time();
        $endTime = $nowTime + ($this->minuteLimit * 60);
        $this->userStartTimeTest = $endTime;

        if (intval($this->userObj->datetest) <=0) {
            $this->loadModel->repository->setTimeUser($endTime, $this->userObj->id);
        }
    }
}
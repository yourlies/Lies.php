<?php
namespace Layout;

class Board extends \LiesController {
  public function __construct () {
    parent::__construct();
  }
  public function index () {
    include(ROOT_PATH . '/m/Test.php');
    $comments = json_decode(file_get_contents(ROOT_PATH . '/store/comments.txt'), true);
    if (!is_array($comments)) {
      $comments = [];
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (!trim($_POST['content'])) {
        echo 'content error';
        return false;
      }
      if (!trim($_POST['nickname'])) {
        echo 'nickname error';
        return false;
      }
      if (!trim($_POST['email'])
        || !preg_match('/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/', $_POST['email'])) {
        echo 'email error';
        return false;
      }
      $comment['content'] = $_POST['content'];
      $comment['nickname'] = $_POST['nickname'];
      $comment['email'] = $_POST['email'];
      $comment['website'] = $_POST['website'];

      $co = fopen(ROOT_PATH . '/store/comments.txt', 'w+');
      array_unshift($comments, $comment);
      fwrite($co, json_encode($comments));
      fclose($co);
      foreach ($comments as $key => $value) {
        $comments[$key]['email'] = hash('md5', $comments[$key]['email']);
      }
      echo json_encode($comments);
      return false;
      // $model->query("INSERT INTO comments VALUES(null, '" . implode("','", $comment) . "')");
      // $res = $model->query('SELECT * FROM comments ORDER BY id DESC LIMIT 10');
      // mysqli_close($model);
      // $comments = $res->fetch_all();
      // foreach ($comments as $key => $value) {
        // $comments[$key][3] = hash('md5', $comments[$key][3]);
      // }
      // echo json_encode($comments);
      // return false;
    }
    // $res = $model->query('SELECT * FROM comments ORDER BY id DESC LIMIT 10');
    // $comments = $res->fetch_all();
    
    mysqli_close($model);
    $this->render('/Board/index');
  }
  public function selectComments () {
    $comments = json_decode(file_get_contents(ROOT_PATH . '/store/comments.txt'), true);
    foreach ($comments as $key => $value) {
      $comments[$key]['email'] = hash('md5', $comments[$key]['email']);
    }
    echo json_encode($comments);
  }
}
<?php
require_once("../../root.php");
class Connection {
  public function send($port, $value = true) {
    echo $this->saveLog('Chamando o raspberry...');
    if ($value) {
      echo $this->saveLog('Ligando porta ' . $port);
      shell_exec($this->getCommand('acender.py') . " {$port}");
    } else {
      echo $this->saveLog('Desligando porta ' . $port);
      shell_exec($this->getCommand('apagar.py') . " {$port}");
    }
  }

  public function getCommand($program) {
    $path = $this->getPath();
    return 'sudo python ' . $path . $program;
  }

  public function getPath() {
    global $root;
    return $root . DIRECTORY_SEPARATOR . 'raspberry' . DIRECTORY_SEPARATOR;
  }


  public function saveLog($message) {
    $message = $this->actionLog($message);
    shell_exec('echo ' . $message . ' >> ' . $this->getPath() . 'log.txt');
  }

  public function actionLog($message) {
    $program = "SMARTHOUSE";
    $date = date('Y-m-d h:i:s');

    return "{$program} - {$date} - {$message}"; 
  }
}

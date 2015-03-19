<?php 
class Templater {
  var $currentTemplate;
  var $templatePath;
  var $flash;
  var $logged;
  var $title;

  public function Templater($title = "") {
    $this->templatePath = $_SERVER['DOCUMENT_ROOT']."/templates/";
    $this->logged = false;
    $this->title = $title;
  }

  public function render($flash = false){
    $this->errorHandler();

    $this->flash = $flash;
    $this->getHeader();
    $this->callTemplate($this->currentTemplate);
    $this->getFooter();

  }

  public function setTemplate($template){
    $this->currentTemplate = $template;
  }

  private function callTemplate($template) {
    require($this->templatePath.$template.".inc.php");
  }

  private function getHeader() {
    $this->callTemplate("header");
  }

  private function getFooter() {
    $this->callTemplate("footer");
  }

  private function errorHandler(){
    if (!is_file($this->templatePath.$this->currentTemplate.".inc.php"))
      throw new Exception("Template doesnt exist");
    elseif(!isset($this->currentTemplate)) 
      throw new Exception("No template has been selected");
    else return true;
  }

}

?>


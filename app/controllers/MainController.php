<?php
class MainController
{
    private static $handler;

    public static function main($handler) {
        self::$handler = $handler;
        $url = $GLOBALS["request"]->getUrl()->getString();
        if($url == "/add/submit") {
            self::submit();
        }
        if($url == "/add" || $url == "/view") {
            self::list();
        }
    }

    public static function submit() {
        db::query("INSERT INTO events (USER, `TEXT`, DATE_FROM, DATE_TO)
        VALUES (?,?,FROM_UNIXTIME(?),FROM_UNIXTIME(?))", array($GLOBALS["auth"]->user("name"), $_GET["text"], substr_replace($_GET["date_from"], "", -3), substr_replace($_GET["date_to"], "", -3)));
        redirect('/add');
     //   dump($_GET);
       // dump(strtotime($_GET["date_from"]));
//        if($GLOBALS["request"]->workWith("GET", ["date_from", "date_to", "text"])) {
         /*   $event = db::count("SELECT COUNT(*) WHERE
            `DATE_FROM` BETWEEN FROM_UNIXTIME(?) AND FROM_UNIXTIME(?) OR
            `DATE_TO` BETWEEN FROM_UNIXTIME(?) AND FROM_UNIXTIME(?) OR
            FROM_UNIXTIME(?) BETWEEN `DATE_FROM` AND `DATE_TO` OR
            FROM_UNIXTIME(?) BETWEEN `DATE_FROM` AND `DATE_TO`
            ", array($_GET["date_from"], $_GET["date_to"], $_GET["date_from"], $_GET["date_to"], $_GET["date_from"], $_GET["date_to"]));
            dump($event);
            exit();
   /*     } else {
            $_SESSION["ERROR"] = "Zadejte všechny hodnoty.";
            redirect('/add');
        }*/
    }

    public static function list() {
        self::$handler::setParameters([
            'events'=>db::multipleSelect("SELECT * FROM events"),
        ]);
    }
}

<?php
// apiGroup create route /api/version/route
//TODO delte insecure routes

Route::apiGroup("v1", array(
    // /api/v1/list
    array("list", function(){
        echo "list";
    }),
    
    array("getlatestversion", function() {
        echo "0.2.4";
    }),

    array("getposts", function () {
        //dump("test");
        echo json(json_encode(Post::listPosts()));
    }),

    array("getposts/{TOPIC}", function () {
        //dump("test");
        echo json(json_encode(Post::listPosts(Route::getValue('TOPIC'))));
    }),

    array('server', function () {
        dump($_SERVER);
    }),

    array('sleep', function () {
        sleep(1);
    }),

    array('getTitle/{ID}', function() {
        echo Post::getTitle(Route::getValue("ID"));

    }),

    array('getheaders', function () {
        foreach (getallheaders() as $name => $value) {
            echo "$name: $value<br>";
        }
    }),

    array('pagination', function () {
        $data = array(
            1,2,3,4,5,6,7,8,9,10
        );
        $p = new Pagination($data, 3);
        foreach ($p->getData() as $d) {
            echo "$d<br>";
        }

        echo "Current: {$p->currentPage()}<br>";
        echo "Total: {$p->totalPages()}<br>";
        if($p->previousPage() !== false) {
            echo "<a href='?page={$p->previousPage()}'>Previous page</a>";
        }
        if($p->nextPage() !== false) {
            echo "<a href='?page={$p->nextPage()}'>Next page</a>";
        }
    }),


    array('request', function () {
        echo $GLOBALS["request"]->getUrl()->getString();
        echo "<br>";
        echo $GLOBALS["request"]->getQuery();
        echo "<br>";
        echo $GLOBALS["request"]->getQuery('xd');
        echo "<br>";
        echo var_dump($GLOBALS["request"]->getPost());
        echo "<br>";
        echo $GLOBALS["request"]->getPost('xd');
        echo "<br>";
        echo $GLOBALS["request"]->getMethod();
        echo "<br>";
        echo var_dump($GLOBALS["request"]->isMethod('post'));
        echo "<br>";
        echo $GLOBALS["request"]->getHeader('user-agent');
        echo "<br>";
        echo var_dump($GLOBALS["request"]->getHeaders());
        echo "<br>";
        echo var_dump($GLOBALS["request"]->getReferer());
        echo "<br>";
        echo var_dump($GLOBALS["request"]->isSecured());
        echo "<br>";
        echo var_dump($GLOBALS["request"]->isAjax());
        echo "<br>";
        echo $GLOBALS["request"]->getRemoteAddress();
        echo "<br>";
        echo var_dump($GLOBALS["request"]->detectLanguage(array("en", "sk", "cz")));
        echo "<br>";
        echo var_dump($GLOBALS["request"]->workWith('GET', ['xd', 'lel']));
        echo "<br>";
        echo var_dump($GLOBALS["request"]->getMostPreferredLanguage());
    }),

    array('username', function() {
        echo "Username: ". $GLOBALS["auth"]->user('name');
    }),

    array('someerror', function() {
        require(rand(0,1000).".php");
    }),

    array('dump', function() {
        $random = "X";
        dump(get_defined_vars(), false);
        dump($random, false);
        dump(null, false);
        dump(false, false);

    }),

));

Route::apiGroup("v2", array(
    // /api/v1/list
    array("edit/post", function(){
        echo "edit post";
    }),
    
));
Route::setApiMiddleware("v2", ["AuthMiddleware"]);

Route::apiGroup("v3", array(
    // /api/v1/list
    array("edit/post/{ID}", function () {
        //echo "edit post " . Route::getValue("ID");
        error(403);
    }),

    array("view/post/{ID}", function () {
        return [
            "action" => "view-post",
            "id" => Route::getValue('ID')
        ];
    }),

    array("delete/post/*", function () {
        echo "delete post";
    }),
    array("templatefile", "home.php"),
));
Route::setApiEndpoint("v3", new API("v3"));


Route::apiGroup("v4", array(
    array('<action>/*', function () {
        echo Route::getRouteAction();
    }),
    array('convert-route', function() {
        echo Route::convertRoute("/route-test/parameter/ALEDX/10/XD");
    }),
    array('strict-types', function() {
        $x = new URL(array(),"xd");
        echo $x->getString();
    })
));

Route::apiGroup("v5", array(
    array('x/*'),
    array('e/*', null, null, null, "login"),
    array(
        "route" => "alex/{name}/{action}",
        "files" => null,
        "lock" => null,
        "required_params" => null,
        "action" => "login",
        "alias" => "alex"
    ),
    array('<action>/{ID}/{NAME}'),
    array('<action>/*', null, [], [["id", "name"], [], 400], "test"),
));

Route::setApiController("v5", "V5Contoller");
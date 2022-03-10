<?php
#require __DIR__."/controllers/";

class Routes
{

    public array $dict;

    public function __construct()
    {
        $this->dict = array(
            /*
             * Routes for the application
             */
            "get" => [
                "/" => "home",
                "/home" => function() {
                    echo "Welcome home";
                }

            ],

            "post" => [


            ]
        );
    }

}
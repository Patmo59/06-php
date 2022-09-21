<?php
define("ROUTES", [
    "06-poo" =>[
        "controller" =>"userController",
        "fonction"=>"read"
    ],
    "06-poo/inscription" =>[
        "controller" =>"userController",
        "fonction"=>"create"
    ],
    "06-poo/user/update" =>[
        "controller" =>"userController",
        "fonction"=>"update"
    ],
    "06-poo/user/delete" =>[
        "controller" =>"userController",
        "fonction"=>"delete"
    ],
]);
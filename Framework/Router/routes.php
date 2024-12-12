<?php

        $router->get('/',"HomeController","index");

        $router->get('/books', "ListController", "index");
        $router->get('/books/show', "ActionsController", "show");
        $router->get('/books/edit/{id}', "ActionsController", "showEdit");
        $router->get('/books/{id}', "ListController", "show");

        $router->get('/login', "AuthController", "login");
        $router->get('/register', "AuthController", "register");

        $router->post('/books/create', "ActionsController", "create");
        $router->post('/books/edit', "ActionsController", "edit");
        $router->post('/books/delete/{id}', "ActionsController", "delete");

        $router->post('/login', "AuthController", "login");
        $router->post('/register', "AuthController", "register");
        $router->get('/logout', "AuthController", "logout");
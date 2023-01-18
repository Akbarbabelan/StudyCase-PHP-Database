<?php

require_once "../Entity/TodoList.php";
require_once "../Repository/TodoListRepository.php";
require_once "../Service/TodoListService.php";
require_once "../Config/Database.php";

use Entity\TodoList;
use Service\TodoListServiceImpl;
use Repository\TodoListRepositoryImpl;

function testShowTodoList(): void
{
    $connection = Config\Database::getConnection();
    $todoListRepository = new TodoListRepositoryImpl($connection);
    $todoListService = new TodoListServiceImpl($todoListRepository);
    $todoListService->addTodoList("Belajar PHP");
    $todoListService->addTodoList("Belajar PHP OOP");
    $todoListService->addTodoList("Belajar PHP Database");


    $todoListService->showTodoList();
}

function testAddTodoList(): void
{
    $connection = Config\Database::getConnection();
    $todoListRepository = new TodoListRepositoryImpl($connection);

    $todoListService = new TodoListServiceImpl($todoListRepository);
    $todoListService->addTodoList("Belajar PHP");
    $todoListService->addTodoList("Belajar PHP OOP");
    $todoListService->addTodoList("Belajar PHP Database");

    $todoListService->showTodoList();
}

function testRemoveTodoList(): void
{
    $connection = \Config\Database::getConnection();
    $todoListRepository = new TodoListRepositoryImpl($connection);

    $todoListService = new TodoListServiceImpl($todoListRepository);

    echo $todoListService->removeTodoList(5) . PHP_EOL;
    echo $todoListService->removeTodoList(4) . PHP_EOL;
    echo $todoListService->removeTodoList(3) . PHP_EOL;
    echo $todoListService->removeTodoList(2) . PHP_EOL;
    echo $todoListService->removeTodoList(1) . PHP_EOL;


}

testShowTodoList();
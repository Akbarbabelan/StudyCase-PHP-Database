<?php

namespace Repository {

    use Entity\TodoList;

    interface TodoListRepository {

        function save(TodoList $todoList): void;

        function remove(int $number): bool;

        function findAll(): array;
    }

    class TodoListRepositoryImpl implements TodoListRepository {

        public array $todoList = array();

        private \PDO $connection;

        public function __construct(\PDO $connection)
        {
            $this->connection = $connection;   
        }

        function save(TodoList $todoList): void
        {
            //$number = sizeof($this->todoList) + 1;
            //$this->todoList[$number] = $todoList;

            $sql = "INSERT INTO todoList(todo) VALUES (?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$todoList->getTodo()]);
        }

        function remove(int $number): bool
        {
          /*if($number > sizeof($this->todoList)) 
                    return false;
            }
        
            for($i = $number; $i < sizeof($this->todoList); $i++){
                $this->todoList[$i] = $this->todoList[$i + 1];
            }
        
            unset($this->todoList[sizeof($this->todoList)]);
        
            return true;*/

            $sql = "SELECT id FROM todoList WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$number]);
            
            if($statement->fetch()) {
                // todolist ada
                $sql  = "DELETE FROM todoList WHERE id = ?";
                $statement = $this->connection->prepare($sql);
                $statement->execute([$number]);
                return true;
            } else {
                // todolis tidak ada
                return false;
            }
        }
            function findAll(): array
            {
                //return $this->todoList;

                $sql = "SELECT id, todo FROM todoList";
                $statement = $this->connection->prepare($sql);
                $statement->execute();

                $result = [];

                $sql = "SELECT id, todo FROM todolist";
                $statement = $this->connection->prepare($sql);
                $statement->execute();

                $result = [];

                foreach ($statement as $row){
                    $result[] = new TodoList();
                }
                return $result;
                }
            }
    }
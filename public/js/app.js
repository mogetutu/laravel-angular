"use strict";
angular.module('todo-app', [])
    .controller('TodoCtrl', ['$scope', '$http', function ($scope, $http) {

        $http.get('/todos').success(function (todos) {
            $scope.todos = todos;
        });

        $scope.remaining = function () {
            var count = 0;

            angular.forEach($scope.todos, function (todo) {
                count += todo.completed ? 0 : 1;
            });

            return count;
        };

        $scope.addTodo = function (todo) {
            var todo = {
                title: $scope.newTodoText,
                completed: false
            };

            $scope.todos.push(todo);
            $http.post('/todos', todo);
            $scope.newTodoText = null; // Clear text field
        };

        $scope.completeTodo = function (todo) {
            var todo = {
                id: todo.id,
                title: todo.title,
                completed: (todo.completed ? 1 : 0)
            };
            $http.put('/todos/' + todo.id, todo);
        };

        $scope.deleteTodo = function (todo) {
            $scope.todos.pop(todo);
            $http.delete('/todos/' + todo.id);
        };
    }]);
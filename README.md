# Laravel Todo List API


### API should provide task management:
- get own tasks by filter
- create own task
- edit own task
- mark own task
- delete own task

### After getting the tasks list user can:
- filter by status
- filter by priority 
- filter by title, description (fulltext search)
- sort by createdAt, completedAt, priority - 
must be support sorting by two fields
Example: (priority desc, createdAt asc)

### User can't:
- change or remove another user tasks
- remove already done task
- mark as done if task has not completed subtasks

### Every task should have fields:
- status (todo, done)
- priority (1...5)
- title
- description
- createdAt
- completedAt

Also task can have subtasks, level of subtask is not limited

## Installation

1. Clone the repository:
    ```sh
    git clone git@github.com:commit-art/TodoListAPI.git
    ```
2. Run dev environment
    ```sh
    sudo docker-compose up -d
    ```

3. Install dependencies
    ```sh
    sudo docker exec php-fpm_todo_list composer install
    ```

4. Run database migrations & seeders
   ```env
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=todo_list
    DB_USERNAME=root
    DB_PASSWORD=root
   ``` 
   ```sh
    sudo docker exec php-fpm_todo_list php artisan migrate --seed
   ```

5. App key generate
    ```sh
    sudo docker exec php-fpm_todo_list php artisan key:generate
    ```
6. Update configs
    ```sh
    sudo docker exec php-fpm_todo_list php artisan optimize:clear
    ```


## Running tests

```sh
sudo docker exec php-fpm_todo_list php artisan test
```

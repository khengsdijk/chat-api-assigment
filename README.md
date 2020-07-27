# Bunq chat API assignment

This is my implementation of the Bunq Home assignment

I decided upon using the Lumen framework because of my previous experience with 
the Laravel framework. I was also interested in how Lumen differed from Laravel.

Even though the assignment was relatively small I decided upon using a framework because 
it makes interacting with the database a lot easier and results in more readable code.
The framework also makes it easier to expand the application when necessary. 

The database scheme can be found in the migration files in chat-api/database/migrations.

When calling the API to create entities the following JSON objects should be used:

For creating a user:
```
{
  "username": "bob",
}
```
The complete user object returned by the API when called:
```
{
    "user_id": 1,
    "username": "bob",
}
```


For sending a message:

```
{
  "sender": 1,
  "Receiver": 2,
  "content": "a message"
}
```
The complete user object returned by the API when called:
```
{
  "message_id": 1,
  "sender": 1,
  "Receiver": 2,
  "content": "a message",
  "timestamp": "2020-07-25 18:06:16"
}
```

The API supports the following endpoints:

| action         | url |      payload |
| ----------- | ----------- | ------- |
| Create a user | POST localurl/user | User JSON object  |
| get a list of all users | GET localurl/user  |   |
| get a specific user| GET localurl/user/{id} |   |
| get a specific user| GET localurl/user/{id} |   |
| get the messages sent to a user | GET localurl/user/{id}/messages |   |
| get the users that sent a message to the user | GET localurl/user/{id}/chats |   |
| get the messages sent by a specific user | GET localurl/user/{receiver_id}/messages/{sender_id} |   |
| send a message to a user | POST localurl/messages | Message JSON object  |
| get a list of the messages send using the API | GET localurl/messages |   |
the endpoints can also be located in routes/web.php

I used homestead as the development environment but its also easy to launch the app on the local system using:
php -S localhost:8000 -t public 


The data is stored in a sqlite database located in the directory database/chat-database.sqlite
This sqlite database already contains two users and two messages they sent to each other



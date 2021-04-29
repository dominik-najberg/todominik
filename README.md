As a user, I want to have an ability to see a list of tasks for my day, so that I can do them one by one.

```bash
./dev up
./dev init
```

I am trying my best to keep it as framework agnostic as possible. This is why I moved some classes to `\framework`.
I did not add more endpoints as you already see how I would do it.


You can try the CLI commands if you have the wish to do so:

```bash
./dev bin/console task:create "just a task"
./dev bin/console task:mark-as-done {uuid} 
```
